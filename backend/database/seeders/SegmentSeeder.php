<?php

namespace Database\Seeders;

use App\Models\Segment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $segments = [
            [
                'name' => 'customer_success', 'description' => 'Canal de Relacionamento'
            ],
            [
                'name' => 'atendimento', 'description' => 'Canal de Atendimento'
            ],
            [
                'name' => 'marketing', 'description' => 'Canal de Vendas'
            ]
        ];

        foreach ($segments as $segment) {
            Segment::updateOrCreate(['name' => $segment['name']], $segment);
        }
    }
}
