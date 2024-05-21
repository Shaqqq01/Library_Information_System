<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book; // Import the Book model
use Illuminate\Support\Facades\DB; // Import DB facade

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use the create() method to insert records into the database
        Book::factory()->count(50)->create(); // Use the factory() method to generate fake data
    }
}
