@extends('Layouts.modelo1')

@section('content')
<div class="row col-md-12 text-center">
      <h1> <strong> Enquete @if($enquete->status == 'NOT-STARTED') Não Iniciada
            @elseif($enquete->status == 'STARTED') Em Andamento
            @elseif($enquete->status == 'ENDED') Finalizada
            @endif
      </strong> </h1>
      <div class="date-header">
            <div>
                  <p>Início:</p>
                  <span>{{date('d-m-y H:i', strtotime($enquete->start_date))}}</span>
            </div>

            <div>
                  <i class="bi bi-arrow-right"></i>
            </div>

            <div>
                  <p>Término:</p>
                  <span>{{date('d-m-y H:i', strtotime($enquete->end_date))}}</span>
            </div>
      </div>
</div>
<div class="gap-40"></div>
<hr>
<div class="alert-div">

@if($errors->any())
      <div id="error-card" class="alert alert-danger row">
            <div class="col-md-11">

                  <ul>
                  @foreach($errors->all() as $error)

                        <li> {{ $error }} </li>
                  @endforeach
                  </ul>
            </div>
            <div class="col-md-1">

                  <button type="button" data-bs-target="#error-card" class="btn-close mt-1"
                        aria-label="close" id="hide-error" data-bs-dismiss="alert"
                  ></button>
            </div>
      </div>
@elseif(session('success'))
      <div id="success-card" class="alert alert-success row">
            <div class="col-md-11">

                  {{ session('message') }}
            </div>
            <div class="col-md-1">

                  <button type="button" data-bs-target="#success-card" class="btn-close mt-1"
                        aria-label="close" id="hide-success" data-bs-dismiss="alert"
                  ></button>
            </div>
      </div>
@endif
</div>

<div class="simple-card">
      <div class="gap-20"></div>

      <h2 class="text-center">{{$enquete->title}}</h2>
      @if($enquete->description)
      <h4 class="text-center mt-4">{{$enquete->description}}</h4>
      @else
      <p class="text-center mt-4">(sem descrição)</p>
      @endif

      <div class="show-options">
            @foreach($enquete->options as $option)
            <div class="row col-md-12 radio-option">

                  <div class="form-check col-md-11">
                        <input class="form-check-input" name="vote"  id="radio-option_{{$option->id}}"
                        value="{{$option->id}}" type="radio" @if($enquete->status != 'STARTED') disabled @endif
                        >
                        <label class="form-check-label" for="radio-option_{{$option->id}}">
                              {{$option->content}}
                        </label>
                  </div>
                  <span id="votes_{{$option->id}}" class="text-end col-md-1">{{$option->votes}}</span>
            </div>
            @endforeach
      </div>

      <div class="text-center">
            <a class="back-button" href="{{ route('enquete-index') }}">Voltar</a>
            <button @if($enquete->status != 'STARTED') disabled @endif class="btn btn-primary vote-button" type="button" onclick="Vote()">Votar</button>
      </div>
</div>
<div class="gap-40"></div>

@endsection


@section('scripts')
<script>
      var sendVoteRoute = "{{route('send-vote', '')}}"
      @if($enquete->status == 'STARTED')
      var started = true
      @else
      var started = false
      @endif
</script>
<script src="{{asset('js/Vote.js')}}"></script>
@endsection