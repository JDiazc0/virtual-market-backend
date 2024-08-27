<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('promotions')->insert([
            [
                'promotion_name' => 'Beef free',
                'percentage' => 30,
                'id_product' => 1,
            ],
            [
                'promotion_name' => '10% final cost',
                'percentage' => 10,
                'id_product' => null,
            ],
            [
                'promotion_name' => '20% final cost',
                'percentage' => 20,
                'id_product' => null,
            ]
        ]);
    }
}
