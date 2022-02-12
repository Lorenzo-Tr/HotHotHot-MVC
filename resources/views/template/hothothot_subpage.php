<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/public/css/app.css">
    <script type="module" src="/public/js/main.js"></script>
</head>

<body class="bg-myBg text-white px-6 md:px-9 lg:px-0">
<header class="w-full py-8">
    <nav>
        <ul class="flex items-center">
            <li><a href="/hothothot"><img class="rotate-90 h-9 md:h-12" src="/public/assets/img/arrow.svg"
                                          alt="link to return to home page"></a>
            </li>
            <li>
                <h1 class="ml-4 uppercase"><?= $page_name ?></h1>
            </li>
        </ul>
    </nav>
</header>
<?php section('content') ?>
</body>
</html>

