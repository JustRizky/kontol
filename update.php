<?php
include 'koneksi.php';

$id_transaksi = $_GET['id'];
$sql = "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi";
$hasil = $koneksi->query($sql);
$row = $hasil->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];
    $tanggal = $_POST['tanggal'];
    $total = $_POST['total'];

    $sql_update = "UPDATE transaksi SET id_barang='$id_barang', tanggal='$tanggal', total='$total' WHERE id_transaksi='$id_transaksi'";

    if ($koneksi->query($sql_update) === TRUE) {
        header("Location: read.php");
    } else {
        echo "Error: " . $sql_update . "<br>" . $conn->error;
    }
}

$sql_barang = "SELECT * FROM barang";
$hasil_barang = $koneksi->query($sql_barang);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
</head>
<body>
    <h1>Edit Transaksi</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id_transaksi";?>">
        <label for="id_barang">Barang:</label>
        <select name="id_barang" required>
            <?php
            if ($hasil_barang->num_rows > 0) {
                while($row_barang = $hasil_barang->fetch_assoc()) {
                    echo "<option value='" . $row_barang["id_barang"] . "' " . ($row_barang["id_barang"] == $row['id_barang'] ? "selected" : "") . ">" . $row_barang["nama_barang"] . "</option>";
                }
            }
            ?>
        </select>
        <br><br>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
        <br><br>
        <label for="total">Total:</label>
        <input type="number" name="total" value="<?php echo $row['total']; ?>" required>
        <br><br>
        <input type="submit" value="Update">
    </form>
    <br>
    <a href="read.php">Kembali ke Daftar Transaksi</a>
</body>
</html>