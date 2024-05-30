<?php

include 'koneksi.php';
echo "Koneksi";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];
    $tanggal = $_POST['tanggal'];
    $total = $_POST['total'];

    $sql = "INSERT INTO transaksi(id_barang,tanggal,total)
            values
            ('$id_barang', '$tanggal', '$total')";
    
    if ($koneksi->query($sql) == TRUE) {
        header("Location: read.php");
        exit;
    } else {
        echo "Error" . $sql . "<br>" . $koneksi->error;
    }
}

$sql_barang = "SELECT * FROM barang";
$hasil_barang = $koneksi->query($sql_barang);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h1>Tambah Transaksi Baru</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="id_barang">Barang:</label>
        <select name="id_barang" required>
            <?php
            if ($hasil_barang->num_rows > 0) {
                while($row_barang = $hasil_barang->fetch_assoc()) {
                    echo "<option value='" . $row_barang["id_barang"] . "'>" . $row_barang["nama_barang"] . "</option>";
                }
            }
            ?>
        </select>
        <br><br>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" required>
        <br><br>
        <label for="total">Total:</label>
        <input type="number" name="total" required>
        <br><br>
        <button type="submit">Tambah</button>
    </form>
    <br>
    <a href="read.php">Kembali ke Daftar Transaksi</a>
</body>
</html>