<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new Client();

        $client->name = 'Nome do cliente';
        $client->phone = '75999991111';
        $client->socialNumber = '00011133344';
        $client->password = bcrypt('12345678');

        $client->save();

        $client->assignRole('client');
    }
}
