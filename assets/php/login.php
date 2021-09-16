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
}
else {
    exit('יש להקליד סיסמה');
}

// Check if the user exist => get the password
if($stmt = $db->prepare("SELECT Password, ID FROM Users WHERE Email = ?"))
{
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows >= 1)
    {
        $row = $result->fetch_assoc();
        $userPass = $row["Password"];
        $userID = $row["ID"];
    }
    else
    {
        exit('לא נמצא משתמש בעל כתובת האימייל');
    }
}

if (password_verify($password, $userPass)) {
    $_SESSION['user'] = $userID;

    // update the last ip
    if($stmt = $db->prepare("UPDATE Users SET LastIP = ? WHERE ID = ?"))
    {
        $stmt->bind_param("ss", $ReqIP, $userID);
        $stmt->execute();
    }
}
else {
    exit('הסיסמה שגוייה.');
}

exit('success');