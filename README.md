# search-points-of-interest
search POIs

The goal is to find the nearby points on map. It can be an API or a function, up to you. The returned close points can be just a plain text list or JSON.

There are two data tables - 1. hotels and 2. POIs (points of interest). The function should return the nearby POIs for a specific hotel in a 1km radius. All hotels and POIs have lat long data so they are real and specific points on a map. 

The function should return the following, for example: "the Royal Horseguards hotel” has 3 POIs in a 1km radius and POIs are: Big Ben (description, address, lat long), Carnaby Street (description, address, lat long), Eye of London (description, address, lat long).

![image](https://github.com/dykyi-roman/search-points-of-interest/blob/master/images/image.jpg)

## Install

+ composer install && composer dumpautoload -o
+ set URL path in file index.php
 
## Usage
```php
require_once "vendor/autoload.php";

define('URL','http://test.app/api/pois.php');

$app = new \Dykyi\Application();
$app->run(URL);

```

## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)
