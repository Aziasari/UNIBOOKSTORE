<?php
include 'koneksi.php';

$query = "SELECT * FROM buku JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit ORDER BY buku.stok ASC ";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>UNIBOOKSTORE - Toko Buku Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Css -->
    <link rel="stylesheet" href="css2.css">
</head>

<body>

    <!-- Navbar -->
    <nav id="navbar" class="navbar bg-dark navbar-expand-lg navbar-dark fixed-top mb-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand fw-bold text-white" href="#">UNIBOOKSTORE</a>
            <div class="d-flex align-items-center">
                <a href="index.php" class="text-white text-decoration-none me-4">Home</a>
                <a href="admin.php" class="text-white text-decoration-none ms-2">
                    <i class="bi bi-person-circle fs-4"></i>
                </a>
            </div>
        </div>
    </nav>


    <div class="container py-5 mt-5">
        <h2 class="text-center  mb-5">Buku yang Perlu Segera Dibeli</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="text-center">
                            <td><?php echo $nomor ?></td>
                            <td><?php echo $row['nama_buku']; ?></td>
                            <td><?php echo $row['nama_penerbit']; ?></td>
                            <td><?php echo $row['stok']; ?></td>
                        </tr>
                    <?php $nomor++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>