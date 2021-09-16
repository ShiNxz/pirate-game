<?
require $_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php';

$ReqIP = $_SERVER['REMOTE_ADDR'];
$Req = basename(__FILE__, '.php');

if(checkAbuse($ReqIP))
    exit('false');

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    abuseReq($ReqIP, $Req);
    exit();
}
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    abuseReq($ReqIP, $Req);
    exit();
}

if(!$logged)
    exit();

if($stmt = $db->prepare("SELECT Won, Lost FROM Users WHERE ID = ?"))
{
    $stmt->bind_param("s", $User["UserID"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows >= 1)
    {
        $row = $result->fetch_assoc();
        $results = array(
            'won'  => $row["Won"],
            'lost' => $row["Lost"]
        );
        exit(json_encode($results));
    }
    else
    {
        exit();
    }
}
else
{
    exit();
}