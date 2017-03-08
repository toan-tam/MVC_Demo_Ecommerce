<?php require "views/admin/partials/head.view.php"; ?>
<h2 class="text-center"><?=isset($product) ? "SỬA" : "THÊM MỚI" ?> SẢN PHẨM</h2>
<br>
<a href="<?=route("products", "index", "admin")?>" class="btn btn-primary">Trở lại</a>
<br><br>

<form class="form-horizontal" action="<?=route("products", isset($product) ? "update&id=" . $product->id : "store", "admin")?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <!-- Tên sản phẩm Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Tên sản phẩm:</label>
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" value="<?= isset($product) ? $product->name : '' ?>"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <!-- Tên sản phẩm Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="image">Ảnh:</label>
            <div class="col-md-6">
                <input type="file" name="fileToUpload">
            </div>
        </div>
    </div>


    <div class="form-group">
        <!-- Tên sản phẩm Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price">Giá:</label>
            <div class="col-md-6">
                <input type="text" name="price" class="form-control" value="<?= isset($product) ? $product->price : ''?>"/>
            </div>
        </div>
    </div>



    <div class="form-group">
        <!-- Tên sản phẩm Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="menu_id">Thuộc menu:</label>
            <div class="col-md-6">
                <select class="form-control" name="menu_id">
                    <?php foreach($menus as $menu) : ?>
                        <option value="<?= $menu->id; ?>" <?= isset($product) && $product->menu_id == $menu->id ? 'selected' : '' ?>><?= $menu->name ?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>


    <div class="form-group">
        <!-- Tên sản phẩm Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="price">Mô tả:</label>
            <div class="col-md-6">
                <textarea name="description" class="form-control" rows="6"><?= isset($product) ? $product->description : '' ?></textarea>
            </div>
        </div>
    </div>

    <div class="form-group text-center">
        <input type="submit" value="<?= isset($product) ? "Sửa" : "Thêm mới" ?>" class="btn btn-primary">
        <input type="reset" value="Nhập lại" class="btn btn-default">
    </div>

</form>


<?php require "views/admin/partials/footer.view.php"; ?>
