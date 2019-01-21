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
               ['name' => 'Technical', 'color' => '#009051'],
               ['name' => 'Billing', 'color' => '#005493'],
               ['name' => 'Customer Services', 'color' => '#ff9300'],
               ['name' => 'Fulfilment', 'color' => '#ff7e79'],
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


    }
}
