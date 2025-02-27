<?php
include 'koneksi.php';

// Ambil penerbit
$penerbit_result = mysqli_query($koneksi, "SELECT * FROM penerbit");

// Ambil  buku
$buku_result = mysqli_query(
    $koneksi,
    // Ambil  ambil buku dan ambil beberapa is tabel penerbit
    "SELECT * FROM buku  JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit"
); ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>UNIBOOKSTORE - Toko Buku Online</title>

    <link rel="stylesheet" href="css2.css">

    <!-- link boostrap online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICon boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Css -->
    <link rel="stylesheet" href="css2.css">
</head>

<body>
    <!-- Navbar -->
    <nav id="navbar" class="navbar bg-dark navbar-expand-lg navbar-dark fixed-top">
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

    <div class="container py-5">
        <h2 class="text-center mb-4 mt-5 "><b>Kelola Buku & Penerbit</b></h2>

        <button class="btn btn-dark mb-5 me"><a href="pengadaan.php" class="text-decoration-none text-white">Pengadaan</a></button>

        <!-- Kelola Penerbit -->
        <h4>Daftar Penerbit</h4>
        <button class="btn btn-dark  mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPenerbit">Tambah Penerbit</button>
        <div class="card mb-4 p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Penerbit</th>
                        <th>Nama Penerbit</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    while ($row = mysqli_fetch_assoc($penerbit_result)) { ?>
                        <tr>
                            <td> <?php echo $nomor; ?> </td>
                            <td><?php echo $row['id_penerbit']; ?></td>
                            <td><?php echo $row['nama_penerbit']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['kota']; ?></td>
                            <td><?php echo $row['telepon']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditPenerbit<?php echo $row['id_penerbit']; ?>">
                                    Edit
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusPenerbit<?php echo $row['id_penerbit']; ?>">
                                    Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Edit Penerbit -->
                        <div class="modal fade" id="modalEditPenerbit<?php echo $row['id_penerbit']; ?>" tabindex="-1"
                            aria-labelledby="modalEditPenerbitLabel<?php echo $row['id_penerbit']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditPenerbitLabel<?php echo $row['id_penerbit']; ?>">Edit Penerbit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="controller.php">
                                            <input type="hidden" name="old_id_penerbit" value="<?php echo $row['id_penerbit']; ?>">
                                            <div class="mb-3">
                                                <label class="form-label">ID Penerbit</label>
                                                <input type="text" class="form-control" name="id_penerbit" value="<?php echo $row['id_penerbit']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Penerbit</label>
                                                <input type="text" class="form-control" name="nama" value="<?php echo $row['nama_penerbit']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kota</label>
                                                <input type="text" class="form-control" name="kota" value="<?php echo $row['kota']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Telepon</label>
                                                <input type="text" class="form-control" name="telepon" value="<?php echo $row['telepon']; ?>" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" name="edit_penerbit">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus Penerbit -->
                        <div class="modal fade" id="modalHapusPenerbit<?php echo $row['id_penerbit']; ?>" tabindex="-1"
                            aria-labelledby="modalHapusPenerbitLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalHapusPenerbitLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus penerbit ini?</p>
                                        <form method="POST" action="controller.php">
                                            <input type="hidden" name="id_penerbit" value="<?php echo $row['id_penerbit']; ?>">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name="hapus_penerbit">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php $nomor++;
                    }
                    if (mysqli_num_rows($penerbit_result) == 0) :  ?>
                        <tr>
                            <td>
                            <td colspan="7" class="text-center">Tidak ada data penerbit</td>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>

        <!-- Kelola Buku -->
        <h4>Daftar Buku</h4>
        <button type="button" class="btn btn-dark text-white mb-3" data-bs-toggle="modal" data-bs-target="#tambahBukuModal">
            Tambah Buku
        </button>
        <div class="card p-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Buku</th>
                        <th>Kategori</th>
                        <th>Nama Buku</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Penerbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 1;
                    while ($row = mysqli_fetch_assoc($buku_result)) { ?>
                        <tr>
                            <td><?php echo $nomor ?></td>
                            <td><?php echo $row['id_buku']; ?></td>
                            <td><?php echo $row['kategori']; ?></td>
                            <td><?php echo $row['nama_buku']; ?></td>
                            <td> Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo $row['stok']; ?></td>
                            <td><?php echo $row['nama_penerbit']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id_buku']; ?>">Edit</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id_buku']; ?>">Hapus</button>
                            </td>
                        </tr>

                        <!-- Modal Edit Buku -->
                        <div class="modal fade" id="editModal<?php echo $row['id_buku']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="controller.php">
                                            <input type="hidden" name="id_buku_lama" value="<?php echo $row['id_buku']; ?>">
                                            <div class="mb-3">
                                                <label class="form-label">ID BUKU</label>
                                                <input type="text" class="form-control" name="id_buku" value="<?php echo $row['id_buku']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kategori</label>
                                                <input type="text" class="form-control" name="kategori" value="<?php echo $row['kategori']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Buku</label>
                                                <input type="text" class="form-control" name="nama_buku" value="<?php echo $row['nama_buku']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga</label>
                                                <input type="number" class="form-control" name="harga" value="<?php echo $row['harga']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Stok</label>
                                                <input type="number" class="form-control" name="stok" value="<?php echo $row['stok']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_penerbit" class="form-label">Penerbit</label>
                                                <select class="form-control" id="id_penerbit" name="id_penerbit" required>
                                                    <?php
                                                    $query_penerbittambah = "SELECT id_penerbit, nama_penerbit FROM penerbit";
                                                    $result_penerbit = mysqli_query($koneksi, $query_penerbittambah);
                                                    while ($row_penerbit = mysqli_fetch_assoc($result_penerbit)) {
                                                        echo "<option value='" . $row_penerbit['id_penerbit'] . "'>" . $row_penerbit['nama_penerbit'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="edit_buku" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus Buku -->
                        <div class="modal fade" id="deleteModal<?php echo $row['id_buku']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus penerbit ini?</p>
                                        <form method="POST" action="controller.php">
                                            <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name="hapus_buku">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $nomor++;
                    }
                    if (mysqli_num_rows($penerbit_result) == 0) : ?>
                        <tr>
                            <td>
                            <td colspan="7" class="text-center">Tidak ada data buku</td>
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Penerbit -->
    <div class="modal fade" id="modalTambahPenerbit" tabindex="-1" aria-labelledby="modalTambahPenerbitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPenerbitLabel">Tambah Penerbit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="controller.php" method="POST">
                        <div class="mb-3">
                            <label for="id_penerbit" class="form-label">ID Penerbit</label>
                            <input type="text" class="form-control" id="id_penerbit" name="id_penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
                            <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <input type="text" class="form-control" id="kota" name="kota" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary " name="tambah_penerbit">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="controller.php">
                        <div class="mb-3">
                            <label for="id_buku" class="form-label">ID</label>
                            <input type="text" class="form-control" id="id_buku" name="id_buku" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_buku" class="form-label">Nama Buku</label>
                            <input type="text" class="form-control" id="nama_buku" name="nama_buku" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_penerbit" class="form-label">Penerbit</label>
                            <select class="form-control" id="id_penerbit" name="id_penerbit" required>
                                <?php
                                $query_penerbittambah = "SELECT id_penerbit, nama_penerbit FROM penerbit";
                                $result_penerbit = mysqli_query($koneksi, $query_penerbittambah);
                                while ($row_penerbit = mysqli_fetch_assoc($result_penerbit)) {
                                    echo "<option value='" . $row_penerbit['id_penerbit'] . "'>" . $row_penerbit['nama_penerbit'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="tambah_buku" class="btn btn-success">Tambah</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>