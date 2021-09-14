<?php
session_start();

// Load Functions
foreach(glob($_SERVER['DOCUMENT_ROOT'].'/inc/functions/*.php') as $file){
    require $file;
}

// Load Config
require $_SERVER['DOCUMENT_ROOT'].'/inc/config.php';

// Load Database Connect
require $_SERVER['DOCUMENT_ROOT'].'/inc/database.php';

// --========== Login ==========--
$logged = false;
// check if the user logged
if( isset( $_SESSION['user'] ) ) {
    $userID = $_SESSION['user'];
    if($stmt = $db->prepare("SELECT * FROM Users WHERE ID = ?"))
    {
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows >= 1)
        {
            $User = $result->fetch_assoc();
            $User = array (
                "UserID"    =>   $userID,
                "Email"     =>   $User["Email"],
                "Username"  =>   $User["Username"],
                "PName"     =>   $User["PName"],
                "Timestamp" =>   $User["Timestamp"],
                "Token"     =>   $User["Token"],
            );
            $logged = true;
        }
    }
}

// --========== Requests ==========--
// Logout
if (isset($_GET["logout"]) && $_GET["page"]):
    session_destroy();
    $page = $_GET["page"];
    header("Location: $page");
    exit;
endif;