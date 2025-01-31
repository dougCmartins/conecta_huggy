<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Customer Success', 'description' => 'Relacionamento entre organizações e seus clientes', 'active' => true
            ],
            [
                'name' => 'Atendimento Digital', 'description' => 'Calor humano é com a gente', 'active' => true
            ],
            [
                'name' => 'Marketing de Vendas', 'description' => 'Capturar, engajar, encantar', 'active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
