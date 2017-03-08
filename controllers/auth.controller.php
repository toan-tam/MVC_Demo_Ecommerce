<?php

class AuthController{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AuthController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }


    /**
     *
     * handle register user
     *  */
    public function register()
    {
        $name = $_POST["name"];
        $phoneNumber = $_POST["phone_number"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $passwordConfirm = $_POST["password_confirm"];

        if (!$name) redirectWithErrorSession("?controller=auth&action=showRegistrationForm", "Họ tên không được để trống");
        if (!is_numeric($phoneNumber)) redirectWithErrorSession("?controller=auth&action=showRegistrationForm", "Số điện thoại phải là số");

        if (!$username && !$password) redirectWithErrorSession("?controller=auth&action=showRegistrationForm", "Tên tài khoản, mật khẩu không được để trống") ;

        if ($password != $passwordConfirm) redirectWithErrorSession("?controller=auth&action=showRegistrationForm", "Mật khẩu và nhập lại mật khẩu phải giống nhau");

        $this->userRepository->create(['name' => $name, 'phone_number' => $phoneNumber, 'email' => $email, 'address' => $address, 'username' => $username, 'password' => $password, 'role_id' => 2]);

        redirectWithMessageSession("?controller=auth&action=showLoginForm", "Tạo tài khoản thành công");
    }

    /**
     * handle login
     */
    public function login()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($username && $password) {
            $user = $this->userRepository->validate($username, $password);
            if ($user) {
                $_SESSION['currentUser'] = serialize($user);
                $_SESSION['login'] = true;

                if ($user->role_id == 1){
                    return redirectWithMessageSession(route("products", "index", "admin"));
                }

                return redirectWithMessageSession("?controller=pages&action=home");
            }
        }
        redirectWithErrorSession("?controller=auth&action=showLoginForm", "Tài khoản hoặc mật khẩu không đúng");
    }

    /**
     * show login form
     */
    public function showLoginForm()
    {
        $title = "Đăng nhập";
        require "views/auth/login.view.php";
    }


    /**
    *
    */
    public function logout()
    {
        session_unset();
        return redirectWithMessageSession(route());
    }

    /**
     * show registration form
     */
    public function showRegistrationForm()
    {
        $title = "Đăng ký";
        require "views/auth/register.view.php";
    }
}