<?php

$keranjang =  $_POST["keranjang"];
$payments = $keranjang["payment"];

echo "<h1>Keranjang Anda</h1>";
echo "<table border=1>";
echo "<thead>";
echo "<td>Nama Barang</td>";
echo "<td>Harga Per Item</td>";
echo "<td>Jumlah Barang</td>";
echo "<td>Sub Total Barang</td>";
echo "</thead>";
echo "<tbody>";
$total = 0;
for($i=0; $i < count($keranjang["items"]); $i++){
    echo "<tr>";
    echo "<td>" . $keranjang["items"][$i]["name"] . "</td>";
    echo "<td style='text-align: center;'>" . $keranjang["items"][$i]["qty"] . "</td>";
    echo "<td> Rp" . $keranjang["items"][$i]["price"] . ",-</td>";
    echo "<td> Rp" . $keranjang["items"][$i]["price"] * $keranjang["items"][$i]["qty"] . ",-</td>";
    echo "</tr>";

    $total += $keranjang["items"][$i]["qty"] * $keranjang["items"][$i]["price"];
}
echo "</tbody>";
echo "<tfoot>";
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td>Subtotal</td>";
echo "<td> Rp" . $total . ",- </td>";
echo "</tr>";
echo "</tfoot>";
echo "</table>";
echo "<a href='../'>Kembali Ke Toko</a>";

?>