<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= config_item('company_name') ?></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 34px;
            font-weight: bold;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .text-danger {
            color: #ff0000;
        }

    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <h1 class="text-danger">
                Your domain did not registered
            </h1>
            <p>Your domain did not registered.You need to register new domain from <a
                        style="text-decoration: none;color: #00a0d2;"
                        href="<?= config_item('default_url') ?>">here</a></p>
            <p class="bold"><a style="text-decoration: none;color: #000;" href="<?= config_item('default_url') ?>">Dont
                    worry
                    about payment.You can trial free </a></p>
        </div>
    </div>
</div>
</body>
</html>
