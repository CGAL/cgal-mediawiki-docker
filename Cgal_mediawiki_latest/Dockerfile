FROM cgal/mediawiki:base
#Install python
RUN set -x; \
    apt-get update \
    && apt-get install -y python

#Download the extensions and extract them
RUN cd /usr/src/mediawiki/extensions/ \
&& curl https://extdist.wmflabs.org/dist/extensions/Math-REL1_27-efdd7c2.tar.gz --output ./math.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/DiscussionThreading-REL1_27-f9cc186.tar.gz --output ./discussionthreading.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/UserMerge-REL1_27-31ea86d.tar.gz --output ./usermerge.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/ConfirmAccount-REL1_27-071b0df.tar.gz --output ./confirmaccount.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/Renameuser-REL1_27-615d761.tar.gz --output ./renameuser.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/MagicNoCache-REL1_27-9e93e90.tar.gz --output ./magicnocache.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/UrlGetParameters-REL1_27-dd6c467.tar.gz --output ./urlgetparameters.tar.gz \
&& curl -L https://github.com/wikimedia/mediawiki-extensions-SemanticFormsInputs/archive/0.10.1.zip --output semanticformsinput.zip \
&& tar -xf ./math.tar.gz \
&& tar -xf ./discussionthreading.tar.gz \
&& tar -xf ./usermerge.tar.gz \
&& tar -xf ./renameuser.tar.gz \
&& tar -xf ./confirmaccount.tar.gz \
&& unzip ./semanticformsinput.zip \
&& mv ./mediawiki-extensions-SemanticFormsInputs-0.10.1 ./SemanticFormsInputs\
&& tar -xf ./magicnocache.tar.gz \
&& tar -xf ./urlgetparameters.tar.gz 

#Replace composer.json file
COPY composer.local.json /usr/src/mediawiki/composer.local.json 
RUN cd /usr/src/mediawiki \
&& /usr/src/mediawiki/composer.phar update

ADD cgal-dev-wiki-logo2.png /var/www/html/img/

RUN apt-get install -y nano 
ENV TERM=linux

ADD php.ini /usr/local/etc/php/

#Copy the LocalSettings.php to the image
ADD LocalSettings.php /usr/src/mediawiki/
