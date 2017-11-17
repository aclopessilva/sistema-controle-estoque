
# Instalar
-  git clone https://github.com/aclopessilva/sistema-controle-estoque.git
- entrar na pasta "sistema-controle-estoque"
- composer install

# Criar BD
Criar BD com nome sistema-controle-estoque

# Criar arquivo .env
pode ser baseado do ".env.example" e modificar a a configuracao de base de dados para o mysql local, 

# Criar chave para laravel
php artisan key:generate

# Criar as tabelas
php artisan migrate

# Ver os routes cadastrados
Para ver os routes com os verbos HTTP apontando a diferentes metodos dos controlers

php artisan route:list


## testes
os testes estao na pasta  test

### Rodar testes
vendor/phpunit/phpunit/phpunit ou
vendor/bin/phpunit

## links de ajuda
### exemplo para a criacao do trabalho
https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers

### adicionar suporte de helpers Html para o Laravel

https://laravelcollective.com/docs/master/html

composer require "laravelcollective/html":"^5.4.0"

### criar controller com estrutura CRUD
php artisan make:controller UserController --resource

### especificar uns routes automaticos para controllers de tipo resource
Route::resource('photos', 'PhotoController');



