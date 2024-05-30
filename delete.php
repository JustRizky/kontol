<?php
include 'koneksi.php';

$id_transaksi = $_GET['id'];

$sql = "DELETE FROM transaksi WHERE id_transaksi = $id_transaksi";

if ($koneksi->query($sql) === TRUE) {
    header("Location: read.php");
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$conn->close();
?>