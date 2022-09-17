@extends('layouts.app')

@section('title', "Редагувати обʼєкт: ID $delta->id")

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('delta.index') }}">Список обʼєктів</a></li>
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('delta.show', $delta->id) }}">Обʼєкт: ID {{ $delta->id }}</a></li>
  <li class="breadcrumb-item active" aria-current="page">Редагувати</li>
@stop

@section('content')

   <div class="row">
     <div class="col-xl-12 mx-auto">
       <h6 class="mb-0 text-uppercase">Внесіть необхідні правки</h6>
       <hr/>
       <div class="card">
         <div class="card-body">
           <div class="p-4 border rounded">
                {{ Form::open(['route' => ['delta.update', $delta->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                    <div class="col-md-4">
                      {{ Form::label('delta-location', 'Локація', ['class' => 'form-label']) }}
                      {{ Form::text('location', $delta->location, ['class' => 'form-control', 'id' => 'delta-location', 'placeholder' => 'Місто, область', 'required' => true]) }}
                      <div class="invalid-feedback">Вкажіть локацію.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-4">
                      {{ Form::label('direction_id', 'Напрямок', ['class' => 'form-label']) }}
                      {{ Form::select('direction_id', Delta::getFormData('directions'), $delta->direction_id, ['class' => 'single-select', 'required' => true]) }}
                      <div class="invalid-feedback">Необхідно зробити вибір.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-2">
                      {{ Form::label('delta-date', 'Дата', ['class' => 'form-label']) }}
                      {{ Form::date('date', $delta->date, ['class' => 'form-control', 'id' => 'delta-date', 'required' => true]) }}
                      <div class="invalid-feedback">Виберіть дату.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-2">
                      {{ Form::label('delta-time', 'Час', ['class' => 'form-label']) }}
                      {{ Form::time('time', $delta->time, ['class' => 'form-control', 'id' => 'delta-time', 'required' => true]) }}
                      <div class="invalid-feedback">Виберіть час.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-8">
                      {{ Form::label('delta-content', 'Опис', ['class' => 'form-label']) }}
                      {{ Form::textarea('content', $delta->content, ['class' => 'form-control', 'id' => 'delta-content', 'placeholder' => 'Детальний опис обʼєкта"', 'required' => true, 'minlength' => 80, 'rows' => 5]) }}
                      <div class="invalid-feedback">Опишіть обʼєкт (мінімум 80 символів).</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-2">
                      {{ Form::label('delta-civil-yes', 'Чи присутні цивільні?', ['class' => 'form-label']) }}
                      <div class="form-check">
                        {{ Form::radio('civil', 1, ($delta->civil), ['class' => 'form-check-input', 'id' => 'delta-civil-yes', 'required' => true]) }}
                        {{ Form::label('delta-civil-yes', 'Так', ['class' => 'form-check-label']) }}
                      </div>
                      <div class="form-check mb-3">
                        {{ Form::radio('civil', 0, (!$delta->civil), ['class' => 'form-check-input', 'id' => 'delta-civil-no', 'required' => true]) }}
                        {{ Form::label('delta-civil-no', 'Ні', ['class' => 'form-check-label']) }}
                        <div class="invalid-feedback">Необхідно зробити вибір.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                    </div>
                    <div class="col-2">
                      {{ Form::label('delta-correction-yes', 'Чи можливе коригування?', ['class' => 'form-label']) }}
                      <div class="form-check">
                        {{ Form::radio('correction', 1, ($delta->correction), ['class' => 'form-check-input', 'id' => 'delta-correction-yes', 'required' => true]) }}
                        {{ Form::label('delta-correction-yes', 'Так', ['class' => 'form-check-label']) }}
                      </div>
                      <div class="form-check mb-3">
                        {{ Form::radio('correction', 0, (!$delta->correction), ['class' => 'form-check-input', 'id' => 'delta-correction-no', 'required' => true]) }}
                        {{ Form::label('delta-correction-no', 'Ні', ['class' => 'form-check-label']) }}
                        <div class="invalid-feedback">Необхідно зробити вибір.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      {{ Form::label('reliability', 'Надійність', ['class' => 'form-label']) }}
                      {{ Form::select('reliability', Delta::getFormData('reliability'), $delta->reliability, ['class' => 'single-select', 'required' => true]) }}
                      <div class="invalid-feedback">Необхідно зробити вибір.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                   </div>
                   <div class="col-md-4">
                      {{ Form::label('specific', 'Уточнення', ['class' => 'form-label']) }}
                      {{ Form::select('specific', Delta::getFormData('specific'), $delta->specific, ['class' => 'single-select', 'required' => true]) }}
                      <div class="invalid-feedback">Необхідно зробити вибір.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-4">
                      {{ Form::label('source_id', 'Джерело', ['class' => 'form-label']) }}
                      {{ Form::select('source_id', Delta::getFormData('sources'), $delta->source_id, ['class' => 'single-select', 'required' => true]) }}
                      <div class="invalid-feedback">Необхідно зробити вибір.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>

                    <div class="col-12">
                        <h4 class="mb-0">Координати</h4>
                        <hr/>
                        <div class="row gy-3">
                            <div class="col-md-3">
                              <input id="coordinates-long" type="text" class="form-control" value="" placeholder="Довжина">
                            </div>
                            <div class="col-md-3">
                                <input id="coordinates-lang" type="text" class="form-control" value="" placeholder="Широта">
                              </div>
                              <div class="col-md-4">
                                <input id="coordinates-desk" type="text" class="form-control" value="" placeholder="Коментар">
                              </div>
                            <div class="col-md-2 text-end d-grid">
                              <button type="button" onclick="CreateCoor();" class="btn btn-dark">Додати</button>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-12">
                              <div id="coor-container"></div>
                              @foreach (json_decode($delta->coordinates) as $id => $coordinates)
                                <div class="pb-3 coor-item" coor-id="{{ $id }}">
                                    <div class="input-group">
                                        <input type="text" readonly class="form-control" name="coordinates[{{ $id }}][long][]" value="{{ $coordinates->long[0] }}">
                                        <input type="text" readonly class="form-control" name="coordinates[{{ $id }}][lang][]" value="{{ $coordinates->lang[0] }}">
                                        <input type="text" readonly class="form-control" name="coordinates[{{ $id }}][desk][]" value="{{ $coordinates->desk[0] }}">
                                        
                                        <button coor-id="{{ $id }}" class="btn btn-outline-secondary bg-danger text-white" type="button" onclick="DeleteCoor(this);" id="button-addon2 ">X</button>
                                    </div>
                                </div>
                              @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        {{ Form::submit('Редагувати обʼєкт', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
           </div>
         </div>
       </div>

     </div>
   </div>
   <!--end row-->


@stop