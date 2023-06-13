<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i=0; $i < 10; $i++) { 
            # code...
            DB::table('products')->insert(
                [
                    'name_product'=>'product'.$i,
                    'price'=> 50,
                    'slug'=> 'slug' . ($i) ,
                ]);
         }
    }
}
