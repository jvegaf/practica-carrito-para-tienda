@ECHO off
set DOCKER_BE=webserver
set UID=1000
if /I %1 == default goto :default
if /I %1 == run goto :run
if /I %1 == stop goto :stop
if /I %1 == prepare goto :prepare
if /I %1 == ssh-be goto :ssh-be
if /I %1 == clean goto :clean

goto :eof ::can be ommited to run the `default` function similarly to makefiles

:default
echo DEFAULT
goto :eof

:run
docker-compose -f docker-compose.yml up -d
goto :eof

:stop
docker-compose -f docker-compose.yml stop
goto :eof

:prepare
goto :composer-install
goto :eof

:ssh-be
docker exec -it --user %UID% %DOCKER_BE% bash
goto :eof

:composer-install
docker exec --user %UID% -it %DOCKER_BE% composer install --no-scripts --no-interaction --optimize-autoloader
goto :eof

:clean
docker-compose down --rmi local --volumes --remove-orphans
goto :eof


