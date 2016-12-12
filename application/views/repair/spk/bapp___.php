<!DOCTYPE html>
<html>
<head>
    <title>Bhaskara Madya - BAPP <?php echo $spk->no_sp?></title>
</head>
<body>

    <table cellpadding="2" cellspacing="0" border="0" width="100%">
        <tr><td colspan="3"><img src="<?php echo base_url('logo.png') ?>" alt="logo" height="50px;"></td></tr>
        <tr><td colspan="3" align="center"><strong>BERITA ACARA PEMERIKSAAN HASIL PEKERJAAN (BAPP)</strong></td></tr>
        <tr>
            <td colspan="3" align="center">
                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                    <tr  align="center">
                        <?php 

                            if ($spk->id_jk==2) {
                                $kanca = $spk->nama_k;
                                $alamat_kanca = $spk->alamat_k;
                            }else{
                                if ($spk->id_jk2==2) {                                    
                                    $kanca = $spk->nama_parent;
                                    $alamat_kanca = $spk->alamat_parent;
                                }else{
                                    //Wilayah = 1 || Cabang = 2
                                    $parent = $spk->id_parent;

                                    for ($w=0; $w < 10; $w++) { 

                                        $kantor = Mkantor::select('kantor.id_k',
                                                                    'kantor.id_parent',
                                                                    'kantor.nama_k',
                                                                    'k2.nama_k as nama_parent', 
                                                                    'k2.alamat_k as alamat_parent', 
                                                                    'k2.id_jk as jenis_parent')
                                                            ->where('kantor.id_k',$parent)
                                                            ->leftjoin('kantor as k2', 'k2.id_k','=','kantor.id_parent')
                                                            ->first();
                                        if ($kantor->jenis_parent==2) {
                                            $kanca = $kantor->nama_parent;
                                            $alamat_kanca = $kantor->alamat_parent;
                                            break;
                                        }
                                    }
                                    $parent = $kantor->id_parent;
                                }
                            }
                        ?>
                        <td>Proyek  : <?php echo $spk->judul_repair_spk ?></td>
                    </tr>
                    <tr  align="center">
                        <td>
                            PT. Bank Rakyat Indonesia (Persero) Tbk. KC <?php echo $kanca ?>
                            <!-- <?php 
                                if ($spk->nama_parent!="") {
                                    echo $spk->nama_jk2.' '.$spk->nama_parent;
                                }
                            ?>   -->  
                        </td>
                    </tr>
                </table>                
            </td>
        </tr>
        <tr><td colspan="3">Pada Hari ini ..................... Tanggal ........................................ , kami yang bertandatangan dibawah ini :</td></tr>

        <tr><td width="1px;">1</td><td width="150px;">Nama</td><td>: ....</td></tr>
        <tr><td></td><td>Jabatan</td><td>: Pimpinan BRI KC <?php echo $kanca ?></td></tr>
        <tr><td></td><td>Unit Kerja</td><td>: KC <?php echo $kanca ?></td></tr>
        <tr><td></td><td>Alamat</td><td>: <?php echo $alamat_kanca?></td></tr>
        <tr><td>2</td><td>Nama</td><td>: Budihardjo</td></tr>
        <tr><td></td><td>Jabatan</td><td>: Direktur</td></tr>
        <tr><td></td><td>Unit Kerja</td><td>: PT. Bhaskara Madya Jaya</td></tr>
        <tr><td></td><td>Alamat</td><td>: Dukuh Kupang Utara I GX No. 16, Dukuh Pakis, Surabaya</td></tr>

        <tr><td colspan="3"><strong>Telah melakukan Pemeriksaan dan Penelitian dengan seksama terhadap hasil pekerjaan :</strong></td></tr>

        <tr><td colspan="2">Pekerjaan</td><td>: <?php echo $spk->judul_repair_spk ?></td></tr>
        <tr><td colspan="2">No. SPK</td><td>: <?php echo $spk->no_repair_spk?></td></tr>
        <tr><td colspan="2">Tanggal SPK</td><td>: <?php echo TanggalIndo($spk->tanggal_repair_spk)?></td></tr>
        <tr><td colspan="2">Kontraktor</td><td>: PT. Bhaskara Madya Jaya</td></tr>
        <tr>
            <td colspan="2" valign="top">Lokasi</td>
            <td>
                : 
                <ol>    
                <?php foreach ($relasi as $t){ ?>
                <?php 
                    $detail  = Mrepairdetail::leftjoin('repair_subkon', 'repair_subkon.id_repair_subkon','=','repair_detail.id_repair_subkon')
                    ->leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_detail.id_repair_pekerjaan')
                    ->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
                    ->where('repair_detail.id_repair_pekerjaan',$t->id_repair_pekerjaan)
                    ->get();
                ?>
                <li>
                    <?php 
                        echo $t->nama_k .'(';
                        foreach ($detail as $p) {
                            echo $p->nama_repair_subkon.', ';
                        }
                        echo ")";
                    ?>
                                       
                </li>
                <?php } ?>
                </ol>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                Kanca Supervisi : KC <?php echo $kanca?><br><br>                
                (Kontraktor, PT. Bhaskara Madya Jaya) telah melakukan <?php echo $spk->judul_sp ?> dengan Baik dan sesuai standarisasi tampilan yang ditetapkan oleh Kantor Pusat BRI <br><br>Demikian Berita Acara Pemeriksaan Hasil Pekerjaan (BAPP) ini kami buat dengan sebaik-baiknya, untuk kelengkapan administrasi di Bagian Logistik <?php echo $spk->nama_jk3." ".$spk->nama_logistik ?> <br><br>Atas kerjasama yang baik kami sampaikan terimakasih.
            </td>
        </tr>
    </table>
    <br><br>
    <table cellpadding="2" border="0" width="100%">
        <tr>
            <td width="60%">
                Diserahkan Oleh, <br> PT. Bhaskara Madya Jaya
            </td> 
            <td width="40%">
                Diterima Oleh, <br> BRI
            </td>
        </tr>
        <tr><td><br><br><br><br><strong>Budihardjo</strong><br>Direktur</td><td><br><br><br><br>.......................<br> Pimpinan BRI KC <?php echo $kanca ?> </td></tr>
    </table>
</body>
</html>