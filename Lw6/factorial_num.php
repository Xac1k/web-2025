<?php //сдать на следующей лабе
function getFactorial(int $num) {
    if ($num === 1 || $num === 0) {
        return 1;
    } else {
        return getFactorial($num - 1) * $num;
    }
}

$query = $_GET['data'];

if (isset($query)) {
    if (is_numeric($query)) {
        $res = getFactorial((int)$query);
        echo $res;
    }
}
?>