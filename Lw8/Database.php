<?php

require_once "../utils.php";
const FILE_ERROR_UNKNOWN_USER = 'unknownUser.png';

function connectDataBase(): PDO
{
    $dsn = 'mysql:host=127.0.0.1;dbname=blog';
    $password = '';

    return new PDO($dsn, 'root', $password);
}

function getPostsFromDB(PDO $con): array
{
    $queryToPost = <<<SQL
        SELECT * 
        FROM post
    SQL;

    $result = $con->query($queryToPost);
    return ($result->fetchAll(mode: PDO::FETCH_ASSOC));
}

function getURLImages(PDO $con, int $postId): array
{
    $queryToPost = <<<SQL
        SELECT * 
        FROM images
        WHERE post_id = {$postId};
    SQL;

    $result = $con->query($queryToPost);
    $data = $result->fetchAll(mode: PDO::FETCH_ASSOC);

    return ($data);
}

function getUserFromDB(PDO $con, int $id): array
{
    $queryToPost = <<<SQL
        SELECT * 
        FROM user
        WHERE id = {$id};
    SQL;

    $result = $con->query($queryToPost);
    return ($result->fetchAll(mode: PDO::FETCH_ASSOC));
}

function getOneRecordFromUserPostURL(array $user, array $post, array $urls): array
{
    //( [name] => Лиза Дёмина 
    //[img_avatar] => lisa_demina.png 
    //[text] => 'Дво до цзин' ? классика нон-фикшн, которая остаётся актуальной. Погрузитесь в мудрость веков и откройте для себя глубину мысли. ?? #Классика #Философия #Чтение 
    //[created_time] => 2025-04-13 22:01:38 
    //[like] => 250 
    //[urls] => ( [0] => post1.png) )

    $res['name'] = $user[0]['name'];
    $res['img_avatar'] = getOrDefault($user[0]['img_avatar'], FILE_ERROR_UNKNOWN_USER);
    $res['text'] = getOrDefault($post['text'], "");
    $res['created_time'] = strtotime($post['created_time']);
    $res['like'] = getOrDefault($post['likes'], 0);
    $res['urls'] = [];
    foreach ($urls as $url) {
        if (isImageFormatSupported($url['url'])) array_push($res['urls'], $url['url']);
    }

    return $res;
}

function putPostDB(PDO $con, int $userId, string $nameImg, string $text): void
{
    $time = date('YmdGis', time());
    //Save Post into DB 
    $queryToPost = <<<SQL
                INSERT INTO 
                post(created_by, text, created_time, likes)
                VALUES(?, ?, ?, ?);
            SQL;
    $statemant = $con->prepare($queryToPost);
    $statemant->execute([$userId, $text, $time, 0]);

    //Get post_id
    $idPost = $con->lastInsertId('post');

    //Save image into DB 
    $queryToImages = <<<SQL
                INSERT INTO 
                images(post_id, url)
                VALUES(?, ?);
                SQL;
    $statemant = $con->prepare($queryToImages);
    $statemant->execute([$idPost, $nameImg]);
}
