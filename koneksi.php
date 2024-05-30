<?php
    $koneksi = mysqli_connect("localhost", "root", "", "pertemuan5");
    $sql = "SELECT * FROM transaksi";
    $result = $koneksi->query($sql);
?>