<?php

namespace Database\Seeders;

use App\Enums\PriceMatrixCategory;
use App\Enums\PriceMatrixType;
use App\Models\ClientPriceMatrix;
use App\Models\PickupType;
use App\Models\PriceMatrix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceMatrixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /// Default Pricing \\\

        // Bike
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 120,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 250,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 500,
        ]);

        // Car
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 200,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 1500,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 600,
        ]);

        // Van
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 280,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 2100,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 700,
        ]);

        // Truck
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 300,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 2800,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Default Pricing')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 1043.33,
        ]);



        /// Cooperate Pricing (UBA) \\\

        // Bike
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 60,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 125,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.0075,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 300,
        ]);

        // Car
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 100,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 750,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.0075,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 350,
        ]);

        // Van
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 150,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 1050,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.0075,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 400,
        ]);

        // Truck
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 200,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 2000,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.0075,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Cooperate Pricing (UBA)')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 600,
        ]);




        /// Walk-In Customers \\\

        // Bike
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 120,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 250,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 500,
        ]);

        // Car
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 200,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 1500,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 600,
        ]);

        // Van
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 280,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 2100,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 700,
        ]);

        // Truck
        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::DISTANCE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 300,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::WEIGHT->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 2800,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::INSURANCE->value,
            'type'                      => PriceMatrixType::PERCENTAGE->value,
            'price'                     => 0.015,
        ]);

        PriceMatrix::create([
            'client_price_matrix_id'    => ClientPriceMatrix::where('name', 'Walk-In Customers')->firstOrCreate()->id,
            'pickup_type_id'            => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'category'                  => PriceMatrixCategory::ADMINISTRATIVE->value,
            'type'                      => PriceMatrixType::FLAT->value,
            'price'                     => 1043.33,
        ]);
    }
}
