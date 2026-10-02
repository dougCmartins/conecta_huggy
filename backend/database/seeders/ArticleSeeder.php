<?php

namespace Database\Seeders;

use Domain\Content\Models\Article;
use Domain\Content\Models\Category;
use Domain\Segment\Models\Segment;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->where('email', 'ana@conecta.test')->first();
        $customerSuccess = Category::query()->where('name', 'Customer Success')->first();
        $digitalService = Category::query()->where('name', 'Atendimento Digital')->first();
        $salesMarketing = Category::query()->where('name', 'Marketing de Vendas')->first();
        $relationship = Segment::query()->where('name', 'customer_success')->first();
        $service = Segment::query()->where('name', 'atendimento')->first();
        $marketing = Segment::query()->where('name', 'marketing')->first();

        if (! $user || ! $customerSuccess || ! $digitalService || ! $salesMarketing || ! $relationship || ! $service || ! $marketing) {
            return;
        }

        $articles = [
            [
                'title' => 'Construindo Relacionamentos Duradouros',
                'subtitle' => 'O papel do Customer Success no sucesso do cliente.',
                'content' => '<h1>Customer Success</h1><p>Customer Success é essencial para criar laços entre empresas e seus clientes...</p>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$customerSuccess->id],
                'segments' => [$relationship->id, $service->id],
            ],
            [
                'title' => 'Como Medir o Sucesso do Cliente',
                'subtitle' => 'Indicadores chave para o Customer Success.',
                'content' => '<h2>Métricas do Sucesso</h2><p>O sucesso do cliente pode ser medido através de KPIs como churn rate...</p>',
                'image' => 'digital.jpg',
                'published' => true,
                'categories' => [$customerSuccess->id],
                'segments' => [$relationship->id],
            ],
            [
                'title' => 'Melhores Práticas para Customer Success',
                'subtitle' => 'Como impulsionar resultados positivos.',
                'content' => '<h2>Dicas de Customer Success</h2><p>1. Mantenha o foco no cliente...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$customerSuccess->id],
                'segments' => [$relationship->id],
            ],
            [
                'title' => 'A Evolução do Atendimento Digital',
                'subtitle' => 'Como o digital transformou o atendimento.',
                'content' => '<h1>Atendimento Digital</h1><p>O atendimento digital conecta marcas e clientes em tempo real...</p>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$digitalService->id],
                'segments' => [$relationship->id, $service->id],
            ],
            [
                'title' => 'Humanização no Atendimento Digital',
                'subtitle' => 'O toque humano em um mundo digital.',
                'content' => '<h2>Por que humanizar?</h2><p>Mesmo no ambiente digital, o toque humano é fundamental...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$digitalService->id],
                'segments' => [$service->id],
            ],
            [
                'title' => 'Ferramentas de Atendimento Digital',
                'subtitle' => 'Plataformas que transformam o atendimento.',
                'content' => '<h2>Top Ferramentas</h2><ul><li>Chatbots com IA</li><li>CRMs avançados</li><li>Redes sociais</li></ul>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$digitalService->id],
                'segments' => [$service->id],
            ],
            [
                'title' => 'Estratégias de Captura de Leads',
                'subtitle' => 'Como atrair o público certo.',
                'content' => '<h1>Marketing de Vendas</h1><p>Capturar leads é o primeiro passo para engajar...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$salesMarketing->id],
                'segments' => [$marketing->id],
            ],
            [
                'title' => 'Engajamento em Campanhas de Vendas',
                'subtitle' => 'Crie campanhas irresistíveis.',
                'content' => '<h2>Engajamento que Converte</h2><p>Invista em campanhas interativas e conteúdo relevante...</p>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$salesMarketing->id],
                'segments' => [$marketing->id],
            ],
            [
                'title' => 'Como Encantar Clientes nas Vendas',
                'subtitle' => 'O segredo para fidelizar consumidores.',
                'content' => '<h2>Encantamento de Clientes</h2><p>O atendimento personalizado e o valor agregado...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$salesMarketing->id],
                'segments' => [$service->id, $marketing->id],
            ],
        ];

        foreach ($articles as $data) {
            $article = Article::query()->updateOrCreate(
                ['title' => $data['title']],
                [
                    'user_id' => $user->id,
                    'subtitle' => $data['subtitle'],
                    'content' => $data['content'],
                    'image' => $data['image'],
                    'published' => $data['published'],
                ],
            );

            $article->segments()->sync($data['segments']);
            $article->categories()->sync($data['categories']);
        }
    }
}
