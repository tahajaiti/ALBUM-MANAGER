<?php

session_start();

function checkAdmin (){
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 1) {
        http_response_code(403);
        echo json_encode(["error" => "Unauthorized"]);
        exit();
    }
};

function blockCustomer () {
    if (!isset($_SESSION['role']) || $_SESSION['role'] === 3) {
        http_response_code(403);
        echo json_encode(["error" => "Unauthorized"]);
        exit();
    }
}