<?php

namespace Database\Seeders;

use Domain\Content\Models\Category;
use Domain\Content\Models\Post;
use Domain\Content\Models\Topic;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
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

        if (! $user || ! $customerSuccess || ! $digitalService || ! $salesMarketing) {
            return;
        }

        $topics = [
            [
                'category_id' => $customerSuccess->id,
                'title' => 'Construindo Relacionamentos Duradouros',
                'subtitle' => 'Discussão aberta sobre o tema de relacionamento com o cliente.',
                'content' => '<h1>Customer Success</h1><p>Customer Success é essencial para criar laços entre empresas e seus clientes, promovendo resultados positivos e retenção a longo prazo.</p><p>Entenda as necessidades do cliente, ofereça suporte proativo, monitore indicadores de sucesso.</p>',
                'image' => 'digital.jpg',
                'is_closed' => false,
            ],
            [
                'category_id' => $digitalService->id,
                'title' => 'A Importância do Calor Humano',
                'subtitle' => 'Como o atendimento digital pode ter empatia e proximidade.',
                'content' => '<h1>Atendimento Digital</h1><p>Mesmo em canais digitais, criar um atendimento caloroso faz a diferença. Saiba como encantar os clientes!</p><p>Seja humano, responda rapidamente, use a tecnologia a seu favor.</p>',
                'image' => 'digital.jpg',
                'is_closed' => false,
            ],
            [
                'category_id' => $salesMarketing->id,
                'title' => 'Estratégias para Retenção de Clientes',
                'subtitle' => 'Dicas para fidelizar clientes e melhorar o relacionamento.',
                'content' => '<h1>Fidelização</h1><p>Construir um relacionamento forte com clientes pode garantir a longevidade do negócio.</p><p>Ofereça valor contínuo, crie programas de fidelidade, escute o feedback dos clientes.</p>',
                'image' => 'insides.jpg',
                'is_closed' => false,
            ],
        ];

        foreach ($topics as $key => $topicData) {
            $topic = Topic::query()->updateOrCreate(
                ['title' => $topicData['title']],
                [
                    'user_id' => $user->id,
                    'category_id' => $topicData['category_id'],
                    'subtitle' => $topicData['subtitle'],
                    'content' => $topicData['content'],
                    'image' => $topicData['image'],
                    'is_closed' => $topicData['is_closed'],
                ],
            );

            Post::query()->updateOrCreate(
                [
                    'topic_id' => $topic->id,
                    'user_id' => $user->id,
                ],
                [
                    'comment' => "<p>Este é o conteúdo do post {$key} no tópico '{$topic->title}'.</p>",
                ],
            );
        }
    }
}
