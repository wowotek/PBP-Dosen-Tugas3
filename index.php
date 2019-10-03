<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table,
    th,
    td {
        border: 2px solid black;
    }
</style>
<?php
$daftar_barang = array(
    array("nama" => "Baju", "harga" => 50000),
    array("nama" => "Celana", "harga" => 15000),
    array("nama" => "Sepatu", "harga" => 25000),
    array("nama" => "Sendal", "harga" => 90000),
    array("nama" => "Topi", "harga" => 125000),
    array("nama" => "Kutang", "harga" => 39000),
    array("nama" => "Kaus Kaki", "harga" => 15000),
    array("nama" => "Stocking", "harga" => 19000),
);

$keranjang = array();
?>
<script>
    class Item {
        constructor(name, price){
            this.name = name;
            this.price = price;
            this.qty = 1;
        }
    }

    var items = [];
    var keranjang_total = 0;

    function add_item(name, price) {
        for (var i=items.length-1; i>=0; i--) {
            if (items[i].name === name) {
                items[i].qty++;
                update_keranjang();
                return
            }
        }
        items.push(new Item(name, price));
        update_keranjang();
    }

    function remove_item(name) {
        for (var i=items.length-1; i>=0; i--) {
            if (items[i].name === name) {
                items.splice(i, 1);
                update_keranjang();
                return items;
            }
        }
        update_keranjang();
    }

    function update_keranjang(){
        var total = 0;
        var table = document.getElementById('data_keranjang');
        table.innerHTML = "";
        for(var i=0; i<items.length; i++){
            var row = table.insertRow();
            var cell = row.insertCell(0);
            cell.innerHTML = items[i].name;
            var cell = row.insertCell(1);
            cell.innerHTML = items[i].qty;
            var cell = row.insertCell(2);
            cell.innerHTML = "Rp"+items[i].price * items[i].qty+",-";
            var cell = row.insertCell(3);
            var b = 'onclick=remove_item("' + items[i].name + '")';
            cell.innerHTML = "<button " + b + ">Hapus</button>";

            total += items[i].price * items[i].qty;
        }
        keranjang_total = total;

        var total_harga = document.getElementById("total_harga");
        total_harga.innerHTML = "Rp"+total+",-";

        var form_bayar = document.getElementById("form_bayar");
        form_bayar.innerHTML = "";
        var form = "";
        for(var i=0;i < items.length; i++){
            console.log(items[i].name);
            form += "<input type='hidden' name='keranjang[items][" + i + "][name]' value='" + items[i].name + "'>";
            form += "<input type='hidden' name='keranjang[items][" + i + "][price]' value='" + items[i].price + "'>";
            form += "<input type='hidden' name='keranjang[items][" + i + "][qty]' value='" + items[i].qty + "'>";
        }
        form += '<input type="hidden" name="keranjang[payment][total]" value=' + keranjang_total + '>';
        form += '<input type="submit" value="Bayar">';
        form_bayar.innerHTML = form;
    }

    function bayar(){
        
    }
</script>

<body>
    <table>
        <tr>
            <td>
                <h2>Menu Belanja</h2>
                <table>
                    <thead>
                    <tr>
                        <td>No.</td>
                        <td>Nama Barang</td>
                        <td>Harga</td>
                        <td>Beli</td>
                    </tr>
                    </thead>
                    <?php $i = 1; foreach($daftar_barang as $barang) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $barang["nama"]; ?></td>
                        <td>Rp<?php echo $barang["harga"]; ?>,-</td>
                        <td><button onclick="add_item('<?php echo $barang['nama']; ?>', '<?php echo $barang['harga']; ?>')">Tambahkan</button></td>
                    </tr>
                    <?php $i++; } ?>
                </table>
            </td>
            <td>
                <h2>Keranjang Belanja</h2>
                <table>
                    <thead>
                    <tr>
                        <td>Nama Barang</td>
                        <td>Jumlah Barang</td>
                        <td>Subtotal</td>
                        <td>Hapus</td>
                    </tr>
                    </thead>
                    <tbody id="data_keranjang">
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td id="total_harga">Rp0</td>
                            <td>
                                <form id="form_bayar" action="pembayaran/" method="post"></form>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>