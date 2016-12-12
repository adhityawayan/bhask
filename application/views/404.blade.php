@extends('layouts.adminlte')

@section('title', $title)

@section('content')
	<section class="content-header">
      <h1>
        404 Error Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{base_url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">404 error</li>
      </ol>
    </section>
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Maaf! Halaman tidak ditemukan.</h3>

          <p>
          	Sistem tidak dapat menemukan halaman yang anda inginkan. Mungkin saat ini programmer kami sedang mengerjakannya :)
          </p>
        </div>
      </div>
    </section>	
@endsection