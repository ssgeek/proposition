@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class='fade-in'>
                        <div class='row' style='witdh:100%;'>
                            
                            <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-success">
                                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div style="padding:10px;">
                                            <div class="text-value-lg badge badge-primary">{{ isset($data['nbrePropositions']) ? $data['nbrePropositions'] : 0 }}</div>
                                            <div>Propositions</div>
                                            <div>
                                                <br />
                                                <a href = "{{ route('proposition.index')}}">
                                                    <button type="button" class="btn btn-primary btn-sm">Gérer</button>
                                                </a> 
                                            </div> 
                                        </div>
                                          
                                          
                                    </div>
                                </div>
                            </div> 
                            <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-primary">
                                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div style="padding:10px;">
                                            <div class="text-value-lg badge badge-danger">{{ isset($data['nbreUsers']) ? $data['nbreUsers'] : 0}}</div>
                                            <div>Utilisateurs</div>
                                            <div>
                                                <br />
                                                <a href = "{{ route('user.index')}}">
                                                    <button type="button" class="btn btn-danger btn-sm">Gérer</button>
                                                </a> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-sm-6 col-lg-3">
                                <div class="card text-white bg-secondary">
                                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div style="padding:10px;">
                                            <div class="text-value-lg badge badge-warning">{{ isset($data['nbreTarifs']) ? $data['nbreTarifs'] : 0 }}</div>
                                            <div>tarifs</div>
                                            <div>
                                                <br />
                                                <a href = "{{ route('tarif.index')}}">
                                                    <button type="button" class="btn btn-warning btn-sm">Gérer</button>
                                                </a> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-sm-6 col-lg-3">
                                <div class="card text-dark bg-warning">
                                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div style="padding:10px;">
                                            <div class="text-value-lg badge badge-success">{{ isset($data['nbreSites']) ? $data['nbreSites'] : 0 }}</div>
                                            <div>Sites Orange</div>
                                            <div>
                                                <br />
                                                <a href = "{{ route('site.index')}}">
                                                    <button type="button" class="btn btn-success btn-sm">Gérer</button>
                                                </a> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>









                </div>
            </div>
        </div>
    </div>
</div>
@endsection
