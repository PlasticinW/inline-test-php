<?php 
    #получаем дату из ссылок и сохраняем в файлы и далее это закоментируем
    #$posts_json = file_get_contents('https://jsonplaceholder.typicode.com/posts');
    #$comments_json = file_get_contents('https://jsonplaceholder.typicode.com/comments');
    #file_put_contents('posts.json', $posts_json);
    #file_put_contents('comments.json', $comments_json);
    #дёргаем дату из файлов
    $posts_json = file_get_contents('posts.json');
    $comments_json = file_get_contents('comments.json');
    #декодируем её в массив для дальнейшей вставки в бд (postgreSQL)
    $posts_decoded = json_decode($posts_json, true);
    $comments_decoded = json_decode($comments_json, true);
    #вводим параметры бд, в моём случае это были 'host=localhost port=5432 dbname=inlinedatabase user=postgres password=...'
    $connect = pg_connect('host=localhost port=5432 dbname=inlinedatabase user=postgres password=...');
    #это для проверки
    #print_r($comments_decoded[0]);
    #print_r($comments_decoded[499]["postId"]);
    #print_r(count($comments_decoded));
    #print_r($comments_decoded[0]);
    #echo count($comments_decoded);
    for ($i = 0; $i < count($posts_decoded); $i++) {
        #могли бы передать сразу $posts_decoded[$i], но я оплашал и в моей таблице userId это userid, из-за разницы в регистре получается ошибка
        $userId = $posts_decoded[$i]["userId"];
        $id = $posts_decoded[$i]["id"];
        $title = $posts_decoded[$i]["title"];
        $body = $posts_decoded[$i]["body"];
        $data = array("userid" => $userId, "id" => $id, "title" => $title, "body" => $body);
        pg_insert($connect, "posts", $data);
    }
    for ($i = 0; $i < count($comments_decoded); $i++) {
        $postId = $comments_decoded[$i]["postId"];
        $id = $comments_decoded[$i]["id"];
        $name = $comments_decoded[$i]["name"];
        $email = $comments_decoded[$i]["email"];
        $body = $comments_decoded[$i]["body"];
        $data = array("postid" => $postId, "id" => $id, "name" => $name, "email" => $email, "body" => $body);
        pg_insert($connect, "comments", $data);
    }
    echo "Загружено " . count($posts_decoded) . " записей и " . count($comments_decoded) . " комментариев";
?>