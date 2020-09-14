@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurkime naują rezervuarą:</div>
               <div class="card-body">
                   <form action="{{ route('reservoir.store') }}" method="POST">
                       @csrf

                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                       <div class="form-group">
                           <label>Pavadinimas: </label>
                           <input type="text" name="title" class="form-control">
                       </div>

                        @error('area')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                       <div class="form-group">
                           <label>Plotas: </label>
                           <input type="decimal" name="area" class="form-control"> 
                       </div>
                       <div class="form-group">
                           <label>Aprašymas: </label>
                           <textarea id="mce" name="about" rows=10 cols=100 class="form-control"></textarea>
                       </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
