@extends('layouts.app')

@section('title', 'Список обʼєктів')

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Список обʼєктів</li>
@stop

@can('agent')
    @section('controls')
        <a href="{{ route('target.create') }}"><button type="button" class="btn btn-success px-3">+ Додати</button> </a>
    @stop
@endcan

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="card-body"> 
                <div class="col-12">
                    {{ Form::open(['route' => 'target.index', 'method' => 'GET', 'enctype' => 'multipart/form-data', 'class' => 'row g-3', 'novalidate' => true]) }}
                        @can('admin')
                            <div class="col-12 col-lg">
                                {{ Form::label('filter-officer_id', 'Офіцер', ['class' => 'form-label']) }}
                                {{ Form::select('officer_id', Users::getOfficersList(), Request::query('officer_id'), ['id' => 'choose-officer-ajax', 'class' => (Request::filled('officer_id')) ? 'single-select' : 'single-select-empty']) }}
                            </div>
                        @endcan
                        @can('officer')
                            <div class="col-12 col-lg">
                                {{ Form::label('filter-agent_id', 'Агент', ['class' => 'form-label']) }}
                                @if(Auth::user()->role == 'admin')
                                    {{ Form::select('agent_id', Users::getAgentsListByOfficerId(Request::query('officer_id')), Request::query('agent_id'), ['id' => 'choose-agent-ajax', 'class' => (Request::filled('agent_id')) ? 'single-select' : 'single-select-empty']) }}
                                @else
                                    {{ Form::select('agent_id', Users::getAgentsListByOfficerId(Auth::id()), Request::query('agent_id'), ['id' => 'choose-agent-ajax', 'class' => (Request::filled('agent_id')) ? 'single-select' : 'single-select-empty']) }}
                                @endif
                            </div>
                        @endcan
                        <div class="col-12 col-lg">
                            {{ Form::label('filter-source_id', 'Джерело', ['class' => 'form-label']) }}
                            @if(Auth::user()->role == 'agent')
                                {{ Form::select('source_id', Sources::getByAgentId(Auth::id()), Request::query('source_id'), ['id' => 'choose-source-ajax', 'class' => (Request::filled('source_id')) ? 'single-select' : 'single-select-empty']) }}
                            @else
                                {{ Form::select('source_id', Sources::getByAgentId(Request::query('agent_id')), Request::query('source_id'), ['id' => 'choose-source-ajax', 'class' => (Request::filled('source_id')) ? 'single-select' : 'single-select-empty']) }}
                            @endif
                        </div>
                        <div class="col-12 col-lg">
                            {{ Form::label('filter-agent_id', 'В роботі', ['class' => 'form-label']) }}
                            {{ Form::select('status', [1 => 'Так', 0 => 'Ні'], Request::query('status'), ['class' => (Request::filled('status')) ? 'single-select' : 'single-select-empty']) }}
                        </div>
                        <div class="col-12 col-lg">
                            {{ Form::label('tags', 'Теги', ['class' => 'form-label']) }}
                            {{ Form::select('tags[]', Targets::getAllTags(), Request::query('tags'), ['multiple' => 'multiple', 'class' => 'multiple-select']) }}
                        </div>
                        <div class="col-12 col-lg">
                            <br>
                            {{ Form::submit('Фільтр', ['class' => 'btn btn-dark w-100 mt-2']) }}
                        </div>
                    {{ Form::close() }}
                </div>
                @if(!empty(array_filter(Request::all())) || Request::filled('status') || Request::filled('result'))
                    <div class="col-12 col-lg mt-3 d-md-flex align-items-center">
                        <p class="align-middle mb-0 mt-2">
                            @can('admin')
                                @if(Request::filled('officer_id'))
                                    <span class="me-2">Офіцер: <span class="badge rounded-pill bg-secondary">{{ Users::getNameById(Request::query('officer_id')) }}</span></span>
                                @endif
                            @endcan
                            @can('officer')
                                @if(Request::filled('agent_id'))
                                    <span class="me-2">Агент: <span class="badge rounded-pill bg-secondary">{{ Users::getNameById(Request::query('agent_id')) }}</span></span>
                                @endif
                            @endcan
                            @if(Request::filled('source_id'))
                                <span class="me-2">Джерело: <span class="badge rounded-pill bg-secondary">{{ Sources::getNameById(Request::query('source_id')) }}</span></span>
                            @endif
                            @if(Request::filled('status'))
                                <span class="me-2">В роботі: <span class="badge rounded-pill bg-secondary">{{ (Request::query('status')) ? 'Так' : 'Ні' }}</span></span>
                            @endif
                            @if(Request::filled('result'))
                                <span class="me-2">Відпрацьований: <span class="badge rounded-pill bg-secondary">{{ (Request::query('result')) ? 'Так' : 'Ні' }}</span></span>
                            @endif
                            @if(Request::filled('tags'))
                                <span class="me-2">Теги: 
                                    @foreach (Request::query('tags') as $tag)
                                        <span class="badge rounded-pill bg-secondary">{{ $tag }}</span>
                                    @endforeach
                                </span>
                            @endif
                        </p>
                        <a href="{{ route('target.index') }}" class="btn btn-sm btn-danger mt-2">Очистити</a>
                    </div>
                @endif
            </div>
        </div> <!--end row-->
        <hr>
        <div class="table table-responsive ps-1 pe-1">
            <table id="targets-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Локація</th>
                        <th>Напрямок</th>
                        <th>Дата</th>
                        <th>Надійність</th>
                        <th>Опис</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($targets as $target)
                        <tr>
                            <td>{{ $target->id }}</td>
                            <td class="table-middle-text table-text" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $target->location }}"><a href="{{ route('target.show', $target->id) }}">{{ $target->location }}</a></td>
                            <td>{{ $target->direction->title }}</td>
                            <td>{{ $target->date }}</td>
                            <td>{{ strtoupper($target->reliability) }}</td>
                            <td class="table-long-text table-text" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $target->content }}">{{ $target->content }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Локація</th>
                        <th>Напрямок</th>
                        <th>Дата</th>
                        <th>Надійність</th>
                        <th>Опис</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@stop



