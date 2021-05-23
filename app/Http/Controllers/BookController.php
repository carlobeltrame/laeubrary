<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index() {
        /** @var User $user */
        $user = Auth::user();
        return view('book.index', [
            'books' => $user->books
        ]);
    }

    public function show(Book $book) {
        return view('book.show', [
            'book' => $book
        ]);
    }
}
