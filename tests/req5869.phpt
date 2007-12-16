--TEST--
Services_AmazonECS4: req#5869: Provide access to the raw XML
--SKIPIF--
--FILE--
<?php
require_once 'config.php';
require_once 'Services/AmazonECS4.php';

$amazon = new Services_AmazonECS4(ACCESS_KEY_ID);

$result = $amazon->ItemLookup('B000B649X2');
if (PEAR::isError($result)) {
    die($result->message);
}
$raw = $amazon->getRawResult();

echo substr($raw, 0, 57);
?>
--EXPECT--
<?xml version="1.0" encoding="UTF-8"?><ItemLookupResponse