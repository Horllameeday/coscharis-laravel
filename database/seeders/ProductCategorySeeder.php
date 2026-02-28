<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Accessory (no-battery)',
            'description' => 'eg. Charging Cables, Wired Earphones',
        ]);

        ProductCategory::create([
            'name' => 'Audio or Video',
            'description' => "eg. CD's, DVD's",
        ]);

        ProductCategory::create([
            'name' => 'Bags & Luggage',
            'description' => 'eg. Suitcases, Handbags',
        ]);

        ProductCategory::create([
            'name' => 'Books & Collectibles',
            'description' => 'eg. Books, Magazines',
        ]);

        ProductCategory::create([
            'name' => 'Building Materials',
            'description' => 'eg. Sand, Cement, Iron',
        ]);

        ProductCategory::create([
            'name' => 'Cameras',
            'description' => 'eg. Digital Cameras, DSLR\'s',
        ]);

        ProductCategory::create([
            'name' => 'Computers & Laptops',
            'description' => 'eg. Laptops, Displays, Desktops',
        ]);

        ProductCategory::create([
            'name' => 'Documents & Laptops',
            'description' => 'eg. Paper, Booklets',
        ]);

        ProductCategory::create([
            'name' => 'Dry Food & Supplements',
            'description' => 'eg. Protein Powder, Nuts',
        ]);

        ProductCategory::create([
            'name' => 'Fashion',
            'description' => 'eg. Hoodies, T-Shirts',
        ]);

        ProductCategory::create([
            'name' => 'Gaming',
            'description' => 'eg. Consoles, Portable Gaming Devices',
        ]);

        ProductCategory::create([
            'name' => 'Health & Beauty',
            'description' => 'eg. Lipstick, Lotions',
        ]);

        ProductCategory::create([
            'name' => 'Home Appliances',
            'description' => 'eg. Blender, Toaster',
        ]);

        ProductCategory::create([
            'name' => 'Home Décor',
            'description' => 'eg. Paintings, Figures',
        ]);

        ProductCategory::create([
            'name' => 'Jewelry',
            'description' => 'eg. Neckless, Bracelets',
        ]);

        ProductCategory::create([
            'name' => 'Mobile Phones',
            'description' => 'eg. iPhones, Androids',
        ]);

        ProductCategory::create([
            'name' => 'Pet Accessory',
            'description' => 'eg. Animal Toys, Collars',
        ]);

        ProductCategory::create([
            'name' => 'Sport & Leisure',
            'description' => 'eg. Footballs, Sporting Equipment',
        ]);

        ProductCategory::create([
            'name' => 'Tablets',
            'description' => 'eg. iPads, Kindles',
        ]);

        ProductCategory::create([
            'name' => 'Toys',
            'description' => 'eg. Legos, Dolls',
        ]);

        ProductCategory::create([
            'name' => 'Watches',
            'description' => 'eg. Wristwatches, Wall Clocks',
        ]);

        ProductCategory::create([
            'name' => 'Others',
            'description' => 'Any other item not in the category listed',
        ]);
    }
}
