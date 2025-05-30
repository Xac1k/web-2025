<?php
    $error = [
        "404" => "Страница не найдена",
        "400" => "Неверный формат данных",
        "411" => "Слишком объёмный файл",
        "415" => "Неподдерживаемый тип данных",
        "500" => "Ошибка сервера",
        "503" => "Сервер не доступен"
    ];

    function printError(string $code) 
    {
        global $error;
        http_response_code($code);
        if (isset($error[$code]))
        {
            $errorMsg = $error[$code];
            include "errorPage.php";
        }
        die();
    }
?>


