<?php
include_once './includes/helpers.php';
include_once './includes/db.php';
include_once './includes/csrf_token.php';

if (isset($_GET['action']) && !empty($_GET['action'])) {
    include_once "actions/" . $_GET["action"] . "_action.php";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./src/style.css">
    <title>MEZIKKA - Your only album store</title>
</head>

<body class="font-pop text-white bg-slate-900 h-screen">
    <div id="msgContainer" class="hidden fixed top-24 left-1/2 transform -translate-x-1/2 -translate-y-1/2 ">
        <div class="flex justify-between items-center gap-6 w-fit h-fit px-6 py-4 rounded-md border-2 border-slate-800 bg-slate-700/80 shadow-lg text-white">
            <p id="msgContent" class="text-sm font-medium">Your message here</p>
            <button id="closeMsg" class="text-slate-300 hover:text-slate-100 font-bold text-lg">X</button>
        </div>
    </div>

    <?php

    include_once 'views/header.php';

    if (isset($_GET["view"]) && !empty($_GET["view"])) {
        $view = $_GET["view"];
        include_once "views/" . $view . "_view.php";
    } else {
        include_once './views/home_view.php';
    }




    ?>



    <script type="module" src="./dist/registerHandler.js"></script>
    <script type="module" src="./dist/loginHandler.js"></script>
</body>

</html>