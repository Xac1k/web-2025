<?php

function renderPost(array $userInfo, array $postInfo): string {
    return <<<HTML
                <div class="frame"> 
                    <div class="block-avatar">
                        <img class="avatar" src="../image/{$userInfo['image']}" alt="Аватар пользователя">
                        <span class="text name">{$userInfo['name']}</span>
                    </div>
                    <img class="image" src="../image/{$postInfo['image']}" alt="Изображение">
                    <div class="like">
                        <img class = "heart" src="../image/heart.png" alt="Сердечко">
                        <span>{$postInfo['like']}</span> 
                    </div>
                    <p class="text">{$postInfo['desription']}</p>
                    <p class="text past">{$postInfo['time']}</p>
                </div>
                HTML;
}