<?php

require "./fungsi.php";

session_start();

if(isset($_POST['action'])) {

    if($_POST['action'] === 'create') {
        // Panggil Function createData
        $success = createData($_POST, $_FILES);

        if($success) {
            $_SESSION['alert'] = "Data Berhasil Ditambahkan";
            header("location: ./index.php");
        } else {
            echo $success;
        }
    } else if($_POST['action'] === 'update') {
        // Panggil Function updateData
        $success = updateData($_POST, $_FILES);

        if ($success) {
            $_SESSION['alert'] = "Data Berhasil Diperbarui";
            header("location: ./index.php");
        } else {
            echo $success;
        }
    }
    
}

if(isset($_POST['delete'])) {
    // Panggil Function deleteData
    $success = deleteData($_POST);

    if ($success) {
        $_SESSION['alert'] = "Data Berhasil Dihapus";
        header("location: ./index.php");
    } else {
        echo $success;
    }
}

?>