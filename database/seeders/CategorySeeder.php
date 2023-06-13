<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //query builder

        for ($i=0; $i < 10; $i++) { 
            # code...
            DB::table('categories')->insert(
                [
                    'name'=>'category'.$i,
                    'created_at'=>now()
                ]
                );
        }

    }
}
