<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Reset cached roles and permissions */
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /** Create Permissions */
        Permission::create(['name' => 'create service ticket']);
        Permission::create(['name' => 'comment on service ticket']);
        Permission::create(['name' => 'can see customer service tab']);
        Permission::create(['name' => 'can see promotions tab']);
        Permission::create(['name' => 'fulfill order']);

        $marketingRole = Role::create(['name' => 'marketing']);
        $marketingRole->givePermissionTo('comment on service ticket');
        $marketingRole->givePermissionTo('can see promotions tab');

        $customerServiceRole = Role::create(['name' => 'customer-service']);
        $customerServiceRole->givePermissionTo('can see customer service tab');

        $fulfillmentRole = Role::create(['name' => 'fulfillment']);
        $fulfillmentRole->givePermissionTo('fulfill order');

        /** Create roles and assign created permissions */
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        /** Users */
        $superAdminUser = new \App\User();

        $superAdminUser->id = 1000;
        $superAdminUser->name = 'jkhamler';
        $superAdminUser->first_name = 'Jon';
        $superAdminUser->surname = 'Hamler';
        $superAdminUser->email = 'jkhamler@gmail.com';
        $superAdminUser->password = Hash::make('123456');
        $superAdminUser->ticketit_agent = 1;
        $superAdminUser->ticketit_admin = 1;

        $superAdminUser->assignRole('super-admin');
        $superAdminUser->save();

        $marketingUser = new \App\User();

        $marketingUser->name = 'dsmith';
        $marketingUser->first_name = 'Dave';
        $marketingUser->surname = 'Smith';
        $marketingUser->email = 'dsmith@email.com';
        $marketingUser->password = Hash::make('123456');
        $marketingUser->ticketit_agent = 1;


        $marketingUser->assignRole('marketing');
        $marketingUser->save();

        $customerServiceUser = new \App\User();

        $customerServiceUser->name = 'cclark';
        $customerServiceUser->first_name = 'Charlotte';
        $customerServiceUser->surname = 'Clark';
        $customerServiceUser->email = 'cclark@email.com';
        $customerServiceUser->password = Hash::make('123456');
        $customerServiceUser->ticketit_agent = 1;

        $customerServiceUser->assignRole('customer-service');
        $customerServiceUser->save();

        $fulfillmentUser = new \App\User();

        $fulfillmentUser->name = 'jdavies';
        $fulfillmentUser->first_name = 'Jim';
        $fulfillmentUser->surname = 'Davies';
        $fulfillmentUser->email = 'jdavies@email.com';
        $fulfillmentUser->password = Hash::make('123456');
        $fulfillmentUser->ticketit_agent = 1;

        $fulfillmentUser->assignRole('fulfillment');
        $fulfillmentUser->save();
    }
}
