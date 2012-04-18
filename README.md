ElasticSearchClient
===================

## Search
```php
<?php
$elasticsearch->search(array(
    'index' => '[your index]',
    'type' => '[your type]',
    'query' => array(
        'term' => array('body' => 'word')
    )
);
```