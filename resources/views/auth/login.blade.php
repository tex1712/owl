@extends('layouts.login')

@section('title', 'Вхід в панель керування')

@section('content')
    <div class="row g-0 m-0">
        <div class="col-xl-6 col-lg-12">
        <div class="login-cover-wrapper">
            <div class="card shadow-none">
            <div class="card-body">
                <div class="text-center">
                <h4>Увійти</h4>
                <p>Увійдіть у свій обліковий запис</p>
                </div>
                {{ Form::open(['route' => 'authenticate', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-body row g-3', 'novalidate' => true]) }}

                    <div class="col-12">
                        {{ Form::label('inputEmail', 'Елетрона пошта', ['class' => 'form-label']) }}
                        {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'inputEmail', 'required' => true]) }}
                        @if($errors->has('email'))
                            <div class="error text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="col-12">
                        {{ Form::label('inputPassword', 'Пароль', ['class' => 'form-label']) }}
                        {{ Form::input('password', 'password', null, ['class' => 'form-control', 'id' => 'inputPassword', 'required' => true]) }}
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRemember">
                        <label class="form-check-label" for="flexSwitchCheckRemember">Запам'ятати мене</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 text-end">
                        <a href="javascript:;">Забули пароль?</a>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="d-grid">
                            {{ Form::submit('Увійти', ['class' => 'btn btn-dark']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            </div>
        </div>
        </div>
        <div class="col-xl-6 col-lg-12">
        <div class="position-fixed top-0 h-100 d-xl-block d-none login-cover-img">
        </div>
        </div>
    </div>

@stop