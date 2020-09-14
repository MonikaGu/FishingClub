@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurkime naują narį:</div>
               <div class="card-body">
                   <form action="{{ route('members.store') }}" method="POST">
                        @csrf

                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Vardas: </label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        @error('surname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Pavardė: </label>
                            <input type="text" name="surname" class="form-control"> 
                        </div>

                        @error('live')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Miestas kuriame gyvena: </label>
                            <input type="text" name="live" class="form-control"> 
                        </div>

                        @error('experience')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @if($errors->any())
                            <h4 style="color: red">{{$errors->first()}}</h4>
                        @endif

                        <div class="form-group">
                            <label>Patirtis metais: </label>
                            <input type="number" name="experience" class="form-control"> 
                        </div>

                        @error('registered')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label>Klube registruotas metais: </label>
                            <input type="number" name="registered" class="form-control"> 
                        </div>
                        <div class="form-group">
                            <label>Žvejybos rezervuaras: </label>
                            <select name="reservoir_id" id="" class="form-control">
                                 <option value="" selected disabled>Pasirinkite rezervuarą</option>
                                 <option value="{{NULL}}">-</option>
                                 @foreach ($reservoirs as $reservoir)
                                 <option value="{{ $reservoir->id }}">{{ $reservoir->title }}</option>
                                 @endforeach
                            </select>
                        </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
