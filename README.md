<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Projecto To Do List(API)

## Pré-requisitos

-   [Git](https://git-scm.com/)
-   [Composer](https://getcomposer.org/)
-   [PHP](https://www.php.net/) (versão 8.0 ou superior)
-   [Node.js](https://nodejs.org/)
-   Um servidor de banco de dados como [MySQL](https://www.mysql.com/) ou [PostgreSQL](https://www.postgresql.org/)

## Instalação

1. Clonar o projeto do GitHub

    ```sh
    git clone https://github.com/Dumilson/back-end-task.git
    cd back-end-task
    ```

2. Instalar as dependências
    ```sh
    composer install
    ```

## Configuração

### 1. Configurar o .env

Renomeie o arquivo `.env.example` para `.env`:

```sh
cp .env.example .env
```

Gere uma chave de aplicativo Laravel:

```sh
php artisan key:generate
```

### 2. Configurar o banco de dados

Abra o arquivo `.env` e configure as seguintes variáveis de ambiente de acordo com seu servidor de banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco_de_dados
DB_USERNAME=seu_usuário
DB_PASSWORD=sua_senha
```

### 3. Migrar o banco de dados e rodar os seeders

Execute as migrações para criar as tabelas no banco de dados:

```sh
php artisan migrate
```

Em seguida, execute o seeder para adicionar os usuários ao banco de dados:

```sh
php artisan db:seed
```

### 4. credencias criadas automaticamente

-   **Credencias**
    -   Nome: Admin Admin
    -   Email: admin@gmail.com
    -   Senha: 12345678

Certifique-se de que o servidor do banco de dados está em execução e as credenciais configuradas no arquivo `.env` são corretas.

### 5. Iniciar o servidor de desenvolvimento

Finalmente, inicie o servidor de desenvolvimento do Laravel:

```sh
php artisan serve
```

A aplicação estará disponível em [http://localhost:8000](http://localhost:8000).
