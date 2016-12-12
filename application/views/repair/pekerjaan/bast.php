<!DOCTYPE html>
<html>
<head>
    <title>Bhaskara Madya - <?php echo $title ?></title>
</head>
<body>
    <table cellpadding="0" border="0" width="100%">
        <tr><td colspan="3"><img src="<?php echo base_url('logo.png') ?>" alt="logo"></td></tr>
        <tr><td colspan="3" align="center"><h2>BERITA ACARA</h2></td></tr>
        <tr><td width="120px">Pada hari ini</td><td width="1px;">:</td><td>..................</td></tr>
        <tr><td>Hari</td><td>:</td><td>..................</td></tr>
        <tr><td>Tanggal</td><td>:</td><td>..................</td></tr>
        <tr><td colspan="3">Telah dilakukan Berita Acara Serah Terima :</td></tr>
        <tr>
            <td valign="top">1. Pekerjaan</td>
            <td valign="top">:</td>
            <td valign="top">
                <ul>
                <?php foreach ($repair_detail as $s){ ?>
                    <li><?php echo $s->nama_repair_subkon?></li>
                <?php } ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td>2. Lokasi</td><td>:</td><td><?php echo $detail->nama_k?></td>
        </tr>
        <tr>
            <td colspan="3"><p>Dari hasil pemeriksaan prestasi pekerjaan tersebut, seluruh pekerjaan telah diselesaikan 100% dengan hasil baik.</p><p> Demikian Berita Acara ini dibuat dengan sebenarnya, untuk digunakan kelengkapan administrasi.</p></td>
        </tr>
    </table>
    <table cellpadding="0" border="0" width="100%">
        <tr>
            <td colspan="2">Surabaya, ..................... 2016 </td>
        </tr>
        <tr>
            <td width="50%">
                Yang Membuat, <br> PT. Bhaskara Madya Jaya
            </td> 
            <td width="50%">
                Diterima Oleh, <br> BRI
            </td>
        </tr>
        <tr><td><br><br><br><br>.......................</td><td><br><br><br><br>.......................</td></tr>
    </table>
</body>
</html>


    <!--   -->