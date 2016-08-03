FROM cgal/mediawiki:base
#Copy the LocalSettings.php to the image
ADD LocalSettings.php /usr/src/mediawiki
#install unzip for Semantic Forms Input
RUN  set -x; \
    apt-get update \
    && apt-get install -y zip
#Download the extensions and extract them
RUN cd /usr/src/mediawiki/extensions/ \
&& curl https://extdist.wmflabs.org/dist/extensions/Math-REL1_27-efdd7c2.tar.gz --output ./math.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/DiscussionThreading-REL1_27-f9cc186.tar.gz --output ./discussionthreading.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/UserMerge-REL1_27-31ea86d.tar.gz --output ./usermerge.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/ConfirmAccount-REL1_27-071b0df.tar.gz --output ./confirmaccount.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/SemanticForms-REL1_27-7e54d7c.tar.gz --output ./semanticforms.tar.gz \
&& curl -L https://github.com/wikimedia/mediawiki-extensions-SemanticFormsInputs/archive/0.10.1.zip --output semanticformsinput.zip \
&& curl https://extdist.wmflabs.org/dist/extensions/MagicNoCache-REL1_27-9e93e90.tar.gz --output ./magicnocache.tar.gz \
&& curl https://extdist.wmflabs.org/dist/extensions/UrlGetParameters-REL1_27-dd6c467.tar.gz --output ./urlgetparameters.tar.gz \
&& tar -xf ./math.tar.gz \
&& tar -xf ./discussionthreading.tar.gz \
&& tar -xf ./usermerge.tar.gz \
&& tar -xf ./confirmaccount.tar.gz \
&& tar -xf ./semanticforms.tar.gz \
&& unzip ./semanticformsinput.zip \
&& mv ./mediawiki-extensions-SemanticFormsInputs-0.10.1 ./SemanticFormsInputs\
&& tar -xf ./magicnocache.tar.gz \
&& tar -xf ./urlgetparameters.tar.gz  
