<?php

const FILE_USERS = 'users.json';
const FILE_POSTS = 'posts.json';


require_once '../Database.php';
require_once 'templeteHome.php';
require_once '../utils.php';

function getDiferenceTime(int $created_time): string
{
    $time = intdiv(time() - $created_time, 3600);
    return "$time" . ' ч назад';
}

$DB = connectDataBase();
$query = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if (!is_bool($DB)) {
    include "home.html";
    $posts = getPostsFromDB($DB);
    $res = '';

    if (is_array($posts)) {
        foreach ($posts as $post) {
            $user = getUserFromDB($DB, $post['created_by']);
            if($user){
                $urls = getURLImages($DB, $post['id']);
                $infoPost = getOneRecordFromUserPostURL($user, $post, urls: $urls);
                $infoPost['time'] = getDiferenceTime($infoPost['created_time']);
                
                if ($user[0]['id'] == $query || !$query) {
                    $res .= getHTMLPost($infoPost);
                }
            }
        }

        echo "<div class='frames'>".$res."</div>";
    }
}