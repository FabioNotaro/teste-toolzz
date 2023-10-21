## teste-toolzz

[Api de Series] permite que você gerencie Series de forma simples. Permitindo o cadastro, edição e exclusão. 

Cada recurso tem sua rota e necessita de autenticação do usuário. 

Para isso, é necessário realizar um cadastro através da rota 'project'/api/users, enviando um json via post como exemplo abaixo

```json
{
    "name": "seu nome",
    "email": "seu email",
    "password": "sua senha"
}

```

## Autenticação

Após realizar o cadastro, é necessário realizar o login, pela rota 'project'/api/authenticate, enviando email e senha, como exemplo abaixo:


```json
{
    "email": "seu email",
    "password": "sua senha"
}

```

Confirmando o login, receberá um Token, ele será necessário para as demais ações da api. Lembre-se de sempre informar em seu cabeçario. 

## Utilização 

Para começar a utilizar, primeiro, deve cadastrar as series desejadas. Basta enviar todos os campos abaixo, pois são obrigatórios, via POST para a rota 'project'/api/series

```json
{
    "name": "Nome da Série (String)",
    "seasons_qty": "Quantidade de Teporadas (INT)",
    "episodes_per_season": "Quantidade de Episódios por Teporada (INT)"
}

```

## Visualizando as Series Cadastradas

Para visualizar as séries cadastradas, basta fazer uma requisição GET para a rota 'project'/api/series, assim trará todas as séries, paginadas com 5 por página.  No retorno você terá um link para proxima pagina e anterior, facilitando paginações no Front. 

## Atualizando as Series

Para atualizar uma série existente, é necessário fazer uma requisição via Put, informando os dados as serem modificados e o id da serie a ser modificada, para a rota 'project'/api/series/'id da serie'. Exemplo abaixo:

```json
{
    "Campo modificado": "Novo Dado",
    "Campo modificado": "Novo Dado",
}

```

Obs: Pode-se editar mais de um campo.

## Deletando as Series

Para deletar uma serie existe, é necessário permissão para isso, atualmente, todos os usuarios cadastrados, tem a mesma permissão, mas já foi implementado esse recurso, para caso seja necessário futuramente. Tendo a permissão, faça uma requisição via Delete para a rota 'project'/api/series/'id da serie'.


##### LEMBRE-SE DE SEMPRE INFORMAR O TOKEN DE AUTENTICAÇÃO #####