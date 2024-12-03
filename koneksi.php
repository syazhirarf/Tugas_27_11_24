<?php
// Koneksi ke database
$host = "localhost";  // Ganti dengan server Anda
$username = "root";         // Ganti dengan username database Anda
$password = "";             // Ganti dengan password database Anda
$dbname = "db_buku_tamu";   // Nama database

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// $conn->close();
?>