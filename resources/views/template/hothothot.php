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
        <ul class="flex justify-between items-center">
            <li>
                <a href="hothothot/profile">
                    <img class="rounded-full min-h-10 h-12 md:h-14 lg:h-16 "
                         src="/public/assets/img/profilePicture.jpg" alt="Link to user setting">
                </a>
            </li>
            <li class="inline-flex">
                <svg style="width: 40px; height: 40px;" viewBox="0 0 19 26" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.115.111c.17.092.3.236.371.407.071.171.079.36.021.536l-3.11 9.509h5.739c.169 0 .334.046.475.133.14.087.251.211.318.357a.768.768 0 0 1 .058.463.795.795 0 0 1-.222.416L4.947 25.744a.909.909 0 0 1-1.063.146.828.828 0 0 1-.37-.407.767.767 0 0 1-.021-.535l3.11-9.51H.864a.903.903 0 0 1-.475-.134.828.828 0 0 1-.318-.357.768.768 0 0 1-.058-.463.796.796 0 0 1 .222-.416L14.053.256A.91.91 0 0 1 15.115.11V.11Z"
                          fill="currentColor"/>
                </svg>
            </li>
            <li><a href="hothothot/setting"><img class="h-9 md:h-12" src="/public/assets/img/setting.svg"
                                            alt="Link to app setting"></a></li>
        </ul>
    </nav>
</header>
<?php section('content') ?>
</body>
</html>

