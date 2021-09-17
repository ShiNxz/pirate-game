<?php
session_start();

$Root = $_SERVER['DOCUMENT_ROOT'];

// Load Functions
foreach(glob($Root.'/inc/functions/*.php') as $file){
    require $file;
}

// Load Config
require $Root.'/inc/config.php';

// Load Database Connect
require $Root.'/inc/database.php';

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
                "Role"     =>   $User["Role"],
            );
            $logged = true;
        } else {
            session_unset();
            session_destroy();
        }
    }
}

// --========== Requests ==========--
// Logout
if (isset($_GET["logout"])):
    session_destroy();
    header("Location: index.php");
    exit;
endif;