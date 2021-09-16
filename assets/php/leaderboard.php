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

if($stmt = $db->prepare("SELECT `Email`, `Won`, `Lost` FROM `Users` ORDER BY `Won` DESC LIMIT 7"))
{
    $stmt->execute();
    $result = $stmt->get_result();
    $array = array();
    if($result->num_rows >= 1)
    {
        while($row = $result->fetch_assoc()) {
            $results = array(
                'email'  => htmlspecialchars($row["Email"]),
                'wins'   => $row["Won"],
                'loses'  => $row["Lost"]
            );
            
            array_push($array, $results);
        }
        exit(json_encode($array));
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