<?php //сдано 6.6
function writeLuckyTicket(int $startNum, $endnum)
{
    for ($numTick = $startNum; $numTick < $endnum + 1; $numTick++) {
        $resStr = (string)$numTick;
        $length = strlen($resStr);
        $resStr = (str_repeat('0', 6 - $length)) . $resStr;
        $arr = str_split($resStr);
        if (($arr[0] + $arr[1] + $arr[2]) == ($arr[3] + $arr[4] + $arr[5])) {
            echo "$resStr </br>";
        }
    }
}

if (isset($_GET['dataStart']) && isset($_GET['dataEnd'])) {
    $dataStart = $_GET['dataStart'];
    $dataEnd = $_GET['dataEnd'];

    if (preg_match('/^[0-9]{6}$/', $dataStart) && preg_match('/^[0-9]{6}$/', $dataEnd)) {
        if ($dataStart < $dataEnd) {
            writeLuckyTicket($dataStart, $dataEnd);
        } else {
            echo 'Начальная дата и конечная дата перепутаны местами';
        }
    } else {
        echo 'Неверно введены билеты. Проверьте номера';
    }
}
?>