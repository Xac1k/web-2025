<?php
    function translateNum(int $num): string {
        return match($num){
            1 => 'Один',
            2 => 'Два',
            3 => 'Три',
            4 => 'Четыре',
            5 => 'Пять',
            6 => 'Шесть',
            7 => 'Семь',
            8 => 'Восемь',
            9 => 'Девять',
            0 => 'Ноль',
            default => 'Ошибка ввода числа'
        };
    }

    
    if (isset($_GET['data'])) {
        echo translateNum($_GET['data']);
    }
?>
