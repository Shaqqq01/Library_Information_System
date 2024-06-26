<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index(Request $request)
    {
        // Search for something similar to that
        $search = $request->input('search');
        $books = Book::where('title', 'like', "%{$search}%")
            ->orWhere('author', 'like', "%{$search}%")
            ->paginate(7);
        // dont understand the search
        return view('books.index', compact('books', 'search'));
    }


    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher_name' => 'required',
            'published_year' => 'required|integer',
            'category' => 'required',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher_name' => 'required',
            'published_year' => 'required|integer',
            'category' => 'required',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}
