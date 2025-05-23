<?php

function getHTMLPost(array $data): string
{
    return <<<HTML
                <div class="frame"> 
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