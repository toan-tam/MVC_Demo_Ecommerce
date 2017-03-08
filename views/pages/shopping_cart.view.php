<?php require "views/partials/head.view.php" ?>

    <section>
        <div class="form-group">
            <h2 class="type_title">Giỏ hàng ( <?= count($shoppingCartItems) ?> sản phẩm)</h2>

            <div class="table-responsive">
                <form action="<?= route("orders", "update") ?>" method="post">
                    <table class="table">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>

                        <?php $tongtien = 0; ?>
                        <?php foreach ($shoppingCartItems as $shoppingCartItem) : ?>
                            <tr>
                                <td>
                                    <input type="hidden" value="<?= $shoppingCartItem->order_id ?>" name="order_id">
                                    <img src="uploads/<?= $shoppingCartItem->getProduct()->image ?>" width="100">
                                </td>
                                <td><?= $shoppingCartItem->getProduct()->name ?></td>
                                <td>
                                    <input name="quantity[<?= $shoppingCartItem->product_id ?>]" type="number" value="<?= $shoppingCartItem->quantity ?>" min="1">
                                </td>
                                <td><?= $shoppingCartItem->price ?>đ</td>
                                <?php
                                    $thanhtien = $shoppingCartItem->price * $shoppingCartItem->quantity;
                                    $tongtien += $thanhtien;
                                ?>
                                <td><?= $thanhtien ?>đ</td>
                                <td>
                                    <a onclick="return confirmDelete();" href="<?= route("orders", "removeShoppingCartItem&order_id=" . $shoppingCartItem->order_id . "&product_id=" . $shoppingCartItem->product_id) ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (count($shoppingCartItems) > 0) : ?>
                            <tr>
                                <th colspan="3"></th>
                                <th>Tổng cộng</th>
                                <th colspan="2"><span class="total_cost"><?=$tongtien?>đ</span></th>
                            </tr>

                            <tr>
                                <td colspan="6" align="center">
                                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Cập nhật</button>
                                </td>
                            </tr>

                        <?php endif; ?>
                    </table>
                </form>
            </div>

        </div>

        <div class="form-group">
            <?php if (count($shoppingCartItems) > 0) : ?>
                <?php $orderId = $shoppingCartItems[0]->order_id;?>
                <a onclick="return confirm('Xác nhận đặt hàng ? ');" href="<?= route("orders", "order&order_id=" . $orderId) ?>" class="btn btn-danger btn-lg">TIẾN HÀNH ĐẶT HÀNG</a>
            <?php endif; ?>
        </div>
    </section>


<?php require "views/partials/footer.view.php" ?>