<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>laporan data stok barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div id="laporan">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>

        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>LAPORAN DATA BARANG</h4>
                        <h4>BALI TEES</h4>
                    </center><br />
                </td>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;margin-bottom:20px;">
            <?php
            $urut = 0;
            $nomor = 0;
            $group = '-';
            foreach ($g->result_array() as $d) {
                $nomor++;
                $urut++;
                if ($group == '-' || $group != $d['nama_item']) {
                    $kat = $d['nama_item'];
                    $query = $this->db->query("SELECT baranggudang.kode_barang,baranggudang.no_barang,
                    kategori_item.nama_item,baranggudang.nama_barang FROM baranggudang 
                    JOIN kategori_item ON kategori_item.kode_item=baranggudang.kode_item WHERE kategori_item.nama_item='$kat' ORDER BY kode_barang DESC");
                    $t = $query->row_array();
                    if ($group != '-')
                        echo "</table><br>";
                    echo "<table align='center' width='900px;' border='1'>";
                    echo "<tr><td colspan='8'><b>Kategori: $kat</b></td></tr>";
                    echo "<tr style='background-color:#ccc;'>
    <td width='4%' align='center'>No</td>
    <td align='center'>Barang Kode</td>
    <td align='center'>Nama Barang</td>
    <td align='center'>Warna</td>
    <td align='center'>Stok</td>
    <td align='center'>Hargajual</td>
    <td align='center'>Hargagrosir</td>
    <td align='center'>Hargapokok</td>
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