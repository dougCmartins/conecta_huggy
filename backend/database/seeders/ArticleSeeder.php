<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Segment;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(1);

        $category1 = Category::find(1);
        $category2 = Category::find(2);
        $category3 = Category::find(3);

        $segment1 = Segment::find(1);
        $segment2 = Segment::find(2);
        $segment3 = Segment::find(3);

        if (!$user || !$category1 || !$category2 || !$category3 || !$segment1 || !$segment2 || !$segment3) {
            dump("Execute os seeders das categorias, usuários e segmentos primeiro.");
            return;
        }

        $articles = [
            [
                'user_id' => $user->id,
                'title' => 'Construindo Relacionamentos Duradouros',
                'subtitle' => 'O papel do Customer Success no sucesso do cliente.',
                'content' => '<h1>Customer Success</h1><p>Customer Success é essencial para criar laços entre empresas e seus clientes...</p>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$category1->id],
                'segments' => [$segment1->id, $segment2->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'Como Medir o Sucesso do Cliente',
                'subtitle' => 'Indicadores chave para o Customer Success.',
                'content' => '<h2>Métricas do Sucesso</h2><p>O sucesso do cliente pode ser medido através de KPIs como churn rate...</p>',
                'image' => 'digital.jpg',
                'published' => true,
                'categories' => [$category1->id],
                'segments' => [$segment1->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'Melhores Práticas para Customer Success',
                'subtitle' => 'Como impulsionar resultados positivos.',
                'content' => '<h2>Dicas de Customer Success</h2><p>1. Mantenha o foco no cliente...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$category1->id],
                'segments' => [$segment1->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'A Evolução do Atendimento Digital',
                'subtitle' => 'Como o digital transformou o atendimento.',
                'content' => '<h1>Atendimento Digital</h1><p>O atendimento digital conecta marcas e clientes em tempo real...</p>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$category2->id],
                'segments' => [$segment1->id, $segment2->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'Humanização no Atendimento Digital',
                'subtitle' => 'O toque humano em um mundo digital.',
                'content' => '<h2>Por que humanizar?</h2><p>Mesmo no ambiente digital, o toque humano é fundamental...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$category2->id],
                'segments' => [$segment2->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'Ferramentas de Atendimento Digital',
                'subtitle' => 'Plataformas que transformam o atendimento.',
                'content' => '<h2>Top Ferramentas</h2><ul><li>Chatbots com IA</li><li>CRMs avançados</li><li>Redes sociais</li></ul>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$category2->id],
                'segments' => [$segment2->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'Estratégias de Captura de Leads',
                'subtitle' => 'Como atrair o público certo.',
                'content' => '<h1>Marketing de Vendas</h1><p>Capturar leads é o primeiro passo para engajar...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$category3->id],
                'segments' => [$segment3->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'Engajamento em Campanhas de Vendas',
                'subtitle' => 'Crie campanhas irresistíveis.',
                'content' => '<h2>Engajamento que Converte</h2><p>Invista em campanhas interativas e conteúdo relevante...</p>',
                'image' => 'topic-1.jpg',
                'published' => true,
                'categories' => [$category3->id],
                'segments' => [$segment3->id],
            ],
            [
                'user_id' => $user->id,
                'title' => 'Como Encantar Clientes nas Vendas',
                'subtitle' => 'O segredo para fidelizar consumidores.',
                'content' => '<h2>Encantamento de Clientes</h2><p>O atendimento personalizado e o valor agregado...</p>',
                'image' => 'insides.jpg',
                'published' => true,
                'categories' => [$category3->id],
                'segments' => [$segment2->id, $segment3->id],
            ],
        ];

        foreach ($articles as $data) {
            $article = Article::create([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'subtitle' => $data['subtitle'],
                'content' => $data['content'],
                'image' => $data['image'],
                'published' => $data['published'],
            ]);

            if (isset($data['segments'])) {
                $article->segments()->sync($data['segments']);
            }

            if (isset($data['categories'])) {
                $article->categories()->sync($data['categories']);
            }
        }
    }
}
