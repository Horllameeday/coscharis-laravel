<?php

namespace Database\Seeders;

use App\Models\PickupType;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bike_driver = User::create([
            'id' => Str::uuid(),
            'first_name' => 'bike',
            'last_name' => 'driver',
            'email' => 'bike@driver.com',
            'phone_number' => '+2348111111111',
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),
            'password' => 'password',
        ]);

        Vehicle::create([
            'id' => Str::uuid(),
            'user_id' => $bike_driver->id,
            'pickup_type_id' => PickupType::where('name', 'Bike')->firstOrCreate()->id,
            'make' => 'Qlink',
            'model' => 'Champion 200cc',
            'plate_number' => 'ABJ239LSR',
        ]);

        $car_driver = User::create([
            'id' => Str::uuid(),
            'first_name' => 'car',
            'last_name' => 'driver',
            'email' => 'car@driver.com',
            'phone_number' => '+2348222222222',
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),
            'password' => 'password',
        ]);

        Vehicle::create([
            'id' => Str::uuid(),
            'user_id' => $car_driver->id,
            'pickup_type_id' => PickupType::where('name', 'Car')->firstOrCreate()->id,
            'make' => 'Kia',
            'model' => 'Rio',
            'plate_number' => 'IKJ231HP',
        ]);

        $van_driver = User::create([
            'id' => Str::uuid(),
            'first_name' => 'van',
            'last_name' => 'driver',
            'email' => 'van@driver.com',
            'phone_number' => '+2348333333333',
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),
            'password' => 'password',
        ]);

        Vehicle::create([
            'id' => Str::uuid(),
            'user_id' => $van_driver->id,
            'pickup_type_id' => PickupType::where('name', 'Van')->firstOrCreate()->id,
            'make' => 'Ford',
            'model' => 'Transit',
            'plate_number' => 'SMK982JJ',
        ]);

        $truck_driver = User::create([
            'id' => Str::uuid(),
            'first_name' => 'truck',
            'last_name' => 'driver',
            'email' => 'truck@driver.com',
            'phone_number' => '+2348444444444',
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),
            'password' => 'password',
        ]);

        Vehicle::create([
            'id' => Str::uuid(),
            'user_id' => $truck_driver->id,
            'pickup_type_id' => PickupType::where('name', 'Truck')->firstOrCreate()->id,
            'make' => 'Mitsubishi',
            'model' => 'Canter',
            'plate_number' => 'EPE532JK',
        ]);
    }
}
