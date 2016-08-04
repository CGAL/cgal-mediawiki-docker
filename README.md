# wikimedia-docker
This repo contains the files used to deploy CGAL wiki with docker.

First you need to start a mysql server in a container. You can use the official mySQL image :
 
> docker run --rm --name [mysql-server's name] -v [the volume used to store the mediawiki iamges] -p 3306:3306 -e MYSQL_ROOT_PASSWORD=[DB root password] -e MYSQL_USER=cgalwiki -e MYSQL_PASSWORD=[DB Password] -e MYSQL_DATABASE=cgalwikidb mysql
 
 This will create a database called cgalwikidb and a user 'cgalwiki' that has superuser access but only for cgalwikidb.
 Then you need to load the wiki's database. 
 > docker exec [mysql-server's name] sh -c 'exec mysql -u[user] -p[password] -e"USE cgalwikidb"'
 > docker exec -i [mysql-server] mysql -u[user] -p[DB password] [database's name if the DB already exists] < [path to your dump file on the host]

The database is now ready. 
The next step will be to build the wikimedia image. 
Let's start with the base image if it doesn't exist yet:
> docker build -t 'cgal/mediawiki:base' [path to Cgal_mediawiki_base]

Then the latest :

> docker build -t 'cgal/mediawiki:latest' [path to Cgal_mediawiki_latest]
Now you can run the container :
> docker run --rm --name mediawiki --link [mysql-server's name]:mysql -p 8080:80 -e MEDIAWIKI_DB_PASSWORD=[DB password] cgal/mediawiki:latest

The wiki is now online.
