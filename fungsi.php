<?php

require "./connectDatabase.php";

// CREATE DATA
function createData($data, $files) {

    // nilai yang disimpan dalam variabel $npm adalah data yang dimasukkan pengguna pada input npm.
    $npm = $data['npm'];
    $namaLengkap = $data['nama_lengkap'];
    $jenisKelamin = $data['jenis_kelamin'];
    $prodi = $data['prodi'];
    $alamat = $data['alamat'];

    // foto
    // Memecah nama file foto berdasarkan titik (.) dan menyimpannya dalam array $split.
    $split = explode('.', $files['foto']['name']);
    // Mengambil nilai terakhir dari array $split, yang merupakan ekstensi file.
    $extension = $split[count($split)-1];
    // Menyusun nama file baru dengan format NPM (yang diambil dari input form) diikuti dengan ekstensi file.
    $foto = $npm.'.'.$extension;
    // foto end

    $fotoDirectory = "./assets/images/";
    $tmpFile = $files['foto']['tmp_name'];

    move_uploaded_file($tmpFile, $fotoDirectory.$foto);

    // Prepared statement
    $query = "INSERT INTO tb_mahasiswa (id_mahasiswa, npm, nama_lengkap, jenis_kelamin, prodi, alamat, foto)
    VALUES (null, ?, ?, ?, ?, ?, ?)";
    
    $statement = mysqli_prepare($GLOBALS['connectDatabase'], $query);
    mysqli_stmt_bind_param($statement, "ssssss", $npm, $namaLengkap, $jenisKelamin, $prodi, $alamat, $foto);
    mysqli_stmt_execute($statement);
    
    return true;
}


// UPDATE DATA
function updateData($data, $files) {
    $idMahasiswa = $data['id_mahasiswa'];
    $npm = $data['npm'];
    $namaLengkap = $data['nama_lengkap'];
    $jenisKelamin = $data['jenis_kelamin'];
    $prodi = $data['prodi'];
    $alamat = $data['alamat'];

    $queryShow = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$idMahasiswa';";
    $sqlShow = mysqli_query($GLOBALS['connectDatabase'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if($files['foto']['name'] == "") {
        $foto = $result['foto'];
    } else {
        $split = explode('.', $files['foto']['name']);
        $extension = $split[count($split)-1];
        
        $foto = $result['npm'].'.'.$extension;
        unlink("./assets/images/".$result['foto']);
        move_uploaded_file($files['foto']['tmp_name'], './assets/images/'.$foto);
    }

    $query = "UPDATE tb_mahasiswa SET npm='$npm', nama_lengkap='$namaLengkap', jenis_kelamin='$jenisKelamin', prodi='$prodi', alamat='$alamat', foto='$foto' WHERE id_mahasiswa = '$idMahasiswa';";
    $sql = mysqli_query($GLOBALS['connectDatabase'], $query);

    return true;

}


// DELETE DATA
function deleteData($data) {
    $idMahasiswa = $data['delete'];

    $queryShow = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = '$idMahasiswa';";
    $sqlShow = mysqli_query($GLOBALS['connectDatabase'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    unlink("./assets/images/".$result['foto']);

    $query = "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$idMahasiswa';";
    $sql = mysqli_query($GLOBALS['connectDatabase'], $query);

    return true;
}
?>