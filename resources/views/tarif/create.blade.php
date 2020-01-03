@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Ajouter des tarifs
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('tarif.store') }}">
          <div class="form-group">
              @csrf
              <label for="label">Label:</label>
              <input type="text" class="form-control" name="label"/>
          </div>
          <div class="form-group">
              <label for="tjm">TJM :</label>
              <input type="text" class="form-control" name="tjm"/>
          </div>
          <button type="submit" class="btn btn-primary">Ajouter ce Tarif</button>
      </form>
  </div>
</div>
@endsection