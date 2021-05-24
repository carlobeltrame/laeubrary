<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function return(Borrowing $borrowing) {
        $borrowing->update(['returned_at' => Carbon::now()]);
        return redirect()->route('books.show', [ 'book' => $borrowing->book_id ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'borrower_id' => 'nullable|numeric',
            'new_borrower_name' => 'nullable|max:255',
            'book_id' => 'required|numeric',
        ]);

        if (!isset($data['borrower_id']) || !$data['borrower_id']) {
            $borrower = Borrower::create(['name' => $data['new_borrower_name']]);
            unset($data['new_borrower_name']);
            $data['borrower_id'] = $borrower->id;
        }

        $borrowing = Borrowing::create($data);

        return redirect()->route('books.show', [ 'book' => $borrowing->book_id ]);
    }
}
