<?php
$laporan = query("SELECT * FROM laporan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perusahaan</title>
</head>

<body class="item-center">

    <?php
    if (isset($_POST['submit'])) {
        $result = tambahLaporan($_POST);
        if ($result == 1) {
            echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href = '/admin/index.php?page=laporan';
        </script>";
        } else {
            echo "<script>
            alert('Data gagal ditambahkan')
        </script>";
        }
    }
    ?>

    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Buat Data Lamaran
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="post" enctype="multipart/form-data">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                            <input type="text" name="nik" id="nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type nik" required="">
                        </div>
                        <div class="col-span-1">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type name" required="">
                        </div>
                        <div class="col-span-1">
                            <label for="kelahiran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelahiran</label>
                            <input type="date" name="kelahiran" id="kelahiran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type password" required="">
                        </div>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan Tujuan</label>
                        <select name="jabatan" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Pilih Jabatan</option>
                            <option id="Management Keuangan" value="Management Keuangan">Management Keuangan</option>
                            <option id="Software Developer" value="Software Developer">Software Developer</option>
                            <option id="Cleaning Service" value="Cleaning Service">Cleaning Service</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="deskripsi" class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block p-2.5 w-full mb-4 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="file" name="gambar" id="gambar" class="text-white border mb-2 border-gray-300 w-full">
                    </div>
            </div>
            <button name="submit" type="submit" class="w-full justify-center text-white inline-flex items-center  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
            </form>
        </div>
    </div>

    <section class="text-gray-600 body-font items-center overflow-hidden">
        <div class="py-2 my-20">
            <?php
            if ($_SESSION["role_name"] != 'admin'):
            ?>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="flex justify-center items-center mx-auto text-black bg-white border border-gray-300 font-medium rounded-lg text-sm px-8  hover:text-white hover:bg-blue-700 duration-500" type="button">
                    Tambah Data
                </button><?php endif ?>
        </div>

        <?php if (empty($laporan)) : ?>
            <tr>
                <td colspan="7" class="bg-white px-6 py-4 text-center text-black border-x border-b border-gray-700">
                    Data kosong
                </td>
            </tr>
        <?php else : ?>
            <?php foreach ($laporan as $laporan_pegawai) : ?>
                <div class="container px-5 py-24 -mt-20 mx-auto">
                    <div class="-my-8 divide-y-2 divide-gray-100">
                        <div class="py-8 flex flex-wrap md:flex-nowrap border-b border-gray-300 pb-14">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                <span class="font-semibold title-font text-gray-700"><?= $laporan_pegawai["jabatan"] ?></span>
                                <span class="mt-1 text-gray-500 text-sm"><?= $laporan_pegawai["kelahiran"] ?></span>
                                <img class="w-32 mt-4" src="../uploads/<?= $laporan_pegawai["gambar"] ?>">
                            </div>
                            <div class="md:flex-grow">
                                <h2 class="text-2xl font-medium text-gray-900 title-font mb-2"><?= $laporan_pegawai["nama"] ?></h2>
                                <span class="text-gray-500 text-sm"><?= $laporan_pegawai["kelahiran"] ?></span>
                                <p class="mt-2 leading-relaxed w-3/4"><?= $laporan_pegawai["deskripsi"] ?>.</p>
                                <a class="text-indigo-500 inline-flex items-center mt-4">Lihat CV
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </section>
</body>

</html>