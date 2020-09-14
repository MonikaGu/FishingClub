@extends('layouts.app')
@section('content')
<div class="card-body">

    @if (session('status_success'))
        <h4 style="color: green">{{session('status_success')}}</h4>
    @else 
        <h4 style="color: red">{{session('status_error')}}</h4>
    @endif


    <table class="table">
        <tr>
            <th>Pavadinimas</th>
            <th>Plotas kv km</th>
            <th>Aprašymas</th>
            <th>Veiksmai</th>
        </tr>
        @foreach ($reservoirs as $reservoir)
        <tr>
            <td>{{ $reservoir->title }}</td>
            <td>{{ $reservoir->area }}</td>
            <td>{!! $reservoir->about !!}</td>
            <td>
                <form action={{ route('reservoir.destroy', $reservoir->id) }} method="POST">
                    <a class="btn btn-success" href={{ route('reservoir.edit', $reservoir->id) }}>Redaguoti</a>
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Trinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('reservoir.create') }}" class="btn btn-success">Pridėti</a>
    </div>
</div>
@endsection
