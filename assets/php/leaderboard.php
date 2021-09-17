<?
require $_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php';

$ReqIP = $_SERVER['REMOTE_ADDR']; // get the request ip
$Req = basename(__FILE__, '.php'); // get the current php script name

if(checkAbuse($ReqIP)) // check if the user has more than 4 failed requests and block him
    exit('false');

if(!isset($_SERVER['HTTP_REFERER'])) {
    abuseReq($ReqIP, $Req);
    exit();
}

// Check if the request sent with ajax, if not, get the user ip -> insert it to the banned db
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    abuseReq($ReqIP, $Req);
    exit();
}
// confirm the request sent as GET request
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    abuseReq($ReqIP, $Req);
    exit();
}

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