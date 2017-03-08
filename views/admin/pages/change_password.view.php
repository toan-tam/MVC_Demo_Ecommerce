<?php require "views/admin/partials/head.view.php"; ?>

    <h2 class="text-center">ĐỔI MẬT KHẨU</h2>
    <br>

    <form action="<?= route("admin", "changePassword", "admin") ?>" method="post">
        <div class="form-group">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-2">Mật khẩu hiện tại</div>
                <div class="col-md-4"><input type="text" class="form-control" name="txt_password"></div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-2">Mật khẩu mới</div>
                <div class="col-md-4"><input type="password" class="form-control" name="txt_new_password"></div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-2">Nhập lại mật khẩu</div>
                <div class="col-md-4"><input type="password" class="form-control" name="txt_confirm_password"></div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
              <div class="col-md-12 text-center">
                  <input type="submit" class="btn btn-primary" value="Cập nhật">
                  <input type="reset" class="btn btn-default" value="Nhập lại">
              </div>
            </div>
        </div>

    </form>


<?php require "views/admin/partials/footer.view.php"; ?>