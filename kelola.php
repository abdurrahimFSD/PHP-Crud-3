<?php

require "./connectDatabase.php";

session_start();

// UPDATE DATA
$idMahasiswa = '';
$npm = '';
$namaLengkap = '';
$jenisKelamin = '';
$prodi = '';
$alamat = '';

if(isset($_POST['update'])) {
    $idMahasiswa = $_POST['update'];

    $query = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$idMahasiswa';";
    $sql = mysqli_query($connectDatabase, $query);

    $result = mysqli_fetch_assoc($sql);

    $npm = $result['npm'];
    $namaLengkap = $result['nama_lengkap'];
    $jenisKelamin = $result['jenis_kelamin'];
    $prodi = $result['prodi'];
    $alamat = $result['alamat'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud-3 __ Kelola Data Mahasiswa</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="./assets/vendors/bootstrap/bootstrap.min.css">

    <!-- CSS Font Awesome -->
    <link rel="stylesheet" href="./assets/vendors/fontawesome/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold mx-auto mb-0 text-white">PHP Crud-3</span>
        </div>
    </nav>
    <!-- Navbar end -->

    <!--  -->
    <div class="container">
        <div class="row my-4">
            <div class="col-12 col-md-6 d-flex align-items-center">
                <?php
                    $action = isset($_POST['update']) ? 'update' : 'create';
                    $buttonText = ($action === 'update') ? 'Update' : 'Create';
                ?>
                <h5 class="mb-0">
                    <?php echo $buttonText; ?> Data Mahasiswa
                </h5>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="./index.php" class="btn btn-info">
                    <i class="fa-solid fa-arrow-left"></i>
                    Data Mahasiswa
                </a>
            </div>
        </div>

        <!-- Form Kelola Mahasiswa -->
        <form action="./proses.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_mahasiswa" value="<?= $idMahasiswa; ?>">

            <div class="row mb-4">
                <label for="npm" class="col-sm-2 col-form-label">NPM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="npm" id="npm" value="<?= $npm; ?>" required>
                </div>
            </div>

            <div class="row mb-4">
                <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $namaLengkap; ?>" required>
                </div>
            </div>

            <div class="row mb-4">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-select" required name="jenis_kelamin" id="jenis_kelamin">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option <?php if($jenisKelamin == 'Laki-Laki') {echo "selected";} ?> value="Laki-Laki">Laki-Laki</option>
                        <option <?php if($jenisKelamin == 'Perempuan') {echo "selected";} ?> value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                <div class="col-sm-10">
                    <select required class="form-select" name="prodi" id="prodi">
                        <option selected>Pilih Prodi</option>
                        <option <?php if($prodi == 'Teknik Informatika') {echo "selected";} ?> value="Teknik Informatika">Teknik Informatika</option>
                        <option <?php if($prodi == 'Sistem Informasi') {echo "selected";} ?> value="Sistem Informasi">Sistem Informasi</option>
                        <option <?php if($prodi == 'Teknik Sipil') {echo "selected";} ?> value="Teknik Sipil">Teknik Sipil</option>
                        <option <?php if($prodi == 'Teknik Mesin') {echo "selected";} ?> value="Teknik Mesin">Teknik Mesin</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-4">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" id="alamat" rows="2" required><?= $alamat; ?></textarea>
                </div>
            </div>
            
            <div class="row mb-4">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="foto" id="foto" accept="image/*" <?php if(!isset($_POST['update'])) {echo "required";} ?> >
                </div>
            </div>

            <div class="row">
                <div class="col">

                    <?php
                        $action = isset($_POST['update']) ? 'update' : 'create';
                        $buttonText = ($action === 'update') ? 'Update Data' : 'Create Data';
                    ?>
                    <button class="btn btn-success me-2" type="submit" name="action" value="<?= $action; ?>">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <?= $buttonText; ?> 
                    </button>

                    <button class="btn btn-danger"  type="reset"><i class="fa-solid fa-rotate"></i> Reset</button>
                </div>
            </div>
            
        </form>
        <!-- Form Kelola Mahasiswa end -->

    </div>
    <!-- end -->
    

    <!-- JS Bootstrap -->
    <script src="./assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- JS Font Awesome -->
    <script src="./assets/vendors/fontawesome/all.min.js"></script>
</body>
</html>