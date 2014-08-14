##UAlberta Open Data API (OAuth-Server)

This server manages and controls the resources for the API.

###Installation
As a prerequisite to installing this server, please install the Admin Console, and perform the migrations. Once the
migrations have been performed you will be able to install the oauth server.

First you must clone the repository onto your web server.

```
composer update
```

You need to create a mysql database, and then add it to the project's configuration. Create a file in the root of the
project folder called ```.env.php``` and add the following:

```php
<?php
return [
    'DATABASE_DATABASE' => "your-database-name",
    'DATABASE_USER' => "your-database-username",
    'DATABASE_PASSWORD' => "your-database-password",
];
```

**Remember:** the database name must match the database used for the Admin Server