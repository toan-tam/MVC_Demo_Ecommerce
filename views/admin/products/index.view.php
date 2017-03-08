<?php require "views/admin/partials/head.view.php"; ?>
<h2 class="text-center">QUẢN LÝ SẢN PHẨM</h2>
<br>
<a href="<?=route("products", "create", "admin")?>" class="btn btn-primary">Thêm mới</a>
<br><br>

<?php if (isset($menus)): ?>
    <?php foreach ($menus as $menu) : ?>
        <a href="<?=route("products", "index&menuId=" .$menu->id, "admin")?>" class="btn <?= isset($_GET['menuId']) && $_GET['menuId'] == $menu->id ? 'btn-primary' : 'btn-default'; ?>"><?= $menu->name; ?></a>
    <?php endforeach; ?>
<?php endif; ?>
<br><br>


<div class="table-responsive">
    <table class="table table-hover table-bordered table-responsive text-center">
        <tr>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Giá sản phẩm</th>
            <th>Thuộc Menu</th>
            <th colspan="2">Thao tác</th>
        </tr>
        <tbody>
        <?php if (isset($products)): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->name ?></td>
                    <td><img src="uploads/<?= $product->image?>" width="150" /></td>
                    <td><?= $product->description; ?></td>
                    <td><?= $product->price ?>đ</td>
                    <td><?= $product->getMenuName(); ?></td>
                    <td class="text-right"><a href="<?=route("products", "edit&id=" . $product->id, "admin")?>" class="btn btn-primary"> Sửa </a></td>
                    <td align="left"><a onclick="return confirmDelete();" href="<?=route("products", "destroy&id=" . $product->id, "admin")?>" class="btn btn-danger"> Xóa </a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</div>
<?php require "views/admin/partials/footer.view.php"; ?>