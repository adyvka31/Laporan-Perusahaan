<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/layout/header.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/layout/navbar.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/function.php");
if ($_GET['page'] == "" || $_GET["page"] == "dashboard") {
    include_once('dashboard.php');
}

if ($_GET['page'] == "pengguna") {
    include_once('pengguna.php');
}


if ($_GET['page'] == "hapus_pengguna") {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $result = hapus($_GET['id']);
        if ($result == 1) {
            echo "<script>
                alert('Data berhasil dihapus');
                window.location.href = '/admin/index.php?page=pengguna';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus')
            </script>";
        }
    }
}

if ($_GET['page'] == "laporan") {
    include_once('laporan.php');
}

if ($_GET['page'] == "daftarlaporan") {
    include_once('daftarLaporan.php');
}

if ($_GET['page'] == "logout") {
    include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/auth.php");
}
