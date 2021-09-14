<?
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php');
?>
<!DOCTYPE html>
<html lang="he">

<head>
    <? // Meta
	include_once "{$Root}/assets/components/meta.php"; ?>
</head>
<body class="app">
    <div class="game">
        <div class="player"></div>
        <div class="lands"></div>
    </div>
    
    <? // JS Files
    include_once "{$Root}/assets/components/js.php"; ?>
    <? // Modal: Land Info
    include_once "{$Root}/assets/components/modals/land-info.php"; ?>
</body>