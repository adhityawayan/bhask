<?php

$count_relasi = count($relasi);

// print_r($relasi);

// die();

if ($count_relasi > 1 ) {

    $kanca_tbk_check = array();
    foreach ($relasi as $t) {

            $kantor_custom = Mkantor::select('kantor.id_k','kantor.id_jk','kantor.nama_k','kantor.alamat_k')->where('kantor.id_k',$t->id_parent)->first();
            if ( $kantor_custom->id_jk == 2) {
                $kanca_tbk = $kantor_custom->nama_k;
                $alamat_kanca_tbk = $kantor_custom->alamat_k;
                $id_k_tbk = $kantor_custom->id_k;
            } else {
                $kanca_tbk = $t->nama_k;
                $alamat_kanca_tbk = $t->alamat_k;
                $id_k_tbk = $t->id_k;
            }

// print_r( $kantor_custom);
        $kanca_tbk_check[] = $id_k_tbk;

    }

    $count_kanca = array_unique($kanca_tbk_check);
    $count_kanca_tbk_check = count($count_kanca);

print_r(array_count_values($kanca_tbk_check));

    // print_r($count_kanca);




// jika Ruteng [4] lebih dari 1

// Array ( [0] => Kalabahi [1] => Ruteng [4] => Maumere [6] => Ende )


    if ($count_kanca_tbk_check > 1) { ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Bhaskara Madya - BAPP <?php echo $spk->no_sp?></title>
        </head>
        <body>
        <?php
        for ($i=1; $i <= $count_relasi; $i++) { ?>
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
                                        }
                                    }
                                ?>
                                <td>Proyek  : <?php echo $spk->judul_sp ?></td>
                            </tr>
                            <?php
                            $irel = 1;
                            foreach ($relasi as $t) {
                                if ($i == $irel) {
                                    $kantor_custom = Mkantor::select('kantor.id_k','kantor.id_jk','kantor.nama_k','kantor.alamat_k')->where('kantor.id_k',$t->id_parent)->first();
                                    if ( $kantor_custom->id_jk == 2) {
                                        $kanca_tbk = $kantor_custom->nama_k;
                                        $alamat_kanca_tbk = $kantor_custom->alamat_k;
                                    } else {
                                        $kanca_tbk = $t->nama_k;
                                        $alamat_kanca_tbk = $t->alamat_k;
                                    }
                                }
                                $irel++;
                            }
                            ?>
                            <tr  align="center">
                                <td>PT. Bank Rakyat Indonesia (Persero) Tbk. KC <?php echo $kanca_tbk; ?></td>
                            </tr>
                        </table>                
                    </td>
                </tr>
                <tr><td colspan="3">Pada Hari ini ..................... Tanggal ........................................ , kami yang bertandatangan dibawah ini :</td></tr>

                <tr><td width="1px;">1</td><td width="150px;">Nama</td><td>: ....</td></tr>
                <tr><td></td><td>Jabatan</td><td>: Pimpinan BRI KC <?php echo $kanca_tbk ?></td></tr>
                <tr><td></td><td>Unit Kerja</td><td>: KC <?php echo $kanca_tbk ?></td></tr>
                <tr><td></td><td>Alamat</td><td>: <?php echo $alamat_kanca_tbk?></td></tr>
                <tr><td>2</td><td>Nama</td><td>: Budihardjo</td></tr>
                <tr><td></td><td>Jabatan</td><td>: Direktur</td></tr>
                <tr><td></td><td>Unit Kerja</td><td>: PT. Bhaskara Madya Jaya</td></tr>
                <tr><td></td><td>Alamat</td><td>: Dukuh Kupang Utara I GX No. 16, Dukuh Pakis, Surabaya</td></tr>

                <tr><td colspan="3"><strong>Telah melakukan Pemeriksaan dan Penelitian dengan seksama terhadap hasil pekerjaan :</strong></td></tr>

                <tr><td colspan="2">Pekerjaan</td><td>: <?php echo $spk->judul_sp ?></td></tr>
                <tr><td colspan="2">No. SPK</td><td>: <?php echo $spk->no_sp?></td></tr>
                <tr><td colspan="2">Tanggal SPK</td><td>: <?php echo TanggalIndo($spk->tanggal_sp)?></td></tr>
                <tr><td colspan="2">Kontraktor</td><td>: PT. Bhaskara Madya Jaya</td></tr>
                <tr>
                    <td colspan="2" valign="top">Lokasi</td>
                    <td> :
                        <?php
                        $irel = 1;

                        foreach ($relasi as $t) {

                            $signage_atm  = Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
                            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage_atm.id_p')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->where('signage_atm.id_p',$t->id_p)
                            ->get();
                            $signage  = Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
                            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage.id_p')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->where('signage.id_p',$t->id_p)
                            ->get();
                            $pylon  = Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
                            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','pylon.id_p')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->where('pylon.id_p',$t->id_p)
                            ->get();

                            if ($i == $irel) {

                                echo $t->nama_k .'(';
                                foreach ($signage_atm as $sa) {
                                    echo $sa->nama_b. 'Ukuran De = '.$sa->depan_sa.' Ka = '.$sa->kanan_sa.' Ki = '.$sa->kiri_sa.' Be = '.$sa->belakang_sa.',';
                                }
                                foreach ($signage as $s) {
                                    echo $s->nama_b.' Ukuran P = '.$s->panjang_s.' L = '.$s->lebar_s.', ';
                                }
                                foreach ($pylon as $p) {
                                    echo $p->nama_b;
                                }
                                echo ")";
                            }
                            $irel++;
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <br>
                        Kanca Supervisi : KC <?php echo $kanca_tbk?><br><br>                
                        (Kontraktor, PT. Bhaskara Madya Jaya) telah melakukan <?php echo $spk->judul_sp ?> dengan Baik dan sesuai standarisasi tampilan yang ditetapkan oleh Kantor Pusat BRI <br><br>Demikian Berita Acara Pemeriksaan Hasil Pekerjaan (BAPP) ini kami buat dengan sebaik-baiknya, untuk kelengkapan administrasi di Bagian Logistik <?php echo $spk->nama_jk3." ".$spk->nama_logistik ?> <br><br>Atas kerjasama yang baik kami sampaikan terimakasih.
                    </td>
                </tr>
            </table>
            <br>
            <table cellpadding="2" border="0" width="100%">
                <tr>
                    <td width="60%">
                        Diserahkan Oleh, <br> PT. Bhaskara Madya Jaya
                    </td> 
                    <td width="40%">
                        Diterima Oleh, <br> BRI
                    </td>
                </tr>
                <tr><td><br><br><strong>Budihardjo</strong><br>Direktur</td><td><br><br>.......................<br> Pimpinan BRI KC <?php echo $kanca_tbk ?> </td></tr>
            </table>
            <?php if ($i != $count_relasi) { ?>
            <br clear="all" style="page-break-before:always" />
            <?php }
        } // foreach
            
        ?>
        </body>
        </html>
    <?php } else { ?>
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
                                <td>Proyek  : <?php echo $spk->judul_sp ?></td>
                            </tr>
                            <tr  align="center">
                                <td>
                                    PT. Bank Rakyat Indonesia (Persero) Tbk. KC <?php echo $kanca ?>
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

                <tr><td colspan="2">Pekerjaan</td><td>: <?php echo $spk->judul_sp ?></td></tr>
                <tr><td colspan="2">No. SPK</td><td>: <?php echo $spk->no_sp?></td></tr>
                <tr><td colspan="2">Tanggal SPK</td><td>: <?php echo TanggalIndo($spk->tanggal_sp)?></td></tr>
                <tr><td colspan="2">Kontraktor</td><td>: PT. Bhaskara Madya Jaya</td></tr>
                <tr>
                    <td colspan="2" valign="top">Lokasi</td>
                    <td> : <ol style="display: inline-table;margin: 0;padding: 0 0 0 20px;">
                        <?php foreach ($relasi as $t){ ?>
                            <li>
                                <?php 
                                    $signage_atm  = Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
                                    ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage_atm.id_p')
                                    ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                    ->where('signage_atm.id_p',$t->id_p)
                                    ->get();
                                    $signage  = Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
                                    ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage.id_p')
                                    ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                    ->where('signage.id_p',$t->id_p)
                                    ->get();
                                    $pylon  = Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
                                    ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','pylon.id_p')
                                    ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                                    ->where('pylon.id_p',$t->id_p)
                                    ->get();
                                ?>
                                <?php 
                                    echo $t->nama_k .'(';
                                    foreach ($signage_atm as $sa) {
                                        echo $sa->nama_b. 'Ukuran De = '.$sa->depan_sa.' Ka = '.$sa->kanan_sa.' Ki = '.$sa->kiri_sa.' Be = '.$sa->belakang_sa.', ';
                                    }
                                    foreach ($signage as $s) {
                                        echo $s->nama_b.' Ukuran P = '.$s->panjang_s.' L = '.$s->lebar_s.', ';
                                    }
                                    foreach ($pylon as $p) {
                                        echo $p->nama_b;
                                    }
                                    echo ")";
                                ?>
                            </li>
                        <?php } ?>
                    </ul> 
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        Kanca Supervisi : KC <?php echo $kanca?><br><br>                
                        (Kontraktor, PT. Bhaskara Madya Jaya) telah melakukan <?php echo $spk->judul_sp ?> dengan Baik dan sesuai standarisasi tampilan yang ditetapkan oleh Kantor Pusat BRI <br><br>Demikian Berita Acara Pemeriksaan Hasil Pekerjaan (BAPP) ini kami buat dengan sebaik-baiknya, untuk kelengkapan administrasi di Bagian Logistik <?php echo $spk->nama_jk3." ".$spk->nama_logistik ?> <br><br>Atas kerjasama yang baik kami sampaikan terimakasih.
                    </td>
                </tr>
            </table>
            <br>
            <table cellpadding="2" border="0" width="100%">
                <tr>
                    <td width="60%">
                        Diserahkan Oleh, <br> PT. Bhaskara Madya Jaya
                    </td> 
                    <td width="40%">
                        Diterima Oleh, <br> BRI
                    </td>
                </tr>
                <tr><td><br><br><strong>Budihardjo</strong><br>Direktur</td><td><br><br>.......................<br> Pimpinan BRI KC <?php echo $kanca ?> </td></tr>
            </table>
        </body>
        </html>
    <?php } ?>

<?php } else { ?>

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
                        <td>Proyek  : <?php echo $spk->judul_sp ?></td>
                    </tr>
                    <tr  align="center">
                        <td>
                            PT. Bank Rakyat Indonesia (Persero) Tbk. KC <?php echo $kanca ?>
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

        <tr><td colspan="2">Pekerjaan</td><td>: <?php echo $spk->judul_sp ?></td></tr>
        <tr><td colspan="2">No. SPK</td><td>: <?php echo $spk->no_sp?></td></tr>
        <tr><td colspan="2">Tanggal SPK</td><td>: <?php echo TanggalIndo($spk->tanggal_sp)?></td></tr>
        <tr><td colspan="2">Kontraktor</td><td>: PT. Bhaskara Madya Jaya</td></tr>
        <tr>
            <td colspan="2" valign="top">Lokasi</td>
            <td> : <ol style="display: inline-table;margin: 0;padding: 0 0 0 20px;">
                <?php foreach ($relasi as $t){ ?>
                    <li>
                        <?php 
                            $signage_atm  = Msignage_atm::leftjoin('bahan', 'bahan.id_b','=','signage_atm.id_b')
                            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage_atm.id_p')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->where('signage_atm.id_p',$t->id_p)
                            ->get();
                            $signage  = Msignage::leftjoin('bahan', 'bahan.id_b','=','signage.id_b')
                            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','signage.id_p')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->where('signage.id_p',$t->id_p)
                            ->get();
                            $pylon  = Mpylon::leftjoin('bahan', 'bahan.id_b','=','pylon.id_b')
                            ->leftjoin('pekerjaan', 'pekerjaan.id_p','=','pylon.id_p')
                            ->leftjoin('kantor', 'kantor.id_k','=','pekerjaan.id_k')
                            ->where('pylon.id_p',$t->id_p)
                            ->get();
                        ?>
                        <?php 
                            echo $t->nama_k .'(';
                            foreach ($signage_atm as $sa) {
                                echo $sa->nama_b. 'Ukuran De = '.$sa->depan_sa.' Ka = '.$sa->kanan_sa.' Ki = '.$sa->kiri_sa.' Be = '.$sa->belakang_sa.', ';
                            }
                            foreach ($signage as $s) {
                                echo $s->nama_b.' Ukuran P = '.$s->panjang_s.' L = '.$s->lebar_s.', ';
                            }
                            foreach ($pylon as $p) {
                                echo $p->nama_b;
                            }
                            echo ")";
                        ?>
                    </li>
                <?php } ?>
            </ul> 
            </td>
        </tr>

        <tr>
            <td colspan="3">
                Kanca Supervisi : KC <?php echo $kanca?><br><br>                
                (Kontraktor, PT. Bhaskara Madya Jaya) telah melakukan <?php echo $spk->judul_sp ?> dengan Baik dan sesuai standarisasi tampilan yang ditetapkan oleh Kantor Pusat BRI <br><br>Demikian Berita Acara Pemeriksaan Hasil Pekerjaan (BAPP) ini kami buat dengan sebaik-baiknya, untuk kelengkapan administrasi di Bagian Logistik <?php echo $spk->nama_jk3." ".$spk->nama_logistik ?> <br><br>Atas kerjasama yang baik kami sampaikan terimakasih.
            </td>
        </tr>
    </table>
    <br>
    <table cellpadding="2" border="0" width="100%">
        <tr>
            <td width="60%">
                Diserahkan Oleh, <br> PT. Bhaskara Madya Jaya
            </td> 
            <td width="40%">
                Diterima Oleh, <br> BRI
            </td>
        </tr>
        <tr><td><br><br><strong>Budihardjo</strong><br>Direktur</td><td><br><br>.......................<br> Pimpinan BRI KC <?php echo $kanca ?> </td></tr>
    </table>
</body>
</html>

<?php } ?>