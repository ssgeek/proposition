@extends('layout')


@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <table class="table" style="margin-top:50px;margin-bottom:50px;">
    <tr><td><a href="{{ route('tarif.create')}}"><button type="button" class="btn btn-primary btn-lg btn-block">Ajouter un nouveau tarif</button></a></td></tr>
  </table>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Label</td>
          <td>TJM</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tarifs as $tarif)
        <tr>
            <td>{{$tarif->id}}</td>
            <td>{{$tarif->label}}</td>
            <td>{{$tarif->tjm}}</td>
            <td><a href="{{ route('tarif.edit', $tarif->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('tarif.destroy', $tarif->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection