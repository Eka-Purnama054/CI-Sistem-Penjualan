<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/v_header');
?>

<body onload="window.print()">
    <div class="wrapper">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>
        <?php
        $b = $trans->row_array();
        ?>
        <table border="0" align="center" style="width:400px; border:none;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>BALI TEES </h4>
                        <h4><?= $b['nama_toko'] ?></h4>
                        <h4><?= $b['alamat_toko'] ?>/<?= $b['no_telp'] ?></h4>
                    </center>
                </td>
            </tr>
            <tr>
                <th style="width:400px">----------------------------------------------------------------------------------------------</th>
            </tr>
        </table>
        <table border="0" align="center" style="width:400px; border:none;margin-bottom:0px;">
            <tr>
                <th style="text-align:left;">No.</th>
                <th style="text-align:left;">: <?php echo $b['no_faktur']; ?></th>&nbsp;
            </tr>
            <tr>
                <th style="text-align:left;">Tanggal</th>
                <th style="text-align:left;">: <?php echo $b['tanggal']; ?></th>
            </tr>
            <tr>
                <th style="text-align:left;">Customer</th>
                <th style="text-align:left;">: Umum</th>
            </tr>
            <tr>
                <th style="text-align:left;">Member</th>
                <th style="text-align:left;">: Umum</th>
            </tr>
            <tr>
                <th style="text-align:left;">Kasir</th>
                <th style="text-align:left;">: <?= $b['name'] ?></th>
            </tr>
            <tr>
                <th colspan="2" style="width:400px">----------------------------------------------------------------------------------------------</th>
            </tr>
        </table>
        <div class="row"></div>
        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
        <table border="0" align="center" style="width:400px; border:none;margin-top:5px;margin-bottom:0px;">
            <thead>
                <tr>
                    <th style="width:20px;border:none;text-align:center;">No</th>
                    <th style="width:100px;border:none;text-align:center;">Item</th>
                    <th style="width:80px;border:none;text-align:center;">Price</th>
                    <th style="width:50px;border:none;text-align:center;">QTY</th>
                    <th style="width:90px;border:none;text-align:center;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($trans->result_array() as $i) {
                    $no++;

                    $nabar = $i['nama_barang'];
                    $harjul = $i['hargajual'];
                    $qty = $i['jumlah'];
                    $total = $i['subtotal'];
                ?>
                    <tr>
                        <td style="text-align:left;"><?php echo $no; ?></td>
                        <td style="text-align:center;"><?php echo $nabar; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul) . ',-'; ?></td>
                        <td style="text-align:center;"><?php echo $qty; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($total) . ',-'; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" style="width:400px">----------------------------------------------------------------------------------------------</th>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right;"><b>Total</b></td>
                    <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($b['total']) . ',-';; ?></b></td>
                </tr>
                <tr>
                    <th colspan="4" style="text-align:right;"><b>Diskon</b></th>
                    <th style="text-align:right;"><b><?php echo  'Rp ' . number_format($b['diskon']) . ',-'; ?></b></th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align:right;"><b>Tunai</b></th>
                    <th style="text-align:right;"><b><?php echo  'Rp ' . number_format($b['jml_uang']) . ',-'; ?></b></th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align:right;"><b>Kembalian</b></th>
                    <th style="text-align:right;"><b><?php echo  'Rp ' . number_format($b['kembalian']) . ',-'; ?></b></th>
                </tr>
                <tr>
                    <th colspan="5" style="width:400px">----------------------------------------------------------------------------------------------</th>
                </tr>
                <tr>
                    <th colspan="5" style="width:400px;text-align:center;">Terimakasih, Telah Berbelanja dengan Kami</th>
                </tr>
            </tfoot>
        </table>
        <table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
            <tr>
                <td></td>
        </table>
    </div>
    <?php
    $this->load->view('template/v_script');
    ?>
</body>

</html>