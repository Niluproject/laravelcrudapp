<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
         {
            DB::table('users')->delete();
    
            $users = [
                ['name' => 'Nilesh', 'email' => 'niesh-v@gmail.com', 'password' => Hash::make('password')],
                ['name' => 'viks', 'email' => 'viksm@gmail.com', 'password' => Hash::make('password')],
                ['name' => 'Khushal', 'email' => 'khushal@gmail.com', 'password' => Hash::make('password')],
                ['name' => 'Nirmit', 'email' => 'nirmit@gmail.com', 'password' => Hash::make('password')]
            ];
    
            DB::table('users')->insert($users);
        }
    }
}
