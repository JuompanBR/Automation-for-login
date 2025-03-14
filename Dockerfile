FROM phpdockerio/php7-cli
 
# Install FPM
RUN apt-get -y update
RUN apt-get -y --no-install-recommends install ssh php7.0-mbstring php7.0-mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
 
# ADD php-ini-overrides.ini /tmp/php-ini-overrides.ini
# RUN cat /tmp/php-ini-overrides.ini >> /etc/php/7.0/cli/php.ini
 
# get composer
# RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
# RUN php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer && \
#     rm -rf /tmp/composer-setup.php
 
RUN echo 'alias run="vendor/bin/codecept run -vv"' >> ~/.bashrc
 
WORKDIR "/tests"