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

Setting the index and/or type makes it unnecessary to include it in the following.

## Search
```php
<?php
$elasticsearch->search([
    'index' => '[your index]',
    'type' => '[your type]',
    'query' => array(
        'term' => array('body' => 'word')
    )
]);
```

or

```php
<?php
$elasticsearch->search([
    'index' => '[your index]',
    'type' => '[your type]',
    'query' => 'word'
]);
```

## Index
```php
<?php
$elasticsearch->index([
    'id' => '[your id]',
    'data' => array(
        'title' => 'Blog post title',
        'tags' => array('ElasticSearch','PHP')
    )
]);
```

## Get
```php
<?php
$elasticsearch->get('[your id]');
```

## Custom request

```php
<?php
$elasticsearch->request(["twitter","tweet","1"],'PUT',[
  "tweet" => [
    "_index" => ["enabled" => true]
  ]
]);
```

Or if you so desire:

```php
<?php
$elasticsearch->request('/twitter/tweet/1','PUT',<<<EOS
{
    "tweet" : {
        "_index" : { "enabled" : true }
    }
}
EOS)
```
