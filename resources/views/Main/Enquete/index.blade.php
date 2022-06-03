@extends('Layouts.modelo1')

@section('content')
<div class="row col-md-12">
      <h1 class="col-md-10"> <strong> Lista de Enquetes </strong> </h1>
      <div class="col-md-2">

            <button type="button" class="btn btn-outline-success mt-3" onclick="window.location='{{ route('enquete-create') }}'"> <strong> + Nova Enquete</strong></button>
      </div>
</div>
<div class="gap-40"></div>

{{-- ------------------------ FILTERS ------------------------- --}}
{{-- ------------------------ FILTERS ------------------------- --}}
<div class="text-center">
      <div class="btn-group">

      <button onclick="window.location='{{route('enquete-index')}}'"
            class="btn @if($filter == '') btn-primary @else btn-outline-primary @endif  slim-button filter-button" type="button"
      >
            Todas
      </button>
      <button onclick="window.location='{{route('enquete-index', 'filter=NOT-STARTED')}}'"
            class="btn @if($filter == 'NOT-STARTED') btn-primary @else btn-outline-primary @endif  slim-button filter-button" type="button"
      >
            Não Iniciadas
      </button>
      <button onclick="window.location='{{route('enquete-index', 'filter=STARTED')}}'"
            class="btn @if($filter == 'STARTED') btn-primary @else btn-outline-primary @endif  slim-button filter-button" type="button"
      >
            Em Andamento
      </button>
      <button onclick="window.location='{{route('enquete-index', 'filter=ENDED')}}'"
            class="btn @if($filter == 'ENDED') btn-primary @else btn-outline-primary @endif  slim-button filter-button" type="button"
      >
            Finalizadas
      </button>
      </div>
</div>
<hr style="margin-top: 3px">
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


{{-- ------------------------ TABLE ------------------------- --}}
{{-- ------------------------ TABLE ------------------------- --}}
<div class="simple-card">

@if ($enquetes->count() > 0)
      <table class="table">
            <thead class="thead-light">
                  <tr>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Início</th>
                        <th scope="col">Término</th>
                        <th scope="col">Ações</th>

                  </tr>
            </thead>

            <tbody>
                  @foreach ($enquetes as $enquete)

                  <tr class="enquete status-{{$enquete->status}}">
                        <td>{{$enquete->title}}</td>
                        <td>{{$enquete->description}}</td>
                        <td>{{date('d-m-y H:i', strtotime($enquete->start_date))}}</td>
                        <td>{{date('d-m-y H:i', strtotime($enquete->end_date))}}</td>
                        <td>

                              <div class="btn-group">
                                    <button id="view-button_{{$enquete->id}}" type="button"
                                          class="btn btn-outline-secondary"
                                          onclick="window.location='{{route('enquete-show', $enquete->id)}}'"
                                    >
                                          <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button id="edit-button_{{$enquete->id}}" type="button"
                                          class="btn btn-outline-primary"
                                          onclick="window.location='{{route('enquete-edit', $enquete->id)}}'"
                                    >
                                          <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button id="delete-button_{{$enquete->id}}" type="button"
                                          class="btn btn-outline-danger"
                                          data-bs-toggle="modal" data-bs-target="#deleteItemModal_{{$enquete->id}}"
                                    >
                                          <i class="bi bi-trash3-fill"></i>
                                    </button>
                              </div>
                        </td>
                  </tr>

                  {{-- ------------------------ MODAL ------------------------- --}}
                  {{-- ------------------------ MODAL ------------------------- --}}
                  <div class="modal fade" id="deleteItemModal_{{$enquete->id}}"
                        tabIndex="-1" role="dialog" aria-hidden="true"
                  >
                        <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 600px">

                              <div class="modal-content">

                                    <div style="background: #b54c4c" class="modal-header">

                                          <h4 class="modal-title" id="modalLongTitle">Excluindo a Enquete: <strong>{{$enquete->title}}</strong></h4>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                          <h2 class="text-center">Tem certeza que deseja excluir esta Enquete?</h2>
                                    </div>
                                    <div class="modal-footer">

                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                          <button
                                                type="button"
                                                class="btn btn-danger"
                                                data-dismiss="modal"
                                                onclick="window.location=
                                                      '{{ route('enquete-destroy', $enquete->id) }}'
                                                "
                                          >Sim</button>
                                    </div>
                              </div>
                        </div>
                  </div>
                  @endforeach
            </tbody>
      </table>
@else
      <h4 class="text-center"> Nenhuma Enquete por enquanto. Adicione uma nova <a href="{{route('enquete-create')}}">Aqui</a>. </h4>
@endif
</div>

@endsection

@section('scripts')
      <script>
            // console.log('hello World!!')
      </script>
@endsection