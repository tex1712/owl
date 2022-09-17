@extends('layouts.app')

@section('title', 'Список обʼєктів')

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Список обʼєктів</li>
@stop

@section('controls')
    <a href="{{ route('delta.create') }}"><button type="button" class="btn btn-success px-3">+ Додати</button> </a>
@stop

@section('content')
    {{-- <h6 class="mb-0 text-uppercase">DataTable Import</h6>
    <hr/> --}}
    <div class="card">
        <div class="card-body">

            <div>
                <table id="delta-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Локація</th>
                            <th>Напрямок</th>
                            <th>Дата</th>
                            <th>Надійність</th>
                            <th>Опис</th>
                            <th>Уточнення</th>
                            <th>Цивільні</th>
                            <th>Коригування</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deltas as $delta)
                            <tr>
                                <td>{{ $delta->id }}</td>
                                <td><a href="{{ route('delta.show', $delta->id) }}">{{ $delta->location }}</a></td>
                                <td>{{ $delta->direction->title }}</td>
                                <td>{{ $delta->date }}</td>
                                <td>{{ strtoupper($delta->reliability) }}</td>
                                <td>{{ $delta->content }}</td>
                                <td>
                                    @if($delta->specific == 'p')
                                    Можливе
                                    @elseif($delta->specific == 'i')
                                    Неможливе
                                    @elseif($delta->specific == 'd')
                                    Ускладнене
                                    @endif
                                </td>
                                <td>
                                    @if($delta->civil == 1)
                                    Так
                                    @else
                                    Ні
                                    @endif
                                </td>
                                <td>
                                    @if($delta->correction == 1)
                                    Так
                                    @else
                                    Ні
                                    @endif
                                </td>
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
                            <th>Уточнення</th>
                            <th>Цивільні</th>
                            <th>Коригування</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop



