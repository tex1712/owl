@extends('layouts.app')

@section('title', 'Список користувачів')

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page">Список користувачів</li>
@stop

@section('controls')
    <a href="{{ route('users.create') }}"><button type="button" class="btn btn-success px-3">+ Додати</button> </a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div>
                <table id="users-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Позивний</th>
                            <th>Звання</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></td>
                                <td>
                                    @if($user->role == 'agent')
                                        Агент
                                    @elseif($user->role == 'officer')
                                        Офісер
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Позивний</th>
                            <th>Звання</th>
                            <th>Email</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop



