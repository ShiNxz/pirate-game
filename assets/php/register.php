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
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    abuseReq($ReqIP, $Req);
    exit();
}

// EMAIL
if (isset($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('יש להקליד כתובת אימייל תקינה!');
    } else {
        $email = strtolower($_POST['email']);
    }
} else {
    exit('יש להקליד כתובת אימייל');
}

// PASSWORD
if (isset($_POST['password'])) {
    $password = trim($_POST['password']);
    if(strlen($password) > 20 || strlen($password) < 7) {
        exit('יש להקליד סיסמה בעלת 7 - 20 תוים!');
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
}
else {
    exit('יש להקליד סיסמה');
}
// Check if the user exist
if($stmt = $db->prepare("SELECT * FROM `Users` WHERE `Email` = ?"))
{
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows >= 1)
    {
        exit('כתובת האימייל כבר קיימת במערכת, יש לבחור כתובת אימייל שונה!');
    }
} else {
    exit('חלה שגיאה במהלך ההוספה למסד הנתונים! יש לנסות שוב בעוד מספר דקות');
}

$Time = time();
$IP = $_SERVER['REMOTE_ADDR'];

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