--TEST--
Services_AmazonECS4: ItemSearch()
--SKIPIF--
--FILE--
<?php
require_once 'config.php';
require_once 'Services/AmazonECS4.php';

$amazon = new Services_AmazonECS4(ACCESS_KEY_ID);
$amazon->setVersion('2006-03-08');

$options = array();
$options['Keywords'] = 'PEAR';
$result = $amazon->ItemSearch('Books', $options);
if (PEAR::isError($result)) {
    die($result->message);
}

foreach ($result['Item'] as $book) {
    if (empty($book['ItemAttributes']['Title'])) {
        die('error');
    }
}

?>
--EXPECT--
