<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberLibrary;

class MemberLibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Add seed data for member_libraries table
       MemberLibrary::create([
            'member_library_name' => 'Pamantasan ng Lungsod ng Pasig',
            'member_library_email' => 'example1@example.com',
        ]);

        MemberLibrary::create([
            'member_library_name' => 'Rizal High School',
            'member_library_email' => 'example2@example.com',
        ]);

        MemberLibrary::create([
            'member_library_name' => 'Pasig City Science High School',
            'member_library_email' => 'example2@example.com',
        ]);

        MemberLibrary::create([
            'member_library_name' => 'Pasig City Science Institute',
            'member_library_email' => 'example2@example.com',
        ]);

    }
}
