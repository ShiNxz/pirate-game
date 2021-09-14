<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/inc/constructor.php');
if($logged)
    Redirect('game.php');
?>
<!DOCTYPE html>
<html dir="rtl" lang="he">

<head>
    <? // Meta
    include_once "{$Root}/assets/components/meta.php"; ?>
</head>
<body class="bg">
    <? // Login Modal
    include_once "{$Root}/assets/components/modals/login.php"; ?>
    <? // Register Modal
    include_once "{$Root}/assets/components/modals/register.php"; ?>

    <? // JS Files
    include_once "{$Root}/assets/components/js.php"; ?>
    <script>
        $(document).ready(function() {
            $('#login').modal('show');
        });
    </script>
</body>