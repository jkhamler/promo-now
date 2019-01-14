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
            'name' => 'jkhamler',
            'first_name' => 'Jon',
            'surname' => 'Hamler',
            'email' => 'jkhamler@gmail.com',
            'password' => Hash::make('j1k2h3bass')
        ]);

    }
}
