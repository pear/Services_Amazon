<?php
// * VERY IMPORTANT *
// YOU NEED TO CHANGE THE DEVELOPERS TOKEN TO SOMETHING OTHER THEN XXXXXXXXXX
// YOU ALSO SHOULD CHANGE THE ASSOSCIATE ID TO YOUR OWN
// * VERY IMPORTANT *
require_once 'PEAR.php';
require_once 'Services/Amazon.php';

echo <<<EOT
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Services_Amazon example</title>
</head>
<body>
EOT;

if(substr(Services_Amazon::getApiVersion(), 0, 1) != 1) {
    echo 'This script was written to work with Services_Amazon 1 API';
    exit();
}

$amazon   = &new Services_Amazon('XXXXXXXXXX', 'catdevnull-20');
$products = null;
$message  = 'No Results';
$keyword  = '';

if(isset($_GET['keyword']) && isset($_GET['mode'])) {
    $mode = $_GET['mode'];
    if(empty($mode)) {
        $mode = null;
    }
    
    $page = 1;
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    
    if(empty($_GET['keyword'])) {
        $message = 'Must search for something.';
    } else {
        $keyword  = $_GET['keyword'];
        $products = $amazon->searchKeyword($keyword, $mode, $page);

        if(PEAR::isError($products)) {
            $message  = $products->message;
            $products = null;
        }
    }
}

$modes     = Services_Amazon::getModes();
$modes[''] = 'All Modes';

echo <<< EOT
<form action="{$_SERVER['PHP_SELF']}" method="get">
<table border="0">
<tr>
    <td>
    <select name="mode">
EOT;

foreach($modes as $mode => $name) {
    echo '<option value="' . $mode . ($mode == $_GET['mode'] ? '" selected="selected"' : '') . '">' . htmlentities($name) . '</option>';
}

echo <<< EOT
    </select>
    </td>
    <td><input type="text" name="keyword" value="$keyword" /></td>
    <td><input type="submit" value="Search" /></td>
</table>
</form>

<table border="0">
EOT;

if(!is_null($products)) {
    $pages = $products['pages'];
    $page  = $products['page'];
    unset($products['pages']);
    unset($products['page']);
    
    if($pages != 1) {
        echo '<tr><td colspan="2">';
        if($page != 1) {
            if(is_null($mode)) {
                $mode = '';
            }
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?mode=' . $_GET['mode'] . '&keyword=' . $_GET['keyword'] . '&page=' . ($page - 1) .  '">&laquo; Previous Page</a> ';
        }
        echo 'Page ' . $page . ' of ' . $pages . '';
        if($page != $pages) {
            if(is_null($mode)) {
                $mode = '';
            }
            echo ' <a href="' . $_SERVER['PHP_SELF'] . '?mode=' . $_GET['mode'] . '&keyword=' . $_GET['keyword'] . '&page=' . ($page + 1) .  '">Next Page &raquo;</a>';
        }
        echo '</td></tr>';
    }
    
    foreach($products as $product) {
        $creator = '';
        if(is_array($product['authors'])) {
            $creator = 'by ' . implode(', ', $product['authors']);
        } elseif(is_array($product['artists'])) {
            $creator = 'by ' . implode(', ', $product['artists']);        
        }
        
        $price = '';
        if($product['listprice'] != $product['ourprice']) {
            $price = '<strike>' . $product['listprice'] . '</strike> ' . $product['ourprice'];
        } else {
            $price = $product['listprice'];
        }
        
        echo <<<EOT
<tr>
    <td valign="top"><a href="{$product['url']}"><img src="{$product['imagesmall']}" border="0" alt="" /></a></td>
    <td valign="top">
    <b>{$product['name']}</b> $creator<br />
    Category: {$product['type']}<br />
    Release Date: {$product['release']}<br />
    Price: $price<br />
    Manufacturer: {$product['manufacturer']}<br />
    ASIN: {$product['asin']}
    </td>
</tr>
EOT;
    }
    
    if($pages != 1) {
        echo '<tr><td colspan="2">';
        if($page != 1) {
            if(is_null($mode)) {
                $mode = '';
            }
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?mode=' . $_GET['mode'] . '&keyword=' . $_GET['keyword'] . '&page=' . ($page - 1) .  '">&laquo; Previous Page</a> ';
        }
        echo 'Page ' . $page . ' of ' . $pages . '';
        if($page != $pages) {
            if(is_null($mode)) {
                $mode = '';
            }
            echo ' <a href="' . $_SERVER['PHP_SELF'] . '?mode=' . $_GET['mode'] . '&keyword=' . $_GET['keyword'] . '&page=' . ($page + 1) .  '">Next Page &raquo;</a>';
        }
        echo '</td></tr>';
    }
} else {
    echo '<tr><td><i>' . $message . '</i></td></tr>';
}

echo <<< EOT
</table>
</body>
</html>
EOT;
?>