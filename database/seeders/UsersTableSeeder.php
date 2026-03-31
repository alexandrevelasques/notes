<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //with DB
        /*DB::table('users')->insert([
            [
                'username' => 'user1@email.com',
                'password' => bcrypt('abc123456'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'user2@email.com',
                'password' => bcrypt('abc123456'),
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'user3@email.com',
                'password' => bcrypt('abc123456'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ]);*/

        //using the Model
        $users = ['user1@email.com', 'user2@email.com', 'user3@email.com'];

        foreach ($users as $username) {
            User::create([
                'username' => $username,
                'password' => bcrypt('abc123456'),
                //'created_at' and 'updated_at' are generated automatically here.
            ]);
        }
    }
}
