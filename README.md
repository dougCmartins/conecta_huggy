## Conecta Huggy

O **Conecta Huggy** é a comunidade da Huggy: o visitante cria conta, escolhe segmentos de interesse e entra numa área com artigos, fórum e trilha de conteúdos. Depois do login, o widget da Huggy abre e o lead (nome e e-mail) segue para o Zapier.

O backend é Laravel 11 com PHP 8.2. O frontend é Vue 3 com Pinia. O banco é MySQL 8.0. A API devolve o objeto de dados no sucesso. O envelope com `message` e `code` aparece só quando um erro de domínio é lançado.

## Versões

| Peça | Versão |
| --- | --- |
| PHP | 8.2 (`php:8.2-cli` no container) |
| Laravel | 11 |
| Laravel Sanctum | 4 |
| Spatie Laravel Data | 4 |
| MySQL | 8.0 (`mysql:8.0`) |
| Node.js | 22 |
| Vue | 3.5 |
| Pinia | 2 |
| Vite | 6 |
| Vitest | 3 |

## Como subir

Na raiz do repositório:

```bash
docker compose up --build
```

O entrypoint do backend espera o MySQL, gera `APP_KEY` se faltar e roda `php artisan migrate`. O frontend instala as dependências e sobe o Vite.

| Serviço | Onde aceder |
| --- | --- |
| Frontend | http://localhost:5173 |
| API | http://localhost:8085/api |
| MySQL no host | `127.0.0.1:3307` |

Dentro da rede do Compose o MySQL escuta na porta `3306`, no host `mysql`.

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=conecta_huggy
DB_USERNAME=conecta
DB_PASSWORD=secret
```

A raiz do MySQL no container usa a senha `root`. O volume `mysql_data` guarda os dados entre reinícios.

O webhook do Zapier não fica no código. Defina no `backend/.env`:

```env
ZAPIER_WEBHOOK_URL=
ZAPIER_CAMPAIGN_ID=
ZAPIER_LEAD_SOURCE=Teste
```

## Dados iniciais

A migração sobe sozinha. Os seeders da comunidade rodam à parte, nesta ordem, porque artigo e tópico dependem do utilizador e das categorias:

```bash
docker compose exec backend php artisan db:seed --class=UserSeeder
docker compose exec backend php artisan db:seed --class=CategorySeeder
docker compose exec backend php artisan db:seed --class=SegmentSeeder
docker compose exec backend php artisan db:seed --class=ArticleSeeder
docker compose exec backend php artisan db:seed --class=TopicSeeder
```

`UserSeeder` grava a senha `123`. `php artisan db:seed` sem `--class` só corre o `DatabaseSeeder`, que cria um utilizador de teste e não chama os seeders acima.

## Fluxo da aplicação

1. Quem não está autenticado cai em `/guest`.
2. O registo (`POST /api/user`) pede nome, e-mail, senha e pelo menos um `segment_ids`.
3. O login (`POST /api/login`) devolve o token do Sanctum. O frontend guarda esse token e envia `Authorization: Bearer`.
4. Com sessão e sem inscrição, o guard manda para `/preference`.
5. A home, o fórum, os artigos e a trilha exigem autenticação.
6. Na primeira navegação autenticada, o widget da Huggy abre e `POST /api/widget-event` envia o lead ao Zapier.

## Estrutura

O domínio nasce no backend, em `backend/src/Domain/`. O frontend ocupa a pasta com o mesmo nome. Orchestrator e Shared não têm pasta no frontend.

```
backend/src/Domain/
  Auth/            login, token e envio do lead
  User/            utilizador, preferência e segmentos ligados à conta
  Segment/         catálogo de segmentos
  Content/         artigos, tópicos, categorias, comentários e posts
  Orchestrator/    fluxos que cruzam domínios (registo e preferências)
  Shared/          exceção de domínio

frontend/src/
  Auth/            Guest, Login, store, widget e teste
  User/            Register, Preferences, store e models
  Segment/         store, model e teste
  Content/         Home, Articles, Forum, Trail e stores
  ui/              layout e botão (não é domínio)
  router/          rotas, cliente HTTP e tag manager
```

Cada domínio do backend guarda `Actions`, `Controllers`, `Data`, `Models`, `Routes` e `Tests` quando o caso existe. O controller devolve o `Data` ou a `DataCollection`. A query e a relação do mesmo domínio ficam no model. O teste de feature fica em `Domain/{Nome}/Tests`. No frontend, o Vitest fica ao lado da store.

## API

Prefixo `/api`. Sucesso: o JSON é o próprio dado. Erro de domínio:

```json
{
  "data": null,
  "message": "mensagem",
  "code": "codigo",
  "status_code": 422,
  "errors": []
}
```

### Login

`POST /api/login`

```json
{ "email": "user@example.com", "password": "123456" }
```

Resposta: `{ "token": "..." }`.

### Utilizador

`GET /api/user` exige Sanctum.

```json
{
  "id": 1,
  "name": "Ana",
  "email": "ana@example.com",
  "is_subscribed": true,
  "segment_ids": [1, 2]
}
```

`POST /api/user`

```json
{
  "name": "Ana",
  "email": "ana@example.com",
  "password": "123456",
  "segment_ids": [1]
}
```

`PUT /api/users/{id}` e `PATCH /api/users/{id}` exigem Sanctum. Corpo: `name`, `email` e `password`, todos opcionais.

`PUT /api/user/preference`

```json
{
  "name": "Ana",
  "email": "ana@example.com",
  "is_subscribed": true,
  "segment_ids": [1, 3]
}
```

### Segmentos

`GET /api/segments` devolve uma lista:

```json
[
  { "id": 1, "name": "customer_success", "description": "Canal de Relacionamento" }
]
```

### Artigos e tópicos

`GET /api/articles?page=1&perPage=7`

`GET /api/topics?page=1&perPage=10`

`page` começa em 1. `perPage` vai de 1 a 100. A lista é o array do `Data`, com `author_name`. O tópico também traz `category_name`.

### Lead

`POST /api/widget-event` exige Sanctum.

```json
{ "name": "Ana", "email": "ana@example.com" }
```

O backend publica no webhook configurado com `nome`, `email`, `id_da_campanha` e `lead_source`. A resposta de sucesso é `{ "delivered": true }`.

## Testes

```bash
docker compose exec backend php artisan test --compact
docker compose exec frontend npx vitest run
```
