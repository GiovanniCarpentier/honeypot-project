<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::create([
            'name' => "Appel",
            'price' => "0.99",
            'image' => "img/products/jonagold.jpg"
        ]);

        Product::create([
            'name' => "Worst",
            'price' => "3.99",
            'image' => "img/products/worst.jpg"
        ]);

        Product::create([
            'name' => "Coca-Cola",
            'price' => "2.00",
            'image' => "img/products/cola.jpg"
        ]);

        Product::create([
            'name' => "Lay's Chips paprika",
            'price' => "2.50",
            'image' => "img/products/chips.jpg"
        ]);

        Product::create([
            'name' => "Philips Airfryer",
            'price' => "99.99",
            'image' => "img/products/philips_air_fryer.jpg"
        ]);

        Product::create([
            'name' => "SmartScreen Tv",
            'price' => "232.24",
            'image' => "img/products/tv.jpg"
        ]);

        Product::create([
            'name' => "Iphone 12 mini",
            'price' => "737.00",
            'image' => "img/products/iphone.jpg"
        ]);

        Product::create([
            'name' => "Schaar 20 cm Titanium",
            'price' => "5.37",
            'image' => "img/products/schaar.jpg"
        ]);

        Product::create([
            'name' => "Page wc papier - 96 rollen",
            'price' => "30.00",
            'image' => "img/products/wc_rollen.jpg"
        ]);
    }
}
