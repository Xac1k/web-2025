<?php

const FILE_USERS = '../users.json';
const FILE_POSTS = '../posts.json';
const FILE_ERROR_UNKNOWN_USER = 'unknownUser.png';
const ERROR_NO_POSTS = "<div style = 'text-align: center;'>У пользователя нет постов</div>";

require_once "../utils.php";

function getUserPosts(array $posts, string $id): array|bool
{
    $res = [];

    foreach ($posts as $post) {
        $isCreator = getOrDefault($post['created_by_id_user'], null) === $id;

        if ($isCreator && isImageFormatSupported($post['image'])) {
            array_push($res, $post['image']);
        }
    }

    if (count($res) > 0) {
        return $res;
    } else {
        return false;
    }
}

$users = file_get_contents(FILE_USERS);
$posts = file_get_contents(FILE_POSTS);

$users = json_validate($users) ? json_decode($users, true) : false;
$posts = json_validate($posts) ? json_decode($posts, true) : false;

$query = isset($_GET['id']) && is_numeric($_GET['id']) && preg_match('/^\d+$/', $_GET['id']) ? $_GET['id'] : null;

if ($query && !is_bool($users) && !is_bool($posts)) {
    $infoUser = getUserInfo($users, $query);

    if (!is_bool($infoUser)) {
        include 'profile.html';
        include "templeteProfile.php";

        $infoPosts = getUserPosts($posts, $query);
        $count = is_array($infoPosts) ? count($infoPosts) : 0;

        $user = getHTMLUser($infoUser, $count);
        $posts = is_array($infoPosts) ? getHTMLPosts($infoPosts) : ERROR_NO_POSTS;

        if (is_bool($user)) {
            header('Refresh: 2; url=http://localhost:8001/lw5/Home');
            echo "<p class = 'text name'>Ошибка данных пользователя</p>";
        } else {
            echo <<<HTML
                <div class="profile-frame">
                    {$user}
                    {$posts}
                </div>
             HTML;
        }
    } else {
        header('Refresh: 2; url=http://localhost:8001/lw5/Home');
        echo 'Пользователь с таким id не найден';
    }

} else {
    if (!$query) {
        header('Refresh: 2; url=http://localhost:8001/lw5/Home');
        if (!isset($_GET['id']))
            echo 'Невведён пользователь';
        if (!is_numeric($_GET['id']))
            echo 'Неверный id пользователя';
    }
    if (is_bool($users) || is_bool($posts)) {
        echo 'Ошибка чтения JSON файла';
    }
}