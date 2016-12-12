<!DOCTYPE html>
<html>
<head>
    <title>Bhaskara Madya - SPK <?php echo $spk->no_sp?></title>
</head>
<body>
    

    <table width="100%">
        <tr><td colspan="3"><img src="<?php echo base_url('logo.png') ?>" alt="logo"></td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td><?php echo $spk->judul_sp?></td></tr>
        <tr><td>Vendor</td><td>:</td><td>PT. BHAKARA MADYA JAYA </td></tr>
        <tr><td>Nomor Pengajuan</td><td>:</td><td><?php echo $spk->no_pengajuan_sp?></td></tr>
        <tr><td>Tanggal Pengajuan</td><td>:</td><td><?php echo TanggalIndo($spk->tanggal_pengajuan_sp)?></td></tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="0" width="100%">
        <thead>
            <tr valign="top"><th>No</th><th>UKER</th><th>Pekerjaan</th><th>Deskripsi</th><th>Vol</th><th>Satuan</th><th>Harga Satuan <br>(Rp)</th><th>Total <br>(Rp)</th></tr>
        </thead>
        <tbody>
            <?php $harga = 0; $no =0; foreach ($relasi as $t): ?>
            <?php 
            $total = 0;
            $no++;
            $signage_atm  = Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage_atm.id_p')
            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
            ->where('signage_atm.id_p',$t->id_p)
            ->get();
            $total += count($signage_atm->toArray());
            $signage  = Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage.id_p')
            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
            ->where('signage.id_p',$t->id_p)
            ->get();
            $total += count($signage->toArray());
            $pylon  = Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','pylon.id_p')
            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
            ->where('pylon.id_p',$t->id_p)
            ->get();
            $total += count($pylon->toArray());
            ?>
            <?php $sa=1; ?>
            <?php foreach ($signage_atm as $s): ?>
                <tr valign="top">
                    <?php if ($sa==1): ?>
                    <td colspan="0" rowspan="<?php echo $total?>"><?php echo $no?></td>
                    <td colspan="1" rowspan="<?php echo $total?>"><?php echo $t->nama_k?></td>
                    <?php endif ?>
                    <?php $sa++; ?>
                    <td><?php echo $s->nama_b?></td>
                    <td>
                        Depan = <?php echo $s->depan_sa?><br>
                        Kanan = <?php echo $s->kanan_sa?><br>
                        Kiri = <?php echo $s->kiri_sa?><br>
                        Belakang = <?php echo $s->belakang_sa?><br>
                        Tinggi = <?php echo $s->tinggi_sa?><br>
                    </td>
                    <td align="right">
                        <?php 
                        $jumlah = $s->depan_sa + $s->kanan_sa + $s->kiri_sa + $s->belakang_sa;
                        echo $jumlah;
                        ?>
                    </td>
                    <td>Meter</td>
                    <td align="right">
                        <?php
                        $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                        ->where('id_z', $s->id_z)
                        ->first();
                        $hj = $jumlah*$harga_jual->harga_b;
                        $harga += $hj;
                        ?>
                        <?php echo number_format($harga_jual->harga_b)?>
                    </td>
                    <td align="right"><?php echo number_format($hj)?></td>
                </tr>
            <?php endforeach ?>
            <?php foreach ($signage as $s): ?>
                <tr valign="top">
                    <?php if ($sa==1): ?>
                    <td colspan="0" rowspan="<?php echo $total?>"><?php echo $no?></td>
                    <td colspan="1" rowspan="<?php echo $total?>"><?php echo $t->nama_k?></td>
                    <?php endif ?>
                    <?php $sa++; ?>
                    <td><?php echo $s->nama_b?></td>
                    <td>
                        Panjang = <?php echo $s->panjang_s?><br>
                        Lebar = <?php echo $s->lebar_s?><br>
                    </td>
                    <td align="right"><?php echo $l= $s->panjang_s*$s->lebar_s ?></td>
                    <td>Meter</td>
                    <td align="right">
                        <?php
                        $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                        ->where('id_z', $s->id_z)
                        ->first();
                        $hj = $l * $harga_jual->harga_b;
                        $harga += $hj;

                        ?>
                        <?php echo number_format($harga_jual->harga_b)?>
                    </td>
                    <td align="right"><?php echo number_format($hj)?></td>
                </tr>
            <?php endforeach ?>
            <?php foreach ($pylon as $s): ?>
                <tr valign="top">
                    <?php if ($sa==1): ?>
                    <td colspan="0" rowspan="<?php echo $total?>"><?php echo $no?></td>
                    <td colspan="1" rowspan="<?php echo $total?>"><?php echo $t->nama_k?></td>
                    <?php endif ?>
                    <?php $sa++; ?>

                    <td><?php echo $s->nama_b?></td>
                    <td></td>
                    <td align="right">1</td>
                    <td>Unit</td>
                    <td align="right">
                        <?php
                        $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                        ->where('id_z', $s->id_z)
                        ->first();
                        $harga += $harga_jual->harga_b;
                        ?>
                        <?php echo number_format($harga_jual->harga_b)?>
                    </td>
                    <td align="right"><?php echo number_format($harga_jual->harga_b)?></td>
                </tr>
            <?php endforeach ?>


        <?php endforeach ?>
    </tbody>
    <tfoot>
        <?php 
            $hpp =  $harga/1.1;

        ?>
        <tr>
            <th colspan="7" align="right">Grand Total (Rp)</th>
            <th align="right"><?php echo number_format($harga)?></th>
        </tr>
        <tr>
            <th colspan="7" align="right">DPP (Rp)</th>
            <th align="right"><?php echo number_format($hpp)?></th>
        </tr>
        <tr>
            <th colspan="7" align="right">PPH (2%) (Rp)</th>
            <th align="right"><?php echo number_format($hpp*2/100)?></th>
        </tr>
        <tr>
            <th colspan="7" align="right">PPN (10%) (Rp)</th>
            <th align="right"><?php echo number_format($hpp*10/100)?></th>
        </tr>
        <tr>
            <th colspan="7" align="right">Nilai Neto (Rp)</th>
            <th align="right"><?php echo number_format($hpp-($hpp*2/100))?></th>
        </tr>
    </tfoot>
</table>

<p>
    Hormat Kami,<br><br><br><br><br><br>Budiharjo
</p>

</body>
</html>