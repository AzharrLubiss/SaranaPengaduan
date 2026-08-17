@extends('layouts.app')

@section('title', 'Lapor')

@section('content')

    <div class="row">

        <div class="col-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="text-center">Laporkan</h3>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('buat-laporan') }}" method="post">
                        @csrf
                        
                    </form>

                </div>
            </div>
        </div>


        <div class="col-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="text-center">Laporan</h3>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>

    </div>


    

    

@endsection