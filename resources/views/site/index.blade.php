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
    <tr><td><a href="{{ route('site.create')}}"><button type="button" class="btn btn-primary btn-lg btn-block">Ajouter un nouveau site</button></a></td></tr>
  </table>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Localisation</td>
          <td>Site</td>
          <td>Adresse</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($sites as $site)
        <tr>
            <td>{{$site->id}}</td>
            <td>{{$site->depatement}}</td>
            <td>{{$site->site}}</td>
            <td>{{$site->adresse}}</td>
            <td><a href="{{ route('site.edit', $site->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('site.destroy', $site->id)}}" method="post">
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