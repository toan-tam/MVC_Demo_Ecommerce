<?php require "views/admin/partials/head.view.php"; ?>

    <h2 class="text-center">QUẢN LÝ ĐẶT HÀNG</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-responsive text-center">
            <tr>
                <th>Người đặt</th>
                <th>SDT</th>
                <th>Thời gian</th>
                <th>Trạng thái</th>
                <th colspan="2">Thao tác</th>
            </tr>
            <tbody>
            <?php if (isset($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order->getOwner()->name ?></td>
                        <td><?= $order->getOwner()->phone_number ?></td>
                        <td><?= $order->getAmountTime() ?></td>
                        <td><a href="<?=route("admin.orders", "deliveredToggle&id=" . $order->id, "admin")?>" class="btn btn-primary btn-sm"><?= $order->is_delivered ? "Hủy chuyển" : "Chuyển hàng"?></a></td>
                        <td><a href="<?=route("admin.orders", "show&id=" . $order->id, "admin")?>" class="btn btn-primary"><span class="glyphicon glyphicon-info-sign"></span></a></td>
                        <td align="left"><a onclick="return confirmDelete();" href="<?=route("admin.orders", "destroy&id=" . $order->id, "admin")?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php require "views/admin/partials/footer.view.php"; ?>