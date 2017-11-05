
##instalar

#baixar as fontes e rodar
composer install


# criar arquivo .env com a configuracao de base de dados
# pode ser baseado do .env.example


#criar chave para laravel
php artisan key:generate

#criar as tabelas
php artisan migrate


#ver os routes definidos
php artisan route:list


## TESTES
# os testes estaso na pasta  test

#rodar testes
vendor/phpunit/phpunit/phpunit



##UTILS
# exemplo de criacao
https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers




# adicionar suporte html
# https://laravelcollective.com/docs/master/html
composer require "laravelcollective/html":"^5.4.0"
	

# criar controller com estrutura CRUD
php artisan make:controller UserController --resource

# especificar uns routes automaticos para controllers de tipo resource
Route::resource('photos', 'PhotoController');



