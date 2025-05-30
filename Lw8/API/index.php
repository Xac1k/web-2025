<?php

require_once "../database.php";

const PICTURE_SIZE = 100 * 1024 * 1024;
$DB = connectDataBase();
$userId = isset($_GET['id']) && strlen(trim($_GET['id'])) != 0 && userIntoDB($DB, $_GET['id']) ? $_GET['id'] : null;
$text = isset($_POST['text']) && strlen(trim($_POST['text'])) != 0 && is_string($_POST['text']) ? $_POST['text'] : '';
$files = isset($_FILES['img']) && is_array($_FILES['img']) && !empty($_FILES['img']) ? $_FILES['img'] : null;

if(!$DB){
    include '../notFoundResponse.php';
    printError("503");
}
if(!$userId){
    include '../notFoundResponse.php';
    printError("400");
}
if(!$files){
    include '../notFoundResponse.php';
    printError("400");
}
if($files['type'] !== 'image/png'){
    include '../notFoundResponse.php';
    printError("415");
}
if($files['size'] > PICTURE_SIZE){
    include '../notFoundResponse.php';
    printError("411");    
}

$nameFile = uniqid().'.png';
move_uploaded_file($_FILES['img']['tmp_name'], '../image/'.$nameFile);

//Print some information
echo "Сохраняем пост <br>";
echo '<br>id=' . $userId . '<br>';
echo uniqid().'.png';
echo '<br>text=' . $text;

//save Post In DB
putPostDB($DB, $userId, $nameFile, $text);
header("Refresh: 2; url=http://localhost:8001/lw8/AddPost?id={$userId}");