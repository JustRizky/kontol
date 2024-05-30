<?php

include 'koneksi.php';

$sql = "SELECT trans.id_transaksi, brng.id_barang, trans.tanggal, trans.total
        FROM transaksi trans
        JOIN barang brng ON trans.id_barang = brng.id_barang
        ORDER BY trans.id_transaksi";

$hasil = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Daftar Transaksi </title>
    </head>
    <body>
        <h1> Daftar Transaksi </h1>

        <table border="1">
            <tr>
                <th>ID Transaksi</th>
                <th>ID Barang</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Aksi</th> 
            </tr>

            <?php

            if($hasil->num_rows > 0){
                while($row = $hasil->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $row["id_transaksi"] . "</td>";
                    echo "<td>" . $row["id_barang"] . "</td>";
                    echo "<td>" . $row["tanggal"] . "</td>";
                    echo "<td>" . $row["total"] . "</td>";

                    echo "<td>";
                    echo "<a href='update.php?id=" . $row["id_transaksi"] . "'> Edit | </a>";
                    echo "<a href='delete.php?id=" . $row["id_transaksi"] . "'> Hapus </a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'> Tidak Ada Data </tr></td>";
            }

            ?>
        </table>
        <br>
        <a href="create.php"> Tambah Transaksi Baru</a>

    </body>
</html>