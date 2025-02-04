## **Conecta Huggy - Documentação do Projeto**

### **Visão Geral**
O **Conecta Huggy** é um sistema desenvolvido em Laravel 11 e Vue 3. Ele visa integrar o Huggy com uma plataforma personalizada, permitindo o envio de dados de leads para o Zapier, e instegrado ao widget da huggy, além de gerenciar usuários, categorias e segmentos.

---

# Documentação da API

## Autenticação

### Login
**Endpoint:** `POST /login`

Autentica um usuário e retorna um token de acesso.

## Usuário

### Obter Usuário Autenticado
**Endpoint:** `GET /user`

**Autenticação:** Requer token `auth:sanctum`

**Retorno:** Dados do usuário autenticado.

### Criar Usuário
**Endpoint:** `POST /user`

**Parâmetros:**

```json
{
    "name": "string (obrigatório)",
    "email": "string (obrigatório, formato email)",
    "password": "string (obrigatório)",
    "segment_ids": ["array (obrigatório)"]
}
```

### Atualizar Usuário
**Endpoint:** `PUT /users/{user}` ou `PATCH /users/{user}`

**Autenticação:** Requer token `auth:sanctum`

**Parâmetros:**

```json
{
    "name": "string (obrigatório)",
    "email": "string (obrigatório, formato email)",
    "preference": {
        "is_subscribed": "boolean (opcional)",
        "segment_ids": ["array (opcional, ids válidos de segmentos)"]
    }
}
```

### Atualizar Preferências do Usuário
**Endpoint:** `PUT /user/preference`

**Parâmetros:** Apenas os itens presentes na requisição serão atualizados.

```json
{
    "preference": {
        "is_subscribed": "boolean (opcional)",
        "segment_ids": ["array (opcional, ids válidos de segmentos)"]
    }
}
```

## Segmentos

### Listar Segmentos
**Endpoint:** `GET /segments`

**Retorno:**

```json
[
    {
        "name": "customer_success",
        "description": "Canal de Relacionamento"
    },
    {
        "name": "atendimento",
        "description": "Canal de Atendimento"
    },
    {
        "name": "marketing",
        "description": "Canal de Vendas"
    }
]
```

## Categorias

### Listar Categorias
**Endpoint:** `GET /categories`

**Retorno:**

```json
[
    {
        "name": "Customer Success",
        "description": "Relacionamento entre organizações e seus clientes",
        "active": true
    },
    {
        "name": "Atendimento Digital",
        "description": "Calor humano é com a gente",
        "active": true
    },
    {
        "name": "Marketing de Vendas",
        "description": "Capturar, engajar, encantar",
        "active": true
    }
]
```

## Tópicos

### Listar Tópicos
**Endpoint:** `GET /topics`

**Retorno:**

```json
[
    {
        "user_id": 1,
        "category_id": 3,
        "title": "Estratégias para Retenção de Clientes",
        "subtitle": "Dicas para fidelizar clientes e melhorar o relacionamento.",
        "content": "<h1>Fidelização</h1><p>Construir um relacionamento forte com clientes pode garantir a longevidade do negócio.</p><p>Ofereça valor contínuo, crie programas de fidelidade, escute o feedback dos clientes.</p>",
        "image": "insides.jpg",
        "is_closed": false
    }
]
```

## Artigos

### Listar Artigos
**Endpoint:** `GET /articles`

**Retorno:**

```json
[
    {
        "user_id": 1,
        "title": "Como Encantar Clientes nas Vendas",
        "subtitle": "O segredo para fidelizar consumidores.",
        "content": "<h2>Encantamento de Clientes</h2><p>O atendimento personalizado e o valor agregado...</p>",
        "image": "insides.jpg",
        "published": true,
        "categories": [3],
        "segments": [2, 3]
    }
]
```

## Envio de Evento para Zapier

### Enviar Evento
**Endpoint:** `POST /widget-event`

**Autenticação:** Requer token `auth:sanctum`

**Parâmetros:**

```json
{
    "nome": "string (obrigatório)",
    "email": "string (obrigatório, formato email)"
}
```

**Processo:** Envia um evento para o Zapier na URL `https://hooks.zapier.com/hooks/catch/15892772/3r3hwiq/` com os dados:

```json
{
    "nome": "<nome>",
    "email": "<email>",
    "id_da_campanha": "701U600000JM6biIAD",
    "lead_source": "Teste"
}
```

**Retorno:** Resposta da API do Zapier.

---

### **Requisitos**
Antes de iniciar, verifique se você tem as seguintes ferramentas instaladas:

- **PHP** (versão 7.3 ou superior)
- **Composer** (para gerenciamento de dependências PHP)
- **Node.js** e **npm** (para o front-end com Vue 3)
- **MySQL** (usado como banco de dados)

---

### **Instalação**

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/usuario/conecta_huggy.git
   cd conecta_huggy
   ```

2. **Instale as dependências do backend (Laravel):**
   No diretório raiz do projeto:
   ```bash
   composer install
   ```

3. **Instale as dependências do frontend (Vue 3):**
   No diretório `frontend` ou onde o seu Vue 3 estiver:
   ```bash
   npm install
   ```

4. **Configuração do ambiente:**
   Copie o arquivo `.env.example` para `.env`:
   ```bash
   cp .env.example .env
   ```

   No arquivo `.env`, configure as variáveis de ambiente, especialmente para o banco de dados (MySQL):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=conecta-huggy
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Criação do banco de dados:**
   Certifique-se de que o banco de dados está criado no MySQL:
   ```sql
   CREATE DATABASE conecta-huggy;
   ```

6. **Executar migrações e seeders:**
   Execute as migrações para criar as tabelas no banco de dados e os seeders para popular com dados iniciais (usuários, categorias e segmentos):
   ```bash
   php artisan migrate --seed
   ```

Em caso de problemas recomendo rodar cada seeder separadamente pela sequência: UserSeeder, CategorySeeder, SegmentSeeder, ArticleSeeder, TopicSeeder.
   ```bash
   php artisan migrate db:seed --class SuaSeeder
   ```

   Isso irá rodar os seeders definidos em `Database\Seeders`, criando usuários, categorias e segmentos no banco de dados.

---

### **Rodando o Projeto**

1. **Iniciar o servidor backend (Laravel):**
   No diretório raiz:
   ```bash
   php artisan serve
   ```
   O servidor estará disponível em [http://localhost:8000](http://localhost:8000).

2. **Iniciar o servidor frontend (Vue 3):**
   No diretório `frontend` ou onde o Vue 3 estiver configurado:
   ```bash
   npm run dev
   ```
   O frontend estará disponível em [http://localhost:5173](http://localhost:5173) (porta padrão do Vue).

---

### **Endpoints da API (Backend)**

- **GET /api/user**
    - Retorna as informações do usuário logado (necessário token JWT no cabeçalho de autorização).

- **POST /api/widget-event**
    - Envia os dados de um lead para o Zapier, utilizando a integração com o Huggy.

---

### **Comandos de Artisan Úteis**

- **Rodar migrações:**
  ```bash
  php artisan migrate
  ```

- **Rodar seeders:**
  ```bash
  php artisan db:seed
  ```

- **Criar um novo seeder:**
  ```bash
  php artisan make:seeder NomeSeeder
  ```

- **Verificar a lista de rotas:**
  ```bash
  php artisan route:list
  ```

---

### **Estrutura do Projeto**

- **Backend (Laravel):**
    - `app/Http/Controllers`: Contém os controladores principais da API.
    - `app/Models`: Modelos Eloquent para interagir com o banco de dados.
    - `database/seeders`: Seeders para popular o banco com dados iniciais.
    - `routes/api.php`: Arquivo de rotas da API.
    - `.env`: Arquivo de configuração de ambiente (variáveis como banco de dados e chave de API).

- **Frontend (Vue 3):**
    - `src/components`: Componentes Vue usados para construir a interface do usuário.
    - `src/views`: Páginas principais do Vue.
    - `src/store`: Gerenciamento de estado usando Vuex (caso seja necessário).

---

### **Problemas Comuns**

1. **Erro CORS**: O projeto precisa de alteração no cors (apresentou erros), mas pode ser utilizado da maneira comum, instalando manualmente e subindo ambos os projetos.

2. **Banco de Dados**: Se o banco de dados não estiver criado ou configurado corretamente, execute o comando de criação do banco no MySQL.
 preparado para rodar o projeto **Conecta Huggy**, com Laravel 11 e Vue 3. Basta seguir as instruções de instalação e rodar os comandos de migração/seeders para configurar o banco de dados e inicializar a aplicação.
 3. **Sistema operaciona**: Caso utilize no windows a instalação padrão precisará do servidor apache
