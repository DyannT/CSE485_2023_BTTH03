<?php
require("services/AdminService.php");
class LoginController
{
    public function index()
    {
        include("view/home/login.php");
    }
    public function login()
    {
        $userService = new AdminService();
        $username = $_POST['txtUser'];
        $password = $_POST['txtPassword'];

        $user = $userService->login($username, $password);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header('Location: index.php?controller=admin');
            exit;
        } else {
            header("Location: index.php?controller=login&error='Invalid user or pass'");
            exit;
        }
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header('Location: index.php?controller=login');
        exit;
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['txtUser'];
            $password = $_POST['txtPassword'];
            $userService = new AdminService();
            $userService->register($username, $password);
            header("Location: index.php?controller=login&success='Register success'");
            // include("view/home/login.php");
        } else {

            include("view/home/register.php");
        }
    }
}
