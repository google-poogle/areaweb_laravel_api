# Laravel Shop API

REST API для курса "Laravel - создание API". Текущий проект относится только к разделу уроков "CRUD".

---

## Установка

Установка рассчитана на запуск приложения с помощью [Laravel Sail](https://laravel.com/docs/10.x/sail) с использованием [Docker](https://www.docker.com/) и [WSL](https://learn.microsoft.com/ru-ru/windows/wsl/install) 

### Конфигурация

Скопируйте экземпляр конфига из `.env.example` в `.env`
```shell
cp .env.example .env
```

### Зависимости

Установите зависимости с помощью:

```shell
composer install --ignore-platform-reqs
```

или 

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

## Запуск

Для запуска выполните команду:

```shell
./vendor/bin/sail up -d
```

Приложение будет доступно по адресу `localhost:$port`, где `$port` - это значение `APP_PORT` из конфигурации.

## База данных

```shell
./vendor/bin/sail artisan migrate --seed
```