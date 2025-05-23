<?php
const FILE_USERS = '../users.json';
const FILE_POSTS = '../posts.json';
const FILE_ERROR_UNKNOWN_USER = 'unknownUser.png';

require_once "../utils.php";

function getDiferenceTime(int $created_time): string
{
    $time = intdiv(time() - $created_time, 3600);
    return "$time" . ' ч назад';
}

function getPostInfo(array $post): array
{
    $postInfo['image'] = getOrDefault($post['image'], 'default_img.png');
    $postInfo['desription'] = getOrDefault($post['text_post'], '');
    $postInfo['like'] = getOrDefault($post['like'], '');
    $created_time = getOrDefault($post['created_time'], time());
    $postInfo['time'] = getDiferenceTime($created_time);

    return $postInfo;
}

$users = file_get_contents(FILE_USERS);
$posts = file_get_contents(FILE_POSTS);

$users = json_validate($users) ? json_decode($users, true) : false;
$posts = json_validate($posts) ? json_decode($posts, true) : false;

$query = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
$hasQuery = !is_null($query);

if (!is_bool($users) && !is_bool($posts)) {
    include "home.html";
    include_once "templatePost.php";
    $res = '';
    foreach ($posts as $post) {
        $idUser = $post['created_by_id_user'];

        if ($hasQuery) {
            if (is_bool(getUserInfo($users, $query))) {
                echo "<p style = 'text-align: center;' >Такого пользователя нет</p>";
                break;
            }
        }

        if (($query === $idUser) || !$hasQuery) {
            $userInfo = getUserInfo($users, $idUser);
            $postInfo = getPostInfo($post);

            if (is_array($userInfo)) {
                $res .= renderPost($userInfo, $postInfo);
            }
        }
    }
    echo "<div class='frames'>{$res}</div>";
} else {
    echo 'Ошибка чтения JSON файла';
}