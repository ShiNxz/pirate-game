<? // --========== Databases Config ==========--

$servername = "127.0.0.1:3306";
$dbname = "startapp_main";
$username = "startapp_admin";
$password = "ZBsk2ZTLwQc7AMWKxR5m";

$db = mysqli_connect($servername, $username, $password, $dbname)
or die ("Error during connection to database.");

$db->query("SET NAMES 'utf8'");

?>