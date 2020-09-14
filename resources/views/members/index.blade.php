@extends('layouts.app')
@section('content')
<div class="card-body">
    
    @if (session('status_success'))
        <h4 style="color: green">{{session('status_success')}}</h4>
    @else 
        <h4 style="color: red">{{session('status_error')}}</h4>
    @endif

    <form action="{{ route('members.index') }}" method="GET">
        <select name="reservoir_id" id="" class="form-control">
            <option value="" selected>Visi</option>
            @foreach ($reservoirs as $reservoir)
            <option value="{{ $reservoir->id }}" 
                @if($reservoir->id == app('request')->input('reservoir_id')) 
                    selected="selected" 
                @endif>{{ $reservoir->title }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="card-body">

    @if($errors->any())
    <h4 style="color: green">{{$errors->first()}}</h4>
    @endif
    
    <table class="table">
        <tr>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Miestas kuriame gyvena</th>
            <th>Patirtis metais</th>
            <th>Klube registruotas metais</th>
            <th>Rezervuaras</th>
            <th>Veiksmai</th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{ $member->name }}</td>
            <td>{{ $member->surname }}</td>
            <td>{{ $member->live }}</td>
            <td>{{ $member->experience }}</td>
            <td>{{ $member->registered }}</td>
            {{-- <td>{{ $member->reservoir->title }}</td> --}}
            <td>@if ($member->reservoir_id !== NULL)
                {{$member->reservoir->title}}
                @else
                {{"-"}}
            @endif</td>  
            <td>
                <form action={{ route('members.destroy', $member->id)  . 
                    ( app('request')->input('reservoir_id') !== '' 
                        ? '?reservoir_id=' . app('request')->input('reservoir_id') 
                        : '' ) 
                    }} method="POST">
                    <a class="btn btn-success" href={{ route('members.edit', $member->id) }}>Redaguoti</a>
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Trinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('members.create') }}" class="btn btn-success">Pridėti</a>
    </div>
</div>
@endsection
