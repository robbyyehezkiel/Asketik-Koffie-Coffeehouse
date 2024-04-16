<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Coffee;
use App\Models\User;
use App\Models\Coupon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user12345',
            'usertype' => 'customer',
        ]);


        User::factory()->create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => 'customer12345',
            'usertype' => 'customer',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin12345',
            'usertype' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => 'superadmin12345',
            'usertype' => 'superadmin',
        ]);

        $coffees = [
            ['name' => 'Espresso', 'price' => 35000, 'description' => 'A concentrated coffee beverage brewed by forcing hot water under pressure through finely-ground coffee beans.', 'image' => 'img/products/shop_product.jpg'],
            [
                'name' => 'Cappuccino', 'price' => 45000, 'description' => 'An espresso-based coffee drink that originated in Italy, and is traditionally prepared with double espresso, hot milk, and steamed milk foam.',
                'image' => 'img/products/shop_product.jpg'
            ],
            [
                'name' => 'Latte', 'price' => 50000, 'description' => 'A coffee drink made with espresso and steamed milk.',
                'image' => 'img/products/shop_product_1.jpg'
            ],
            [
                'name' => 'Americano', 'price' => 40000, 'description' => 'A type of coffee drink prepared by diluting an espresso with hot water, giving it a similar strength to, but different flavor from, traditionally brewed coffee.',
                'image' => 'img/products/shop_product.jpg'
            ],
            [
                'name' => 'Macchiato', 'price' => 45000, 'description' => 'An espresso coffee drink with a small amount of milk, usually foamed.',
                'image' => 'img/products/shop_product_2.jpg'
            ],
            [
                'name' => 'Mocha', 'price' => 55000, 'description' => 'A chocolate-flavored variant of a latte.',
                'image' => 'img/products/shop_product_1.jpg'
            ],
            [
                'name' => 'Flat White', 'price' => 55000, 'description' => 'A coffee drink consisting of espresso with microfoam (steamed milk with small, fine bubbles and a glossy or velvety consistency).',
                'image' => 'img/products/shop_product_1.jpg'
            ],
            [
                'name' => 'Affogato', 'price' => 60000, 'description' => 'A coffee-based dessert consisting of a scoop of vanilla gelato or ice cream topped or "drowned" with a shot of hot espresso.',
                'image' => 'img/products/shop_product_2.jpg'
            ],
            [
                'name' => 'Irish Coffee', 'price' => 70000, 'description' => 'A cocktail consisting of hot coffee, Irish whiskey, and sugar, stirred, and topped with cream.',
                'image' => 'img/products/shop_product_1.jpg'
            ],
            [
                'name' => 'Turkish Coffee', 'price' => 55000, 'description' => 'A traditional method of preparing unfiltered coffee, brewed by boiling finely powdered roast coffee beans in a pot (cezve), possibly with sugar, and serving it into a cup, where the grounds are allowed to settle.',
                'image' => 'img/products/shop_product_2.jpg'
            ],
        ];

        foreach ($coffees as $coffeeData) {
            Coffee::factory()->create([
                'name' => $coffeeData['name'],
                'price' => $coffeeData['price'],
                'description' => $coffeeData['description'],
                'image' => $coffeeData['image'],
            ]);
        }

        Coupon::create([
            'code' => 'SAVE10',
            'type' => 'percentage',
            'value' => 10,
            'max_uses' => 100,
            'expiry_date' => Carbon::now()->addMonths(6), // Expires in 6 months
        ]);

        Coupon::create([
            'code' => 'GET20OFF',
            'type' => 'fixed_amount',
            'value' => 20,
            'max_uses' => 50,
            'expiry_date' => Carbon::now()->addYear(), // Expires in 1 year
        ]);

        //Coffee::factory()->count(10)->create();
    }
}
