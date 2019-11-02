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
- Fazer login:
```
Usuário: admin@admin.com
Senha: password 
```
<br>

**Pendências**

1. Calendário como Google Calendar
2. Remover editar e excluir do atendimento e do paciente, 
3. Adicionar observações, que fiquem como "avisos" (N observações)
4. Imprimir em sequencia um relatorio de todos os prontuários de um paciente específico, no cabeçalho os dados do paciente e anexos (extra)
5. Corrigir visualização de documentos.