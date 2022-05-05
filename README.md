# Teste Checklist Fácil

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

# Otimize o projeto para desenvolvimento:
art optimize:clear
```

# Rotas da API
No navegador, entre no  endereço `http://localhost:5555`

# Ferramentas utilizadas
- Laravel 9.x
- PHP 8.1.x
- Larastan
- Laravel Horizon
- Laradock
- Redis
- MariaDB
- PHP CS Fixer
