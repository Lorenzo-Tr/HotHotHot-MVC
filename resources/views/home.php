<?php extend('template/home')?>

<?php startSection('content');?>
<nav class="navbar">
    <a href="/" class="logo">
        <svg class="logo" viewBox="0 0 19 26" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.115.111c.17.092.3.236.371.407.071.171.079.36.021.536l-3.11 9.509h5.739c.169 0 .334.046.475.133.14.087.251.211.318.357a.768.768 0 0 1 .058.463.795.795 0 0 1-.222.416L4.947 25.744a.909.909 0 0 1-1.063.146.828.828 0 0 1-.37-.407.767.767 0 0 1-.021-.535l3.11-9.51H.864a.903.903 0 0 1-.475-.134.828.828 0 0 1-.318-.357.768.768 0 0 1-.058-.463.796.796 0 0 1 .222-.416L14.053.256A.91.91 0 0 1 15.115.11V.11Z"
                  fill="currentColor"/>
        </svg>
    </a>
    <?php
        if (isset($_SESSION["id"])) {
            echo '    <ul class="nav-links">
        <li class="nav-item "><a href="login/logout">Déconnexion</a></li>
        <li class="nav-item"><a class="button" href="#">'.$_SESSION["prenom"].'</a></li>
    </ul>';
        }
        else
            echo '    <ul class="nav-links">
        <li class="nav-item "><a href="inscription">Sign-in</a></li>
        <li class="nav-item"><a class="button" href="login">Log-in</a></li>
    </ul>';

    ?>

</nav>
<section class="wrapper">
    <div class="content">
        <h1>Combine comfort and energy savings on a daily basis.</h1>
        <section class="buttons">
            <a class="button" href="#">Download</a>
            <a class="button" href="#">Documentation</a>
        </section>
    </div>
</section>
<canvas id="gradient-canvas" data-transition-in></canvas>
<?php endSection()?>