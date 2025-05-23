<?php

require_once "../utils.php";

function getHTMLPost(array $data): string
{

    $images = '';
    $pos = 0;
    foreach ($data['urls'] as $link) 
    {
        $pos = $pos + 1;
        if($pos == 1) $images .= "<img class='image' src='/image/$link' alt='Изображение'>";
        else $images .= "<img class='image' src='/image/$link' alt='Изображение' hidden>";
    }

    return <<<HTML
                <div class="frame"> 
                    <div class="block-avatar">
                        <img class="avatar" src="../image/{$data['img_avatar']}" alt="Аватар пользователя">
                        <span class="text name">{$data['name']}</span>
                    </div>
                    {$images}
                    <div class="like">
                        <img class = "heart" src="/image/heart.png" alt="Сердечко">
                        <span>{$data['like']}</span> 
                    </div>
                    <p class="text">{$data['text']}</p>
                    <p class="text past">{$data['time']}</p>
                </div>
            HTML;
}