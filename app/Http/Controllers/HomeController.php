<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function export_book_data()
    {
        $url = "https://fakerapi.it/api/v1/books";
        $queryString = ["_quantity" => 100];
        $books = $this->apiRequest($url, "GET", [], $queryString);
        foreach ($books->data as $book) {
            Book::updateOrCreate(
                [
                    'id' => $book->id
                ],
                [
                    'title' => $book->title,
                    'author' => $book->author,
                    'genre' => $book->genre,
                    'description' => $book->description,
                    'isbn' => $book->isbn,
                    'image' => $book->image,
                    'published' => $book->published,
                    'publisher' => $book->publisher,
                    'slug' => Str::slug($book->title)
                ]
            );
        }
        return redirect('/home')->with('success', "Import Done");
        //return view('home');
    }
}
