@extends('layouts.app')

@section('title', 'Додати нового користувача')

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('users.index') }}">Користувачі</a></li>
  <li class="breadcrumb-item active" aria-current="page">Додати нового користувача</li>
@stop

@section('content')

   <div class="row">
     <div class="col-xl-6 mx-auto">
       <div class="card radius-10">
         <div class="card-body p-5">
              {{ Form::open(['route' => 'users.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'row g-3 needs-validation', 'novalidate' => true, 'oninput' => '\'confirmPassword.setCustomValidity(confirmPassword.value != password.value ? true : false)\'']) }}
                <h5 class="mb-3 text-uppercase">Заповніть дані</h5>
                <div class="col-md-12">
                  {{ Form::label('user-name', 'Позивний', ['class' => 'form-label']) }}
                  {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'user-name', 'placeholder' => 'Горинич', 'autocomplete' => 'off', 'required' => true]) }}
                  <div class="invalid-feedback">Вкажіть позивний.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-12">
                    {{ Form::label('user-email', 'Електронна пошта', ['class' => 'form-label']) }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'user-email', 'placeholder' => 'example@gmail.com', 'autocomplete' => 'off', 'required' => true]) }}
                    <div class="invalid-feedback">Вкажіть електронну пошту.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-12">
                    {{ Form::label('password', 'Пароль', ['class' => 'form-label']) }}
                    {{ Form::input('password', 'password', null, ['class' => 'form-control', 'id' => 'password', 'pattern' => '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}', 'autocomplete' => 'off', 'required' => true]) }}
                    <div class="invalid-feedback">Пароль має містити принаймні одну цифру, одну велику та малу літеру та принаймні 8 або більше символів.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-12">
                    {{ Form::label('confirmPassword', 'Підтвердіть пароль', ['class' => 'form-label']) }}
                    {{ Form::input('password', 'confirmPassword', null, ['class' => 'form-control', 'id' => 'confirmPassword', 'autocomplete' => 'off', 'required' => true]) }}
                    <div class="invalid-feedback">Паролі не співпадають.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                </div>

                <div class="col-md-12">
                  {{ Form::label('user-role', 'Звання', ['class' => 'form-label']) }}
                  {{ Form::select('role', ['' => '','agent' => 'Агент', 'officer' => 'Офісер'], null, ['class' => 'single-select', 'required' => true]) }}
                  <div class="invalid-feedback">Необхідно зробити вибір.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-2">

               <div class="col-12">
                {{ Form::submit('Додати користувача', ['class' => 'btn btn-primary']) }}
               </div>

              {{ Form::close() }}
         </div>
       </div>

     </div>
   </div>
   <!--end row-->

@stop