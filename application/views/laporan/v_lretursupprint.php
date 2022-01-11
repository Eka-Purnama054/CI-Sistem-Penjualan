<!DOCTYPE html>
<html lang="en">

<?php
$this->load->view('template/v_header');
?>

<body onload="window.print()">
    <div class="wrapper">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>
        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>BALI TEES </h4>
                        <h4>Laporan Retur Gudang</h4>
                    </center><br />
                </td>
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
                    <th>No. Retur</th>
                    <th>Tanggal</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Zise</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Ket.</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($retur->result_array() as $row) :
                    $kt = $row['no_retur'];
                    $tgl = $row['tanggal_retur'];
                    $barang_kode = $row['kode_barang'];
                    $id = $row['id_barang'];
                    $barang_nama = $row['nama_barang'];
                    $barang_harjul = $row['hargapokok'];
                    $barang_qty = $row['jumlah'];
                    $barang_total = $row['subtotal'];
                    $size = $row['size_barang'];
                    $ket = $row['keterangan'];
                    $user = $row['username'];
                ?>
                    <tr>
                        <td><?= $kt ?></td>
                        <td><?= $tgl ?></td>
                        <td><?= $barang_kode ?></td>
                        <td><?= $barang_nama ?></td>
                        <td><?= $size ?></td>
                        <td><?= $barang_harjul ?></td>
                        <td><?= $barang_qty ?></td>
                        <td><?= $barang_total ?></td>
                        <td><?= $ket ?></td>
                        <td><?= $user ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
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