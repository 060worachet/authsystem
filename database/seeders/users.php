<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        //
        $password = Hash::make('admin');
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}
