# Teste Checklist Fácil

### Clonando o projeto:
Esse Projeto faz uso de um submódulo, que é um fork do laradock para levantar o ambiente local. Execute o seguinte comando para clonar o projeto corretamente:
```shell
git clone --recurse-submodules https://github.com/ErickJMenezes/checklist-facil-bakery-api.git
```

### Estrutura do projeto:
```
checklist-facil-bakery-api-laradock/
│   README.md
│
└───.git/
│
└───src/        # Projeto Laravel [9.x]
│
└───laradock/   # Fork Laradock   [master]
```

### Executando o projeto:
```shell
# Execute dentro da pasta laradock:
# Crie um .env baseado no arquivo .env.development:
cp .env.development .env

# Execute o projeto:
docker-compose -f docker-compose-dev.yml up -d

# Entre no container do workspace:
docker-compose -f docker-compose-dev.yml exec -u laradock workspace bash

# A partir de agora, os seguintes comandos serão executados dentro do container:
# Copie o .env.example em um novo .env
cp .env.example .env

# Instale as dependências do projeto:
composer install

# Gere uma nova chave de criptografia para o app:
art key:generate

# Gere o banco de dados, caso o laradock não gere automaticamente:
mysql -u root -h mariadb -p # A senha é "root"

# Após ter executado o comando acima, você deve estar no terminal do banco de dados.
# Execute o comando para criar o banco de dados do projeto:
CREATE DATABASE IF NOT EXISTS checklist_facil_bakery_api;
exit;

# Executando as migrations:
art migrate;

# Otimize o projeto para desenvolvimento:
art optimize:clear
```

# Swagger da API:
O projeto fornece um swagger com as rotas disponíveis da api.
Visite `http://localhost` para visualizar o swagger.

# Teste de envio de emails:
O Projeto fornece um inbox fake para teste de envio de emails. 
Visite `http://localhost/mails` para ter acesso à caixa de emails fake.

# Observando os processos da fila:
O Laravel Horizon é um serviço que monitora as filas do projeto.
Visite `http://localhost/horizon` para ter acesso ao monitoramento filas.

# Ferramentas utilizadas
- Laravel 9.x
- PHP 8.1.x
- Larastan
- Laravel Horizon
- Laradock
  - maihog
  - mariadb
  - swagger-ui
  - laravel-hozizon
  - redis
- Redis
- MariaDB
- PHP CS Fixer
- Laravel Auditing
- Laravel Horizon
