@extends('layouts.adminlte')

@section('title', $title)

@section('content')
<section class="content-header">
    <h1>
        {{$title}}
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-folder"></i> Repair</li>
        <li><i class="fa fa-money"></i> Harga Bahan</li>
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
</section>
@endsection