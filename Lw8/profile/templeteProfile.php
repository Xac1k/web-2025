<?php

const ERROR_UNKNOWN_USER = 'unknownUser.png';

function printHeaderProfile(array $user, int $count) {

    if (!isset($user['name']) || !is_string($user['name'])) {
        include '../notFoundResponse.php';
        printError('500');
    }

    $html = "<p class = 'text name'>{$user['name']}</p>";

    if(isset($user['img_avatar']) && is_string($user['img_avatar'])) {
        $html .= "<img class = 'avatar' src='../image/{$user['img_avatar']}'' alt='Аватар пользователя'>";
    }
    else
    {
        $html .= "<img class = 'avatar' src='../image/".ERROR_UNKNOWN_USER."' alt='Аватар пользователя'>";
    }

    if(isset($user['description']) && is_string($user['description'])) {
        $html .= "<p class = 'text about'>{$user['description']}</p>";
    }

    $html .= <<<HTML
        <div class = 'album text'>
            <img class = 'album-img' src='../image/album.png' alt='Иконка альбома'>
            <span>{$count} поста</span>
        </div>
    HTML;

    echo "<div class=profile-frame>".$html;
}

function printPostsTemplete($posts) 
{
    $postIdInLine = 0;
    $html = '';
    $res = '';

    foreach ($posts as $post) {
        $post = IsIntoStorage($post) ? $post : "default_img.png";

        if ($postIdInLine != 2) {
            $postIdInLine += 1;
            $html .= "<img class = 'post-image' src='../image/{$post}' alt='Пост'>";
        } else {
            $postIdInLine = 0;
            $res .= <<<HTML
                <div>
                    {$html}
                    <img class = "post-image" src="../image/{$post}" alt="Пост">;
                </div>
            HTML;
            $html = '';
        }
    }

    if ($postIdInLine != 0) {
        $res .= "<div>{$html}</div>";
    }

    echo $res;
}