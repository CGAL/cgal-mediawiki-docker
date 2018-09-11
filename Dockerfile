#This image is a customized version of the MediaWiki image from Synctree, slightly modified to use version 1.31 instead of 1.24

FROM php:7.1-apache
MAINTAINER GeometryFactory <laurent.rineau@cgal.org>

ENV MEDIAWIKI_VERSION=1.31 MEDIAWIKI_FULL_VERSION=1.31.0 TERM=linux

RUN set -x; \
    apt-get update \
    && apt-get install -y --no-install-recommends \
        g++ \
        libicu-dev \
        python3 \
        zip \
        unzip \
        wget \
        imagemagick \
        git \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install mbstring mysqli opcache intl

RUN pear install mail net_smtp zip

RUN a2enmod rewrite

# https://www.mediawiki.org/keys/keys.txt
#RUN gpg --keyserver pool.sks-keyservers.net --recv-keys \
#    441276E9CCD15F44F6D97D18C119E1A64D70938E \
#    41B2ABE817ADD3E52BDA946F72BC1C5D23107F8A \
#    162432D9E81C1C618B301EECEE1F663462D84F01 \
#    1D98867E82982C8FE0ABC25F9B69B3109D3BB7B0 \
#    3CEF8262806D3F0B6BA1DBDD7956EE477F901A30 \
#    280DB7845A1DCAC92BB5A00A946B02565DC00AA7

RUN MEDIAWIKI_DOWNLOAD_URL="https://releases.wikimedia.org/mediawiki/$MEDIAWIKI_VERSION/mediawiki-$MEDIAWIKI_FULL_VERSION.tar.gz"; \
    set -x; \
    mkdir -p /usr/src/mediawiki \
    && curl -fSL "$MEDIAWIKI_DOWNLOAD_URL" -o mediawiki.tar.gz \
    && tar -xf mediawiki.tar.gz -C /usr/src/mediawiki --strip-components=1 \
    && rm mediawiki.tar.gz


COPY apache/mediawiki.conf /etc/apache2/
RUN echo Include /etc/apache2/mediawiki.conf >> /etc/apache2/apache2.conf


COPY composer-install.sh /usr/src/mediawiki/composer-install.sh
RUN chmod +x /usr/src/mediawiki/composer-install.sh \
&& cd /usr/src/mediawiki \
&& sh "/usr/src/mediawiki/composer-install.sh" 

#Download the extensions and extract them
RUN cd /usr/src/mediawiki/extensions/ \
&& curl https://extdist.wmflabs.org/dist/extensions/Math-REL1_27-ba08a3a.tar.gz --output ./math.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/UserMerge-REL1_27-31ea86d.tar.gz --output ./usermerge.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/ConfirmAccount-REL1_31-5d98110.tar.gz --output ./confirmaccount.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/Renameuser-REL1_27-615d761.tar.gz --output ./renameuser.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/MagicNoCache-REL1_27-9e93e90.tar.gz --output ./magicnocache.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/UrlGetParameters-REL1_27-dd6c467.tar.gz --output ./urlgetparameters.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/PageForms-REL1_27-7e54d7c.tar.gz --output ./pageforms.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/LookupUser-REL1_31-56fb106.tar.gz --output lookupuser.tar.gz \
&& tar -xf ./math.tar.gz \
&& tar -xf ./usermerge.tar.gz \
&& tar -xf ./renameuser.tar.gz \
&& tar -xf ./confirmaccount.tar.gz \
&& tar -xf ./pageforms.tar.gz \
&& tar -xf ./magicnocache.tar.gz \
&& tar -xf ./urlgetparameters.tar.gz \
&& tar -xf ./lookupuser.tar.gz \
&& rm ./math.tar.gz \
      ./usermerge.tar.gz \
      ./renameuser.tar.gz \
      ./confirmaccount.tar.gz \
      ./pageforms.tar.gz \
      ./magicnocache.tar.gz \
      ./urlgetparameters.tar.gz \
      ./lookupuser.tar.gz

#Replace composer.json file
COPY composer.local.json /usr/src/mediawiki/composer.local.json 
RUN cd /usr/src/mediawiki \
&& /usr/src/mediawiki/composer.phar update

ADD cgal-dev-wiki-logo2.png /var/www/html/img/

ADD php.ini /usr/local/etc/php/

#Copy the LocalSettings.php to the image
ADD LocalSettings.php /usr/src/mediawiki/

COPY docker-entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
