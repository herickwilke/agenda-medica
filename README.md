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

**Pendência**

1. Calendário como Google Calendar
2. Remover editar e excluir do atendimento e do paciente, adicionar uma observação (N observações)
3. Imprimir em sequencia um relatorio de todos os prontuários de um paciente específico, no cabeçalho os dados do paciente e anexos (extra)
4. Corrigir local de arquivos