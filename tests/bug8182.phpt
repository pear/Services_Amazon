--TEST--
Services_AmazonECS4: bug#8182 
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
$amazon->setLocale('JP');
$shared = array('ResponseGroup' => 'BrowseNodeInfo');
$params1 = array('BrowseNodeId' => '513256');
$params2 = array('BrowseNodeId' => '513256');
$result = $amazon->doBatch('BrowseNodeLookup', $shared, $params1, $params2);
if (PEAR::isError($result)) {
    die($result->message);
}
?>
--EXPECT--
