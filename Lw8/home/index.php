<?php

require_once '../database.php';
require_once 'templeteHome.php';

function getDiferenceTime(int $created_time): string
{
    $time = intdiv(time() - $created_time, 3600);
    return "$time" . ' ч назад';
}

$DB = connectDataBase();
$isInt = isset($_GET['id']) && preg_match("/^[0-9]*$/", $_GET['id']);
$query = isset($_GET['id']) && is_numeric($_GET['id']) && $isInt ? $_GET['id'] : null;

if ($query && !userIntoDB($DB, $query)) {
    require_once '../notFoundResponse.php';
    printError("404");
}

if (isset($_GET['id']) && !$isInt) {
    require_once '../notFoundResponse.php';
    printError("400");
}

if(!$DB) {
    require_once '../notFoundResponse.php';
    printError("503");
}

include_once 'home.html';
$res = '';

if ($query) {
    $posts = getInfoFromDB($DB, 'post', ['*'], "created_by = $query");
}
else
{
    $posts = getInfoFromDB($DB, 'post', ['*']);
}

foreach ($posts as $post) {
    $user = getInfoFromDB($DB, 'user', ['id', 'img_avatar', 'name'], "id={$post['created_by']}");
    if (!empty($user)) {
        $urls = getInfoFromDB($DB, 'image', ['url'], "post_id={$post['id']}");
        $infoPost = mergeDataUserPostURL($user, $post, $urls);
        $infoPost['time'] = getDiferenceTime($infoPost['created_time']);

        if ($user[0]['id'] == $query || !$query) {
            $res .= getHTMLPost($infoPost);
        }
    }
}
echo "<div class='frames'>" . $res . "</div>";