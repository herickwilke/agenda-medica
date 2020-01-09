# Instalação do projeto

1. Clonar o projeto;

2. Criar e configurar um novo arquivo .env a partir do .env.example com os dados do banco;

3. Na pasta raiz do projeto, executar em sequência: 

``` 
composer install
php artisan migrate --seed 
php artisan key:generate
php artisan storage:link

```

4. Após este procedimento, ir para "Área de trabalho" ou outro destino que não seja a raiz do projeto e clonar o repositório:
```
git clone https://repositorio.faers.com.br/herickwilke/vendor
```

5. Copiar a pasta clonada chamada "vendor" para a pasta raíz do trabalho. Confirmar para *substituir* os arquivos.

<br>

## Executar o projeto:

- Rodar o comando na raiz do projeto:

```
php artisan serve
```
## Fazer login: 
- Usuário: admin@admin.com
- Senha: password 

<br>
