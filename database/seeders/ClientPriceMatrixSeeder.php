<?php

namespace Database\Seeders;

use App\Models\ClientPriceMatrix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientPriceMatrixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientPriceMatrix::create([
            'name' => 'Default Pricing',
            'default' => true,
        ]);

        ClientPriceMatrix::create([
            'name' => 'Cooperate Pricing (UBA)'
        ]);

        ClientPriceMatrix::create([
            'name' => 'Walk-In Customers'
        ]);

        ClientPriceMatrix::create([
            'name' => 'Hafeez Chambers'
        ]);

        ClientPriceMatrix::create([
            'name' => 'Chevron Inc'
        ]);
    }
}
