<?php

include "koneksi.php";

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $isi = $_POST['isi'];

    // Menyimpan data ke dalam tabel buku_tamu
    $sql = "INSERT INTO buku_tamu (nama, email, isi) VALUES ('$nama', '$email', '$isi')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Data berhasil disimpan!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
    }
}

// Mengambil semua data dari tabel buku_tamu
$sql = "SELECT * FROM buku_tamu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <!-- Menggunakan Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Buku Tamu</h1>
            <p class="text-muted">Silakan isi formulir untuk memberikan pesan Anda.</p>
        </div>

        <!-- Form untuk input data -->
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h2 class="card-title mb-4 text-center">Isi Buku Tamu</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi Pesan</label>
                        <textarea class="form-control" id="isi" name="isi" rows="3" placeholder="Tuliskan pesan Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                </form>
            </div>
        </div>

        <!-- Daftar Pesan -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4 text-center">Daftar Pesan Tamu</h3>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Tamu</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Isi Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Menampilkan data yang sudah diinputkan
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row['ID_tamu'] . "</td>
                                        <td>" . $row['nama'] . "</td>
                                        <td>" . $row['email'] . "</td>
                                        <td>" . $row['isi'] . "</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Belum ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Menyertakan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb3N86uM6pP3g8xTwyfX4p0ek5Hh9A6v1Rm6f5XSdF6Qp1z7gC" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyrn1fiO9toYlF0b3UOdE5z5Xs0ntVdldD/xu8Hv2qdFYb5Y6Bd2+g5" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Menutup koneksi database
// $conn->close();
?>