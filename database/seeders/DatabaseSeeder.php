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
        $out->writeln("Username=admin@admin.com");
        $out->writeln("password=password (literalmente)");

        $category1 = new Category([
            'name' => "Zapatos",
            'description' => "Todo tipo de Zapatos"
        ]);

        $category2 = new Category([
            'name' => "Chaquetas",
            'description' => "Todo tipo de Chaquetas"
        ]);


        $category3 = new Category([
            'name' => "Ofertas de Navidad",
            'description' => "Todo tipo de Ofertas de Navidad"
        ]);

        $category1->save();
        $category2->save();
        $category3->save();

        $out->writeln('3 Categories created! ');


        $product1 = new Product([
            'sku' => "Shoes-Black-US44",
            'name' => "Zapato de Tacon Negro",
            'price' => 35.6,
            'description' => "Tacones de exclusivos de Zara color negro para Mujer",
            'image' => "storage/products/tacon-negro.jpg",
            'stock' => 60
        ]);
        $product1->save();
        $product1->categories()->saveMany([$category1,$category3]);

        $product2 = new Product([
            'sku' => "Shoes-Black-Men-US45",
            'name' => "Zapato de vestir hombre",
            'price' => 50.6,
            'description' => "Zapato de vestir para hombre de color negro",
            'image' => "storage/products/zapato-hombre.png",
            'stock' => 30
        ]);
        $product2->save();
        $product2->categories()->save($category1);


        $product3 = new Product([
            'sku' => "Anorak-Beige-XXL",
            'name' => "Anorak de Deporte",
            'price' => 20.6,
            'description' => "Anorak Deportivo de color discreto",
            'image' => "storage/products/anorak-casual-jacket.jpg",
            'stock' => 25
        ]);
        $product3->save();
        $product3->categories()->saveMany([$category2,$category3]);











    }
}
