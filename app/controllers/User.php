<?php
namespace app\controllers;
use app\controllers\Base;
class User extends Base
{
    private $user_model;

    public function __construct()
    {
        $this->user_model = $this->model('UserModel');
    }

    public function handle_login()
    {
        if (isset($_POST['submit__login'])) {
            $this->user_model->__set('email', trim($_POST['login_email']));
            $user = $this->user_model->get_user_login();
            if ($user && password_verify( trim($_POST['login_pwd']), $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Đăng nhập thành công!', 'type' => 'success'];
                if ($user['role'] == 2) {
                    header('Location: ' . _WEB_ROOT_ . '/admin/');
                } else {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
            } else {
                $_SESSION['messager'] = ['title' => 'Cảnh báo!', 'mess' => 'Sai tài khoản hoặc mật khẩu!', 'type' => 'error'];
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function handle_register() {
        if(isset($_POST['submit_register'])) {
            $hashed_pwd = password_hash(trim($_POST['register_pwd']), PASSWORD_DEFAULT);
            $this->user_model->__sets([trim($_POST['register_name']), trim($_POST['register_email']), $hashed_pwd]);
            $check_register = $this->user_model->insert_register();
            if($check_register > 0) {
                $_SESSION['messager'] = ['title' => 'Thành công!', 'mess' => 'Tạo tài khoản thành công!', 'type' => 'success'];
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: ' . _WEB_ROOT_ . '/');
    }
}