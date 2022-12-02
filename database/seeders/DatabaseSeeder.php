<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        $admin = User::factory(1)->create()->first;
        $out->writeln('Admin User created: '.$admin->toJson());
        $out->writeln("Username=email (del usuario creado)");
        $out->writeln("password=password (literalmente)");

        $customers = Customer::factory(5)->create();
        $out->writeln('5 Customers created! ');

        $categories = Category::factory(5)->create();

        $out->writeln('5 Categories created! ');


        $product1 = new Product([
            'sku' => "Shoes-Black-US44",
            'name' => "Zapato de Tacon Negro",
            'price' => 35.6,
            'description' => "Tacones de exclusivos de Zara color negro para Mujer",
            'image' => "storage/products/tacon-negro.jpg",
            'stock' => 60
        ]);
        $product1->save();
        $product1->categories()->save($categories[0]);


        $product2 = new Product([
            'sku' => "Anorak-Beige-XXL",
            'name' => "Anorak de Deporte",
            'price' => 20.6,
            'description' => "Anorak Deportivo de color discreto",
            'image' => "storage/products/anorak-casual-jacket.jpg",
            'stock' => 60
        ]);
        $product2->save();
        $product2->categories()->save($categories[1]);









    }
}
