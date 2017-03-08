<?php require "views/admin/partials/head.view.php"; ?>

    <h2 class="text-center">QUẢN LÝ MENU</h2>
    <br>
    <form action="<?=route("menus", isset($editMenu) ? "update&id=$editMenu->id" : "store", "admin")?>" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="row">
                <!-- Tên loại Menu Form input -->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="name">Tên Menu:</label>
                    <div class="col-md-7">
                        <input type="text" name="name" class="form-control" value="<?= isset($editMenu) ? $editMenu->name : '' ?>"/>
                    </div>
                </div>
                <!-- Tên loại Menu Form input -->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="menu_type_id">Loại Menu:</label>
                    <div class="col-md-7">
                        <select name="menu_type_id" class="form-control">
                            <?php foreach ($menuTypes as $menuType) : ?>
                                <option value="<?= $menuType->id; ?>" <?= isset($editMenu) && $menuType->id == $editMenu->menu_type_id ? 'selected' : ''; ?>><?= $menuType->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- Tên loại Menu Form input -->
                <div class="form-group">
                    <label class="col-md-3 control-label" for="parent_id">Menu cha:</label>
                    <div class="col-md-7">
                        <select name="parent_id" class="form-control">
                            <option value="0">Root</option>
                            <?php foreach ($menus as $menu) : ?>
                                <option value="<?= $menu->id; ?>" <?= isset($editMenu) && $menu->id == $editMenu->parent_id ? 'selected' : ''; ?>><?= $menu->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-md-offset-5">
                    <input type="submit" value="<?= isset($editMenu) ? "Cập nhật" : "Thêm mới"; ?>" class="btn btn-primary">
                    <input type="reset" value="Nhập lại" class="btn btn-default">
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-responsive text-center">
            <tr>
                <th>Tên Menu</th>
                <th>Menu cha</th>
                <th>Loại Menu</th>
                <th colspan="2">Thao tác</th>
            </tr>
            <tbody>
            <?php if (isset($menus)): ?>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?= $menu->name ?></td>
                        <td><?= $menu->parent_id == 0 ? "Root" : $menu->getParentName(); ?></td>
                        <td><?= $menu->getMenuTypeName(); ?></td>
                        <td class="text-right"><a href="<?=route("menus", "edit&id=" . $menu->id, "admin")?>" class="btn btn-primary"> Sửa </a></td>
                        <td align="left"><a onclick="return confirmDelete();" href="<?=route("menus", "destroy&id=" . $menu->id, "admin")?>" class="btn btn-danger"> Xóa </a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    </div>

<?php require "views/admin/partials/footer.view.php"; ?>