<?php
require_once "Database.php";

$method = $_SERVER['REQUEST_METHOD'];

echo $method . '<br>';

if (isset($_GET['id']) && (strlen(trim($_GET['id'])) != 0)) {
    if (isset($_POST['text'])){
        if (($_FILES['img']['size'] < 100 * 1024 * 1024) && $_FILES['img']['type'] == 'image/png') {
            $nameFile = uniqid().'.png';
            move_uploaded_file($_FILES['img']['tmp_name'], 'image/' . $nameFile);

            //Print some information
            echo '<br>id=' . $_GET['id'] . '<br>';
            echo uniqid().'.png';
            echo '<br>text=' . $_POST['text'];

            //save Post In DB
            $DB = connectDataBase();
            putPostDB($DB, $_GET['id'], $nameFile, $_POST['text']);
        } else {
            echo 'Разрем изображения превышает 100 мб';
        }
    } else {
        echo 'Ошибка ввода текста';
    }
} else {
    echo 'Пользователь не введён';
}
