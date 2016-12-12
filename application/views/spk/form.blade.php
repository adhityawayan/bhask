@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-folder"></i> Projects</li>
        <li><i class="fa fa-wpforms"></i> SPK</li>
        <li class="active">{{$title}}</li>   
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-wpforms"></i>
                    <h3 class="box-title">
                       Form
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg!!}

                    {!!$form!!}
                    
                </div>
            </div>
        </div>
    </div>
    @if($detail==true)
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-table"></i>
                    <h3 class="box-title">
                      Index
                    </h3>
                </div>
                <div class="box-body">
                    {!!$msg_r!!}
                    {!!$form2!!}
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr><th width="30px;">ID</th><th>Nama Unit Kerja</th><th>Jenis Pekerjaan</th><th>Deskripsi</th><th>Volume</th><th>Satuan</th><th>Harga Satuan</th><th>Harga Signage ATM</th><th>Harga Signage</th><th>Harga Pylon</th><th width="130px;">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php $harga = 0; foreach ($relasi as $t): ?>
                            <?php 
                                $total = 1;
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
                                <td colspan="1" rowspan="{{$total}}">{{$t->id_rsp}}</td>
                                <td colspan="1" rowspan="{{$total}}">{{$t->nama_k}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="1" rowspan="{{$total}}">
                                    <a href="{{base_url('spk/delete_relasi/'.$t->id_sp.'?id_rsp='.$t->id_rsp)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
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
                                <td>
                                    <?php 
                                        $jumlah = $s->depan_sa + $s->kanan_sa + $s->kiri_sa + $s->belakang_sa;
                                        echo $jumlah;
                                    ?>
                                </td>
                                <td>Meter</td>
                                <td>
                                <?php
                                    $harga_jual= Mharga_bahan::where('id_b', $s->id_b)
                                                ->where('id_z', $s->id_z)
                                                ->first();
                                    $hj = $jumlah*$harga_jual->harga_b;
                                    $harga += $hj;
                                ?>
                                    Rp {{number_format($harga_jual->harga_b)}}
                                </td>
                                <td>Rp {{number_format($hj)}}</td>
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
                                </td>
                                <td><?php echo $l= $s->panjang_s*$s->lebar_s ?></td>
                                <td>Meter</td>
                                <td>
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
                                <td>Rp {{number_format($hj)}}</td>
                                <td></td>
                            </tr>
                            <?php endforeach ?>
                            <?php foreach ($pylon as $s): ?>
                            <tr>
                                <td>{{$s->nama_b}}</td>
                                <td></td>
                                <td>1</td>
                                <td>Unit</td>
                                <td>
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
                                <td>Rp {{number_format($harga_jual->harga_b)}}</td>
                            </tr>
                            <?php endforeach ?>


                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <?php 
                                $hpp =  $harga/1.1;

                            ?>
                            <tr>
                                <th colspan="7" align="right">Grand Total</th>
                                <th colspan="3">Rp <?php echo number_format($harga)?></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="7" align="right">DPP </th>
                                <th colspan="3">Rp <?php echo number_format($hpp)?></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="7" align="right">PPH (2%)</th>
                                <th colspan="3">Rp <?php echo number_format($hpp*2/100)?></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="7" align="right">PPN (10%)</th>
                                <th colspan="3">Rp <?php echo number_format($hpp*10/100)?></th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="7" align="right">Nilai Neto</th>
                                <th colspan="3">Rp <?php echo number_format($hpp-($hpp*2/100))?></th>
                                <td></td>
                            </tr>
                            <!-- 
                            <tr>
                                <th colspan="7">Grand Total</th>
                                <th colspan="3">Rp {{number_format($harga)}}</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="7" align="right">DPP (Rp)</th>
                                <th colspan="3"><?php echo number_format($hpp)?></th>
                            </tr>
                            <tr>
                                <th colspan="7">PPH (2%)</th>
                                <th colspan="3">Rp {{number_format($harga*2/100)}}</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="7">PPN (10%)</th>
                                <th colspan="3">Rp {{number_format($harga*10/100)}}</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="7">Nilai Neto</th>
                                <th colspan="3">Rp {{number_format($harga+($harga*2/100))}}</th>
                                <td></td>
                            </tr> -->
                        </tfoot>
                    </table>
                </div>
            </div>          
        </div>
    </div>
    @endif
</section>
@endsection