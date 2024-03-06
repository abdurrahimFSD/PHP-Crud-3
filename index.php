<?php
require "./connectDatabase.php";

session_start();

// Read Data dari Database Crud-3, Table tb_mahasiswa

// (Sanitasi data input / prepared statement)
$query = "SELECT * FROM tb_mahasiswa";
$statement = $connectDatabase->prepare($query);
$statement->execute();
$sql = $statement->get_result();
$no = 1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud-3 __ Data Mahasiswa</title>
    
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="./assets/vendors/bootstrap/bootstrap.min.css">

    <!-- CSS Font Awesome -->
    <link rel="stylesheet" href="./assets/vendors/fontawesome/all.min.css">

    <!-- CSS DataTables -->
    <link rel="stylesheet" href="./assets/vendors/DataTables/datatables.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold mx-auto text-white">PHP Crud-3</span>
        </div>
    </nav>
    <!-- Navbar end -->


    <!--  -->
    <div class="container">
        <div class="row my-4">
            <div class="col-12 col-md-6 d-flex align-items-center">
                <h5 class="mb-0">Data Mahasiswa</h5>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end">
                <a href="./kelola.php" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i>
                    Create Data Mahasiswa
                </a>
            </div>
        </div>

        <?php 
            if(isset($_SESSION['alert'])) {
        ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>
                        <?php
                            echo $_SESSION['alert'].".";
                        ?>
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
                session_destroy();
            }
        ?>

        <!-- Table Mahasiswa -->
        <div class="table-responsive">
            <table id="dataTables" class="table table-hover table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center" style="max-width: 55px;">NO</th>
                        <th>NPM</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Prodi</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    <?php
                        while($result = $sql->fetch_assoc()) {
                    ?>
                
                        <tr>
                            <td class="text-center">
                                <?php
                                    echo $no++;
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo strip_tags($result['npm']);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo strip_tags($result['nama_lengkap']);
                                ?>
                            </td>
                            <td>
                                <?=
                                    strip_tags($result['jenis_kelamin']);
                                ?>
                            </td>
                            <td>
                                <?=
                                    strip_tags($result['prodi']);
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo strip_tags($result['alamat']);
                                ?>
                            </td>
                            <td>
                                <img src="./assets/images/<?php echo $result['foto'] ?>" alt="image" width="80px">
                            </td>

                            <td class="text-center">
                                <form style="display: inline-block;" action="./kelola.php" method="post">
                                    <input type="hidden" name="update" value="<?= $result['id_mahasiswa']; ?>">
                                    <button type="submit" class="btn btn-sm btn-primary me-lg-1 mb-2 mb-lg-0">
                                        <i class="fa-solid fa-pen-to-square"></i> Update
                                    </button>
                                </form>
                                
                                <form style="display: inline-block;" action="./proses.php" method="post" onsubmit="return confirm('Apakah anda ingin menghapus data ini..?')">
                                    <input type="hidden" name="delete" value="<?php echo $result['id_mahasiswa']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>

                            </td>

                    <?php
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
        <!-- Table Mahasiswa end -->
    </div>
    <!-- end -->
    
    

    <!-- JS Bootstrap -->
    <script src="./assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- JS Font Awesome -->
    <script src="./assets/vendors/fontawesome/all.min.js"></script>

    <!-- JS DataTables -->
    <script src="./assets/vendors/DataTables/datatables.js"></script>

    <!-- JS Script -->
    <script src="./assets/scripts/script.js"></script>
</body>
</html>