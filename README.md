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
        'password'=>\Illuminate\Support\Facades\Hash::make('SUA_SENHA_FORTE')
    ]);
"
</pre>
#### Altere 'name', 'email', 'SUA_SENHA_FORTE' com os dados corretos
