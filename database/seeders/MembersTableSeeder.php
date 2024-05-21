<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member; // Import the Member model
use Illuminate\Support\Facades\DB; // Import DB facade


class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use the create() method to insert records into the database
        Member::factory()->count(50)->create(); // Use the factory() method to generate fake data
    }
}
