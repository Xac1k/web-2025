<?php

const FILE_USERS = 'users.json';
const FILE_POSTS = 'posts.json';
const FILE_ERROR_UNKNOWN_USER = 'unknownUser.png';

function getUserInfo(array $users, string $id): array|bool
{
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            $name = isset($user['name']) && is_string($user['name']) ? $user['name'] : null;
            $img_avatar = isset($user['img_avatar']) && is_string($user['img_avatar']) ? $user['img_avatar'] : FILE_ERROR_UNKNOWN_USER;
            $description = isset($user['description']) && is_string($user['description']) ? $user['description'] : null;

            return [
                'name' => $name,
                'image' => $img_avatar,
                'description' => $description
            ];
        }
    }
    return false;
}

function getUserPosts(array $posts, string $id): array|bool
{
    $res = [];

    foreach ($posts as $post) {
        if (($post['created_by_id_user'] == $id) && preg_match('/^\w+.png$/u', $post['image'])) {
            array_push($res, $post['image']);
        }
    }
    if (count($res) > 0) {
        return $res;
    } else {
        return false;
    }
}

function getHTMLUser($arrayInfoUser, $count): string|bool
{
    if (isset($arrayInfoUser['name'])) {
        $image = $arrayInfoUser['image'];
        if (isset($arrayInfoUser['description'])) {
            $description = <<<HTML
                <p class = "text about">{$arrayInfoUser['description']}</p>
            HTML;
        } else {
            $description = '';
        }

        $html = <<<HTML
            <img class = "avatar" src="../image/{$image}" alt="Avatar-image">
            <p class = "text name">{$arrayInfoUser['name']}</p>
            {$description}
            <div class = "album text">
                <img class = "album-img" src="../image/album.png" alt="Иконка альбома">
                <span>{$count} поста</span>
            </div>
        HTML;

        return $html;
    }
    return false;
}

function getHTMLPosts($arrayPosts): string
{
    $width = 0;
    $countPosts = 0;
    $html = '';
    $res = '';

    foreach ($arrayPosts as $post) {
        if ($countPosts != 2) {
            $countPosts += 1;
            $html .= <<<HTML
                <img class = "post-image" src="../image/{$post}" alt="Пост">
            HTML;
        } else {
            $countPosts = 0;
            $res .= <<<HTML
                <div>
                    {$html}
                    <img class = "post-image" src="../image/{$post}" alt="Пост">
                </div>
            HTML;
            $html = '';
        }
    }

    if ($countPosts != 0) {
        $res .= <<<HTML
            <div>
                {$html}
            </div>
        HTML;
    }

    return $res;
}

$users = file_get_contents(FILE_USERS);
$posts = file_get_contents(FILE_POSTS);

$users = json_validate($users) ? json_decode($users, true) : false;
$posts = json_validate($posts) ? json_decode($posts, true) : false;

$query = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if ($query && !is_bool($users) && !is_bool($posts)) {
    $infoUser = getUserInfo($users, $query);

    if ($infoUser != false) {
        include 'profile/profile.html';

        $infoPosts = getUserPosts($posts, $query);
        $count = $infoPosts != false ? count($infoPosts) : 0;

        $user = getHTMLUser($infoUser, $count);
        $posts = $infoPosts != false ? getHTMLPosts($infoPosts) : 'У пользователя нет постов';

        if (is_bool($user)) {
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
        header('Refresh: 2; url=http://localhost:8001/Home.php');
        echo 'Пользователь с таким id не найден';
    }

} else {
    if (!$query) {
        header('Refresh: 2; url=http://localhost:8001/Home.php');
        if (!isset($_GET['id']))
            echo 'Невведён пользователь';
        elseif (!is_numeric($_GET['id']))
            echo 'Некоректно пользователь';
    }
    if (is_bool($users) || is_bool($posts)) {
        echo 'Ошибка чтения JSON файла';
    }
    
}