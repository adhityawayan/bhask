@extends('layouts.print')

@section('title', $title)

@section('content')
<img src="{{base_url('logo.png')}}">

<table>
    <tr><td>Pekerjaan</td><td>:</td><td>{{$spk->judul_sp}}</td></tr>
    <tr><td>Vendor</td><td>:</td><td>PT. BHAKARA MADYA JAYA </td></tr>
    <tr><td>Nomor Pengajuan</td><td>:</td><td>{{$spk->no_pengajuan_sp}}</td></tr>
    <tr><td>Tanggal Pengajuan</td><td>:</td><td>{{$spk->tanggal_pengajuan_sp}}</td></tr>
</table>
<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr><th width="30px;">No</th><th>Nama Unit Kerja</th><th>Jenis Pekerjaan</th><th>Deskripsi</th><th>Volume</th><th>Satuan</th><th>Harga Satuan</th><th>Harga Signage ATM</th><th>Harga Signage</th><th>Harga Pylon</th></tr>
    </thead>
    <tbody>
        <?php $harga = 0; $no =0; foreach ($relasi as $t): ?>
        <?php 
            $total = 1;
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
        <tr>
            <td colspan="0" rowspan="{{$total}}">{{$no}}</td>
            <td colspan="1" rowspan="{{$total}}">{{$t->nama_k}}</td>
            
        </tr>
        <?php foreach ($signage_atm as $s): ?>
        <tr>
            <td>{{$s->nama_b}}</td>
            <td>
                Depan = {{$s->depan_sa}}<br>
                Kanan = {{$s->kanan_sa}}<br>
                Kiri = {{$s->kiri_sa}}<br>
                Belakang = {{$s->belakang_sa}}<br>
                Tinggi = {{$s->tinggi_sa}}<br>
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
                Rp {{number_format($harga_jual->harga_b)}}
            </td>
            <td align="right">Rp {{number_format($hj)}}</td>
            <td></td>
            <td></td>
        </tr>
        <?php endforeach ?>
        <?php foreach ($signage as $s): ?>
        <tr>
            <td>{{$s->nama_b}}</td>
            <td>
                Panjang = {{$s->panjang_s}}<br>
                Lebar = {{$s->lebar_s}}<br>
            </td align="right">
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
                Rp {{number_format($harga_jual->harga_b)}}
            </td>
            <td></td>
            <td align="right">Rp {{number_format($hj)}}</td>
            <td></td>
        </tr>
        <?php endforeach ?>
        <?php foreach ($pylon as $s): ?>
        <tr>
            <td>{{$s->nama_b}}</td>
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
                Rp {{number_format($harga_jual->harga_b)}}
            </td>
            <td></td>
            <td></td>
            <td align="right">Rp {{number_format($harga_jual->harga_b)}}</td>
        </tr>
        <?php endforeach ?>


        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="7" align="right">Grand Total</th>
            <th colspan="3" align="right">Rp {{number_format($harga)}}</th>
        </tr>
        <tr>
        <th colspan="7" align="right">PPH (2%)</th>
        <th colspan="3" align="right">Rp {{number_format($harga*2/100)}}</th>
    </tr>
    <tr>
        <th colspan="7" align="right">PPN (10%)</th>
        <th colspan="3" align="right">Rp {{number_format($harga*10/100)}}</th>
    </tr>
    <tr>
        <th colspan="7" align="right">Nilai Neto</th>
        <th colspan="3" align="right">Rp {{number_format($harga+($harga*2/100))}}</th>
    </tr>
    </tfoot>
</table>

<p>
    Hormat Kami,<br><br><br><br><br><br>Budiharjo
</p>
@endsection