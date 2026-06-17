<?php

namespace Database\Seeders;

use App\Models\Kurir;
use Illuminate\Database\Seeder;

class KurirIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kurirs = Kurir::whereNull('kurir_id')->get();

        foreach ($kurirs as $kurir) {
            $kurir->update([
                'kurir_id' => 'KRR' . str_pad($kurir->id, 6, '0', STR_PAD_LEFT)
            ]);
        }
    }
}
