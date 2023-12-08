<?php

namespace Database\Seeders;

use App\Models\Producer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProducersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $producer = new Producer();

        $producer->name = 'PHP Eventos';
        $producer->phone = '75999991111';
        $producer->socialNumber = '11222333000101';
        $producer->password = bcrypt('12345678');

        $producer->save();

        $producer->assignRole('producer');
    }
}
