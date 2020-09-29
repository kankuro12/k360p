@extends('layouts.sellerlayouts.seller-design')
@section('content')
@if($data->verified==0)
        <div class="container">
            <div class="card">
                <div class="card-header card-header-danger">
                    <h4 class="card-title">Full header coloured</h4>
                    <p class="category">Category subtitle</p>
                </div>
                <div class="card-body">
                      The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona...
                </div>
            </div>
          </div>
        </div>

    @endif
@endsection
