<?php require "views/admin/partials/head.view.php"; ?>
    <a href="<?=route("admin.orders", "deliveredToggle&id=" . $order->id, "admin")?>" class="btn btn-primary btn-sm"><?= $order->is_delivered ? "Hủy chuyển" : "Chuyển hàng"?></a>

    <h2 class="text-center">CHI TIẾT ĐƠN HÀNG</h2>
    <br>
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <td class="text-right">Họ và tên : </td>
                <td><?=$order->getOwner()->name?></td>
                <td class="text-right">SDT : </td>
                <td><?=$order->getOwner()->phone_number?></td>
                <td class="text-right">Địa chỉ : </td>
                <td><?=$order->getOwner()->address?></td>
            </tr>
        </table>

        <p>Danh sách sản phẩm:</p>
                <table class="table">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Thành tiền</th>
                    </tr>

                    <?php $tongtien = 0; ?>
                    <?php foreach ($orderItems as $orderItem) : ?>
                        <tr>
                            <td>
                                <img src="uploads/<?= $orderItem->getProduct()->image ?>" width="100">
                            </td>
                            <td><?= $orderItem->getProduct()->name ?></td>
                            <td>
                                <input disabled name="quantity[<?= $orderItem->product_id ?>]" type="number" value="<?= $orderItem->quantity ?>" min="1">
                            </td>
                            <td><?= $orderItem->price ?>đ</td>
                            <?php
                            $thanhtien = $orderItem->price * $orderItem->quantity;
                            $tongtien += $thanhtien;
                            ?>
                            <td><?= $thanhtien ?>đ</td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (count($orderItems) > 0) : ?>
                        <tr>
                            <th colspan="3"></th>
                            <th>Tổng cộng</th>
                            <th colspan="2"><span class="total_cost"><?=$tongtien?>đ</span></th>
                        </tr>

                    <?php endif; ?>
                </table>
    </div>


<?php require "views/admin/partials/footer.view.php"; ?>