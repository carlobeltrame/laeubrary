<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'borrower_id', 'returned_at'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['borrower'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function borrower() {
        return $this->belongsTo(Borrower::class);
    }
}
