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
│   .gitignore
│   .gitmodules
│
└───.git/
│
└───src/        # Projeto Laravel 9.x
│
└───laradock/   # Laradock customizado para o projeto.
```

### Executando o projeto:
> Necessário `docker` e `docker-compose` instalados no seu sistema.

```shell
# Execute os seguintes comandos dentro da pasta laradock.

# Crie um .env baseado no arquivo .env.development, que 
# está pré-configurado para o ambiente de desenvolvimento:
cp .env.development .env

# Para rodar o projeto:
docker-compose up -d

# Entre no container do workspace:
docker-compose exec -u laradock workspace bash

# A partir de agora, os seguintes comandos serão executados dentro do container workspace:
# Copie o .env.example em um novo .env.
# O .env.example está pré-configurado para o ambiente de desenvolvimento.
cp .env.example .env

# Instale as dependências do projeto:
composer install

# Gere uma nova chave de criptografia para o app:
art key:generate

# -----------------------------------------------------------
# A imagem do MariaDB está configurada para criar um banco de dados automaticamente,
# mas caso não seja criado, você pode criar um banco de dados manualmente.
# O container do workspace está configurado para instalar o cli do mysql.
mysql -u root -h mariadb -p # A senha é "root"
CREATE DATABASE IF NOT EXISTS checklist_facil_bakery_api;
exit;
# -----------------------------------------------------------

# Otimize o projeto para desenvolvimento:
art optimize:clear

# Execute as migrations do projeto:
art migrate;
```

# Swagger da API:
O projeto fornece um swagger com as rotas disponíveis da api.
Visite `http://localhost` para visualizar o swagger. A API pode ser completamente testada pela interface do swagger.

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
- PHP CS Fixer
- Laravel Auditing
- Laradock
  - maihog
  - mariadb
  - swagger-ui
  - laravel-horizon
  - redis
