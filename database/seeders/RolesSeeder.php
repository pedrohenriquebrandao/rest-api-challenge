<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $producer = Role::create(['name' => 'producer', 'guard_name' => 'api']);
        $client = Role::create(['name' => 'client', 'guard_name' => 'api']);

        $createEvent= Permission::create(['name' => 'create event', 'guard_name' => 'api']);
        $editEvent = Permission::create(['name' => 'edit event', 'guard_name' => 'api']);
        $deleteEvent = Permission::create(['name' => 'delete event', 'guard_name' => 'api']);

        $createTicket = Permission::create(['name' => 'create ticket', 'guard_name' => 'api']);
        $editTicket = Permission::create(['name' => 'edit ticket', 'guard_name' => 'api']);
        $deleteTicket = Permission::create(['name' => 'delete ticket', 'guard_name' => 'api']);
        $buyTicket = Permission::create(['name' => 'buy ticket', 'guard_name' => 'api']);

        $createBatch= Permission::create(['name' => 'create batch', 'guard_name' => 'api']);
        $editBatch = Permission::create(['name' => 'edit batch', 'guard_name' => 'api']);
        $deleteBatch = Permission::create(['name' => 'delete batch', 'guard_name' => 'api']);

        $createCoupon = Permission::create(['name' => 'create coupon', 'guard_name' => 'api']);
        $editCoupon = Permission::create(['name' => 'edit coupon', 'guard_name' => 'api']);
        $deleteCoupon = Permission::create(['name' => 'delete coupon', 'guard_name' => 'api']);

        $createSector = Permission::create(['name' => 'create sector', 'guard_name' => 'api']);
        $editSector = Permission::create(['name' => 'edit sector', 'guard_name' => 'api']);
        $deleteSector = Permission::create(['name' => 'delete sector', 'guard_name' => 'api']);


        $editClient = Permission::create(['name' => 'edit client', 'guard_name' => 'api']);
        $deleteClient = Permission::create(['name' => 'delete client', 'guard_name' => 'api']);

        $adminPermissions = [
            $createEvent,
            $editEvent,
            $deleteEvent,
            $createTicket,
            $editTicket,
            $deleteTicket,
            $createBatch,
            $editBatch,
            $deleteBatch,
            $createCoupon,
            $editCoupon,
            $deleteCoupon,
            $createSector,
            $editSector,
            $deleteSector,
            $deleteClient
        ];

        $producerPermissions = [
            $createEvent,
            $editEvent,
            $deleteEvent,
            $createTicket,
            $editTicket,
            $deleteTicket,
            $createBatch,
            $editBatch,
            $deleteBatch,
            $createCoupon,
            $editCoupon,
            $deleteCoupon,
            $createSector,
            $editSector,
            $deleteSector,
        ];

        $clientPermissions = [
            $buyTicket,
            $editClient,
            $deleteClient
        ];

        $admin->syncPermissions($adminPermissions);
        $producer->syncPermissions($producerPermissions);
        $client->syncPermissions($clientPermissions);
    }
}
