--TEST--
Services_AmazonECS4: AWS.MissingServiceParameter
--SKIPIF--
--FILE--
<?php
require_once 'config.php';
require_once 'Services/AmazonECS4.php';

$amazon = new Services_AmazonECS4(ACCESS_KEY_ID);
$amazon->setVersion('2006-03-08');

// Set an invalid url
$amazon->setBaseUrl('http://webservices.amazon.com/onca/xml?');

$result = $amazon->ItemSearch('Books', array('Keywords' => 'PHP'));

if (PEAR::isError($result)) {
    $error = $amazon->getError();
    echo $error['Code'] . "\n";
    echo $error['Message'] . "\n";
    $error = $amazon->getError();
    echo $error['Code'] . "\n";
    echo $error['Message'] . "\n";
}

?>
--EXPECT--
AWS.MissingServiceParameter
Your request is missing the Service parameter. Please add  the Service parameter to your request and retry.
AWS.MissingServiceParameter
Your request is missing the Service parameter. Please add  the Service parameter to your request and retry.
