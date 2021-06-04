<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BorrowerController extends Controller {
    public function available(Request $request) {
        $borrowers = Borrower::select('id', 'name');
        if ($request->query('query')) {
            $borrowers = $borrowers->where('name', 'LIKE', '%'.$request->query('query').'%');
        }
        return response()->json($borrowers->get());
    }

    public function show(Borrower $borrower) {
        return view('borrower.show', [
            'borrower' => $borrower->load('borrowings', 'borrowings.book')
        ]);
    }

    public function update(Request $request, Borrower $borrower) {
        $borrower->update(Arr::only($request->validate([
            'name' => 'min:1|max:255',
        ]), ['name']));
        return redirect()->back();
    }
}
