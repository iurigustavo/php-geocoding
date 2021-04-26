# Exemplo Geocoding

Sistema de base para importação de clientes e criação de rotas

## Tecnologias
- [Laravel 8](https://laravel.com/) [Framework]
- [AdminLTE 3](https://adminlte.io/) [Template Admin]
- [AdminLTE Integration](https://github.com/jeroennoten/Laravel-AdminLTE) [Integração]

## Pré-requisitos

- PHP >= 7.4
- MySQL >= 5.7
- Composer

## Instalação


### Executar

- git clone `https://github.com/iurigustavo/php-geocoding.git` geocoding

### Configuração
- Criar banco de dados com o nome `geocoding`
- Alterar as configurações do banco de dados no arquivo `.env`
- Alterar `APP_URL` para o desejado
- Executar:
```
composer update
php artisan migrate
php artisan db:seed
```

### Servidor de Aplicação
- Apontar o seu servidor de aplicação para a pasta `/public`
- executar `php artisan serve` para rodar local

### Usuário Padrão
- usuário `admin@admin.com`
- senha `123456`

## Problemas, Perguntas e Pull Requests
Você pode relatar problemas ou fazer perguntas na [issues section](https://github.com/iurigustavo/php-geocoding/issues). Por favor, comece seu problema com `PROBLEMA:` e sua pergunta com `PERGUNTA:` no assunto.

Se você tiver alguma dúvida, é recomendável pesquisar e verificar os problemas encerrados primeiro.

Para enviar um Pull Request, por favor criar um fork deste repositório, crie um novo branch e envie seu código novo/atualizado lá. Em seguida, abra uma solicitação pull de sua nova branch. Consulte [este guia](https://help.github.com/articles/about-pull-requests/) para obter mais informações.

Ao enviar uma solicitação pull, leve as próximas notas em consideração:
- Verifique se o Pull Request não introduz um grande rebaixamento na qualidade do código.
