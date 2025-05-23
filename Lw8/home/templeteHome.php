<?php

require_once "../utils.php";

function getHTMLPost(array $data): string
{
    $images = getOrDefault($data['urls'][0], 'default_img.png'); 

    return <<<HTML
                <div class="frame"> 
                    <div class="block-avatar">
                        <img class="avatar" src="../image/{$data['img_avatar']}" alt="Аватар пользователя">
                        <span class="text name">{$data['name']}</span>
                    </div>
                    <img class="image" src="/image/{$images}" alt="Изображение">
                    <div class="like">
                        <img class = "heart" src="/image/heart.png" alt="Сердечко">
                        <span>{$data['like']}</span> 
                    </div>
                    <p class="text">{$data['text']}</p>
                    <p class="text past">{$data['time']}</p>
                </div>
            HTML;
}