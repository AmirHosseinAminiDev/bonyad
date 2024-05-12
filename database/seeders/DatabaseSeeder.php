<?php

namespace Database\Seeders;

use App\Enums\RequestsStatus;
use App\Models\Documents;
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
    }
}
