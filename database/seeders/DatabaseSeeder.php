<?php

namespace Database\Seeders;

use App\Enums\RequestsStatus;
use App\Enums\TeachersStatus;
use App\Models\Documents;
use App\Models\University;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('users')->truncate();
        DB::table('documents')->truncate();
        DB::table('master_requests')->truncate();
        DB::table('teachers')->truncate();
        $user = User::factory()->create([
            'name' => 'Test User',
            'last_name' => 'test',
            'email' => 'amirhosseinaminidev@gmail.com',
            'is_admin' => 1,
            'password' => bcrypt('password'),
        ]);

        $document = Documents::create([
            'major' => fake()->name,
            'education_level' => fake()->name,
        ]);

        $user->masterRequest()->create([
            'status' => RequestsStatus::INPROGRESS->value,
            'document_id' => $document->id
        ]);

        $user->teacher()->create([
            'status' => TeachersStatus::ACTIVE
        ]);
        $university = University::create([
            'name' => fake()->name
        ]);
    }
}
