# wikimedia-docker
This repo contains the files used to deploy CGAL wiki with docker.

First you need to start a mysql server in a container. You can use the official mySQL image :
 
> docker run --rm --name mysql -e MYSQL_ROOT_PASSWORD=PASSWD -e MYSQL_USER=cgalwiki -e MYSQL_PASSWORD=PASSWD -e MYSQL_DATABASE=cgalwikidb mysql
 
 This will create a database called cgalwikidb and a user 'cgalwiki' that has superuser access but only for cgalwikidb.
 Then you need to load the wiki's database. 
 > docker exec -i mysql mysql -ucgalwiki -pPASSWD cgalwikidb < [path to your dump file on the host]

The database is now ready. 
The next step will be to build the wikimedia image. 
Let's start with the base image if it doesn't exist yet:
> docker build -t 'cgal/mediawiki:base' [path to Cgal_mediawiki_base]

Then the latest :

> docker build -t 'cgal/mediawiki:latest' [path to Cgal_mediawiki_latest]

Now you can run the container :

> docker run --rm --name mediawiki --link mysql:mysql -v [the volume used to store the mediawiki images on the host]:/var/www/html/images/:Z -p 8080:80 -e MEDIAWIKI_DB_PASSWORD=PASSWD cgal/mediawiki:latest

Any time the wiki is upgraded, the update (/var/www/html/maintenance/update.php) script must be executed inside the container. 

The wiki is now online, and accessible at the following url : 
http://localhost:8080
