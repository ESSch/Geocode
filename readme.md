## Тестовое задание на вакансию
Full stack web программист (php, javascript)
Реализовать сервис подсказок адресов
### Frontend:
* Форма из одного input
* Подсказки начинаются после ввода 3-его символа
* Максимум 6 подсказок
* После выбора подсказки - весь текст подставляется в форму
* Запрос на ваш backend
* Без jquery
* react/vue/angular + webpack
### Backend:
* Реализовать один метод api - возвращающий подсказки
* В этом методе для получения подсказок используйте сервис от яндекса или гугла
* Все запросы в геосервис и их результаты логировать в базе (на ваш выбор)
* Можно использовать сторонние компоненты, либы, фреймворки, все что захотите
Важным фактором оценки задания будет:
* Возможность выкатить этот сервис в продакшен, насколько он будет готов к нему
* Напишите небольшой текст, в котором опишите, как бы вы стали масштабировать
свой сервис на 100к запросов в секунду
* Если у вас есть такая возможность, поднимите этот сервис где-то у себя
Результат: Ссылка на открытый репозиторий, доступы от сервера (если есть), описание
масштабирования

### Ссылки
* Yandex Geocode https://tech.yandex.ru/maps/doc/geocoder/desc/concepts/limits-docpage/
* web view-source:http://geocode.essch.ru/
* github https://github.com/ESSch/Geocode

### Расширение 
WebPack не использовал, так как нечего автоматизировать.
В корне проекта docker-compose.yml для запуска проекта.
Добавил скрипты для разворачиваения кластера на Docker Swarm.
Логи соответсвующих сервисов в консоле, Вы можите настроить их сбор их так как у Вас принято.
Для логирования я выбрал ElasticSearch (доступ внизу).

### Достпы 
* http://geocode1.essch.ru       app
* http://geocode1.essch.ru:5601/ kibana
* http://geocode1.essch.ru:9200/ logsash

### TODO
* протестировать этот коммит

### Требования к главной ноде 
* минимум 2560 МБ оперативной памяти ноде для запуска ES
* на мастер ноде минимум 6G свободного места

### Порядок массштабирование:

Для развёртывания на нескольких нодах кластера возьмём классику: Ansible из за простоты. После устновки прописываем 
в /etc/ansible/ansible.cfg список хостов нод (подчинённых серверов) и добавляем ключи SSH. В playbook указываем, 
что необходимо поставить docker, docker-mashine и склонировать репозиторий. На галавной ноде ставим ещё и docker-compose
и разворачиваем систему docker-compose -f docker-compose.master.yml -f docker-compose.yml up -d.

Приступим к настройке кластера. На главной ноде устанавливаем docker и переходим в режим swarm. По скольку 
мы не фиксируем ни колличетво и распределение реплик нужно убрать у маштабируемого сервива backend жеско-заданные 
моунты на хостовую машину, благ метрики мы пишем в ElasticSearch, который, как и остальны сервисы стоят на главной ноде. 
Мониторинг и логироварние через UI Ansible: Tower. 
Задаём стратегию и параметры, например, нагрузка не более 90%, для автоматического поддрежания колличества 
контейнеров необходимы для стабильной работы.
