<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersPermissionsSeeder::class);
        $this->call(PromotionsSeeder::class);
        $this->call(TierItemsSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(TicketItSeeder::class);
        $this->call(CountrySeeder::class);
    }
}
