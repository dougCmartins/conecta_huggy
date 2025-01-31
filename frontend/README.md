### **Visão Geral**
O **Conecta Huggy** é um sistema desenvolvido em Laravel 8 e Vue 3. Ele visa integrar o Huggy com uma plataforma personalizada, permitindo o envio de dados de leads para o Zapier, além de gerenciar usuários, categorias e segmentos.

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
   git clone https://github.com/usuario/conecta-huggy.git
   cd conecta-huggy
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
  php artisan db:seed --class=SuaSeeder
  
  UserSeeder
  CategorySeeder
  SegmentSeeder
  TopicSeeder
  ArticleSeeder
  ```
**UserSeeder senha padrão 123*
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

- **Problemas Comuns**
- Erro CORS: Você encontrar problemas de CORS ao fazer requisições do frontend para o backend usando o Docker, recomendo a instalação padrão.

- Caso opte em usar o Docker, adicione a configuração da url nas requisições do frontend.

- Banco de Dados: Se o banco de dados não estiver criado ou configurado corretamente, execute o comando de criação do banco no MySQL.