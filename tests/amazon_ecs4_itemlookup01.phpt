--TEST--
Services_AmazonECS4: ItemLookup()
--SKIPIF--
--FILE--
<?php
require_once 'config.php';
require_once 'Services/AmazonECS4.php';

$amazon = new Services_AmazonECS4(ACCESS_KEY_ID);
$amazon->setVersion('2006-03-08');

$result = $amazon->ItemLookup('B000B649X2');
if (PEAR::isError($result)) {
    die($result->message);
}

if (empty($result['Item'][0]['ItemAttributes']['Title'])) {
    die('error');
}

?>
--EXPECT--
