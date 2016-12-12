<!DOCTYPE html>
<html>
<head>
    <title>Bhaskara Madya - SPK <?php echo $spk->no_repair_spk?></title>
</head>
<body>
    

    <table width="100%">
        <tr><td colspan="3"><img src="<?php echo base_url('logo.png') ?>" alt="logo"></td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td><?php echo $spk->judul_repair_spk?></td></tr>
        <tr><td>Vendor</td><td>:</td><td>PT. BHAKARA MADYA JAYA </td></tr>
        <tr><td>Nomor Pengajuan</td><td>:</td><td><?php echo $spk->no_pengajuan_repair_spk?></td></tr>
        <tr><td>Tanggal Pengajuan</td><td>:</td><td><?php echo TanggalIndo($spk->tanggal_pengajuan_repair_spk)?></td></tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="0" width="100%">
        <thead>
            <tr valign="top"><th>No</th><th>UKER</th><th>Pekerjaan</th><th>Vol</th><th>Satuan</th><th>Harga Satuan <br>(Rp)</th><th>Total <br>(Rp)</th></tr>
        </thead>
        <tbody>
            <?php $harga = 0; $no =0; foreach ($relasi as $t): ?>
            <?php 
            $total = 0;
            $no++;
            $detail  = Mrepairdetail::leftjoin('repair_subkon', 'repair_subkon.id_repair_subkon','=','repair_detail.id_repair_subkon')
                ->leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_detail.id_repair_pekerjaan')
                ->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
                ->where('repair_detail.id_repair_pekerjaan',$t->id_repair_pekerjaan)
                ->get();
            $total += count($detail->toArray());
            ?>
            <?php $sa=1; ?>
            <?php foreach ($detail as $s): ?>
                <tr valign="top">
                    <?php if ($sa==1): ?>
                    <td colspan="0" rowspan="<?php echo $total?>"><?php echo $no?></td>
                    <td colspan="1" rowspan="<?php echo $total?>"><?php echo $t->nama_k?></td>
                    <?php endif ?>
                    <?php $sa++; ?>
                    <td><?php echo $s->nama_repair_subkon?></td>
                    <td align="right">1</td>
                    <td>Unit</td>
                    <td align="right">
                        <?php
                        $harga_jual= Mrepairharga::where('id_repair_subkon', $s->id_repair_subkon)
                                                ->where('id_z', $s->id_z)
                                                ->first();
                                    $harga += $harga_jual->harga_repair_harga;
                        ?>
                        <?php echo number_format($harga_jual->harga_repair_harga)?>
                    </td>
                    <td align="right"><?php echo number_format($harga_jual->harga_repair_harga)?></td>
                </tr>
            <?php endforeach ?>

        <?php endforeach ?>
    </tbody>
    <tfoot>
        <?php 
            $hpp =  $harga/1.1;

        ?>
        <tr>
            <th colspan="6" align="right">Grand Total (Rp)</th>
            <th align="right"><?php echo number_format($harga)?></th>
        </tr>
        <tr>
            <th colspan="6" align="right">DPP (Rp)</th>
            <th align="right"><?php echo number_format($hpp)?></th>
        </tr>
        <tr>
            <th colspan="6" align="right">PPH (2%) (Rp)</th>
            <th align="right"><?php echo number_format($hpp*2/100)?></th>
        </tr>
        <tr>
            <th colspan="6" align="right">PPN (10%) (Rp)</th>
            <th align="right"><?php echo number_format($hpp*10/100)?></th>
        </tr>
        <tr>
            <th colspan="6" align="right">Nilai Neto (Rp)</th>
            <th align="right"><?php echo number_format($hpp-($hpp*2/100))?></th>
        </tr>
    </tfoot>
</table>

<p>
    Hormat Kami,<br><br><br><br><br><br>Budiharjo
</p>

</body>
</html>