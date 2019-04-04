Установка:

Уже должны быть установлены: composer, docker, docker-compose.

Домены frontend.lan и backend.lan должны указывать на 127.0.0.1.

Выполняем команды:

`git clone https://github.com/igor-z/fitmost-test && cd fitmost-test`

`composer install`

`sudo docker-compose up -d`

Если имя запущенного контейнера отличается от `fitmost-test_frontend_1`, то подставляем его:

`sudo docker exec -it fitmost-test_frontend_1 /bin/bash`

Ждем поднятия mysql, после чего в контейнере:

`./init --env=Development`

`./yii migrate`

Админка доступна по адресу:
`http://backend.lan/`

API доступно по адресу:
`http://frontend.lan/`

Получение списка услуг по id города:
`http://frontend.lan/services?filter[city_id]=3`

Получение определенной услуги по id:
`http://frontend.lan/services/1`

Доступы:

`admin`: `secret`

`operator`: `secret`