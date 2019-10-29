**Instalação do projeto**

1. Criar e configurar um novo arquivo .env a partir do .env.example com os dados do banco.

2. Executar: composer install

3. Executar: php artisan migrate --seed 
(tem que ser exatamente assim para criar o login inicial de admin)

4. Executar: php artisan key:generate

5. Executar: php artisan storage:link 

6. Agora só rodar: php artisan serve 

<br>
Fazer login:

Username:	admin@admin.com <br>
Password:	password 

<br>

