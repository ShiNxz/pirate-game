<?php

/**
 * Redirect the user to the selected location and abort the current script
 * 
 * @param string The location you want to redirect the user, default to the main url.
**/
function Redirect($url = URL){
    header('Location: '.$url);
    exit;
}

/**
 * generate random int between 2 numbers, should be faster than the rand/mt rand function
 * 
 * @param int The minimum number.
 * @param int The maximum number.
**/
function generateRandom($min = 1, $max = 20) {
    if (function_exists('random_int')):
        return random_int($min, $max); // more secure
    elseif (function_exists('mt_rand')):
        return mt_rand($min, $max); // faster
    endif;
    return rand($min, $max); // old
}

/**
 * Log the user actions with his ip adress.
 * 
 * @param string The action (for exa "rolled number 5").
**/
function logAction($Action) {
    global $db;

    $IP = $_SERVER['REMOTE_ADDR'];
    $Time = time();

    if($stmt = $db->prepare("INSERT INTO `Actions` (`IP`, `Action`, `Timestamp`) VALUES (?, ?, ?)"))
    {
        $stmt->bind_param("sss", $IP, $Action, $Time);
        $stmt->execute();
    }
}

function toTimeName($Unix)
{  
  $Time = (time()-$Unix);
  if($Time <= 60) {$Time = round($Time, 0).' שניות';} else
  if($Time >= 61 && $Time < 60*60) {$Time = round(($Time/60), 0).' דקות';} else
  if($Time >= 60*60 && $Time < 60*60*24) {$Time = round(($Time/60/60), 0).' שעות';} else
  if($Time >= 60*60*24) {$Time = round(($Time/60/60/24), 0).' ימים';}
  if($Time == 1) {$Time = 'שנייה';} else
  if($Time == 60) {$Time = 'דקה';} else
  if($Time == 3600) {$Time = 'שעה';} else
  if($Time == 86400) {$Time = 'יום';}

  return $Time;
}