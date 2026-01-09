<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Table::create([
                'number' => 'MEJA-' . $i,
                'status' => 'available',
            ]);
        }
    }
}
