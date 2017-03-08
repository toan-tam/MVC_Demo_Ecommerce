<?php require "views/partials/head.view.php"; ?>
    <form action="?controller=auth&action=register" method="post" class="form-horizontal">

        <h2 class="text-center">ĐĂNG KÝ TÀI KHOẢN</h2>

        <br>

        <!-- Họ tên Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Họ tên:</label>
            <div class="col-md-4">
                <input type="text" name="name" class="form-control"/>
            </div>
        </div>

        <!-- Điện thoại Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="phone_number">Điện thoại:</label>
            <div class="col-md-4">
                <input type="text" name="phone_number" class="form-control"/>
            </div>
        </div>

        <!-- Email Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email:</label>
            <div class="col-md-4">
                <input type="text" name="email" class="form-control"/>
            </div>
        </div>

        <!-- Địa chỉ Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="address">Địa chỉ:</label>
            <div class="col-md-4">
                <input type="text" name="address" class="form-control"/>
            </div>
        </div>

        <!-- Tên tài khoản Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="username">Tên tài khoản:</label>
            <div class="col-md-4">
                <input type="text" name="username" class="form-control"/>
            </div>
        </div>

        <!-- Mật khẩu Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Mật khẩu:</label>
            <div class="col-md-4">
                <input type="password" name="password" class="form-control"/>
            </div>
        </div>

        <!-- Nhập lại mật khẩu Form input -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password_confirm">Nhập lại mật khẩu:</label>
            <div class="col-md-4">
                <input type="password" name="password_confirm" class="form-control"/>
            </div>
        </div>

        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" value="Đăng ký"> &nbsp;
            <input type="reset" class="btn btn-default" value="Nhập lại">
        </div>

    </form>
<?php require "views/partials/message.view.php" ?>