<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Classes;
use App\Models\School;
use Artisan;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('migrate:refresh');
        Artisan::call('migrate:fresh');
        Artisan::call('optimize:clear');
        DB::table('schools')->insert([
            'name' => 'Admin User',
            'role' => 'Admin',
            'email' => 'admin@gamil.com',
            'password' => bcrypt('admin@gamil.com'), // You might want to use Hash::make() if you're using Laravel 8+
            'school_name' => 'Example School',
            'school_id' => Str::uuid(),
            'address' => '123 Example Street',
            'city' => 'Example City',
            'pin_code' => '123456',
            'mobile_number' => '1234567890',
            'whatsapp_number' => '9876543210',
            'verify_status' => true,
            'affiliation_level' => 'High School',
            'board_type' => 'State Board',
            'opt_code' => '12345',
            'notes' => 'This is a sample user.'
        ]);
        $classes = [
            ['name' => 'Nursery', 'has_stream' => rand(0, 1)],
            ['name' => 'LKG', 'has_stream' => rand(0, 1)],
            ['name' => 'UKG', 'has_stream' => rand(0, 1)],
            ['name' => '1st Grade', 'has_stream' => rand(0, 1)],
            ['name' => '2nd Grade', 'has_stream' => rand(0, 1)],
            ['name' => '3rd Grade', 'has_stream' => rand(0, 1)],
            ['name' => '4th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '5th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '6th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '7th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '8th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '9th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '10th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '11th Grade', 'has_stream' => rand(0, 1)],
            ['name' => '12th Grade', 'has_stream' => rand(0, 1)],
        ];

        foreach ($classes as $class) {
            $class['school_id'] = School::find(1)->school_id ?? '';
            $createdClass = Classes::create($class);

            // Create sections A, B, C for each class
            $sections = ['A', 'B', 'C'];
            foreach ($sections as $section) {
                $createdClass->sections()->create(['name' => $section, 'school_id' => School::find(1)->school_id ?? '']);
            }
        }

        $classes = Classes::where('has_stream', 1)->where('school_id', School::find(1)->school_id ?? '')->get();
        foreach ($classes as $class) {
            $sections = ['Stream 1', 'Stream 3', 'Stream 2'];
            foreach ($sections as $section) {
                $class->streams()->create(['name' => $section, 'school_id' => School::find(1)->school_id ?? '']);
            }
        }
    }
}
