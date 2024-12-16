<?php
include_once './includes/helpers.php';
include_once './includes/db.php';
include_once './includes/csrf_token.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    include_once "actions/". $_GET["action"] ."_action.php";
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./src/style.css">
    <title>LOGIN</title>
</head>

<body class="font-pop">

    <div id="msgContainer" class="hidden bg-black/50 items-center justify-center h-screen w-screen backdrop-blur-lg fixed">
        <div class="bg-white rounded-sm gap-4 w-fit h-fit p-5 flex flex-col justify-center items-center ">
            <p id="msgContent">Message</p>
            <button id="closeMsg" class="btn px-5">Close</button>
        </div>
    </div>

    <?php

    // if (isset($_GET["action"]) && !empty($_GET["action"])) {
    //     $action = $_GET["action"];
    //     include_once "actions/" . $action . ".php";
    // }

    
    include_once "./views/register.php";
    

    ?>



    <script type="module" src="./dist/script.js"></script>
</body>

</html>