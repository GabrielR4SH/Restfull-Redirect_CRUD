Este é um projeto desenvolvido em Laravel para gerenciar redirecionamentos de URLs, incluindo estatísticas de acesso. O projeto permite a criação de redirecionamentos personalizados e o registro de acessos a esses redirecionamentos, fornecendo informações detalhadas sobre os acessos.

## Estrutura do Projeto

O projeto está estruturado da seguinte forma:

- **app/**: Contém o código fonte da aplicação Laravel, incluindo models, controllers, e Service que trabalha junto com o Controller.

- **config/**: Contém arquivos de configuração da aplicação Laravel.
- **database/**: Contém as migrations e seeders do banco de dados.
- **resources/**: Contém as views, arquivos de tradução e outros recursos da aplicação.
- **routes/**: Contém os arquivos de definição de rotas da API.
- **tests/**: Contém os testes automatizados da aplicação.
- **vendor/**: Contém as dependências do projeto gerenciadas pelo Composer.

## Configuração do Ambiente

Para configurar o ambiente de desenvolvimento, siga os seguintes passos:

1. Clone o repositório
2. Instale as dependências do Composer: `composer install`
3. Copie o arquivo de configuração `.env.example` para `.env` e configure as variáveis de ambiente, incluindo a conexão com o banco de dados.
4. Inicie o projeto: `php artisan serve`
5. Execute as migrations + Seeders: `php artisan migrate --seed`


## Executando a Aplicação

Com o comando `php artisan serve`. A aplicação estará disponível em `http://localhost:8000`.

## Testes Automatizados

Os testes automatizados da aplicação podem ser executados com o comando `php artisan test`. Certifique-se de que o ambiente esteja configurado corretamente antes de executar os testes.
# APÓS O `php artisan test` é necessario atualizar a migração para recuperar dados. digite `php artisan migrate:refresh --seed`


## ENDPOINTS explicados com POSTMAN
- Para resgatar todos os dados: 
<br>
(GET) localhost:8000/api/redirects
- Para resgatar apenas um dado especificado: 
<br>
(GET) localhost:8000/api/redirects/{code}
O retorno não exibe o ID, o Code é usado para especificar um retorno único:
- Para atualizar um dado específico: 
<br>
(PUT) localhost:8000/api/redirects/{code}
Passe no corpo da requisição em JSON os dados que serão atualizados
OBS: *SE VOCE DEIXER ATIVO = 0 NÃO TERÁ REDORECT*
- Para deletar um dado: 
<br>
(DELETE) localhost:8000/api/redirects/{code}
Após a deleção de um dado ele não vai aparecer mais no Endpoint de resgate, porém se você for no seu banco de dados e fizer uma consulta `select * from redirects` ele vai aparecer com o campo deleted_at:

- Para o redirect acesse  `localhost:8000/api/r/k5`
*no lugar do k5 Digite outro code. esse redirect manda o usuario para o youtube por exemplo*
*Após um redirect será exibido a ultima vez que ele foi acessado nas proximas solicitações*
