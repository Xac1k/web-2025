<?php
$query = $_GET['data'];

if (isset($query)) {
    if (is_numeric($query) && ($query <= '30000') && ($query >= '0')) {
        if ((($query % 4 === 0) && ($query % 100 != 0)) || ($query % 400 === 0)) {
            echo 'YES';
        } else {
            echo 'NO';
        }
    } else {
        echo 'Не верный ввод';
    }
} else {
    echo 'Пустой ввод';
}

?>