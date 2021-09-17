<?
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php');
?>
<!DOCTYPE html>
<html lang="he">

<head>
    <? // Meta
	include_once "{$Root}/assets/components/meta.php"; ?>
</head>
<body>

    <? // Sidebar
    include_once "{$Root}/assets/components/sidebar.php"; ?>
    <div class="game">
        <div class="player"></div>
        <div class="lands"></div>
    </div>

    <? // JS Files
    include_once "{$Root}/assets/components/js.php"; ?>

    <? // Modal: Land Info
    include_once "{$Root}/assets/components/modals/land-info.php"; ?>

    <? // Modal: Game Over
    include_once "{$Root}/assets/components/modals/game-over.php"; ?>

    <? // Modal: Login
    include_once "{$Root}/assets/components/modals/login.php"; ?>

    <? // Modal: Register
    include_once "{$Root}/assets/components/modals/register.php"; ?>

    <? // Modal: Stats
    include_once "{$Root}/assets/components/modals/stats.php"; ?>

    <? // Modal: Leaderboard
    include_once "{$Root}/assets/components/modals/leaderboard.php"; ?>

    <? // Modal: Admin Menu
    include_once "{$Root}/assets/components/modals/admin.php"; ?>
</body>
