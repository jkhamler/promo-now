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
                ['id' => 1, 'name' => 'Tech', 'color' => '#009051'],
                ['id' => 2, 'name' => 'Billing', 'color' => '#005493'],
                ['id' => 3, 'name' => 'Helpdesk', 'color' => '#ff9300'],
                ['id' => 4, 'name' => 'F&H', 'color' => '#ff7e79'],
                ['id' => 5, 'name' => 'GDPR', 'color' => '#ff0000'],
                ['id' => 6, 'name' => 'GDPR Quiz', 'color' => '#ff0000'],
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

        /** @var \App\User $superAdminUser */
        $superAdminUser = \App\User::query()->where('name', 'jkhamler')->first();

        DB::table('ticketit_categories_users')
            ->insert(
                [
                    [
                        'category_id' => 3,
                        'user_id' => $serviceUser->id,
                    ],
                    [
                        'category_id' => 5,
                        'user_id' => $serviceUser->id,
                    ],
                    [
                        'category_id' => 4,
                        'user_id' => $fulfillmentUser->id,
                    ],
                    [
                        'category_id' => 1,
                        'user_id' => $superAdminUser->id,
                    ],
                    [
                        'category_id' => 2,
                        'user_id' => $superAdminUser->id,
                    ],
                    [
                        'category_id' => 3,
                        'user_id' => $superAdminUser->id,
                    ],
                    [
                        'category_id' => 4,
                        'user_id' => $superAdminUser->id,
                    ],
                    [
                        'category_id' => 5,
                        'user_id' => $superAdminUser->id,
                    ],
                ]
            );

    }
}
