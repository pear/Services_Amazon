<?php
//
// Example of usage for Services_AmazonECS4
//
// * VERY IMPORTANT *
// YOU NEED TO CHANGE THE SUBSCRIPTION ID TO SOMETHING OTHER THEN XXXXXXXXXX
// * VERY IMPORTANT *

require_once 'PEAR.php';
require_once 'Services/AmazonECS4.php';
require_once 'Cache.php';

$amazon = new Services_AmazonECS4('XXXXXXXXXX');
$amazon->setCache('file', array('cache_dir' => 'cache/'));
$amazon->setCacheExpire(60); // 60 seconds = 1 min

$options = array();
$options['Keywords'] = $_GET['keyword'];
$options['ResponseGroup'] = 'Medium';
$result = $amazon->ItemSearch('Books', $options);

if (PEAR::isError($result)) {
    echo $result->message;
} else {
    echo $amazon->getProcessingTime() . 'seconds';
    var_dump($result);
}

?>
