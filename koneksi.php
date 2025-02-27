<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "data";

// Buat koneksi ke MySQL
$koneksi = new mysqli($host, $user, $pass);

// Periksa koneksi awal ke MySQL
if ($koneksi->connect_error) {
    die("Koneksi ke MySQL gagal: " . $koneksi->connect_error);
}

// Buat database jika belum ada
$koneksi->query("CREATE DATABASE IF NOT EXISTS $db") or die("Gagal membuat database");

// Pilih database yang baru dibuat
$koneksi->select_db($db);

// Cek apakah ada tabel di dalam database
$check_tables = $koneksi->query("SHOW TABLES");
if ($check_tables->num_rows == 0) {
    // Jika database kosong, impor file SQL
    $sqlFile = './data.sql';

    if (file_exists($sqlFile)) {
        $queries = file_get_contents($sqlFile);

        if (!empty($queries)) {
            if ($koneksi->multi_query($queries)) {
                // Membersihkan hasil query jika ada lebih dari satu
                while ($koneksi->more_results() && $koneksi->next_result()) {
                }
            } else {
                die("Gagal mengimpor database: " . $koneksi->error);
            }
        }
    } else {
        die("File SQL tidak ditemukan: $sqlFile");
    }
}
