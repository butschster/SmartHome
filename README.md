# Smarthome WebServer

[![Build Status](https://travis-ci.org/butschster/SmartHome.svg?branch=master)](https://travis-ci.org/butschster/SmartHome)

## Компоненты
 - MySQL Server
 - Git client
 - Mosquitto broker (Mqtt)
 - Laravel Echo Server
 - Redis
 - Nginx
 - PHP7.2 FPM
 - Supervisor
 
 
## Установка на Raspberry PI 3

В качестве ОС используется [RASPBIAN STRETCH LITE](https://www.raspberrypi.org/downloads/raspbian/)
Для записи образа на SD использовалось приложение с сайта https://etcher.io/

Основные настройки ОС можно покрутить с помощью команды 
```bash
sudo raspi-config
```

## MySQL Server
```bash
sudo apt-get install mysql-server
sudo su
# Переходим в Mysql cli
mysql
```

Создаем БД и пользователя
```mysql
CREATE DATABASE smarthome COLLATE utf8_general_ci;
CREATE USER 'smarthome'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON smarthome.* TO 'smarthome'@'localhost';
```

### Nginx

```bash
sudo apt-get install nginx
```

После установки необходимо отредактировать конфиг
```bash
sudo nano /etc/nginx/sites-available/default
```

Заменить содержимое на

```
server {
    listen 80;

    server_name localhost;
    
    # Директория с исходным кодом
    root /var/www/public;

    error_log /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;

    index index.php;

    location ~* \.(?:jpg|jpeg|gif|png|ico|cur|gz|svg|svgz|mp4|ogg|ogv|webm|htc)$ {
        expires 1M;
        access_log off;
        add_header Cache-Control "public";
    }
	
    location ~* \.(?:css|js)$ {
        expires 1h;
        access_log off;
        add_header Cache-Control "public";
    }

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        try_files           $uri /index.php =404;
        include             /etc/nginx/fastcgi.conf;
        fastcgi_pass        unix:/run/php/php7.2-fpm.sock;
        fastcgi_index       index.php;
        fastcgi_param       SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include             fastcgi_params;
        sendfile            off;
        expires             off;
    }
}
```

И перезагрузить сервис

```bash
sudo systemctl reload nginx
```


### Mosquitto broker

Инструкция взята здесь [http://robot-on.ru](http://robot-on.ru/articles/ystanovka-mqtt-brokera-mosquitto-raspberry-orange-pi)

```bash
sudo wget http://repo.mosquitto.org/debian/mosquitto-repo.gpg.key

sudo apt-key add mosquitto-repo.gpg.key

cd /etc/apt/sources.list.d/

sudo wget http://repo.mosquitto.org/debian/mosquitto-jessie.list

sudo apt-get update

sudo apt-get install mosquitto
```

### Redis

Использовалась инструкция https://habilisbest.com/install-redis-on-your-raspberrypi

```bash
cd ~

# Скачиваем архив и распаковываем
wget http://download.redis.io/redis-stable.tar.gz
tar xzf redis-stable
cd redis-stable

# Собираем
sudo make
make test
sudo make install PREFIX=/usr

sudo mkdir /etc/redis
sudo cp redis.conf /etc/redis/
cd ..
sudo rm -Rf redis-stable

# Создаем нового пользователя
sudo adduser --system --group --disabled-login redis --no-create-home --shell /bin/nologin --quiet
cat /etc/passwd | grep redis

# Правим настройки
sudo nano /etc/redis/redis.conf
```

Список параметров, которые необходимо откорректировать
```
daemonize yes
stop-writes-on-bgsave-error no
maxmemory 70M
```

```bash
sudo mkdir -p /var/run/redis
sudo chown -R redis /var/run/redis

# Создаем демон
sudo nano /etc/init.d/redis-server
```

```
#! /bin/sh
### BEGIN INIT INFO
# Provides: redis-server
# Required-Start: $syslog $remote_fs
# Required-Stop: $syslog $remote_fs
# Should-Start: $local_fs
# Should-Stop: $local_fs
# Default-Start: 2 3 4 5
# Default-Stop: 0 1 6
# Short-Description: redis-server - Persistent key-value db
# Description: redis-server - Persistent key-value db
### END INIT INFO

PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
DAEMON=/usr/bin/redis-server
DAEMON_ARGS=/etc/redis/redis.conf
NAME=redis-server
DESC=redis-server

RUNDIR=/var/run/redis
PIDFILE=$RUNDIR/redis-server.pid

test -x $DAEMON || exit 0

if [ -r /etc/default/$NAME ]
then
. /etc/default/$NAME
fi

. /lib/lsb/init-functions

set -e

case "$1" in
  start)
echo -n "Starting $DESC: "
mkdir -p $RUNDIR
touch $PIDFILE
chown redis:redis $RUNDIR $PIDFILE
chmod 755 $RUNDIR

if [ -n "$ULIMIT" ]
then
ulimit -n $ULIMIT
fi

if start-stop-daemon --start --quiet --umask 007 --pidfile $PIDFILE --chuid redis:redis --exec $DAEMON -- $DAEMON_ARGS
then
echo "$NAME."
else
echo "failed"
fi
;;
  stop)
echo -n "Stopping $DESC: "
if start-stop-daemon --stop --retry forever/TERM/1 --quiet --oknodo --pidfile $PIDFILE --exec $DAEMON
then
echo "$NAME."
else
echo "failed"
fi
rm -f $PIDFILE
sleep 1
;;

  restart|force-reload)
${0} stop
${0} start
;;

  status)
status_of_proc -p ${PIDFILE} ${DAEMON} ${NAME}
;;

  *)
echo "Usage: /etc/init.d/$NAME {start|stop|restart|force-reload|status}" >&2
exit 1
;;
esac

exit 0
```

```bash
sudo chmod +x /etc/init.d/redis-server
sudo update-rc.d redis-server defaults

# Запускаем
sudo service redis-server restart

# Проверяем работу
redis-server -v
netstat -antp
ps aux | grep redis
```

### Laravel Echo Server

Инструкция взята отсюда https://github.com/tlaverdure/laravel-echo-server и https://nodejs.org/en/download/package-manager/#debian-and-ubuntu-based-linux-distributions

```bash
curl -sL https://deb.nodesource.com/setup_9.x | sudo -E bash -
sudo apt-get install -y nodejs
npm install -g laravel-echo-server
```

### PHP 7.2 FPM

Для работы приложения неоходимо установить версию php 7.2, но в стандартном репозитории ее нет, поэтому я воспользовался советом https://raspberrypi.stackexchange.com/questions/70388/how-to-install-php-7-1

```bash
sudo nano /etc/apt/sources.list
```

И заменить

```
deb http://mirrordirector.raspbian.org/raspbian/ stretch main contrib non-free rpi
на
deb http://mirrordirector.raspbian.org/raspbian/ buster main contrib non-free rpi
```

и выполнить команду 

```bash
sudo apt-get update
```

Далее можно устанавливать **PHP**

```bash
sudo apt-get install php7.2-fpm php7.2-mbstring php7.2-xml php7.2-mysql
```

После установки можно поменять назад `buster` на `stretch`

### Composer

инструкция взята отсюда https://getcomposer.org/doc/00-intro.md#globally

```bash
cd ~
wget https://getcomposer.org/composer.phar
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
```

### Git Client

```bash
sudo apt-get install git
```

### Supervisor

Используется для запуска фоновых задач

```bash
sudo apt-get install supervisor

# Создаем новый конфиг
sudo nano /etc/supervisor/conf.d/smarthome.conf
```

Содержимое конфига
```
[supervisord]
nodaemon=true
logfile=/var/www/storage/logs/supervisord.log

[program:queue]
command=php artisan queue:work
directory=/var/www
#numprocs=5
process_name=queue_daemon
stdout_logfile=/var/www/storage/logs/queue.log
startretries=5

[program:mqtt]
command=php artisan mqtt:listen
directory=/var/www
process_name=mqtt_daemon
stdout_logfile=/var/www/storage/logs/mqtt.log
startretries=5

[program:websocket]
command=laravel-echo-server start
directory=/var/www
process_name=websocket_daemon
stdout_logfile=/var/www/storage/logs/websocket.log
startretries=5
```

Перезагружаем Supervisor
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start all
```