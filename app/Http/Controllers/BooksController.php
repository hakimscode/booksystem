<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\BooksAuthor;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\BookCollection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::all();
        $result = $data;

        foreach ($result as $key => $data){
            $authors = BooksAuthor::join('authors', 'authors.id', '=', 'books_author.author_id')
            ->select('authors.name as name')
            ->where('book_id', $data->id)
            ->pluck('name')->toArray();

            $result[$key]['authors'] = implode(", ", $authors);
        }

        // dd($result);

        return view('books', ['books' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();

        return view('book-insert', ['authors' => $authors]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'year' => ['required'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        
        try {
            DB::beginTransaction();

            $book = new Book();
            $book->title = $request->input('title');
            $book->publisher = $request->input('publisher');
            $book->year = $request->input('year');
            
            if ($book->save()) {
                $authors = explode(',', $request->input('authors'));
            
                for($i=0; $i<count($authors); $i++){
                    $books_author = new BooksAuthor();
                    $books_author->author_id = $authors[$i];
                    $books_author->book_id = $book->id;
                    $books_author->save();
                }

                DB::commit();
                return redirect(route('books'));
            }
        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $authors = Author::all();

        $current_authors = BooksAuthor::join('authors', 'authors.id', '=', 'books_author.author_id')
            ->select('authors.id as id')
            ->where('book_id', $id)
            ->pluck('id')->toArray();

        return view('book-edit', ['book' => $book, 'authors' => $authors, 'current_authors' => implode(", ", $current_authors)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $book = Book::findOrFail($request->input('id'));

        $book->title = $request->input('title');
        $book->publisher = $request->input('publisher');
        $book->year = $request->input('year');

        if ($book->save()) {
            BooksAuthor::where('book_id', $request->input('id'))->delete();

            $authors = explode(',', $request->input('authors'));
            
            for($i=0; $i<count($authors); $i++){
                $books_author = new BooksAuthor();
                $books_author->author_id = $authors[$i];
                $books_author->book_id = $book->id;
                $books_author->save();
            }

            return redirect(route('books'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if($book->delete()){
            return redirect(route('books'));
        }
    }
}
