<?php require "views/partials/head.view.php"; ?>
<form action="?controller=auth&action=login" method="post" style="margin-top: 100px" class="form-horizontal">
    <h2 class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ĐĂNG NHẬP HỆ THỐNG</h2>
    <br>
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="form-group">
                <div class="row">
                    <lable class="col-md-4 control-label">Tên đăng nhập</lable>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="username">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <lable class="col-md-4 control-label">Mật khẩu</lable>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row text-center">
                    <div class="col-md-2"></div>
                    <input type="submit" value="Đăng nhập" class="btn btn-primary btn_login"> &nbsp;
                    <input type="reset" value="Hủy" class="btn btn-default btn_login">
                </div>
            </div>
        </div>
    </div>
</form>
<?php require "views/partials/message.view.php"?>