
## TCC - Brooklyn Em construção

### Descrição

TCC - Brooklyn é um projeto de e-commerce desenvolvido utilizando a linguagem PHP e o framework Laravel. O projeto tem como objetivo oferecer uma plataforma de compra online para os usuários, permitindo a compra de produtos de alta qualidade e atualização de informações pessoais.

### Tecnologias

- PHP
- Laravel
- Bootstrap
- Jquery
- Jquery UI
- Jquery Validation
- Jquery Form

### Instalação

Para instalar o projeto TCC - Brooklyn, siga os seguintes passos:

1. Clone o repositório do projeto TCC - Brooklyn:

```
git clone https://github.com/Jurandir/TCC-Brooklyn.git
```

2. Entre na pasta do projeto e instale as dependências do projeto:

```
cd TCC-Brooklyn
composer install
```

3. Crie um banco de dados para o projeto e configure o arquivo .env para utilizar o banco de dados criado:

```
php artisan migrate
php artisan key:generate
```

4. Configure o arquivo .env para utilizar o banco de dados criado:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tcc_brooklyn
DB_USERNAME=root
DB_PASSWORD=
```

5. Execute o comando para iniciar o servidor de desenvolvimento do Laravel:

```
php artisan serve
```

6. Abra o navegador e acesse a URL http://localhost:8000 para visualizar o site em execução.

### Contribuição

Você pode contribuir com o projeto TCC - Brooklyn, incluindo relatar problemas, sugerir novas funcionalidades e enviar pull requests. Para contribuir, siga os seguintes passos:

1. Fork o repositório do projeto TCC - Brooklyn.
2. Crie uma branch para sua contribuição.
3. Faça suas alterações e teste suas alterações.
4. Envie um pull request para o repositório original.

### Licença

Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para obter mais informações sobre a licença.