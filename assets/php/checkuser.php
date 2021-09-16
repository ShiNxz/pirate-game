<?
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php');

$ReqIP = $_SERVER['REMOTE_ADDR'];
$Req = basename(__FILE__, '.php');

if(checkAbuse($ReqIP))
    exit();

// Check if the request sent with ajax, if not, get the user ip -> insert it to the banned db
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    abuseReq($ReqIP, $Req);
    exit();
}
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    abuseReq($ReqIP, $Req);
    exit();
}

exit('verified');