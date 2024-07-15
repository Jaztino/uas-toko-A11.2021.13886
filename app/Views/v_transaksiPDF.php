<h1>Data Transaksi</h1>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Total Harga</th>
        <th>Alamat</th>
        <th>Ongkir</th>
        <th>Status</th>
    </tr>

    <?php
    $no = 1;
    foreach ($transaction as $index => $transaksi) :
    ?>
        <tr>
            <td align="center"><?= $index + 1 ?></td>
            <td><?= $transaksi['username'] ?></td>
            <td align="right"><?= number_to_currency($transaksi['total_harga'], 'IDR') ?></td>
            <td><?= $transaksi['alamat'] ?></td>
            <td align="right"><?= number_to_currency($transaksi['ongkir'], 'IDR') ?></td>
            <td><?= $transaksi['status'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
Downloaded on <?= date("Y-m-d H:i:s") ?>