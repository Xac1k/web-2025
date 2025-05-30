<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $errorMsg ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            text-align: center;
            position: relative;
            padding: 0 20px;
        }

        .error-code {
            font-size: 150px;
            font-weight: 800;
            margin-bottom: 20px;
            position: relative;
        }

        .error-title {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .error-message {
            font-size: 18px;
            margin-bottom: 30px;
            max-width: 500px;
            opacity: 0.8;
            line-height: 1.6;
        }

        .home-btn {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: white;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(255, 65, 108, 0.3);
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .home-btn:hover {
            box-shadow: 0 15px 30px rgba(255, 65, 108, 0.4);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="error-code"><?= $code ?></h1>
        <h2 class="error-title"><?= $errorMsg ?></h2>
        <p class="error-message">Похоже, страница, которую вы ищете, была перемещена, удалена или никогда не
            существовала. Давайте вернем вас на безопасную орбиту.</p>
        <a href="../home" class="home-btn">Вернуться на главную</a>
    </div>
</body>

</html>