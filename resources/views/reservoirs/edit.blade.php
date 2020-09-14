@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pakeiskime rezervuaro informaciją</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('reservoir.update', $reservoir->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">

                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                            <label for="">Pavadinimas</label>
                            <input type="text" name="title" class="form-control" value="{{ $reservoir->title }}">
                        </div>

                        @error('area')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="">Plotas</label>
                            <input type="decimal" name="area" class="form-control" value="{{ $reservoir->area }}">
                        </div>
                        <div class="form-group">
                            <label for="">Aprašas</label>
                            <textarea type="text" id="mce" name="about" rows=10 cols=100 class="form-control">{{ $reservoir->about }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Pakeisti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
