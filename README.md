ElasticSearchClient
===================

## Requires HTTP_Request2

```pear install HTTP_Request2```

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
?>
```

or

```php
<?php
$elasticsearch->search(array(
    'index' => '[your index]',
    'type' => '[your type]',
    'query' => 'word'
));
?>
```