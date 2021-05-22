<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        Book::factory(10)->create();
        Borrower::factory(10)->create();
        Borrowing::factory(10)->create();
    }
}
