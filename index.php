<?php
// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "mydatabase";  // Pastikan nama database sudah benar

// Membuat koneksi ke MySQL
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $waktu = $_POST["waktu"];
    $uraian = $_POST["uraian"];

    // Query untuk menambahkan data ke tabel kegiatan
    $sql = "INSERT INTO kegiatan (`Waktu`, `Uraian Kegiatan`) VALUES ('$waktu', '$uraian')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-message'>Data berhasil ditambahkan</p>";
    } else {
        echo "<p class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah dan Tampilkan Kegiatan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Manajemen Kegiatan</h1>
    <div class="form-container">
        <h2>Tambah Kegiatan</h2>
        <form action="index.php" method="post">
            <label for="waktu">Waktu Kegiatan</label>
            <input type="text" id="waktu" name="waktu" placeholder="Masukkan waktu kegiatan" required>
            
            <label for="uraian">Uraian Kegiatan</label>
            <input type="text" id="uraian" name="uraian" placeholder="Masukkan uraian kegiatan" required>
            
            <button type="submit" name="submit">Tambah Kegiatan</button>
        </form>
    </div>

    <div class="user-list">
        <h2>Daftar Kegiatan</h2>
        <?php
        // Query untuk mengambil data dari tabel kegiatan
        $sql = "SELECT `No`, `Waktu`, `Uraian Kegiatan` FROM kegiatan";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while($row = $result->fetch_assoc()) {
                echo "<li><strong>No: </strong>" . $row["No"] . " | <strong>Waktu: </strong>" . $row["Waktu"] . " | <strong>Uraian: </strong>" . $row["Uraian Kegiatan"] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Tidak ada data</p>";
        }

        // Menutup koneksi
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>
