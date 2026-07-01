<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Como executar em um servidor

### *Comandos*
### Versão do Artisan necessária
> php artisan --version <br>
> Laravel Framework 13.13.0

### Instalação do fakerphp/faker
> composer require fakerphp/faker --dev 

### Populamento do banco (Apenas para testes)
> php artisan db:seed --force
#### Reinstalação do banco
> php artisan migrate:fresh --force

### Criação do Admin
<pre>
php artisan tinker --execute="
    \App\Models\User::create([
        'name'=>'Admin', 
        'email'=>'admin@example.com', 
        'password'=>\Illuminate\Support\Facades\Hash::make('SUA_SENHA')
    ]);
"
</pre>
#### Altere 'name', 'email', 'SUA_SENHA' com os dados corretos
=======
# SOS-PET

## Pré-requisitos

Antes de iniciar, verifique se o servidor possui:

* PHP compatível com o Laravel 13
* Composer instalado
* Banco de dados PostgreSQL configurado
* Código-fonte do projeto disponível no servidor

---

## 1. Verifique a versão do Laravel

Confirme que a versão instalada é a esperada:

```bash
php artisan --version
```

Resultado esperado:

```text
Laravel Framework 13.13.0
```

---

## 2. Instale as dependências

Caso ainda não tenha instalado as dependências do projeto:

```bash
composer install
```

Se for necessário utilizar o Faker (ambiente de desenvolvimento ou testes), execute:

```bash
composer require fakerphp/faker --dev
```

---

## 3. Configure o ambiente

Configure o arquivo `.env` com as informações do servidor, incluindo:

* Banco de dados
* Chave da aplicação (`APP_KEY`)
* URL da aplicação
* Demais variáveis necessárias

Caso a chave da aplicação ainda não exista:

```bash
php artisan key:generate
```

---

## 4. Execute as migrações

Crie a estrutura do banco de dados:

```bash
php artisan migrate --force
```

> **Importante:** a opção `--force` é necessária para execução em ambiente de produção.

---

## 5. (Opcional) Popular o banco de dados

Para ambientes de teste ou homologação, execute:

```bash
php artisan db:seed --force
```

---

## 6. (Opcional) Recriar completamente o banco

Caso seja necessário apagar todas as tabelas e recriar o banco:

```bash
php artisan migrate:fresh --force
```

> **Atenção:** este comando remove todos os dados existentes.

---

## 7. Criar um usuário administrador

Execute o comando abaixo substituindo **name**, **email** e **password** pelos dados desejados:

```bash
php artisan tinker --execute="
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => \Illuminate\Support\Facades\Hash::make('senhaAdmin')
]);
"
```

---

## 8. Limpar e reconstruir os caches

Após a configuração do ambiente, execute:

```bash
php artisan optimize:clear
php artisan optimize
```

---

## 9. Ajustar permissões (Linux)

Garanta que os diretórios de cache e armazenamento tenham permissão de escrita:

```bash
chmod -R 775 storage bootstrap/cache
```

Se necessário, ajuste também o proprietário dos arquivos conforme o usuário utilizado pelo servidor web.

---

## 10. Iniciar a aplicação

### Ambiente de desenvolvimento

```bash
php artisan serve
```

Por padrão, a aplicação ficará disponível em:

```
http://127.0.0.1:8000
```

### Ambiente de produção

Utilize um servidor web, configurando o diretório public/ como raiz do site. <br>
O comando ```php artisan serve``` deve ser utilizado apenas para desenvolvimento e testes.

---

Desenvolvido para a ONG Patinhas Carentes em colaboração com a Universidade da Região de Joinville (UNIVILLE) para a disciplina de Vivencias de Extenção III
>>>>>>> v1
