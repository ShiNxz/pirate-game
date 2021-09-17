<?
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php');

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

if( empty( $_SESSION["Result"] ) || $_SESSION["Result"] != 0) {

    $number = generateRandom(1, 6);

    $results = array(
        "num"    =>   $number,
    );

    switch($number) {
        case 1:
            // User lost
            $results["status"]["title"] = 'הפסדת!';
            $results["status"]["desc"]  = 'נשארת במקום ולכן הפסדת :(';
            $results["status"]["code"]  = "lost";
        break;

        case 2:
            if(generateRandom(1, 2) == 1) {
                $results["status"]["title"] = 'ניצחת!';
                $results["status"]["desc"]  = 'נתקלת ברום שאינו מקולקל ולכן ניצחת';
                $results["status"]["code"]  = "won";
            } else {
                // User lost
                $results["status"]["title"] = 'הפסדת!';
                $results["status"]["desc"]  = 'נתקלת ברום מקולקל ולכן הפסדת';
                $results["status"]["code"]  = "lost";
            }
        break;

        case 3:
            // User lost
            $results["status"]["title"] = 'הפסדת!';
            $results["status"]["desc"]  = 'נתקלת בדרקון והוא אכל אותך :(';
            $results["status"]["code"]  = "lost";
        break;

        case 4:
            // User lost
            $results["status"]["title"] = 'ניצחת!';
            $results["status"]["desc"]  = 'הגעת לאוצר וזכית!';
            $results["status"]["code"]  = "won";
        break;

        case 5:
            if($stmt = $db->prepare("SELECT `Quote` FROM Quotes ORDER BY RAND() LIMIT 1"))
            {
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                
                // User lost
                $results["status"]["title"] = ' ';
                $results["status"]["desc"]  = $row["Quote"];
                $results["status"]["code"]  = "none";
            }
        break;

        case 6:
            // User lost
            $results["status"]["title"] = 'ניצחת!';
            $results["status"]["desc"]  = 'הגעת לאי וניצלת בהצלחה!';
            $results["status"]["code"]  = "won";
        break;
    }

    if($results["status"]["code"] == "won")
    {
        // won
        logAction("Player Rolled Number {$number} and Won");
        if($logged) {
            // give the logged player 1 win
            if($stmt = $db->prepare("UPDATE `Users` SET `Won` = `Won` + 1 WHERE ID = ?"))
            {
                $stmt->bind_param("s", $User["UserID"]);
                $stmt->execute();
            }
        }
    }
    else if($results["status"]["code"] == "lost")
    {
        // lost
        logAction("Player got number {$number} and lost");
        if($logged) {
            // give the logged player 1 lost
            if($stmt = $db->prepare("UPDATE `Users` SET `Lost` = `Lost` + 1 WHERE ID = ?"))
            {
                $stmt->bind_param("s", $User["UserID"]);
                $stmt->execute();
            }
        }
    }
    else
    {
        logAction('Player got random quote');
    }

    exit(json_encode($results));

} else exit('error');