<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/v_header');
?>

<body onload="window.print()">
    <div class="wrapper">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>
        <?php $c = $kirim->row_array() ?>
        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>BALI TEES </h4>
                        <h4>LAPORAN PENGIRIMAN BARANG</h4>
                        <h4><?= $c['nama_toko'] ?></h4>
                        <h4><?= $c['alamat_toko'] ?>/<?= $c['no_telp'] ?></h4>
                    </center><br />
                </td>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="width:20px;border:none;text-align:center;">Dari Tanggal </th>
                <td style="text-align:left;"><?= $this->session->userdata('tanggal'); ?></td>
            </tr>
            <tr>
                <th style="width:100px;border:none;text-align:center;">Sampai</th>
                <td style="text-align:left;"><?= $this->session->userdata('sampai'); ?></td>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
            <thead>
                <tr>
                    <th style="width:20px;border:none;text-align:center;">No. </th>
                    <th style="width:100px;border:none;text-align:center;">Kode Barang</th>
                    <th style="width:100px;border:none;text-align:center;">Item Barang</th>
                    <th style="width:100px;border:none;text-align:center;">Nama</th>
                    <th style="width:100px;border:none;text-align:center;">Size</th>
                    <th style="width:100px;border:none;text-align:center;">Warna</th>
                    <th style="width:80px;border:none;text-align:center;">Price</th>
                    <th style="width:50px;border:none;text-align:center;">QTY</th>
                    <th style="width:90px;border:none;text-align:center;">Sub Total</th>
                    <th style="width:90px;border:none;text-align:center;">Diterima/Belum</th>
                    <th style="width:90px;border:none;text-align:center;">Tanggal Terima</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($kirim->result_array() as $i) {
                    $no++;
                    $kode = $i['kode_barang'];
                    $item = $i['nama_item'];
                    $size = $i['nama_size'];
                    $nabar = $i['nama_barang'];
                    $harjul = $i['stokin_hargapokok'];
                    $qty = $i['jumlah'];
                    $total = $i['sub_total'];
                    $warna = $i['nama_warna'];
                    $terima = $i['stokin_ket'];
                    $tglterima = $i['tgl_terima'];
                ?>

                    <tr>
                        <td style="text-align:left;"><?php echo $no; ?></td>
                        <td style="text-align:center;"><?php echo $kode; ?></td>
                        <td style="text-align:center;"><?php echo $item; ?></td>
                        <td style="text-align:center;"><?php echo $nabar; ?></td>
                        <td style="text-align:center;"><?php echo $size; ?></td>
                        <td style="text-align:center;"><?php echo $warna; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul) . ',-'; ?></td>
                        <td style="text-align:center;"><?php echo $qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($total) . ',-'; ?></td>
                        <td style="text-align:center;"><?php echo $terima; ?></td>
                        <td style="text-align:center;"><?php echo $tglterima; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <?php
                $b = $sum->row_array();
                ?>
                <tr>
                    <td colspan="8" style="text-align:center;"><b>Total</b></td>
                    <td style="text-align:right;">
                        <b><?php echo 'Rp ' . number_format($b['total']) . ',-'; ?>
                        </b>
                    </td>
                </tr>
            </tfoot>
        </table>

        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td></td>
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
    </div>
    <?php
    $this->load->view('template/v_script');
    ?>
</body>

</html>