# Gerador de CRUDs para Laravel

## Instalar e configurar um aplicativo

## Instalar gerador
composer require ribafs/crud-generator --dev

## Publicar
    php artisan vendor:publish --provider="Ribafs\CrudGenerator\CrudGeneratorServiceProvider"

## Criar os CRUDs

Usar o nome do CRUD no singular e após a criação renomear as pastas das views para o plural (seguindo a convenção do laravel)

### Na pasta raiz
```bash
php artisan crud:generate User --fields='name#string; email#string; password#string;' --view-path='' --controller-namespace=App\\Http\\Controllers --route-group='' --form-helper=html

php artisan crud:generate Role --fields='name#string; slug#string;' --view-path='' --controller-namespace=App\\Http\\Controllers --route-group='' --form-helper=html

php artisan crud:generate Permission --fields='name#string; slug#string;' --view-path='' --controller-namespace=App\\Http\\Controllers --route-group='' --form-helper=html

php artisan crud:generate Client --fields='name#string; email#string;' --view-path='' --controller-namespace=App\\Http\\Controllers --route-group='' --form-helper=html

php artisan crud:generate Product --fields='name#string; price#decimal;' --view-path='' --controller-namespace=App\\Http\\Controllers --route-group='' --form-helper=html
```

### Na pasta admin
```bash
php artisan crud:generate Client --fields='name#string; email#string;' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --route-group=admin --form-helper=html
```
