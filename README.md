# Laravel 12 - Auth & User CRUD with DDD

🚀 API RESTful desenvolvida com **Laravel 12**, aplicando **Domain-Driven Design (DDD)** e boas práticas de arquitetura.

## 📌 Funcionalidades
- Autenticação com Token (Laravel Passport)
- Rotas protegidas por middleware
- CRUD completo de usuários
- Aplicação de **DDD, DTOs, ValueObjects, Services e Repositories**

## 🛠️ Tecnologias
- Laravel 12
- Laravel Passport
- MySQL
- PHP 8.3
- Composer

## 📂 Estrutura DDD
- **Domain** → Entidades, Value Objects, Repositórios (contratos)
- **Application** → Casos de uso (DTOs)
- **Interfaces** → Controllers e rotas (API)

## 🚀 Como rodar o projeto
```bash
git clone https://github.com/felipezinedine/laravel11-ddd-user-api.git
cd laravel11-ddd-user-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
