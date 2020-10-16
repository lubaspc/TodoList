<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->insertGetId([
            'user' => 'lubin',
            'password' => Hash::make('prueba'),
            'api_token' => 'prueba',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('notes')->insert([
            [
                'title' => 'Nueva nota',
                'text' => 'Super nota',
                'programed' => null ,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'title' => 'Nota programada',
                'text' => 'Text....',
                'programed' => now()->addDay(),
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
