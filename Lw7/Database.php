<?php

function connectDataBase(): PDO
{
    $dsn = 'mysql:host=127.0.0.1;dbname=blog';
    $password = '';

    return new PDO($dsn, 'root', $password);
}

function getPostsFromDB(PDO $con): array
{
    $query = <<<SQL
        SELECT * 
        FROM post
    SQL;

    $result = $con->query($query);
    return ($result->fetchAll(mode: PDO::FETCH_ASSOC));
}

function getURLImages(PDO $con, int $postId): array
{
    $query = <<<SQL
        SELECT * 
        FROM images
        WHERE post_id = {$postId};
    SQL;

    $result = $con->query($query);
    return ($result->fetchAll(mode: PDO::FETCH_ASSOC));
}

function getUserFromDB(PDO $con, int $id): array
{
    $query = <<<SQL
        SELECT * 
        FROM user
        WHERE id = {$id};
    SQL;

    $result = $con->query($query);
    return ($result->fetchAll(mode: PDO::FETCH_ASSOC));
}

function getOneRecordFromUserPostURL(array $user,array $post, array $urls): array 
{
    //( [name] => Лиза Дёмина 
    //[img_avatar] => lisa_demina.png 
    //[text] => 'Дво до цзин' ? классика нон-фикшн, которая остаётся актуальной. Погрузитесь в мудрость веков и откройте для себя глубину мысли. ?? #Классика #Философия #Чтение 
    //[created_time] => 2025-04-13 22:01:38 
    //[like] => 250 
    //[urls] => ( [0] => post1.png) )

    $res['name'] = $user[0]['name'];
    $res['img_avatar'] = $user[0]['img_avatar'];
    $res['text'] = $post['text'];
    $res['created_time'] = strtotime($post['created_time']);
    $res['like'] = $post['likes'];
    $res['urls'] = [];
    foreach ($urls as $url){
        array_push($res['urls'], $url['url']);
    }
    
    return $res;
}
