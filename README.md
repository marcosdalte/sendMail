# sendMail
Script to run on Cron for Send Email, with Admin to register special dates, templates, users, receivers. 

## Comandos para iniciar o serviço no c9.io

Executar os comandos com usuário root.

    /etc/init.d/php5-fpm restart
    /etc/init.d/nginx restart
    sudo /etc/init.d/mysql restart

### Name Create Receiver
### URL https://sendmail-upd-marcosdalte.c9users.io/willer/api/receivers
### Method POST
#### Example
    curl -X POST -d "{\"name\": \"John Doe edit\", \"email\": \"mail@mail.com\", \"birthday\": \"1970-01-01\"}" https://sendmail-upd-marcosdalte.c9users.io/willer/api/receivers