@extends('layouts.app')

@section('title', "Дивитись обʼєкт: ID $delta->id")

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('delta.index') }}">Список обʼєктів</a></li>
  <li class="breadcrumb-item active" aria-current="page">Обʼєкт: ID {{ $delta->id }}</li>
@stop

@section('controls')
    <a href="{{ route('delta.create') }}" class="me-2"><button type="button" class="btn btn-success px-3">+ Додати</button> </a>
    <a href="{{ route('delta.edit', $delta->id) }}" class="me-2"><button type="button" class="btn btn-warning px-3"><ion-icon name="pencil"></ion-icon> Редагувати</button> </a>
    <a href="javascript:;" id="delta_{{ $delta->id }}" class="delete-item"><button type="button" class="btn btn-danger px-3"><ion-icon name="trash"></ion-icon> Видалити</button></a>
    {{ Form::open(['url' => route('delta.destroy', $delta->id), 'method' => 'DELETE', 'class' => 'delete-form', 'id' => 'delete_'.'delta_'.$delta->id ]) }}
    {{ Form::close() }}
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="toolbox d-flex flex-row align-items-center gap-2">
                        <div class="d-flex flex-wrap flex-grow-1 gap-1">
                            <div class="d-flex align-items-center flex-nowrap">
                                <p class="mb-0 text-nowrap">Агент: <span><b>{{ $delta->agent->name }}</b></span></p>
                                <p class="mb-0 ms-3 text-nowrap">Офіцер: <span><b>{{ $delta->officer->name }}</b></span></p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="d-flex align-items-center flex-nowrap">
                                <p class="mb-0 text-nowrap">
                                    @if($delta->result)
                                        <span class="badge bg-success">Відпрацьовано</span>
                                    @else
                                        <span class="badge bg-danger">Не відпрацьовано</span>
                                    @endif
                                </p>
                                <p class="mb-0 ms-3 text-nowrap">
                                    @if($delta->status)
                                        <span class="badge bg-success">В роботі</span>
                                    @else
                                        <span class="badge bg-danger">Не в роботі</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                <h4 class="mb-2">Опис</h4>
                    <p>{{ $delta->content }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Основні відомості</h5>

                    <h6 class="mb-0">Напрямок:</h6>
                    <p class="mb-3"><i class="fa-sharp fa-solid fa-diamond-turn-right me-2"></i>{{ $delta->direction->title }}</p>
                    <h6 class="mb-0">Населений пункт:</h6>
                    <p class="mb-3"><ion-icon name="compass-sharp" class="me-2"></ion-icon>{{ $delta->location }}</p>
                    <h6 class="mb-0">Координати:</h6>
                    <ul class="mb-3 ps-0 list-group-flush">
                        @foreach (json_decode($delta->coordinates) as $coordinates)
                            <li class="ps-0 list-group-item"><i class="fa-solid fa-location-dot me-2"></i><a href class="copy-to-clipboard" data-bs-toggle="tooltip" data-bs-placement="top" title="Копіювати в буфер обміну">{{ $coordinates->long[0] }}</a> | <a href class="copy-to-clipboard" data-bs-toggle="tooltip" data-bs-placement="top" title="Копіювати в буфер обміну">{{ $coordinates->lang[0] }}</a> @if($coordinates->desk[0])<span>- {{ $coordinates->desk[0] }}</span> @endif </li>
                        @endforeach
                    </ul>
                    @if(!$delta->tags->isEmpty())
                        <h6 class="mb-0">Теги:</h6>
                        <p class="mb-3"><i class="fa-solid fa-tags me-2"></i>
                            @foreach ($delta->tags as $tag)
                                <span>{{ $tag->name }}@if(!$loop->last), @endif</span>
                            @endforeach
                        </p>
                    @endif
                    <h6 class="mb-0">Дата:</h6>
                    <p class="mb-3"><ion-icon name="calendar" class="me-2"></ion-icon>{{ $delta->date }}</p>
                    <h6 class="mb-0">Час:</h6>
                    <p class="mb-3"><ion-icon name="timer" class="me-2"></ion-icon>{{ $delta->time }}</p>
                </div>
            </div>

            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Деталі</h5>
                    <p>Чи присутні цивільні? <span class="float-end">@if($delta->civil) Так @else Ні @endif</span></p>
                    <hr/>
                    <p>Чи можливе коригування? <span class="float-end">@if($delta->correction) Так @else Ні @endif</span></p>
                    <hr/>
                    <p>Надійність: <span class="float-end">{{ strtoupper($delta->reliability) }}</span></p>
                    <hr/>
                    <p>Уточнення: <span class="float-end">
                        @if($delta->specific == 'p')
                        Можливе
                        @elseif($delta->specific == 'i')
                        Неможливе
                        @elseif($delta->specific == 'd')
                        Ускладнене
                        @endif
                    </span></p>
                    <hr/>
                    <p>Джерело: <span class="float-end">{{ $delta->source->name }}</span></p>
                </div>
            </div>
        </div>
    </div><!--end row-->

@stop