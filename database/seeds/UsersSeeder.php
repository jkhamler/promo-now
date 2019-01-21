<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'pcheatle',
            'first_name' => 'Paul',
            'surname' => 'Cheatle',
            'email' => 'paul@promonow.com',
            'password' => Hash::make('123456'),
            'ticketit_admin' => 1,
        ]);

    }
}
