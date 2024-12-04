# Установка и запуск

To run and build app use:
```
docker-compose up --build
```

Запустить в браузере проект: [http://localhost/](http://localhost/)

# Дополнительные команды
CS Fixer
```
docker-compose exec app vendor/bin/php-cs-fixer fix --allow-risky=yes
```

Analize PHP stan
```
docker-compose exec app vendor/bin/phpstan analyse -c phpstan.neon
```