<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller {
    public function index(Request $request) {
        $borrowers = Borrower::select('id', 'name');
        if ($request->query('query')) {
            $borrowers = $borrowers->where('name', 'LIKE', '%'.$request->query('query').'%');
        }
        return response()->json($borrowers->get());
    }
}
