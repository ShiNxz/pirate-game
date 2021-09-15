<?

// Store the user IP if he abusing the requests
function abuseReq($ip, $request) {
    global $db;

    if($stmt = $db->prepare("INSERT INTO `Requests` (`IP`, `Req`) VALUES (?, ?)"))
    {
        $stmt->bind_param("ss", $ip, $request);
        $stmt->execute();
    }
}

// Check if the user IP abused requests before
function checkAbuse($ip, $max = 5) {
    global $db;
    
    if($stmt = $db->prepare("SELECT COUNT(*) FROM `Requests` WHERE IP = ?"))
    {
        $stmt->bind_param("s", $ip);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows >= 1)
        {
            $row = $result->fetch_assoc();
            if($row["COUNT(*)"] >= $max)
                return true;
        } else
            return false;
    }
    return false;
}