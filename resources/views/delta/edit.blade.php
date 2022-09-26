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
                    <div class="col-md-6">
                      {{ Form::label('delta-content', 'Опис', ['class' => 'form-label']) }}
                      {{ Form::textarea('content', $delta->content, ['class' => 'form-control', 'id' => 'delta-content', 'placeholder' => 'Детальний опис обʼєкта"', 'required' => true, 'minlength' => 40, 'rows' => 5]) }}
                      <div class="invalid-feedback">Опишіть обʼєкт (мінімум 40 символів).</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-3">
                      {{ Form::label('reliability', 'Надійність', ['class' => 'form-label']) }}
                      {{ Form::select('reliability', Delta::getFormData('reliability'), $delta->reliability, ['class' => 'single-select', 'required' => true]) }}
                      <div class="invalid-feedback">Необхідно зробити вибір.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                   </div>
                    <div class="col-md-3">
                      {{ Form::label('source_id', 'Джерело', ['class' => 'form-label']) }}
                      {{ Form::select('source_id', Delta::getFormData('sources'), $delta->source_id, ['class' => 'single-select', 'required' => true]) }}
                      <div class="invalid-feedback">Необхідно зробити вибір.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <h5 class="mb-0 mt-5">Додатково</h5>
                    <hr/>
                    <div class="col-md-12">
                      {{ Form::label('tags', 'Теги', ['class' => 'form-label']) }}
                      {{ Form::select('tags[]', Delta::getFormData('tags'), Delta::getTags($delta->id), ['class' => 'multiple-select-tags', 'multiple' => 'multiple']) }}
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-4">
                      {{ Form::label('civil', 'Чи присутні цивільні?', ['class' => 'form-label']) }}
                      {{ Form::select('civil', [''=>'', 1 => 'Так', 0 => 'Ні'], $delta->civil, ['class' => 'single-select']) }}
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-4">
                      {{ Form::label('correction', 'Чи можливе коригування?', ['class' => 'form-label']) }}
                      {{ Form::select('correction', [''=>'', 1 => 'Так', 0 => 'Ні'], $delta->correction, ['class' => 'single-select']) }}
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                    <div class="col-md-4">
                      {{ Form::label('specific', 'Уточнення', ['class' => 'form-label']) }}
                      {{ Form::select('specific', Delta::getFormData('specific'), $delta->specific, ['class' => 'single-select']) }}
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>

                    @can('admin')
                      <h5 class="mb-0 mt-5">Користувачі</h5>
                      <hr/>
                      <div class="col-md-4">
                        {{ Form::label('agent_id', 'Агент', ['class' => 'form-label']) }}
                        {{ Form::select('agent_id', Delta::getFormData('agents'), $delta->agent_id, ['class' => 'single-select', 'required' => true]) }}
                        <div class="invalid-feedback">Необхідно зробити вибір.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                      <div class="col-md-4">
                        {{ Form::label('officer_id', 'Офіцер', ['class' => 'form-label']) }}
                        {{ Form::select('officer_id', Delta::getFormData('officers'), $delta->officer_id, ['class' => 'single-select', 'required' => true]) }}
                        <div class="invalid-feedback">Необхідно зробити вибір.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                    @endcan

                    <div class="col-12">
                        <h4 class="mb-0 mt-5">Координати</h4>
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
                                @if(!is_null(json_decode($delta->coordinates)))
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
                                @endif
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