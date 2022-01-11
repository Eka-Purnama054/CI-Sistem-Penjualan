<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan data penjualan</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div class="wrapper">
        <table align="center">

        </table>

        <?php $b = $kasir->row_array() ?>
        <table border=" 0" align="center">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <span class="h4">LAPORAN PENJUALAN TOKO</span><br />
                        <span class="h4">BALI TEES</span><br />
                        <span class="h4"><?= $b['nama_toko'] ?></span><br />
                        <span class="h4"><?= $b['alamat_toko'] ?> | <?= $b['no_telp'] ?></span><br />
                    </center><br />
                </td>
            </tr>
        </table>

        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="0" align="center">
            <tr>
                <th style="text-align:left;" colspan="2">Dari Tanggal: </th>
                <th style="text-align:left;" colspan="6"><?=
                                                            $this->session->userdata('tanggal');
                                                            ?></th>
            </tr>
            <tr>
                <th style="text-align:left;" colspan="2">Sampai: </th>
                <th style="text-align:left;" colspan="6"><?=
                                                            $this->session->userdata('sampai');
                                                            ?></th>
            </tr>
        </table>
        <table border="0" align="center">

        </table>
        <table border="1" align="center">
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>No Faktur</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Jual</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($kasir->result_array() as $i) {
                    $no++;
                    $nofak = $i['no_faktur'];
                    $tgl = $i['tanggal'];
                    $barang_id = $i['no_barang'];
                    $barang_kode = $i['kode_barang'];
                    $barang_nama = $i['nama_barang'];
                    $barang_harjul = $i['hargajual'];
                    $barang_qty = $i['jumlah'];
                    $barang_total = $i['subtotal'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                        <td style="text-align:center;"><?php echo $tgl; ?></td>
                        <td style="text-align:center;"><?php echo $barang_kode; ?></td>
                        <td style="text-align:left;"><?php echo $barang_nama; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_harjul); ?></td>
                        <td style="text-align:center;"><?php echo $barang_qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($barang_total); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7" style="text-align:center;"><b>Diskon</b></td>
                    <td style="text-align:right;">
                        <b> Rp. <?php
                                foreach ($total as $data) {
                                    echo $data->diskon . ",00 ";
                                }
                                ?>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td colspan="7" style="text-align:center;"><b>Total</b></td>
                    <td style="text-align:right;">
                        <b> Rp. <?php
                                foreach ($total as $data) {
                                    echo $data->grandtotal . ",00 ";
                                }
                                ?>
                        </b>
                    </td>
                </tr>
            </tfoot>
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

</html>_