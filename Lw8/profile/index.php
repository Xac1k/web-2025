<?php

function reshapeArrayImage($arr): array {
    $finishArr = [];
    foreach ($arr as $arrELT)
    {
        array_push($finishArr, $arrELT['url']);
    }
    return $finishArr;
}

require "../database.php";

const ERROR_NO_POSTS = "<div style = 'text-align: center;'>У пользователя нет постов</div>";

$DB = connectDataBase();
$isFloat = isset($_GET['id']) && preg_match("/\d*[.,]\d*/", $_GET['id']);
$query = isset($_GET['id']) && is_numeric($_GET['id']) && !$isFloat ? $_GET['id'] : null;

if ($isFloat) {
    include '../notFoundResponse.php';
    printError("400");
}

if (!$query) {
    include '../notFoundResponse.php';
    printError("404");
}

if ($query && !userIntoDB($DB, $query)) {
    include '../notFoundResponse.php';
    printError("404");
}

if(!$DB) {
    include '../notFoundResponse.php';
    printError("503");
}

$user = getUserFromDB($DB, $query);
include 'profile.html';
include 'templeteProfile.php';
$posts = getUserImagesPostsFromDB($DB, $query);
$shapedPostsArr = reshapeArrayImage($posts);
$count = count($shapedPostsArr);

printHeaderProfile($user[0], $count);

if(empty($shapedPostsArr)){
    echo ERROR_NO_POSTS;
}
else
{
    printPostsTemplete($shapedPostsArr);
}
