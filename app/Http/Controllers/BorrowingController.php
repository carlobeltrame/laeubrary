<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function return(Borrowing $borrowing) {
        $borrowing->update(['returned_at' => Carbon::now()]);
        return redirect()->route('books.show', [ 'book' => $borrowing->book_id ]);
    }
}
