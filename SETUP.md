# SOS PET - Laravel Frontend Setup

## Descrição
Frontend completo para o site SOS PET - Patinhas Carentes, desenvolvido com Laravel, Tailwind CSS, Blade Templates e Leaflet Maps.

## Estrutura do Projeto

### 📁 Arquivos Criados

#### Controllers
- `app/Http/Controllers/HomeController.php` - Controlador da página inicial
- `app/Http/Controllers/AdminAuthController.php` - Autenticação do admin (placeholder)
- `app/Http/Controllers/AdminDashboardController.php` - Dashboard do admin

#### Middlewares
- `app/Http/Middleware/AdminAuthMiddleware.php` - Proteção de rotas do admin

#### Views (Blade Templates)
- `resources/views/layouts/app.blade.php` - Layout principal
- `resources/views/layouts/navbar.blade.php` - Componente navbar
- `resources/views/home.blade.php` - Página inicial com mapa interativo
- `resources/views/admin/login.blade.php` - Página de login do admin
- `resources/views/admin/dashboard.blade.php` - Dashboard do admin

#### CSS
- `resources/css/app.css` - Estilos customizados com Tailwind

#### Config
- `tailwind.config.js` - Configuração do Tailwind CSS
- `routes/web.php` - Todas as rotas da aplicação

## 🚀 Como Iniciar

### 1. Pré-requisitos
- PHP 8.2+
- Composer
- Node.js 16+
- npm ou yarn

### 2. Instalação

```bash
# Instalar dependências PHP
composer install

# Instalar dependências Node
npm install

# Copiar .env
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Compilar assets (Tailwind + Vite)
npm run dev
