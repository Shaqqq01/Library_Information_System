<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\BorrowRecord;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $totalCheckouts = BorrowRecord::count();

        $recentCheckouts = BorrowRecord::with(['book', 'member'])
            ->where('borrow_date', '>=', Carbon::now()->subDays(30))
            ->orderBy('borrow_date', 'desc')
            ->paginate(7); // Use paginate instead of take to support pagination

        return view('dashboard', compact('totalBooks', 'totalMembers', 'totalCheckouts', 'recentCheckouts'));
    }
}
