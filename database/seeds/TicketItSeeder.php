<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketItSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('ticketit_categories')
            ->insert([
                ['id' => 1, 'name' => 'Technical', 'color' => '#009051'],
                ['id' => 2, 'name' => 'Billing', 'color' => '#005493'],
                ['id' => 3, 'name' => 'Customer Services', 'color' => '#ff9300'],
                ['id' => 4, 'name' => 'Fulfilment', 'color' => '#ff7e79'],
            ]);

        DB::table('ticketit_priorities')
            ->insert([
                ['name' => 'Low', 'color' => '#009051'],
                ['name' => 'Normal', 'color' => '#005493'],
                ['name' => 'Critical', 'color' => '#ff9300'],
            ]);

        DB::table('ticketit_statuses')
            ->insert([
                ['name' => 'Pending', 'color' => '#009051'],
                ['name' => 'In Progress', 'color' => '#005493'],
                ['name' => 'Complete', 'color' => '#ff9300'],
            ]);

        /** @var \App\User $serviceUser */
        $serviceUser = \App\User::query()->where('name', 'cclark')->first();

        /** @var \App\User $fulfillmentUser */
        $fulfillmentUser = \App\User::query()->where('name', 'jdavies')->first();

        DB::table('ticketit_categories_users')
            ->insert([
                'category_id' => 3,
                'user_id' => $serviceUser->id,
            ]);

        DB::table('ticketit_categories_users')
            ->insert([
                'category_id' => 4,
                'user_id' => $fulfillmentUser->id,
            ]);


    }
}
