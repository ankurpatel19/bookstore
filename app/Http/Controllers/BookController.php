<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBook;
use App\Http\Requests\UpdateBook;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $defaultPage = $request->page ?: 1;
        $searchTxt = $request->search ?: '';
        return view('books.index', compact(['defaultPage', 'searchTxt']));
    }

    public function get_books(Request $request)
    {
        $ret = Book::select("books.*")
            ->orderBy('books.created_at', 'DESC');
        $search = $request->input('search');
        if (isset($search)) {
            $ret->search([
                'title',
                'author',
                'genre',
                'isbn',
                'published'
            ], $search);
        }
        $books = $ret->paginate(20);
        return $request->wantsJson()
            ? response()->json($books)
            : view('book', compact(['books']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $book = new Book();
        return view('books.create', compact(['book']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreBook $storeBook)
    {
        try {
            $book = new Book($request->toArray());
            $book->slug = Str::slug($request->title);
            $book->save();
        } catch (\Exception $e) {
            Log::error("Book Store" . ':' . $e->getMessage());
            abort(500, $e->getMessage());
        }
        $redirectURL = route('admin.books.index', ['page' => 1, 'search' => ""]);
        return $request->wantsJson()
            ? new JsonResponse(['status' => 'Success', 'redirect' => $redirectURL], 200)
            : redirect()->intended(route('admin.books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return $this->successResponse(new BookResource($book), 'Book retrieved successfully');
        /* return $request->wantsJson()
            ? new JsonResponse(['status' => 'Success', 'redirect' => $redirectURL], 200)
            : view('books.show', compact(['book'])); */
    }

    /**
     * Display the specified resource.
     *
     * @param  Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show_book(Book $book)
    {
        return view('show', compact(['book']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact(['book']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book, UpdateBook $updateBook)
    {
        $book->update($request->toArray());
        $page = $request->page ?: 1;
        $searchText = $request->search ?: '';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
