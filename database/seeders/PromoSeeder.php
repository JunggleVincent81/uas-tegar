<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        Promo::create([
            'code' => 'DISKON10',
            'discount' => 10,
            'is_active' => true,
        ]);
    }
}
