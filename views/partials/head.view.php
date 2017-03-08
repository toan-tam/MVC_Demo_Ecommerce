<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=isset($title) ? $title : "ITPSoft Shopping online";?></title>
    <link rel="stylesheet" href="views/css/bootstrap.min.css">
    <link rel="stylesheet" href="views/css/site.css">
</head>
<body>
<div class="container">
    <div class="above-nav">
        <a href="<?=route()?>"><img src="views/img/logo-itpsoft.png" alt="Logo"></a>
        <h1>ITPSOFT SHOPPING ONLINE</h1>
        <div class="giohang">
            <p>
                <?=Utils::getAuthDiv(); ?>
            </p>
            <a href="<?=route("pages", "shoppingCart")?>" class="btn btn-info btn-lg">
                <span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng
            </a>
        </div>
    </div>
    <nav>
        <ul>
            <li><a href="<?=route()?>">Trang chủ</a></li>
            <li><a href="<?=route("pages", "maleProducts")?>">Sản phẩm Nam</a></li>
            <li><a href="<?=route("pages", "femaleProducts")?>">Sản phẩm Nữ</a></li>
            <li><a href="#">Giới thiệu</a></li>
            <li><a href="#">Liên hệ</a></li>
        </ul>
    </nav>

    <main>
        <?php include "views/partials/message.view.php"; ?>