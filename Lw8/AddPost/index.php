<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../font/font.css">
    <link  rel="stylesheet" href="Create_post.css">
    <script src="Create_post.js"></script>
    <title>Создание поста</title>
</head>
<body>
    <div class="menu">
        <img src="../image/home.png" class="menu__img first" alt="Иконка дома" onclick="window.location.href ='http://localhost:8001/home'">
        <img src="../image/profile.png" class="menu__img" alt="Иконка меню" onclick="window.location.href ='http://localhost:8001/profile'">
        <img src="../image/add.png" class="menu__img" alt="Иконка добавления поста" onclick="window.location.href ='http://localhost:8001/addPost'">
    </div>
    <?php $id =isset($_GET['id']) ? $_GET['id'] : '';?>
    <form class="main-screen" method="post" <?php echo "action='API.php?id=".$id."'"?> enctype="multipart/form-data"><!-- Динамически генерировать id это нормально? -->
        <div class="loading-file" id="loading-file">
            <img src="../image/image.png" alt="Иконка изображения" id="load_img" class="loading-file__img">
            <label for="load-file" class="loading-file__button" id="load_button">Добавить фото</label>
            <input type="file" id="load-file" accept='image/png' name="img" hidden required>
        </div>

        <label for="load-file" class="button-link text">
            <img src="../image/plus.png" class="button-link__img">Добавить фото
        </label>
        <input type="text" class="text-field text" id="text-field" placeholder="Добавьте подпись..." name="text" required>
        <input type="submit" class="button-submit" value="Поделиться" id="submite">
    </form>
</body>
</html>