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

// check if the user logged -> if not, abort
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
        exit(json_encode($results)); // convert the array to json and return it
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