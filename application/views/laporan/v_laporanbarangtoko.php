<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>laporan data barang toko</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div id="laporan">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>
        <?php $b = $bar->row_array() ?>
        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <th colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <span class="h4">LAPORAN DATA BARANG TOKO</span><br />
                        <span class="h4">BALI TEES</span><br />
                        <span class="h4"><?= $b['nama_toko'] ?></span><br />
                        <span class="h4"><?= $b['alamat_toko'] ?>/<?= $b['no_telp'] ?></span><br />
                    </center><br />
                </th>
            </tr>
        </table>
        <table border="1" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;margin-bottom:20px;">
            <?php
            $urut = 0;
            $nomor = 0;
            $group = '-';
            foreach ($bar->result_array() as $d) {
                $nomor++;
                $urut++;
                if ($group == '-' || $group != $d['nama_item']) {
                    $kat = $d['nama_item'];
                    if ($group != '-')
                        echo "</table><br>";
                    echo "<table align='center' width='900px;' border='1'>";
                    echo "<tr><td colspan='8'><b>Kategori: $kat</b></td></tr>";
                    echo "<tr style='background-color:#ccc;'>
    <th width='4%' align='center'>No</th>
    <th align='center'>Barang Kode</th>
    <th align='center'>Nama Barang</th>
    <th align='center'>Warna</th>
    <th align='center'>Stok</th>
    <th align='center'>Hargajual</th>
    <th align='center'>Hargagrosir</th>
    <th align='center'>Hargapokok</th>
    </tr>";
                    $nomor = 1;
                }
                $group = $d['nama_item'];
                if ($urut == 500) {
                    $nomor = 0;
                    echo "<div class='pagebreak'> </div>";
                }
            ?>
                <tr>
                    <td style="text-align:center;vertical-align:top;text-align:center;"><?php echo $nomor; ?></td>
                    <td style="vertical-align:top;padding-left:5px;"><?php echo $d['kode_barang']; ?></td>
                    <td style="vertical-align:top;padding-left:5px;"><?php echo $d['nama_barang']; ?></td>
                    <td style="vertical-align:center;padding-left:5px;text-align:center;"><?php echo $d['nama_warna']; ?></td>
                    <td style="vertical-align:center;text-align:center;"><?php echo $d['stok_gudang']; ?></td>
                    <td style="vertical-align:center;text-align:right;"><?php echo 'Rp ' . number_format($d['hargajual']); ?></td>
                    <td style="vertical-align:center;text-align:right;"><?php echo 'Rp ' . number_format($d['hargagrosir']); ?></td>
                    <td style="vertical-align:center;text-align:right;"><?php echo 'Rp ' . number_format($d['hargapokok']); ?></td>
                </tr>
            <?php
            }
            ?>
        </table>

        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td></td>
            </tr>
        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td align="right">Bali, <?php echo date('d-M-Y') ?></td>
            </tr>
            <tr>
                <td align="right"></td>
            </tr>

            <tr>
                <td><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td align="right">( <?php echo $this->session->userdata('nama'); ?> )</td>
            </tr>
            <tr>
                <td align="center"></td>
            </tr>
        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <th><br /><br /></th>
            </tr>
            <tr>
                <th align="left"></th>
            </tr>
        </table>
    </div>
</body>

</html>