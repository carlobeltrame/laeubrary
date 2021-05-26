<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller {
    public function index() {
        /** @var User $user */
        $user = Auth::user();
        return view('book.index', [
            'books' => $user->books()->orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function show(Book $book) {
        return view('book.show', [
            'book' => $book->load('borrowings')
        ]);
    }

    public function create() {
        return view('book.create');
    }

    public function store(Request $request) {
        Book::create($request->validate([
            'name' => 'required|max:255',
            'description' => '',
        ]) + ['user_id' => Auth::user()->id]);

        return redirect()->route('home');
    }

    public function update(Request $request, Book $book) {
        $book->update(Arr::only($request->validate([
            'name' => 'min:1|max:255',
            'description' => '',
        ]), ['name', 'description']));
        return redirect()->back();
    }
}
