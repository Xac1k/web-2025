<?php
require_once '../Database.php';

function getDiferenceTime(int $created_time): string
{
    $time = intdiv(time() - $created_time, 3600);
    return "$time" . ' ч назад';
}

function getImageHTML(array $urls): string
{
    foreach ($urls as $url) {
        if (isset($res)) {
            $res .= <<<HTML
                    <img src="../image/{$url}" alt="Фото поста" class="post-frame__images post-frame__images_hidden">
                HTML;
        } else {
            $res = <<<HTML
                    <img src="../image/{$url}" alt="Фото поста" class="post-frame__images">
                HTML;
        }
    }
    return $res;
}

function getPostImageFrame(array $data): array
{
    if (count($data['urls']) > 1) {
        $count = count($data['urls']);
        $slider = <<<HTML
                        <img src="../image/leftSlider.png" alt="Слайдер" class="post-frame__slider_left">
                        <img src="../image/rigthSlider.png" alt="Слайдер" class="post-frame__slider_right">
                        <div class="post-frame__counter-foto">1/{$count}</div>
                    HTML;
        $imageHTML = getImageHTML($data['urls']);
    } else {
        $imageHTML = <<<HTML
                        <img src="../image/{$data['urls'][0]}" alt="Фото поста" class="post-frame__images">
                    HTML;
        $slider = '';
    }

    return [
        'imageHTML' => $imageHTML,
        'slider' => $slider
    ];
}

function getHTMLPost(array $data): string
{
    $imagePost_frame = getPostImageFrame($data);

    return <<<HTML
            <div class="post-frame">
                <div class="post-frame__header">
                    <img src="../image/{$data['img_avatar']}" alt="Аватарка" class="post-frame__foto">
                    <h1 class="post-frame__name">{$data["name"]}</h1>
                    <img src="../image/edit.png" alt="Редактор иконка" class="post-frame__edit">
                </div>
                <div class="post-frame__post">
                    <div class = "image-frame_inner">{$imagePost_frame['imageHTML']}</div>
                    {$imagePost_frame['slider']}
                </div>
                <div class="post-frame__likes">
                    <img src="../image/heart.png" alt="Лайк иконка" class="post-frame__heart">
                    <span class="post-frame__counter-like">{$data['like']}</span>
                </div>
                <div class="post-frame__text_wraped-more">
                    <span class="post-frame__inner-text_hidden">
                        {$data['text']}
                    </span>
                    <div class="post-frame__more">ещё</div> 
                </div>
                <div class="post-frame__time-ago">{$data['time']}</div>
            </div>
            HTML;
}

$DB = connectDataBase();
$query = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if (!is_bool($DB)) {
    include "home.html";
    $modifierPost = 'first';
    $posts = getPostsFromDB($DB);

    if (is_array($posts)) {
        $resHTML = '';
        foreach ($posts as $post) {
            $user = getUserFromDB($DB, $post['created_by']);
            if (empty($user)) continue;
            $urls = getURLImages($DB, $post['id']);
            $infoPost = getOneRecordFromUserPostURL($user, $post, $urls);
            $time = getDiferenceTime($infoPost['created_time']);

            $info = $infoPost;
            $info['modifierPost'] = $modifierPost;
            $info['time'] = $time;

            if ($user[0]['id'] == $query or is_null($query)) {
                $resHTML .= getHTMLPost($info);
                $modifierPost = '';
            }
        }
        echo "<div class='working-frame'>" . $resHTML . "<div class='modal-frame_hidden'></div>" . '</div>';
    }
}