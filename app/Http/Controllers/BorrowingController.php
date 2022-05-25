<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Models\Borrowing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function return(Borrowing $borrowing, Request $request) {
        $borrowing->update(['returned_at' => Carbon::now()]);
        if ($request->get('returnToBorrowing')) {
            return redirect()->to(route('books.show', ['book' => $borrowing->book->id]) . '#borrow');
        }
        return redirect()->back();
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
