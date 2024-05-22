<?php

namespace App\Http\Controllers;

use App\Models\BorrowRecord;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BorrowRecordController extends Controller
{
    /**
     * Display a listing of the borrow records.
     */
    public function index(Request $request)
    {
        $query = BorrowRecord::with('book');

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchType = $request->input('search_type');

            if ($searchType == 'book_id') {
                $query->whereHas('book', function ($q) use ($search) {
                    $q->where('id', 'like', "%$search%");
                });
            } elseif ($searchType == 'ic_no') {
                $query->where('ic_no', 'like', "%$search%");
            }
        }

        $borrowRecords = $query->paginate(10);
        return view('borrow_records.index', compact('borrowRecords'));
    }




    /**
     * Show the form for creating a new borrow record.
     */
    public function create()
    {
        $books = Book::all();
        $members = Member::all();
        return view('borrow_records.create', compact('books', 'members'));
    }

    /**
     * Store a newly created borrow record in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);
        // Check if the book is currently borrowed
        if (BorrowRecord::where('book_id', $book->id)->whereNull('return_date')->exists()) {
            return back()->withErrors(['msg' => 'This book is currently borrowed.']);
        }

        BorrowRecord::create($request->all());

        return redirect()->route('borrow-records.index');
    }

    /**
     * Show the form for editing the specified borrow record.
     */
    public function edit(BorrowRecord $borrowRecord)
    {
        $books = Book::all();
        $members = Member::all();
        return view('borrow_records.edit', compact('borrowRecord', 'books', 'members'));
    }

    /**
     * Update the specified borrow record in storage.
     */
    public function update(Request $request, BorrowRecord $borrowRecord)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
        ]);

        $borrowRecord->update($request->all());

        return redirect()->route('borrow-records.index');
    }

    /**
     * Remove the specified borrow record from storage.
     */
    public function destroy(BorrowRecord $borrowRecord)
    {
        $borrowRecord->delete();

        return redirect()->route('borrow-records.index');
    }

    /**
     * Display the specified borrow record.
     */
    public function show(BorrowRecord $borrowRecord)
    {
        return view('borrow_records.show', compact('borrowRecord'));
    }



}
