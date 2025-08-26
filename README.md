# atividade mapa de salvar localização

Aplicação Laravel para cadastrar, listar, visualizar, editar e excluir locais com mapa interativo (Leaflet).

🔧 Tecnologias

Laravel 10+, PHP 8.1+

MySQL/MariaDB ou SQLite

Leaflet + Bootstrap 5

# 📦 Instalação rápida
git clone <URL>
cd laravel-maps-app
composer install
cp .env.example .env
php artisan key:generate


Edite .env e configure o banco.
Depois:

php artisan migrate

# 🧭 Rotas principais

/ → redireciona para lista de locais

/locations → listar locais + mapa

# CRUD completo (create, show, edit, delete)

# 🗂️ Model & Migration

Model Location com campos:

name (obrigatório)

description, address, category (opcionais)

latitude, longitude (obrigatórios)

php artisan make:model Location -m
php artisan migrate

# 🖼️ Views

index: mapa + lista de locais

create/edit: formulário + clique no mapa para coordenadas

show: detalhes do local + marcador

# ▶️ Rodar
php artisan serve


Acesse: http://127.0.0.1:8000

* pagina inicial
<img width="1919" height="853" alt="image" src="https://github.com/user-attachments/assets/5a612ba5-7e80-4a93-8216-eb1bf4466194" />




- pagina de salvar

  <img width="1900" height="869" alt="image" src="https://github.com/user-attachments/assets/41e46bf5-4904-41eb-ab1f-cbdba29452ff" />

