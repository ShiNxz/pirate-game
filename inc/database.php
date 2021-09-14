<? // --========== Databases Config ==========--

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)
or die ('<script language="javascript">alert("הראה שגיאה במהלך ההתחברות למסד הנתונים!")</script>');

$db->query("SET NAMES 'utf8'");

?>