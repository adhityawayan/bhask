<!DOCTYPE html>
<html>
<head>
    <title>Bhaskara Madya - SPK <?php echo $spk->no_sp?></title>
</head>
<body>
    
    <table border="0" cellpadding="5" cellspacing="0" width="100%">
        <tr><td><img src="<?php echo base_url('logo.png') ?>" alt="logo"></td></tr>
        <tr><td align="center"><hr><h2>NOTA PENJUALAN</h2><hr></td></tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            Kepada / To :
                        </td>
                        <td>Invoice No.</td>
                        <td>: <?php echo $spk->no_invoice ?></td>
                    </tr>
                    <tr>
                        <td>
                            PT. Bank Rakyat Indonesia ( Persero) Tbk<br>
                            Jl. Jend Sudirman No. 44 - 46 Bendungan Hilir, Tanah Abang<br>
                            Jakarta Pusat
                        </td>
                        <td valign="top">Tanggal / date</td>
                        <td valign="top">: <?php echo TanggalIndo($spk->tanggal_invoice) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr><td width="25%">SPK/PO No.</td><td>: <?php echo $spk->no_sp?></td></tr>
                    <tr><td>Tanggal</td><td>: <?php echo TanggalIndo($spk->tanggal_sp)?></td></tr>
                    <tr><td>Project</td><td>: <?php echo $spk->judul_sp?></td></tr>
                    <tr>
                        <td>Nilai SPK/PO</td>
                        <td>: 
                            <?php 
                                    $harga = 0; 
                                    foreach ($relasi as $t){
                                        $signage_atm  = Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
                                        ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage_atm.id_p')
                                        ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                        ->where('signage_atm.id_p',$t->id_p)
                                        ->get();
                                        foreach ($signage_atm as $s){
                                            $jumlah = $s->depan_sa + $s->kanan_sa + $s->kiri_sa + $s->belakang_sa;
                                            $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                                            ->where('id_z', $s->id_z)
                                            ->first();
                                            $hj = $jumlah*$harga_jual->harga_b;
                                            $harga += $hj;
                                        }

                                        $signage  = Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
                                        ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage.id_p')
                                        ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                        ->where('signage.id_p',$t->id_p)
                                        ->get();
                                        foreach ($signage as $s){
                                            $l= $s->panjang_s*$s->lebar_s;
                                            $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                                            ->where('id_z', $s->id_z)
                                            ->first();
                                            $hj = $l * $harga_jual->harga_b;
                                            $harga += $hj;
                                        }

                                        $pylon  = Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
                                        ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','pylon.id_p')
                                        ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                        ->where('pylon.id_p',$t->id_p)
                                        ->get();
                                        foreach ($pylon as $s){
                                            $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                                            ->where('id_z', $s->id_z)
                                            ->first();
                                            $harga += $harga_jual->harga_b;
                                        }
                                    }
                                    $hpp = $harga/1.1;
                                    $ppn = $hpp*0.1;
                                    $grand = $hpp+$ppn; echo number_format($grand);
                                ?>
                        </td>
                    </tr>
                    <tr><td>BAP/CN.</td><td>: Terlampir</td></tr>
                </table>   
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="1" cellpadding="5" cellspacing="0">
                    <tr align="center"><td>Keterangan</td><td>QTY</td><td>Nilai</td><td>Jumlah</td></tr>
                    <tr>
                        <td>
                            <p><?php echo $spk->judul_sp?></p>
                            <ul>                             
                                <?php 
                                    $harga = 0; 
                                    foreach ($relasi as $t){
                                        echo "<li>";
                                        echo $t->nama_k;
                                        echo "</li>";

                                        $signage_atm  = Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
                                        ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage_atm.id_p')
                                        ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                        ->where('signage_atm.id_p',$t->id_p)
                                        ->get();
                                        foreach ($signage_atm as $s){
                                            $jumlah = $s->depan_sa + $s->kanan_sa + $s->kiri_sa + $s->belakang_sa;
                                            $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                                            ->where('id_z', $s->id_z)
                                            ->first();
                                            $hj = $jumlah*$harga_jual->harga_b;
                                            $harga += $hj;
                                        }

                                        $signage  = Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
                                        ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage.id_p')
                                        ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                        ->where('signage.id_p',$t->id_p)
                                        ->get();
                                        foreach ($signage as $s){
                                            $l= $s->panjang_s*$s->lebar_s;
                                            $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                                            ->where('id_z', $s->id_z)
                                            ->first();
                                            $hj = $l * $harga_jual->harga_b;
                                            $harga += $hj;
                                        }

                                        $pylon  = Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
                                        ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','pylon.id_p')
                                        ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                        ->where('pylon.id_p',$t->id_p)
                                        ->get();
                                        foreach ($pylon as $s){
                                            $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                                            ->where('id_z', $s->id_z)
                                            ->first();
                                            $harga += $harga_jual->harga_b;
                                        }
                                    }
                                ?>
                            </ul>
                        </td>
                        <td align="center">
                            1 Ls
                        </td>
                        <td align="right">
                            <?php echo number_format($hpp) ?>
                        </td>
                        <td align="right">
                            <?php echo number_format($harga) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right"><?php echo number_format($hpp) ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">PPN 10%</td>
                        <td align="right"><?php echo number_format($ppn); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Grand Total</td>
                        <td align="right"><?php echo number_format($grand); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" width="100%" cellpadding="10" cellspacing="0">
                    <tr>
                        <td>
                            Terbilang : <?php echo Terbilang($grand); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr align="right">
            <td>
                <table>
                    <tr>
                        <td>
                            <br><br><br><br><br><u>Budihardjo</u>    
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>