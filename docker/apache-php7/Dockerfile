FROM ubuntu:xenial

ENV DOCKER_ALLOW_APP_DEV true
ENV USER_ID 1000
ENV GROUP_ID 1000

RUN apt-get update && apt-get install -y curl \
&& apt-get install -y software-properties-common \
&& curl -sL https://deb.nodesource.com/setup_8.x | bash - \
&& apt-get install -y nodejs \
&& curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
&& echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
&& LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php && LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/apache2 && apt-get update && apt-get install --no-install-recommends -y \
git \
apache2 \
composer \
wget \
php7.2 \
php7.2-xml \
php7.2-zip \
php7.2-curl \
php7.2-intl \
php7.2-mbstring \
php7.2-mysql \
php7.2-gd \
#php7.2-mcrypt \
php7.2-cli \
libapache2-mod-php7.2 \
yarn \
# Merci à https://gist.github.com/philbot9/1e895303a37a1c18717e90eb7067df73 & https://serverpilot.io/community/articles/how-to-install-the-php-apcu-bc-extension.html pour installer php-apcu-bc
php7.2-dev php-pear php-sodium gcc make autoconf libc-dev pkg-config \
&& echo "" | pecl install apcu_bc \
&& rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite mpm_prefork php7.2 negotiation headers alias deflate
RUN a2dismod mpm_event
RUN phpenmod mcrypt opcache

RUN npm install -g bower

COPY envvars /etc/apache2
COPY 000-default.conf /etc/apache2/sites-available

COPY cli/php.ini /etc/php/7.2/cli/php.ini
COPY apache2/php.ini /etc/php/7.2/apache2/php.ini
COPY apache2/security.conf /etc/php/7.2/apache2/security.conf
RUN a2enconf security

# phpunit
RUN wget https://phar.phpunit.de/phpunit.phar
RUN chmod +x phpunit.phar
RUN mv phpunit.phar /usr/local/bin/phpunit

WORKDIR /var/www/html/iorga

RUN groupadd -g $GROUP_ID apache 2> /dev/null
RUN useradd --shell /bin/bash -u $USER_ID -g $GROUP_ID -o -c "" -m apache 2> /dev/null
RUN chown -R apache:apache /home/apache

ADD entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

RUN php -v