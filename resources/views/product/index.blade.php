@extends('layouts.AdminLTE.index')

@section('icon_page', 'gear')

@section('title', 'Application Settings')

@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('product.fetch') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" id="url" name="url" placeholder="Masukkan URL">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
