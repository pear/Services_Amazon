--TEST--
Services_AmazonECS4: AWS.InvalidEnumeratedParameter
--SKIPIF--
<?php
if (!file_exists('config-local.php')) {
    print "Skip Missing config-local.php!";
}
?>
--FILE--
<?php
require_once 'config.php';
require_once 'Services/AmazonECS4.php';

$amazon = new Services_AmazonECS4(ACCESS_KEY_ID);
$amazon->setVersion('2006-03-08');

// Set an invalid SearchIndex
$result = $amazon->ItemSearch('FooBar', array('Keywords' => 'PHP'));

if (PEAR::isError($result)) {
    $error = $amazon->getError();
    echo $error['Code'];
}

?>
--EXPECT--
AWS.InvalidEnumeratedParameter
