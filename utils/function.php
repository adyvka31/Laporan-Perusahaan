<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/connection.php");


function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);

    $rows = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
    }

    return $rows;
}

function tambahUser($data)
{
    global $connection;

    $nama = htmlspecialchars($data["name"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $role = htmlspecialchars($data["role"]);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query_akun = "INSERT INTO akun (Nama, Username, Password, Role) VALUES ('$nama', '$username', '$password', '$role')";

    mysqli_query($connection, $query_akun);


    if (mysqli_affected_rows($connection) < 1) {
        return -1;
    }


    return mysqli_affected_rows($connection);
}

function tambahLaporan($data)
{
    global $connection;

    $nik = htmlspecialchars($data["nik"]);
    $nama1 = htmlspecialchars($data["nama"]);
    $kelahiran = htmlspecialchars($data["kelahiran"]);
    $jabatan = htmlspecialchars($data["jabatan"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $gambar =  $_FILES["gambar"];
    $tmpName =  $_FILES["gambar"]['tmp_name'];

    $filename = uniqid() . '-' . $gambar['name'];

    $imgFolder = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

    if (!is_dir($imgFolder)) {
        mkdir($imgFolder, 0755, true);
    }

    move_uploaded_file($tmpName, $imgFolder . $filename);

    $query_laporan = "INSERT INTO laporan (nik, nama, kelahiran, jabatan, deskripsi, gambar) VALUES ('$nik', '$nama1', '$kelahiran', '$jabatan', '$deskripsi', '$filename')";

    mysqli_query($connection, $query_laporan);

    return mysqli_affected_rows($connection);
}


function update($data)
{
    global $connection;
    $nama = htmlspecialchars($data["name"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $role = htmlspecialchars($data["role"]);

    $query = "UPDATE akun SET 
                Nama = '$nama',
                Username = '$username',
                Password = '$password',
                Role = '$role'";

    mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);
}

function hapus($id)
{
    global $connection;
    mysqli_query($connection, "DELETE FROM akun WHERE id = $id");
    return mysqli_affected_rows($connection);
}

function validatedateInput($data)
{
    $error = [];
    $valid = true;

    if (empty($data["Nama"])) {
        $error['Nama'] = "Nama harus di isi";
        $valid = false;
    } else {
        $nama = htmlspecialchars($data["Nama"]);
    }

    if (empty($data["Username"])) {
        $error['Username'] = "Username harus di isi";
        $valid = false;
    } else {
        $username = htmlspecialchars($data["Username"]);
    }

    if (empty($data["Password"])) {
        $error['Password'] = "Password harus di isi";
        $valid = false;
    } else {
        $password = htmlspecialchars($data["Password"]);
    }

    if (empty($data["Role"])) {
        $error['Role'] = "Role harus di isi";
        $valid = false;
    } else {
        $role = htmlspecialchars($data["Role"]);
    }

    // Laporan

    if (empty($data["nama"])) {
        $error['nama'] = "Nama harus di isi";
        $valid = false;
    } else {
        $nama = htmlspecialchars($data["nama"]);
    }

    if (empty($data["kelahiran"])) {
        $error['kelahiran'] = "Kelahiran harus di isi";
        $valid = false;
    } else {
        $kelahiran = htmlspecialchars($data["kelahiran"]);
    }

    if (empty($data["jabatan"])) {
        $error['jabatan'] = "Jabatan harus di isi";
        $valid = false;
    } else {
        $jabatan = htmlspecialchars($data["jabatan"]);
    }

    if (empty($data["deskripsi"])) {
        $error['deskripsi'] = "Deskripsi harus di isi";
        $valid = false;
    } else {
        $deskripsi = htmlspecialchars($data["deskripsi"]);
    }

    return ['valid' => $valid, 'error' => $error, 'data' => $data];
}

function formSubmit($data, $action)
{
    $validationResult = validatedateInput($data);
    $valid = $validationResult['valid'];
    $error = $validationResult['error'];
}
