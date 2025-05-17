<?php
function getZodiakSign(array $array): string {
    $day = $array[0];
    $month = $array[1];

    if (($month >= '13') || ($day > '31')) {
        return 'Ошибка ввода даты';
    }
    elseif ((($month === '03') && ($day >= '21')) || (($month === '04') && ($day <= '20'))) {
        return 'Овен';
    }
    elseif ((($month === '04') && ($day >= '21')) || (($month === '05') && ($day <= '20'))) {
        return 'Телец';
    }
    elseif ((($month === '05') && ($day >= '21')) || (($month === '06') && ($day <= '21'))) {
        return 'Близнецы';
    }
    elseif ((($month === '06') && ($day >= '22')) || (($month === '07') && ($day <= '22'))) {
        return 'Рак';
    }
    elseif ((($month === '07') && ($day >= '23')) || (($month === '08') && ($day <= '22'))) {
        return 'Лев';
    }
    elseif ((($month === '08') && ($day >= '23')) || (($month === '09') && ($day <= '23'))) {
        return 'Дева';
    }
    elseif ((($month === '09') && ($day >= '24')) || (($month === '10') && ($day <= '23'))) {
        return 'Весы';
    }
    elseif ((($month === '10') && ($day >= '24')) || (($month === '11') && ($day <= '22'))) {
        return 'Скорпион';
    }
    elseif ((($month === '11') && ($day >= '23')) || (($month === '12') && ($day <= '21'))) {
        return 'Стрелец';
    }
    elseif ((($month === '12') && ($day >= '22')) || (($month === '01') && ($day <= '20'))) {
        return 'Козерог';
    }
    elseif ((($month === '01') && ($day >= '21')) || (($month === '02') && ($day <= '18'))) {
        return 'Водолей';
    }
    elseif ((($month === '02') && ($day >= '19')) || (($month === '03') && ($day <= '20'))) {
        return 'Рыба';
    }
    else {
        return null;
    }
}

function getDateFromString(string $stringWithDate): array {
    $arr = explode('.', $stringWithDate);
    $day = (strlen($arr[0]) == 1) ? '0' . $arr[0] : $arr[0];
    $month = (strlen($arr[1]) == 1) ? '0' . $arr[1] : $arr[1];

    return [$day, $month];
}

$query = $_GET['data'];

if (isset($query)) {
    if (preg_match('/^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]+$/u', $query)) {
        echo getZodiakSign(getDateFromString($query));
    } else {
        echo 'Некорректный формат даты';
    }
}
?>