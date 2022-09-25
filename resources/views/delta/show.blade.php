@extends('layouts.app')

@section('title', "Дивитись обʼєкт: ID $delta->id")

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('delta.index') }}">Список обʼєктів</a></li>
  <li class="breadcrumb-item active" aria-current="page">Обʼєкт: ID {{ $delta->id }}</li>
@stop

@can('agent')
    @section('controls')
        <a href="{{ route('delta.create') }}" class="me-2"><button type="button" class="btn btn-success px-3">+ Додати</button> </a>
        <a href="{{ route('delta.edit', $delta->id) }}" class="me-2"><button type="button" class="btn btn-warning px-3"><ion-icon name="pencil"></ion-icon> Редагувати</button> </a>
        <a href="javascript:;" id="delta_{{ $delta->id }}" class="delete-item"><button type="button" class="btn btn-danger px-3"><ion-icon name="trash"></ion-icon> Видалити</button></a>
        {{ Form::open(['url' => route('delta.destroy', $delta->id), 'method' => 'DELETE', 'class' => 'delete-form', 'id' => 'delete_'.'delta_'.$delta->id ]) }}
        {{ Form::close() }}
    @stop
@endcan

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
                <h4 class="mb-2 float-start">Основні відомості</h4>
                <button class="btn-copy btn btn-dark float-end">Копіювати</button> <br>
            
                <div class="clearfix"></div>
<p class="content-copy">
<span>
UF-112<br>
A<br>
{{ strtoupper($delta->reliability) }}<br>
{{ Carbon\Carbon::parse($delta->time)->format('H.i') }} {{ Carbon\Carbon::parse($delta->date)->format('d.m.Y') }}<br>
{{ $delta->location }}<br>
<br>
{!! nl2br($delta->content) !!}<br>
<br>
@if($delta->specific)
Уточнення: @if($delta->specific == 'p') Можливе @elseif($delta->specific == 'i') Неможливе @elseif($delta->specific == 'd') Ускладнене @endif <br>
@endif
@if($delta->civil != null)
Цивільні: @if($delta->civil) Так @else Ні @endif <br>
@endif
@if($delta->correction != null)
Коригування: @if($delta->correction) Так @else Ні @endif <br>
@endif
</span>
</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10">
                <div class="card-body">
                    <h5 class="mb-3">Деталі</h5>
                    <h6 class="mb-0">Напрямок:</h6>
                    <p class="mb-3"><i class="fa-sharp fa-solid fa-diamond-turn-right me-2"></i>{{ $delta->direction->title }}</p>
                    @if(!is_null(json_decode($delta->coordinates)))
                        <h6 class="mb-0">Координати:</h6>
                        <ul class="mb-3 ps-0 list-group-flush">
                            @foreach (json_decode($delta->coordinates) as $coordinates)
                                <li class="ps-0 list-group-item"><i class="fa-solid fa-location-dot me-2"></i><a href class="copy-to-clipboard" data-bs-toggle="tooltip" data-bs-placement="top" title="Копіювати в буфер обміну">{{ $coordinates->long[0] }}</a> | <a href class="copy-to-clipboard" data-bs-toggle="tooltip" data-bs-placement="top" title="Копіювати в буфер обміну">{{ $coordinates->lang[0] }}</a> @if($coordinates->desk[0])<span>- {{ $coordinates->desk[0] }}</span> @endif </li>
                            @endforeach
                        </ul>
                    @endif
                    @if(!$delta->tags->isEmpty())
                        <h6 class="mb-0">Теги:</h6>
                        <p class="mb-3"><i class="fa-solid fa-tags me-2"></i>
                            @foreach ($delta->tags as $tag)
                                <span>{{ $tag->name }}@if(!$loop->last), @endif</span>
                            @endforeach
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div><!--end row-->

@stop