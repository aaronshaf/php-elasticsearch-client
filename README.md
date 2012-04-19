ElasticSearch PHP Client
===================

## Requires HTTP_Request2

### Install it

```pear install HTTP_Request2```

### Include it
```php
<?php
require_once "HTTP/Request2.php";
```


## Set index
```php
<?php
$elasticsearch->setIndex('[your index]');
```

## Set type
```php
<?php
$elasticsearch->setType('[your type]');
```

## Search
```php
<?php
$elasticsearch->search(array(
    'index' => '[your index]',
    'type' => '[your type]',
    'query' => array(
        'term' => array('body' => 'word')
    )
));
```

or

```php
<?php
$elasticsearch->search(array(
    'index' => '[your index]',
    'type' => '[your type]',
    'query' => 'word'
));
```

## Index
```php
<?php
$elasticsearch->index(array(
    'id' => '[your id]',
    'data' => array(
        'title' => 'Blog post title',
        'tags' => array('ElasticSearch','PHP')
    )
));
```

## Get
```php
<?php
$elasticsearch->get('[your id]');
```