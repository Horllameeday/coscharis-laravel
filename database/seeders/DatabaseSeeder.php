<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Abdullah',
            'last_name' => 'Busari',
            'email' => 'abdullah_busari@yahoo.com',
            'phone_number' => '08147885519'
        ]);

        $this->call([
            RolesAndPermissionsSeeder::class,
            PickupTypeSeeder::class,
            ProductCategorySeeder::class,
            VehicleSeeder::class,
            FaqSeeder::class,
            ClientPriceMatrixSeeder::class,
            PriceMatrixSeeder::class,
        ]);

        Shipment::factory(12)->create();
    }
}
