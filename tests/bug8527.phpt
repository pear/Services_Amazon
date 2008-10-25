--TEST--
Services_Amazon: bug#8527: Using locale de, uk, jp and fr does not work
--SKIPIF--
<?php
if (!file_exists('config-local.php')) {
    print "Skip Missing config-local.php!";
}
?>
--FILE--
<?php
require_once 'config.php';
require_once 'Services/Amazon.php';

$amazon = new Services_Amazon(ACCESS_KEY_ID, ASSOC_ID);

$keyword = 'test';

$locale = 'us';
$amazon->setLocale($locale);
$result = $amazon->searchKeyword($keyword);
if (PEAR::isError($result)) {
    echo("locale={$locale}:{$result->message}\n");
}
sleep(1);

$locale = 'uk';
$amazon->setLocale($locale);
$result = $amazon->searchKeyword($keyword);
if (PEAR::isError($result)) {
    echo("locale={$locale}:{$result->message}\n");
}
sleep(1);

$locale = 'de';
$amazon->setLocale($locale);
$result = $amazon->searchKeyword($keyword);
if (PEAR::isError($result)) {
    echo("locale={$locale}:{$result->message}\n");
}
sleep(1);

$locale = 'jp';
$amazon->setLocale($locale);
$result = $amazon->searchKeyword($keyword);
if (PEAR::isError($result)) {
    echo("locale={$locale}:{$result->message}\n");
}
sleep(1);

$locale = 'fr';
$amazon->setLocale($locale);
$result = $amazon->searchKeyword($keyword);
if (PEAR::isError($result)) {
    echo("locale={$locale}:{$result->message}\n");
}
sleep(1);

$locale = 'ca';
$amazon->setLocale($locale);
$result = $amazon->searchKeyword($keyword);
if (PEAR::isError($result)) {
    echo("locale={$locale}:{$result->message}\n");
}
sleep(1);
--EXPECT--
