# GO Rest Blog :zap:

## Objetivo do projeto :dart:

Realizar o consumo completo da [API Go Rest](https://gorest.co.in/) utilizando NodeJS ou Laravel. 
Todos os métodos devem ser consumidos conforme documentação da API.

## Requisitos :memo:

A API que será utilizada está disponível no link https://gorest.co.in/

O Projeto precisa atender os seguintes requisitos:

- [x] Criar um novo usuário dentro do sistema (não utilizar nomes reais);
- [x] Listar todos os usuários da API e encontrar o usuário criado através do ID do mesmo (o ID será retornado na operação de criação);
- [x] Criar um novo post para o usuário criado;
- [x] Criar um novo comentário dentro do post criado;
- [X] Criar um novo comentário dentro do primeiro post da _**lista pública**_ de posts;
- [X] Apagar o comentário criado no requisito acima;
- [X] Disponibilizar o projeto em um repositório do Git com as instruções para que a equipe de avaliação consiga executar;

## Rodando o Projeto :running:

1. Clonar o repositório
``` bash
git clone https://github.com/robsantossilva/blog_go_rest.git
```

2. Incluir token da API Go Rest no arquivo **(.env)**. Existe um **.env.example** de modelo
``` bash
GOREST_API_HEADER_AUTH = COLE_SEU_TOKEN_AQUI
```

3. Subir o container Docker
``` bash
docker-compose up -d
```

3. Acessar [http://localhost:8000/](http://localhost:8000/)

## Decisões de projeto :construction:

#### 1. Contextos da Aplicação:

Analisando os requisitos e a API Go Rest foi possivel identificar 2 contextos diferentes para a aplicação:

**User:** Responsavel por gerenciar o CRUD da Entidade User.
**Blog** Responsável por gerenciar tudo o que esta relacionado a Post e Commentários

#### 2. Design da Aplicação:

**Dominio da Aplicação:** Naturalmente cada contexto tornou-se um módulo dentro do dominio da aplicação que tem como principal objetivo tratar de Regras de Negócio. **Nesse ponto** nada sobre framework precisa necessariamente ser pensado, visto que resolver o problema é muito mais importante.

- **Domain**
  - User
    - Entity
    - Factory
    - Repository
    - Validator
  - Blog
    - Entity: Post / Comment
    - Factory
    - Repository
    - Validator
  - SharedCore: Contem interfaces e recursos compartilhados entre módulos
    - Entity
    - Repository
    - Validator
    - Notification: Pattern para agrupar Exception de errors dentro da camada de dominio
- **Usecase**
  - User: Casos de uso de video
  - Blog: Casos de uso de votos
- **Infraestructure**: É a ultima camada a nivel de prioridade. Aqui estará todas as implementações referente a Framework e Banco de Dados.

O Principal objetivo dessa organização em camadas é proporcionar um menor acoplamento entre as implementações diminuindo a dependencia entre elas e facilitando a evolução do projeto.

## Rotas da Aplicação

Method|Resource|Obs.
--|--|--
GET|   user|                                user.index › UserController@index
POST|  user|                                user.store › UserController@store
GET|   user/create|                         user.create › UserController@create
GET|   user/{userId}/post|                  user.show_post › UserController@showPost
GET|   post|                                post.index › PostController@index
POST|  post|                                post.store › PostController@store
GET|   post/create/user/{userId}|           post.create › PostController@create
GET|   post/{postId}/comment|               post.show_comment › PostController@showComment
POST|  comment|                             comment.store › CommentController@store
GET|   comment/create/post/{postId}|        comment.create › CommentController@create
GET|   comment/{id}/delete/post/{postId}|   comment.delete › CommentController@destroy

## Backlog :gift:

- Coberturar de 100% nos testes
- Remover User e Post
- Paginação na Lista Publica de Posts
- Editar User, Post e Comments