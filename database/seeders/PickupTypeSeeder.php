<?php

namespace Database\Seeders;

use App\Models\PickupType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PickupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PickupType::create([
            'name' => 'Bike',
            'description' => 'Suitable to deliver items like Mobile Phones, Laptops, Mobile Accessories, Documents..etc',
        ]);

        PickupType::create([
            'name' => 'Car',
            'description' => 'Suitable to deliver items like Generator, Air condition, Standing Fan, Washing Machine..etc',
        ]);

        PickupType::create([
            'name' => 'Van',
            'description' => 'Suitable to deliver items like Generator, Air condition, Standing Fan, Washing Machine..etc',
        ]);

        PickupType::create([
            'name' => 'Truck',
            'description' => 'Suitable to deliver items like Office Equipment, Building Materials ..etc',
        ]);
    }
}
