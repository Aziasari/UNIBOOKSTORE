<?php
include 'koneksi.php';
$search = isset($_GET['search']) ? trim(htmlspecialchars($_GET['search'])) : '';
$query = "SELECT * FROM buku WHERE nama_buku LIKE '%$search%'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>UNIBOOKSTORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Css -->
    <link rel="stylesheet" href="css.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

</head>

<body class="bg-white text-dark">
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

    <!-- Hero Section -->
    <section class="text-center d-flex flex-column justify-content-center align-items-center text-white "
        style="height: 100vh;">
        <!-- Background Image -->
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('image/img1.jpg') center/cover no-repeat; z-index: -1;">
        </div>
        <h2 class="fw-bold text-white">Selamat Datang di UNIBOOKSTORE</h2>
        <p class="mt-2 ">Temukan buku favoritmu dengan harga terbaik!</p>
        <button class="btn btn-light">
            <a href="#daftarbuku" class="text-dark text-decoration-none">Lihat</a>
        </button>
    </section>

    <!-- About Section -->
    <section id="about" class="about_section py-5 bg-light">
        <!-- Section Title -->
        <div class="container text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Tentang Kami</h2>
            <p class="text-muted">Kami Menyediakan Buku dari berbagai kotegori yang menarik untuk anda</p>
        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                    <img src="image/download.jpg" class="img-fluid rounded shadow" alt="About Image">
                </div>

                <div class="col-lg-6 content" data-aos="fade-left" data-aos-delay="200">
                    <h3 class="fw-bold mb-3">Mengapa Memilih Kami?</h3>
                    <p class="text-muted">
                        Ada beberapa Alasan toko kami cocok untuk anda
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> <span>Kami Selalu Menyediakan Buku Populer Setiap Bulan.</span></li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> <span>Kami Selalu Memantau Trend Buku Yang Populer setiap musim.</span></li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success"></i> <span>Kami menyediakan beberagai kategori buku yang cocok untuk anak muda dan pelajar</span></li>
                    </ul>
                    <button class="btn btn-dark mt-3 px-4 py-2">
                        <a href="#daftarbuku" class="text-white text-decoration-none">Lebih Lanjut</a>
                    </button>
                </div>
            </div>
        </div>

    </section><!-- About Section -->

    <!-- Buku Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4" data-aos="fade-up">
                        <h2 class="fw-bold">Cari Buku Favoritmu</h2>
                        <p class="text-muted">Temukan buku terbaik dengan cepat dan mudah.</p>
                    </div>

                    <!-- Search Bar -->
                    <form method="GET" class="d-flex position-relative shadow-sm" data-aos="fade-left">
                        <input type="text" name="search" class="form-control form-control-lg rounded-pill ps-4"
                            id="search" placeholder="Cari Buku..." value="<?php echo $search; ?>">
                        <button type="submit" class="btn btn-dark rounded-pill ms-2 px-4">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Buku -->
        <div id="daftarbuku" class="container my-5" data-aos="fade-right">
            <h2 class="text-center  fw-bold mb-5"><b>Daftar Buku</b></h2>
            <div class="row">
                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-6 col-sm-6 col-md-4 mb-4">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?php echo $row['nama_buku']; ?></h5>
                                    <p class="text-muted">Kategori: <?php echo $row['kategori']; ?></p>
                                    <p class="text-success fw-semibold">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                                    <p class="text-muted">Stok: <?php echo $row['stok']; ?></p>
                                    <a href="#" class="btn btn-dark text-white">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-12 text-center">
                        <p class="text-danger fw-bold"> Buku tidak ditemukan.</p>
                    </div>
                <?php } ?>
            </div>
        </div>

    </section>
    <!-- Buku Section -->

    <!-- Footer -->
    <footer id="footer" class="footer bg-dark text-white py-5">
        <div class="container text-center">
            <h3 class="sitename"><b>UNIBOOKSTORE</b></h3>
            <p class="mb-4">Tempat Toko Buku yang menjual buku Favorite anda</p>

            <div class="credits">
                <p>Design By <b>Azi</b></p>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>


</body>

</html>