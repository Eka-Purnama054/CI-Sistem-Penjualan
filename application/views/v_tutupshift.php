<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>TUTUP-SHIFT</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/laporan.css" />
    <style type="text/css">
        hr.new4 {
            border: 1px solid black;
        }
    </style>
</head>

<body onload="window.print()">
    <!--  -->
    <?php
    $b = $toko->row_array();
    ?>
    <?php $d = $barang->row_array() ?>
    <div id="laporan"><br><br><br>
        <table border="0" align="center" style="width:400px; border:none;margin-bottom:0px;">
            <tr>
                <td colspan="3" style="width:800px;padding-left:20px;">
                    <center>
                        <p style="text-align: center;font-size: 12pt;"><b>BALI TEES </b><br>
                            <?= $b['nama_toko'] ?><br>
                            <?= $b['alamat_toko'] ?>/<?= $b['no_telp'] ?><br>
                            Kasir : <?= $d['username'] ?>
                        </p>
                    </center>
                </td>
            </tr>
            <tr>
                <th colspan="3" style="width:400px">
                    <hr class="new4">
                </th>
            </tr>
            <tr>
                <th>
                    <p style="text-align: center;font-size: 12pt;">Nama Barang</p>
                </th>
                <th>
                    <p style="text-align: center;font-size: 12pt;">Qty</p>
                </th>
                <th>
                    <p style="text-align: center;font-size: 12pt;">Sub Total</p>
                </th>
            </tr>
            <tr>
                <th colspan="3" style="width:400px">
                    <hr class="new4">
                </th>
            </tr>
            <?php $no = 0;
            foreach ($barang->result_array() as $row) {
                $no++;
            ?>
                <tr>
                    <td>
                        <p style="text-align: justify;font-size: 12pt;"><?= $no ?>. <?= $row['nama_barang'] ?></p>
                    </td>
                    <td>
                        <p style="text-align: center;font-size: 12pt;"><?= $row['jumlah'] ?></p>
                    </td>
                    <td>
                        <p style="text-align: right;font-size: 12pt;">Rp. <?= number_format($row['subtotal'], 2, ",", ".") ?><br>

                        </p>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="3" style="width:400px">
                    <hr class="new4">
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="text-align: justify;font-size: 12pt;">Total Pendapatan: &emsp;&emsp;
                    </p>
                </td>
                <td>
                    <p style="text-align: right;font-size: 12pt;">Rp.
                        <?php
                        foreach ($tutup as $data) {
                            echo  number_format("$data->grandtotal", 2, ",", ".");
                        }
                        ?></p>
                </td>
            </tr>
        </table>
        <table border="0" align="center" style="width:400px; border:none;margin-bottom:0px;">
        </table>
    </div>
</body>

</html>