@extends('layouts.app')
@include('includes.messages')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row">
        <div class="col-md-8">
            <h2>Strona główna</h2>
            <p>Strona w budowie...</p>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item active"> Ostatnia aktywność 
                    <div class="float-right">
                    <a href="{{$operations->previousPageUrl()}}"><i class="fas fa-arrow-circle-left" style="color:white"></i></a> 
                    {{ $operations->currentPage() }} / {{ $operations->lastPage() }} 
                        <a href="{{$operations->nextPageUrl()}}"><i class="fas fa-arrow-circle-right" style="color:white"></i></a>
                    </div>
                </li>
                @foreach($operations as $operation)
            <li class="list-group-item">{!!$operation->operation_NAME!!}<small> - {{$operation->user->name}} - {{ $diff = Carbon\Carbon::parse($operation->operation_DATETIME)->diffForHumans() }}</small></li>
                @endforeach
              </ul>
        </div>

        </div>
    </div>
</main>
@endsection