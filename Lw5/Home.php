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

function getDiferenceTime(int $created_time): string
{
    $time = intdiv(time() - $created_time, 3600);
    return "$time" . ' ч назад';
}

function getHTMLPost(array $userInfo, array $postInfo): string {
    return <<<HTML
                <div class="frame {$postInfo['modifierPost']}"> 
                    <div class="block-avatar">
                        <img class="avatar" src="/image/{$userInfo['image']}" alt="Аватар пользователя">
                        <span class="text name">{$userInfo['name']}</span>
                    </div>
                    <img class="image" src="/image/{$postInfo['image']}" alt="Изображение">
                    <div class="like">
                        <img class = "heart" src="/image/heart.png" alt="Сердечко">
                        <span>{$postInfo['like']}</span> 
                    </div>
                    <p class="text">{$postInfo['desription']}</p>
                    <p class="text past">{$postInfo['time']}</p>
                </div>
                HTML;
}

$users = file_get_contents(FILE_USERS);
$posts = file_get_contents(FILE_POSTS);

$users = json_validate($users) ? json_decode($users, true) : false;
$posts = json_validate($posts) ? json_decode($posts, true) : false;

$query = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if (!is_bool($users) && !is_bool($posts)) {

    $modifierPost = 'first';

    include "home/home.html";
    foreach ($posts as $post) {
        $hasQuery = !is_null($query);

        if ($hasQuery) {
            if (is_bool(getUserInfo($users, $query))) {
                echo "<p style = 'text-align: center;' >Такого пользователя нет</p>";
                break;
            } 
        }
        $idUser = $post['created_by_id_user'];
        
        if (($hasQuery && $query == $idUser) || !$hasQuery) {
            $postInfo['modifierPost'] = $modifierPost;
            $postInfo['image'] = $post['image'];
            $postInfo['desription'] = $post['text_post'];
            $postInfo['like'] = $post['like'];
            $created_time = $post['created_time'];
            $userInfo = getUserInfo($users, $idUser);
            $postInfo['time'] = getDiferenceTime($created_time);
            if (is_array($userInfo) ) {
                $html = getHTMLPost($userInfo, $postInfo);
                echo $html;
                $modifierPost = '';
            }
        }
    }
} else {
    echo 'Ошибка чтения JSON файла';
}