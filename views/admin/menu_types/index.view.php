<?php require "views/admin/partials/head.view.php"; ?>

<h2 class="text-center">QUẢN LÝ LOẠI MENU</h2>
<br>
<form action="<?= route("menu_types", (isset($editMenuType) ? "update&id=$editMenuType->id" : "store"), "admin") ?>" method="post" class="form-horizontal">
    <div class="form-group">
        <div class="row">
            <!-- Tên loại Menu Form input -->
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Tên loại Menu:</label>
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control" value="<?= isset($editMenuType) ? $editMenuType->name : '' ?>" />
                </div>
                <div class="col-md-2">
                    <input type="submit" value="<?= isset($editMenuType) ? "Cập nhật" : "Thêm mới";  ?>" class="btn btn-primary">
                </div>
            </div>
        </div>
    </div>
</form>
<div class="table-responsive">
    <table class="table table-hover table-bordered table-responsive text-center">
        <tr>
            <th>Tên loại Menu</th>
            <th colspan="2">Thao tác</th>
        </tr>
        <tbody>
        <?php if (isset($menuTypes)): ?>
            <?php foreach ($menuTypes as $menuType): ?>
                <tr>
                    <td><?= $menuType->name ?></td>
                    <td class="text-right"><a href="<?=route("menu_types", "edit&id=" . $menuType->id, "admin")?>" class="btn btn-primary"> Sửa </a></td>
                    <td align="left"><a onclick="return confirmDelete();" href="<?=route("menu_types", "destroy&id=" . $menuType->id, "admin")?>" class="btn btn-danger"> Xóa </a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</div>


<?php require "views/admin/partials/footer.view.php"; ?>
