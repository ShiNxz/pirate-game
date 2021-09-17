<?
require $_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php';

$ReqIP = $_SERVER['REMOTE_ADDR']; // get the request ip
$Req = basename(__FILE__, '.php'); // get the current php script name

if(checkAbuse($ReqIP)) // check if the user has more than 4 failed requests and block him
    exit('false');

if( !isset($_SERVER['HTTP_REFERER']) ) {
    abuseReq($ReqIP, $Req);
    exit();
}

// Check if the request sent with ajax, if not, get the user ip -> insert it to the banned db
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    abuseReq($ReqIP, $Req);
    exit();
}
// confirm the request sent as GET request
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    abuseReq($ReqIP, $Req);
    exit();
}

// EMAIL
if (isset($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // check if the email is valid email
        exit('יש להקליד כתובת אימייל תקינה!'); // if not abort with message
    } else {
        $email = strtolower($_POST['email']); // lowercase the email chars
    }
} else {
    exit('יש להקליד כתובת אימייל'); // the email isn't set
}

// PASSWORD
if (isset($_POST['password'])) {
    $password = trim($_POST['password']); // trim whitespace from the password
    if(strlen($password) > 20 || strlen($password) < 7) { // check if the password lenght is greater than 7 and less than 20
        exit('יש להקליד סיסמה בעלת 7 - 20 תוים!');
    }
    $password = password_hash($password, PASSWORD_DEFAULT); // hash the password with php built function
}
else {
    exit('יש להקליד סיסמה');
}

// Check if the user already exist
if($stmt = $db->prepare("SELECT * FROM `Users` WHERE `Email` = ?"))
{
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0)
    {
        exit('כתובת האימייל כבר קיימת במערכת, יש לבחור כתובת אימייל שונה!');
    }
} else {
    exit('חלה שגיאה במהלך ההוספה למסד הנתונים! יש לנסות שוב בעוד מספר דקות');
}

$Time = time(); // get the current timestamp
$IP = $_SERVER['REMOTE_ADDR']; // get the user ip

// create the account
if($stmt = $db->prepare("INSERT INTO Users (`Email`, `Password`, `RegisteredIP`) VALUES (?, ?, ?)"))
{
    $stmt->bind_param("sss", $email, $password, $IP);
    if(!$stmt->execute()) {
        exit('חלה שגיאה במהלך ההוספה למסד הנתונים! יש לנסות שוב בעוד מספר דקות');
    }
} else {
    exit('חלה שגיאה במהלך ההוספה למסד הנתונים! יש לנסות שוב בעוד מספר דקות');
}

exit('success');