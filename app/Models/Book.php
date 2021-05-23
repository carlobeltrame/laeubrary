<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [ 'current_borrowing' ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function borrowings() {
        return $this->hasMany(Borrowing::class);
    }

    public function borrowers() {
        return $this->hasManyThrough(Borrower::class, Borrowing::class);
    }

    public function getCurrentBorrowingAttribute() {
        return $this->borrowings()->latest()->whereNull('returned_at')->first();
    }
}
