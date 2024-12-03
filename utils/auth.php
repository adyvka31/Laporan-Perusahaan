<?php
global $connection;
require_once($_SERVER['DOCUMENT_ROOT'] . "/utils/function.php");

if (isset($_POST["login"])) {
    $notification = login($_POST);
    if ($notification) {
        header("Location: /auth/login.php?notification=" . urlencode($notification));
        exit;
    }
}

if (isset($_GET['page']) == 'logout') {
    logout();
}

function login($data)
{
    session_start();
    $username = $data["username"];
    $password = $data["password"];

    $result = query("SELECT akun.*, role.nama as role_name
        FROM akun JOIN role ON akun.Role = role.id
        WHERE username = '$username'
    ");

    if (count($result) > 0) {


        if (password_verify($password, $result[0]["Password"])) {
            $_SESSION["login"] = true;
            $_SESSION["nama"] = $result[0]["Nama"];
            $_SESSION["user_id"] = $result[0]["id"];
            $_SESSION["username"] = $result[0]["Username"];
            $_SESSION["role_name"] = $result[0]["role_name"];
            
            return "<script>
            alert('Berhasil Login');
            window.location.href = '/admin/index.php?page=dashboard';
        </script>";
        } else {

            "<script>
            alert('Login Gagal');
            window.location.href = '/auth/login.php';
        </script>";
        }
    } else {
        "<script>
            alert('User Tidak Di Temukan');
            window.location.href = '/auth/login.php';
        </script>";
    }

    return null;
}

function logout()
{
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('id', '', time() - 3600);
    setcookie('key', '', time() - 3600);

    echo "<script>
    window.location.href = '/auth/login.php';
    </script>";
    exit;
}
