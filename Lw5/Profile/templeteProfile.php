<?php
function getHTMLUser($arrayInfoUser, $count): string|bool
{
    if(!isset($arrayInfoUser['name'])) return false;

    $image = $arrayInfoUser['image'];

    $description = isset($arrayInfoUser['description']) ? <<<HTML
        <p class = "text about">{$arrayInfoUser['description']}</p>
    HTML : '';

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

function getHTMLPosts($arrayPosts): string
{
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