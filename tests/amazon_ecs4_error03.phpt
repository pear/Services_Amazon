--TEST--
Services_AmazonECS4: Invalid Access Key ID
--SKIPIF--
--FILE--
<?php
require_once 'config.php';
require_once 'Services/AmazonECS4.php';

// Set an invalid Access Key ID
$amazon = new Services_AmazonECS4('InvalidAccessKeyID');
$amazon->setVersion('2006-03-08');

$result = $amazon->ItemSearch('Books', array('Keywords' => 'PHP'));

if (PEAR::isError($result)) {
    $error = $amazon->getError();
    echo $error['Code'];
}

?>
--EXPECT--
AWS.InvalidParameterValue
