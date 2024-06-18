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
        $search = $request->input('search');
        $searchType = $request->input('search_type');
        $tab = $request->input('tab', 'checkedOut');

        // Query for checked out records
        $checkedOutQuery = BorrowRecord::with('book', 'member')
            ->whereNull('return_date')
            ->orderBy('created_at', 'desc');

        // Query for history records
        $historyQuery = BorrowRecord::with('book', 'member')
            ->whereNotNull('return_date')
            ->orderBy('created_at', 'desc');

        if ($search) {
            if ($searchType == 'book_id') {
                $checkedOutQuery->whereHas('book', function ($q) use ($search) {
                    $q->where('id', 'like', "%$search%");
                });
                $historyQuery->whereHas('book', function ($q) use ($search) {
                    $q->where('id', 'like', "%$search%");
                });
            } elseif ($searchType == 'ic_no') {
                $checkedOutQuery->whereHas('member', function ($q) use ($search) {
                    $q->where('ic_no', 'like', "%$search%");
                });
                $historyQuery->whereHas('member', function ($q) use ($search) {
                    $q->where('ic_no', 'like', "%$search%");
                });
            }
        }

        if ($tab == 'history') {
            $historyRecords = $historyQuery->paginate(7, ['*'], 'history');
            $checkedOutRecords = $checkedOutQuery->paginate(7, ['*'], 'checked-out');
        } else {
            $checkedOutRecords = $checkedOutQuery->paginate(7, ['*'], 'checked-out');
            $historyRecords = $historyQuery->paginate(7, ['*'], 'history');
        }

        return view('borrow_records.index', compact('checkedOutRecords', 'historyRecords', 'tab'));
    }














    /**
     * Show the form for creating a new borrow record.
     */
    public function create()
    {
        // Get all books that are not currently borrowed
        $books = Book::whereDoesntHave('borrowRecords', function ($query) {
            $query->whereNull('return_date');
        })->get();


        $members = Member::all();
        return view('borrow_records.create', compact('books', 'members'));
    }


    /**
     * Store a newly created borrow record in storage.
     */
// BorrowRecordController.php


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
