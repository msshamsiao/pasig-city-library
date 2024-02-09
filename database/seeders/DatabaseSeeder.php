<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(MemberLibrarySeeder::class);
        $this->call(AdminSeeder::class);
        \App\Models\Book::factory(50)->create();
        \App\Models\User::factory(10)->create();
    }
}
