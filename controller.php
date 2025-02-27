<?php
include 'koneksi.php';

// Tambah Buku
if (isset($_POST['tambah_buku'])) {
    $id_buku = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['id_buku']));
    $kategori = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['kategori']));
    $nama = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['nama_buku']));
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $penerbit = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['id_penerbit']));

    $cek_query = "SELECT id_buku FROM buku WHERE id_buku = '$id_buku'";
    $cek_result = mysqli_query($koneksi, $cek_query);

    // Cek apakah id sudah ada di data base
    if (mysqli_num_rows($cek_result) > 0) {
        echo "<script>
        alert('Gagal menambahkan buku! ID buku sudah ada di database.'); 
        window.location.href='admin.php';
        </script>";
        exit();
    }

    // Cek jika input harga user dibawah 0
    if ($harga < 1) {
        echo "<script>
        alert('Tidak bisa menambahkah kkarena harga tidak boleh dibawah angka 0!'); window.location.href='admin.php';
       </script>";
        exit();
    }

    // melakukan penambahan buku
    $query = "INSERT INTO buku (id_buku,kategori, nama_buku, harga, stok, id_penerbit) 
              VALUES ('$id_buku' , '$kategori', '$nama', $harga, $stok, '$penerbit')";

    // cek jika data berhasil menambahakan buku
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Buku berhasil ditambah!'); 
        window.location.href='admin.php';
        </script>";
    } else {
        echo "<script>
        alert('Buku gagal ditambah!'); 
        window.location.href='admin.php';
        </script>";
    }
}


//  Edit Buku
if (isset($_POST['edit_buku'])) {
    $id_buku_lama = $_POST['id_buku_lama'];
    $id_buku = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['id_buku']));
    $kategori = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['kategori']));
    $nama_buku = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['nama_buku']));
    $harga = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['harga']));
    $stok = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['stok']));
    $penerbit = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['id_penerbit']));

    // Cek apakah id sudah ada di data base
    $cek_query = "SELECT id_buku FROM buku WHERE id_buku = '$id_buku'";
    $cek_result = mysqli_query($koneksi, $cek_query);

    if (mysqli_num_rows($cek_result) > 0) {
        echo "<script>
        alert('Gagal menambahkan buku! ID buku sudah ada di database.'); 
        window.location.href='admin.php';
        </script>";
        exit();
    }

    // Cek apakah apakah harga input user tidak boleh menjadi 0
    if ($harga < 1) {
        echo "<script>
        alert('Tidak bisa menambahkah kkarena harga tidak boleh dibawah angka 0!'); window.location.href='admin.php';
       </script>";
        exit();
    }

    // melakukan Update Buku
    $query = "UPDATE buku SET id_buku='$id_buku',kategori='$kategori', nama_buku='$nama_buku', harga=$harga, stok=$stok,    WHERE id_buku='$id_buku_lama'";

    // Jika Berhasil
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Buku berhasil diedit!.'); 
        window.location.href='admin.php';
        </script>";
        // Jika Gagal
    } else {
        echo "<script>
        alert('Buku gagal diedit!'); 
        window.location.href='admin.php';
        </script>";
    }
}

// Hapus Buku
if (isset($_POST['hapus_buku'])) {
    $id_buku = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['id_buku']));

    // Melakukan Hapus Id
    $query = "DELETE FROM buku WHERE id_buku = '$id_buku'";

    // Jika Berhasil
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Buku berhasil dihapus!.'); 
        window.location.href='admin.php';
        </script>";
    } else {
        // Jika Gagal
        echo "<script>
        alert('Buku gagal dihapus!.'); 
        window.location.href='admin.php';
        </script>";
    }
}



// tambah penerbit
if (isset($_POST['tambah_penerbit'])) {
    $id_penerbit = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['id_penerbit']));
    $nama_penerbit = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['nama_penerbit']));
    $alamat = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['alamat']));
    $kota = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['kota']));
    $telepon = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['telepon']));

    // cek apakah user input ada yang sama di dalam database
    $cek_query = "SELECT id_penerbit FROM penerbit WHERE id_penerbit = '$id_penerbit'";
    $cek_result = mysqli_query($koneksi, $cek_query);

    if (mysqli_num_rows($cek_result) > 0) {
        echo "<script>
        alert('Gagal menambahkan penerbit! ID penerbit sudah ada di database.'); 
        window.location.href='admin.php';
        </script>";
        exit();
    }

    // memasukkan penerbit ke database
    $query = "INSERT INTO penerbit (id_penerbit,nama_penerbit, alamat, kota, telepon) VALUES ('$id_penerbit','$nama_penerbit', '$alamat', '$kota','$telepon')";

    // jika berhasil
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Penerbit berhasil menambah.'); 
        window.location.href='admin.php';
        </script>";
    } else {
        // jika gagal
        echo "<script>
        alert('Gagal menambah penerbit!'); 
        window.location.href='admin.php';
        </script>";
    }
}


// Edit penerbit
if (isset($_POST['edit_penerbit'])) {
    $old_id = $_POST['old_id_penerbit'];
    $id = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['id_penerbit']));
    $nama = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['nama']));
    $alamat = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['alamat']));
    $kota = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['kota']));
    $telepon = htmlspecialchars(mysqli_real_escape_string($koneksi, $_POST['telepon']));

    // Cek id baru sudah ada di database, kecuali jika id tidak berubah
    if ($id !== $old_id) {
        $cek_query = "SELECT id_penerbit FROM penerbit WHERE id_penerbit = '$id'";
        $cek_result = mysqli_query($koneksi, $cek_query);

        if (mysqli_num_rows($cek_result) > 0) {
            echo "<script>
            alert('Gagal mengubah penerbit! ID penerbit sudah digunakan oleh penerbit lain.'); 
            window.location.href='admin.php';
            </script>";
            exit();
        }
    }

    // Update data penerbit
    $update_query = "UPDATE penerbit SET 
                    id_penerbit = '$id', 
                    nama_penerbit = '$nama', 
                    alamat = '$alamat', 
                    kota = '$kota', 
                    telepon = '$telepon' 
                    WHERE id_penerbit = '$old_id'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>
        alert('Penerbit berhasil diperbarui.'); 
        window.location.href='admin.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal memperbarui penerbit!'); 
        window.location.href='admin.php';
        </script>";
    }
}


// Hapus penerbit
if (isset($_POST['hapus_penerbit'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id_penerbit']);

    // Cek apakah masih ada buku terkait dengan penerbit ini
    $cek_query = "SELECT id_buku FROM buku WHERE id_penerbit = '$id'";
    $cek_result = mysqli_query($koneksi, $cek_query);

    if (mysqli_num_rows($cek_result) > 0) {
        echo "<script>
              alert('Tidak bisa menghapus penerbit karena masih ada buku yang terkait!'); window.location.href='admin.php';
             </script>";
        exit();
    }

    // Jika tidak ada buku yang terkait, hapus penerbit
    $query = "DELETE FROM penerbit WHERE id_penerbit = '$id'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
        alert('Penerbit berhasil dihapus.'); 
        window.location.href='admin.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal menghapus penerbit!'); 
        window.location.href='admin.php';
        </script>";
    }
}
