# Conecta Huggy API

Laravel 11 e PHP 8.2. A API fala com o MySQL do Compose e devolve um envelope em todas as rotas de domínio.

## Subir

Na raiz do repositório:

```bash
make up
```

- API: http://localhost:8085
- MySQL no host: porta 3307
- Vite: http://localhost:5173

Outros comandos: `make migrate`, `make test`, `make logs`, `make down`, `make shell-api`.

O entrypoint copia `backend/.env.example` quando não existe `.env`, instala o Composer, gera `APP_KEY` se estiver vazio e roda as migrations. A senha do banco fica no ambiente do Compose, não no código.

## Envelope

```json
{
  "data": {},
  "message": "Segments listed successfully.",
  "code": "SEGMENTS_LISTED",
  "status_code": 200,
  "errors": []
}
```

## Onde está o código

| Contexto | Pasta | Rotas |
| --- | --- | --- |
| Segment | `src/Domain/Segment` | `GET /api/segments` |
| Article | `src/Domain/Article` | `GET /api/articles` |
| Topic | `src/Domain/Topic` | `GET /api/topics` |
| Auth | `src/Domain/Auth` | `POST /api/login`, `POST /api/widget-event` |
| User | `src/Domain/User` | `GET /api/user`, `POST /api/user`, `PUT /api/users/{id}`, `PUT /api/user/preference` |
| Orchestrator | `src/Domain/Orchestrator/Auth` | registo e preferências, porque ligam utilizador e segmentos |

Cada Action faz uma tarefa. O controller valida a Data class e devolve o envelope. Registo e atualização de preferências passam pelo Orchestrator: ele confirma os segmentos e só então grava o utilizador. A preferência (`is_subscribed` e `segment_ids`) é atributo do utilizador.

`POST /api/widget-event` exige token Sanctum. A URL do Zapier vem de `ZAPIER_WEBHOOK_URL` e `ZAPIER_CAMPAIGN_ID` no ambiente.

Category, Comment, Post, Like e View continuam em `app/Models`. Não têm rota nesta leva.
