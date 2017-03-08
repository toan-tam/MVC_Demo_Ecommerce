<?php require "views/partials/head.view.php"?>

<?php if (isset($product) && $product):?>

    <div class="detail_container">
        <div class="row">
            <div class="col-md-4">
                <img src="uploads/<?=$product->image?>" width="100%" class="product_image">
            </div>

            <div class="col-md-8">
                <h3><?=$product->name?></h3>
                <p><?=$product->description?></p>
                <p>Giá : <span class="price"><?=$product->price?>đ</span></p>

                <a class="btn btn-primary btn-lg" href="<?=route("orders", "insertShoppingCartItem&id=" . $product->id)?>"> <span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng</a>
            </div>

        </div>
    </div>

<?php endif;?>

<?php require "views/partials/footer.view.php"?>