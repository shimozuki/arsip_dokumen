@extends('layouts/app2')
@section('title', 'Program Tahunan | SiArsip')
@section('judul', 'Program Tahunan')
@section('content')
<section class="section">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-statistic-1">
        <div class="card-wrap">
            <div class="card-header">
            <center><h2>{{ $program->judul_program }}</h2></center>
            <center><h4>{{ $program->tgl_mulai }} - {{ $program->tg_akhir }}</h4></center>
            </div>
            <div class="card-body">
            <p>{{ $program->keterangan }}</p>
            </div>
        </div>
        </div>
    </div>
</section>
              
@endsection

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
