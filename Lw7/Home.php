<?php

const FILE_USERS = 'users.json';
const FILE_POSTS = 'posts.json';
const FILE_ERROR_UNKNOWN_USER = 'unknownUser.png';

require_once 'Database.php';

function getDiferenceTime(int $created_time): string
{
    $time = intdiv(time() - $created_time, 3600);
    return "$time" . ' ч назад';
}

function getHTMLPost(array $data): string
{
    return <<<HTML
            <div class="frame {$data['modifierPost']}"> 
                <div class="block-avatar">
                    <img class="avatar" src="/image/{$data['img_avatar']}" alt="Аватар пользователя">
                    <span class="text name">{$data['name']}</span>
                </div>
                <img class="image" src="/image/{$data['urls'][0]}" alt="Изображение">
                <div class="like">
                    <img class = "heart" src="/image/heart.png" alt="Сердечко">
                    <span>{$data['like']}</span> 
                </div>
                <p class="text">{$data['text']}</p>
                <p class="text past">{$data['time']}</p>
            </div>
            HTML;
}

$DB = connectDataBase();
$query = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if (!is_bool($DB)) {
    include "home/home.html";
    $modifierPost = 'first';
    $posts = getPostsFromDB($DB);

    if (is_array($posts)) {
        foreach ($posts as $post) {
            $user = getUserFromDB($DB, $post['created_by']);
            $urls = getURLImages($DB, $post['id']);
            $infoPost = getOneRecordFromUserPostURL($user, $post, $urls);
            $time = getDiferenceTime($infoPost['created_time']);

            $info = $infoPost;
            $info['modifierPost'] = $modifierPost;
            $info['time'] = $time;
            
            if ($user[0]['id'] == $query OR is_null($query)) {
                echo getHTMLPost($info);
                $modifierPost = '';
            }
        }
    }
}