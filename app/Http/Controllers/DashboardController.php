<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\BorrowRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $totalCheckouts = BorrowRecord::count();
        $recentCheckouts = BorrowRecord::with(['book', 'member'])
            ->orderBy('borrow_date', 'desc')
            ->take(5)
            ->get();
        $recentBooks = Book::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('welcome', compact('totalBooks', 'totalMembers', 'totalCheckouts', 'recentCheckouts', 'recentBooks'));
    }
}
