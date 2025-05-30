<?php

function getHTMLPost(array $data): string
{
    foreach ($data['urls'] as $link) 
    {
        if(!isset($images)) $images = "<img class='image' src='/lw8/image/$link' alt='Изображение'>";
        else $images .= "<img class='image' src='/lw8/image/$link' alt='Изображение' hidden>";
    }

    return <<<HTML
                <div class="frame"> 
                    <div class="block-avatar">
                        <img class="avatar" src="/lw8/image/{$data['img_avatar']}" alt="Аватар пользователя">
                        <span class="text name">{$data['name']}</span>
                    </div>
                    {$images}
                    <div class="like">
                        <img class = "heart" src="/lw8/image/heart.png" alt="Сердечко">
                        <span>{$data['like']}</span> 
                    </div>
                    <p class="text">{$data['text']}</p>
                    <p class="text past">{$data['time']}</p>
                </div>
            HTML;
}