<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Borrowing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => Book::inRandomOrder()->first()->id,
            'borrower_id' => Borrower::inRandomOrder()->first()->id,
        ];
    }
}
