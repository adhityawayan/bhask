@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-folder"></i> Repair</li>
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
                            <tr><th width="30px;">ID</th><th>Nama Unit Kerja</th><th>Jenis Pekerjaan</th><th>Volume</th><th>Satuan</th><th>Harga Satuan</th><th>Harga Repair</th><th width="130px;">Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php $harga = 0; foreach ($relasi as $t): ?>
                            <?php 
                                $total = 1;
                                $detail  = Mrepairdetail::leftjoin('repair_subkon', 'repair_subkon.id_repair_subkon','=','repair_detail.id_repair_subkon')
                                ->leftjoin('repair_pekerjaan', 'repair_pekerjaan.id_repair_pekerjaan','=','repair_detail.id_repair_pekerjaan')
                                ->leftjoin('kantor', 'kantor.id_k','=','repair_pekerjaan.id_k')
                                ->where('repair_detail.id_repair_pekerjaan',$t->id_repair_pekerjaan)
                                ->get();
                                $total += count($detail->toArray());
                            ?>
                            <tr>
                                <td colspan="1" rowspan="{{$total}}">{{$t->id_repair_relasi_spk}}</td>
                                <td colspan="1" rowspan="{{$total}}">{{$t->nama_k}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="1" rowspan="{{$total}}">
                                    <a href="{{base_url('repair/spk/delete_relasi/'.$t->id_repair_spk.'?id_repair_relasi_spk='.$t->id_repair_relasi_spk)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <?php foreach ($detail as $s): ?>
                            <tr>
                                <td>{{$s->nama_repair_subkon}}</td>
                                <td>1</td>
                                <td>Unit</td>
                                <td>
                                <?php
                                    $harga_jual= Mrepairharga::where('id_repair_subkon', $s->id_repair_subkon)
                                                ->where('id_z', $s->id_z)
                                                ->first();
                                    $harga += $harga_jual->harga_repair_harga;

                                ?>
                                    Rp {{number_format($harga_jual->harga_repair_harga)}}
                                </td>
                                <td>Rp {{number_format($harga_jual->harga_repair_harga)}}</td>
                            </tr>
                            <?php endforeach ?>


                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6">Grand Total</th>
                                <th colspan="1">Rp {{number_format($harga)}}</th>
                                <td></td>
                            </tr>
                                <!-- <?php $hpp = $harga/1.1; ?>
                            <tr>
                                <th colspan="6">DPP</th>
                                <th colspan="1">Rp {{number_format($hpp)}}</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="6">PPH (2%)</th>
                                <th colspan="1">Rp {{number_format($pph = $hpp*2/100)}}</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="6">PPN (10%)</th>
                                <th colspan="1">Rp {{number_format($ppn = $hpp*10/100)}}</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="6">Nilai Neto</th>
                                <th colspan="1">Rp {{number_format($neto = $hpp-$pph)}}</th>
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