# Definindo a versão do PHP
FROM php:8.1.2
# Atualizando as dependências e instalando as mais comúns
RUN apt-get update \
    && apt-get install -y --no-install-recommends vim curl debconf subversion git apt-transport-https apt-utils \
    build-essential locales acl mailutils wget zip unzip \
    gnupg gnupg1 gnupg2 \
    zlib1g-dev \
    libxml2-dev \
    sudo
# Instalando bibliotecas do PHP
RUN docker-php-ext-install pdo pdo_mysql zip xml
# Copiando o PHP.ini
COPY php.ini /usr/local/etc/php/php.ini
# Copiando as configurações de conexões com o PHP
COPY php-fpm-pool.conf 	/usr/local/etc/php/pool.d/www.conf
# Instalando o Composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
	mv composer.phar /usr/local/bin/composer
# Instalando o PHP Unit para rodar os testes
RUN wget --no-check-certificate https://phar.phpunit.de/phpunit-6.5.3.phar && \
    mv phpunit*.phar phpunit.phar && \
    chmod +x phpunit.phar && \
    mv phpunit.phar /usr/local/bin/phpunit
# Criando o usuario na máquina
RUN groupadd dev -g 999
RUN useradd dev -g dev -d /home/dev -m
RUN passwd -d dev
# Configurações de locale
RUN rm -rf /var/lib/apt/lists/*
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "pt_BR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen
# Garantindo que nosso usuário tem acesso de adminstrador
RUN echo "dev ALL=(ALL) ALL" > /etc/sudoers
# Ao abrir o container, é nessa pasta que você sai =)
WORKDIR /home/wwwroot/
# Abrindo a porta pro apache consumir
EXPOSE 9000
# Executando o PHP
CMD ["php-fpm"]