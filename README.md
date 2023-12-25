# Desafio API de venda de ingressos 

O projeto foi desenvolvido utilizando as tecnologias:
- **[PHP](https://www.php.net/)**
- **[Laravel 10](https://laravel.com/)**
- **[Docker](https://www.docker.com/)**
- **[MySQL](https://www.mysql.com/)**
- **[Laravel Sanctum (Autenticações)](https://laravel.com/docs/10.x/sanctum)**

## Como executar o projeto

Clone o repositório: 
```
git clone https://github.com/pedrohenriquebrandao/rest-api-challenge
```

Acesse a pasta do projeto e inicialize o container do Docker: 
```
./vendor/bin/sail up -d
```
O projeto poderá ser acessado na rota `localhost`

Execute as migrations: 
```
./vendor/bin/sail php artisan migrate
```

Para acessar o ambiente do `phpmyadmin`, acesse a rota `localhost:8080` e utilize as credenciais:

```
user: sail
password: password 
```
Os endpoints da API podem ser utilizados a partir da rota `localhost/api/`

