@extends('Layouts.modelo1')

@section('content')
<div class="row col-md-12">
      <h1> <strong> Editando Enquete </strong> </h1>
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


{{-------------------------- FORM ----------------------}}
{{-------------------------- FORM ----------------------}}
<div class="simple-card">
      <form id="edit-form" action="{{ route('enquete-update', $enquete->id) }}" method="post" role="form">
            @csrf

            <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                              <label>Titulo <span @error('title') style="color: red" @enderror>*</span></label>
                              <input id="title" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') ?? $enquete->title }}"
                              required autofocus type="text">
                              @error('title')
                                    <div style="color: darkorange"> {{ $message }} </div>
                              @enderror
                        </div>


                        <div class="gap-20"></div>

                        <div class="form-group">
                              <label>Descrição</label>
                              @error('description')
                                    <div style="color: darkorange"> {{ $message }} </div>
                              @enderror
                              <textarea
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description"
                                    id="description"
                                    style="min-height: 70px"
                              >{{old('description') ?? $enquete->description}}</textarea>
                        </div>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-3">
                        <div class="form-group">
                              <div class="gap-20"></div>
                              <label>Data de Início <span @error('start_date') style="color: red" @enderror>*</span></label>
                              <input value="{{old('start_date')?? date('Y-m-d\TH:i', strtotime($enquete->start_date)) }}"
                                    type="datetime-local" required class="form-control"
                              name="start_date">

                              <div class="gap-20"></div>
                              <label>Data de Término <span @error('end_date') style="color: red" @enderror>*</span></label>
                              <input value="{{old('end_date')?? date('Y-m-d\TH:i', strtotime($enquete->end_date)) }}"
                                    type="datetime-local" required class="form-control"
                              name="end_date">
                        </div>
                  </div>
            </div>

            <div class="gap-20"></div>
            <div class="text-center">

                  <h3>Opções de Resposta </h3>
                  <span>(minimo 3)</span>
            </div>
            <div class="gap-20"></div>

            <div class="row">
                  <div class="col-md-6">

                        <ul class="form-group options">
                              @foreach ($enquete->options as $k => $option)
                              @php
                                  $k ++
                              @endphp
                              <li id="option-{{$k}}">
                                    <div class="row mb-4">

                                          <div class="col-md-11">

                                                <input @if($k <= 3) required @endif value="{{$option->content}}" type="text" @if($k <= 3) placeholder="*Obrigatório*" @endif name="option[{{$k}}]" class="form-control option">
                                          </div>
                                          <div class="col-md-1">
                                                @if($k > 3)
                                                <button type="button" data-bs-target="#option-{{$k}}" class="btn-close mt-1"
                                                      aria-label="close" id="hide-{{$k}}" data-bs-dismiss="alert" tabindex="-1"
                                                ></button>
                                                @endif
                                          </div>
                                    </div>
                              </li>
                              @endforeach
                        </ul>
                  </div>
                  <div class="col-md-1"></div>
                  <div class="col-md-5 text-center">
                        <div class="gap-20"></div>
                        <button type="button" class="btn btn-primary" onclick="AddOption()">+ Adicionar Opção</button>

                        <div class="gap-20"></div>
                        <button type="button" class="btn btn-warning" onclick="CleanOptions()">Limpar Opções</button>

                        <div class="gap-20"></div>
                        <button type="button" class="btn btn-danger" onclick="RemoveOptions()">Remover Opções</button>
                  </div>
            </div>

            <div class="gap-40"></div>
            <div style="padding-right: 50px" class="text-end"><br>
                  <a class="col-md-1 back-button" href="{{route('enquete-index')}}">Voltar</a>
                  <button class="btn btn-primary solid blank" type="submit">Editar</button>
            </div>
      </form>
</div>
<div class="gap-40"></div>

@endsection

@section('scripts')
<script src="{{asset('js/AddOption.js')}}"></script>
<script src="{{asset('js/CleanOptions.js')}}"></script>
<script src="{{asset('js/RemoveOptions.js')}}"></script>

@endsection