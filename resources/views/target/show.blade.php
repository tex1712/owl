@extends('layouts.app')

@section('title', "Дивитись обʼєкт: ID $target->id")

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('target.index') }}">Список обʼєктів</a></li>
  <li class="breadcrumb-item active" aria-current="page">Обʼєкт: ID {{ $target->id }}</li>
@stop

@section('controls')
    <a href="{{ route('target.create') }}" class="me-2"><button type="button" class="btn btn-success px-3">+ Додати</button> </a>
    <a href="{{ route('target.edit', $target->id) }}" class="me-2"><button type="button" class="btn btn-warning px-3"><ion-icon name="pencil"></ion-icon> Редагувати</button> </a>
    <a href="javascript:;" id="target_{{ $target->id }}" class="delete-item"><button type="button" class="btn btn-danger px-3"><ion-icon name="trash"></ion-icon> Видалити</button></a>
    {{ Form::open(['url' => route('target.destroy', $target->id), 'method' => 'DELETE', 'class' => 'delete-form', 'id' => 'delete_'.'target_'.$target->id ]) }}
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
                                <p class="mb-0 me-3 text-nowrap">Офіцер: <span><b>{{ $target->officer->name }}</b></span></p>
                                <p class="mb-0 text-nowrap">Агент: <span><b>{{ $target->agent->name }}</b></span></p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="target-status-switcher" data-id="{{ $target->id }}" @if($target->status) checked @endif>
                                    <label class="form-check-label" for="target-status-switcher">Статус "В проботі"</label>
                                  </div>
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
{{ Str::upper($target->reliability) }}<br>
{{ Carbon\Carbon::parse($target->time)->format('H.i') }} {{ Carbon\Carbon::parse($target->date)->format('d.m.Y') }}<br>
{{ Str::upper($target->location) }}, {{ $target->direction->title }}<br>
<br>
@if(!empty(Targets::getCoordinates($target->id)))
За координатами:
@endif
@foreach (Targets::getCoordinates($target->id) as $coordinates)
<span class="d-block">{{ nl2br($coordinates) }}</span>
@endforeach
<br>
@if($target->content)
{!! nl2br($target->content) !!}<br>
<br>
@endif
@if($target->specific)
Уточнення: @if($target->specific == 'p') Можливе @elseif($target->specific == 'i') Неможливе @elseif($target->specific == 'd') Ускладнене @endif <br>
@endif
@if($target->civil != null)
Цивільні: @if($target->civil) Так @else Ні @endif <br>
@endif
@if($target->correction != null)
Коригування: @if($target->correction) Так @else Ні @endif <br>
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
                    <p class="mb-3"><i class="fa-sharp fa-solid fa-diamond-turn-right me-2"></i>{{ $target->direction->title }}</p>
                    @if(!$target->tags->isEmpty())
                        <h6 class="mb-0">Теги:</h6>
                        <p class="mb-3"><i class="fa-solid fa-tags me-2"></i>
                            @foreach ($target->tags as $tag)
                                <span>{{ $tag->name }}@if(!$loop->last), @endif</span>
                            @endforeach
                        </p>
                    @endif
                    <h6 class="mb-0">Джерело:</h6>
                    <p class="mb-3"><i class="fa-solid fa-user me-2"></i>{{ $target->source->name }}</p>
                </div>
            </div>
        </div>
    </div><!--end row-->

@stop