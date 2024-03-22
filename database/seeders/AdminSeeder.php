<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin();

        $admin->name = 'Administrator';
        $admin->phone = '75999991111';
        $admin->socialNumber = '11122233300';
        $admin->password = bcrypt('12345678');

        $admin->save();

        $admin->assignRole('admin');
    }
}
