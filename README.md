> [!IMPORTANT]
> This repository is obsolete.

# wikimedia-docker
This repo contains the files used to deploy CGAL wiki with docker.

First you need to start a mysql server in a container. You can use the official mySQL image :
 
> docker run --rm --name mysql -e MYSQL_ROOT_PASSWORD=PASSWD -e MYSQL_USER=cgalwiki -e MYSQL_PASSWORD=PASSWD -e MYSQL_DATABASE=cgalwikidb mysql
 
This will create a database called `cgalwikidb` and a user `cgalwiki` that has superuser access but only for `cgalwikidb`.
Then you need to load the wiki's database.

To execute a dump, you can call 

 > docker exec [container's name] sh -c 'exec mysqldump --all-databases -uroot -p"$MYSQL_ROOT_PASSWORD"' > [host's path to dump.sql] 

To load a dump, call

 > docker exec -i [container's name] mysql -ucgalwiki -pPASSWD cgalwikidb < [path to your dump file on the host]

The database is now ready. 

The next step will be to build the wikimedia image:

> docker build -t 'cgal/mediawiki:latest' [/path/to/this/directory]

To create a retro-proxy that will generate automatically certificates, you need 3 writable volumes, `certificates`, `virtual_hosts` and `html`.

> docker run -d -p 8080:80 -p 443:443 \
    --name nginx-proxy -v /path/to/`certificates`:/etc/nginx/certs:ro -v /path/to/`virtual_hosts`:/etc/nginx/vhost.d -v /path/to/`html`:/usr/share/nginx/html -v /var/run/docker.sock:/tmp/docker.sock:ro --label com.github.jrcs.letsencrypt_nginx_proxy_companion.nginx_proxy=true jwilder/nginx-proxy

> docker run -d \
    -v /path/to/`certificates`:/etc/nginx/certs:rw -v /var/run/docker.sock:/var/run/docker.sock:ro --volumes-from nginx-proxy jrcs/letsencrypt-nginx-proxy-companion


Now you can run the container :

* Without the proxy:
> docker run --rm --name mediawiki --link mysql:mysql -v [the volume used to store the mediawiki images on the host]:/var/www/html/images/:Z -p 8080:80 -e MEDIAWIKI_DB_PASSWORD=PASSWD -e HTPASSWDCGALPASSWD=[usual cgal password] -e HTPASSWDCGALGROUP=[usual cgal user] cgal/mediawiki:latest

* Or with the proxy:
> docker run --rm --name mediawiki --link mysql:mysql -v [the volume used to store the mediawiki images on the host]:/var/www/html/images/:Z -p 80 -e MEDIAWIKI_DB_PASSWORD=PASSWD -e HTPASSWDCGALPASSWD=[usual cgal password] -e HTPASSWDCGALGROUP=[usual cgal user] -e "VIRTUAL_HOST=`your.domain.com`" -e "LETSENCRYPT_HOST=`your.domain.com`" -e "LETSENCRYPT_EMAIL=`your@email.com`" cgal/mediawiki:latest

Any time the wiki is upgraded, the update (`/var/www/html/maintenance/update.php`) script must be executed inside the container with 

>docker exec mediawiki maintenance/update.php --quick

The wiki is now online, and accessible at the following url : 
http://localhost:8080

To be able to send emails, some configuration might have to be done in the LocalSettings.txt : 
the current configuration is : 

```php
$wgSMTP = array(
        'host' => 'aspmx.l.google.com',
        'IDHost' => 'CGAL Wiki',
        'port' => '25',
        'username' => false,
        'password' => false,
        'auth' => false
); 
```

This configuration allows emails to be sent without authentication but they will probably be received as spam, and only work for GMail and GoogleApps users. 

## Using docker-compose

In dev, using http://localhost/:
> docker-compose -f docker-compose.yml -f dev-wiki.yml up -d

In production:
> docker-compose -f docker-compose.yml -f prod-wiki.yml up -d

To load the database from a dump:
> docker-compose -f docker-compose.yml -f prod-wiki.yml stop
> docker volume rm cgal-mediawiki-docker_mysql
> docker-compose -f docker-compose.yml -f load-db.yml up db

To upgrade the database schemas after an upgrade of Mediawiki versions:
> docker-compose -f docker-compose.yml -f prod-wiki.yml exec wiki maintenance/update.php --quick
