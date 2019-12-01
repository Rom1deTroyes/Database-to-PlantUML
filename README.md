# Database to PlantUML

This utility renders a graphical 2D visualisation of a database.

Currently, the only supported frontends are **PostgreSQL** and
**MySQL**. There are 2 backends: `commonmark` and `plantuml`. The
`plantuml` backend allows to generate visualisations into the
following formats:

  * PNG,
  * SVG,
  * EPS,
  * PDF,
  * VDX,
  * XMI,
  * HTML,
  * TXT,
  * UTXT,
  * LaTeX.

# Installation

With [Composer](https://getcomposer.org/), simply run the following command:

```sh
$ composer install
```

If you would like to use it as a dependency of your project, then:

```sh
$ composer require hywan/database-to-plantuml
```

To use the `plantuml` backend, you can use the JAR in `resource/plantuml.jar`.

# Examples with…

## … PostgreSQL

Taking as an example the famous `employees` use case:

```sh
# Import the schema.
$ psql -f resource/samples/pgsql-employees.sql postgres

# Generate the visualisation.
$ bin/database-to-plantuml -d 'pgsql:dbname=employees' -u hywan -s employees | \
      java -jar resource/plantuml.jar -verbose -pipe > output.png
```

![Output with PostgreSQL](https://cldup.com/UMsPg3WKh0.png)

## … MySQL

With the same `employees` use case:

```sh
# Import the schema.
$ mysql -u root < resource/samples/mysql-employees.sql

# Generate the visualisation.
$ bin/database-to-plantuml -d 'mysql:dbname=employees' -u root -s employees | \
      java -jar resource/plantuml.jar -verbose -pipe > output.png
```

![Output with MySQL](https://cldup.com/Cgn7bqdEz5.png)

Note: Outputs differ because the `employees` examples are not exactly
the same. They are here to illustrate the tool only.

# Errors ...

Sometimes things happen...

## ... could not find driver

Check if php has the good PDO module installed :
```bash
$ php -m |grep -i pdo
PDO
pdo_mysql
```

## ... SQLSTATE[HY000] [2002] No such file or directory

Is your database server reachable ?

Can you connect with the mysql client ?
```bash
$ mysql -h localhost -P 3306 -u root -p
ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2 "No such file or directory")
```
This can happen if you don't have right access to this file, or if you use a Dockerized server exposed on localhost port.

```bash
$ mysql --protocol tcp -u root -p
ERROR 1045 (28000): Access denied for user 'root'@'172.25.0.1' (using password: YES)
```
"Are you going to give me the password or will I have to say awake all night waiting for you to finish your conversation?” ― J.K. Rowling, Harry Potter and the Order of the Phoenix

## ... SQLSTATE[HY000] [2002] Connection timed out

Here you can try to figure out where is your database server.

```bash
mysql -h 172.0.0.1 -P 3306 -u root -p
ERROR 2003 (HY000): Can't connect to MySQL server on '172.0.0.1' (110 "Connection timed out")
```


# License

BSD-3-License, but seriously, do what ever you want!
