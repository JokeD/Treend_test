FROM php:8.0.2-cli

WORKDIR /usr/share/smartpoint_test

ENV GNAME=appgroup
ENV UNAME=appuser
ENV UID=1000
ENV GID=1000

RUN echo 'deb [trusted=yes] https://repo.symfony.com/apt/ /' | tee /etc/apt/sources.list.d/symfony-cli.list \
    && apt-get update && apt-get install libonig-dev libzip-dev  libyaml-dev zip symfony-cli -y \
    && pecl install xdebug-3.0.3 \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && docker-php-ext-install mbstring pdo pdo_mysql \
    && addgroup --gid $GID $GNAME \
    && useradd --password "*" --uid $UID --gid $GID $UNAME \
    && mkdir /home/$UNAME && chown $UNAME:$GNAME /usr/bin/symfony /home/$UNAME


USER $UNAME

CMD  ["sleep","infinity"]