<?php require "views/partials/head.view.php"?>

    <section>
        <div class="form-group">
            <h2 class="type_title">Sản phẩm Nam</h2>
            <div class="row">
                <?php foreach ($maleProducts as $maleProduct):?>

                    <div class="col-md-3">
                        <div class="box">
                            <a href="<?=route("pages", "showProduct&id=" . $maleProduct->id)?>"><img src="uploads/<?=$maleProduct->image?>"></a>
                            <p><a href="<?=route("pages", "showProduct&id=" . $maleProduct->id)?>"><?=$maleProduct->name?></a></p>
                            <p>Giá : <span class="price"><?=$maleProduct->price?>đ</span></p>
                            <a class="btn btn-primary" href="<?=route("orders", "insertShoppingCartItem&id=" . $maleProduct->id)?>"> <span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng</a>
                        </div>
                    </div>

                <?php endforeach;?>
            </div>
        </div>
    </section>

<?php require "views/partials/footer.view.php"?>