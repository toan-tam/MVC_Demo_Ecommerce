<?php


require_once "models/User.php";
require_once "repositories/UserRepository.php";
class AdminController{

    
    
    public function changePassword()
    {
        $password = $_POST['txt_password'];
        $newPassword = $_POST['txt_new_password'];
        $confirmPassword = $_POST['txt_confirm_password'];
        
        if (!$password){
            return redirectWithErrorSession(route("admin", "showChangePasswordForm", "admin"), "Mật khẩu hiện tại không được để trống");
        }
        
        if (!$newPassword){
            return redirectWithErrorSession(route("admin", "showChangePasswordForm", "admin"), "Mật khẩu mới không được để trống");
        }
        
        if ($newPassword != $confirmPassword){
            return redirectWithErrorSession(route("admin", "showChangePasswordForm", "admin"), "Mật khẩu và nhập lại mật khẩu phải trùng nhau");   
        }

        if (Utils::getUser()->password != $password){
            return redirectWithErrorSession(route("admin", "showChangePasswordForm", "admin"), "Mật khẩu hiện tại không đúng");
        }

        $config = require "config.php";
        $pdo = Connection::make($config['database']);
        $userRepository = new UserRepository($pdo);

        $user = unserialize($_SESSION['currentUser']);

        $userRepository->updateById($user->id,[
           'password' => $newPassword
        ]);

        return redirectWithMessageSession(route("admin", "showChangePasswordForm", "admin"), "Đổi mật khẩu thành công");
        
    }


    public function showChangePasswordForm()
    {
        require "views/admin/pages/change_password.view.php";
    }
}