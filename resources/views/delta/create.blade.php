@extends('layouts.app')

@section('title', 'Додати новий обʼєкт')

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('delta.index') }}">Список обʼєктів</a></li>
  <li class="breadcrumb-item active" aria-current="page">Додати новий</li>
@stop

@section('content')

   <div class="row">
     <div class="col-xl-12 mx-auto">
       <h6 class="mb-0 text-uppercase">Заповніть дані</h6>
       <hr/>
       <div class="card">
         <div class="card-body">
           <div class="p-4 border rounded">
              {{ Form::open(['route' => 'delta.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                <div class="col-md-4">
                  {{ Form::label('delta-location', 'Локація', ['class' => 'form-label']) }}
                  {{ Form::text('location', null, ['class' => 'form-control', 'id' => 'delta-location', 'placeholder' => 'Місто, область', 'required' => true]) }}
                  <div class="invalid-feedback">Вкажіть локацію.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-4">
                  {{ Form::label('direction_id', 'Напрямок', ['class' => 'form-label']) }}
                  {{ Form::select('direction_id', Delta::getFormData('directions'), null, ['class' => 'single-select-empty', 'required' => true]) }}
                  <div class="invalid-feedback">Необхідно зробити вибір.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-2">
                  {{ Form::label('delta-date', 'Дата', ['class' => 'form-label']) }}
                  {{ Form::date('date', null, ['class' => 'form-control', 'id' => 'delta-date', 'required' => true]) }}
                  <div class="invalid-feedback">Виберіть дату.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-2">
                  {{ Form::label('delta-time', 'Час', ['class' => 'form-label']) }}
                  {{ Form::time('time', null, ['class' => 'form-control', 'id' => 'delta-time', 'required' => true]) }}
                  <div class="invalid-feedback">Виберіть час.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-8">
                  {{ Form::label('delta-content', 'Опис', ['class' => 'form-label']) }}
                  {{ Form::textarea('content', null, ['class' => 'form-control', 'id' => 'delta-content', 'placeholder' => 'Детальний опис обʼєкта"', 'required' => true, 'minlength' => 80, 'rows' => 5]) }}
                  <div class="invalid-feedback">Опишіть обʼєкт (мінімум 80 символів).</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-2">
                  {{ Form::label('delta-civil-yes', 'Чи присутні цивільні?', ['class' => 'form-label']) }}
                  <div class="form-check">
                    {{ Form::radio('civil', 1, false, ['class' => 'form-check-input', 'id' => 'delta-civil-yes', 'required' => true]) }}
                    {{ Form::label('delta-civil-yes', 'Так', ['class' => 'form-check-label']) }}
                  </div>
                  <div class="form-check mb-3">
                    {{ Form::radio('civil', 0, false, ['class' => 'form-check-input', 'id' => 'delta-civil-no', 'required' => true]) }}
                    {{ Form::label('delta-civil-no', 'Ні', ['class' => 'form-check-label']) }}
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>
                <div class="col-md-2">
                  {{ Form::label('delta-correction-yes', 'Чи можливе коригування?', ['class' => 'form-label']) }}
                  <div class="form-check">
                    {{ Form::radio('correction', 1, false, ['class' => 'form-check-input', 'id' => 'delta-correction-yes', 'required' => true]) }}
                    {{ Form::label('delta-correction-yes', 'Так', ['class' => 'form-check-label']) }}
                  </div>
                  <div class="form-check mb-3">
                    {{ Form::radio('correction', 0, false, ['class' => 'form-check-input', 'id' => 'delta-correction-no', 'required' => true]) }}
                    {{ Form::label('delta-correction-no', 'Ні', ['class' => 'form-check-label']) }}
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>
                <div class="col-md-4">
                  {{ Form::label('reliability', 'Надійність', ['class' => 'form-label']) }}
                  {{ Form::select('reliability', Delta::getFormData('reliability'), null, ['class' => 'single-select-empty', 'required' => true]) }}
                  <div class="invalid-feedback">Необхідно зробити вибір.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-4">
                  {{ Form::label('specific', 'Уточнення', ['class' => 'form-label']) }}
                  {{ Form::select('specific', Delta::getFormData('specific'), null, ['class' => 'single-select-empty', 'required' => true]) }}
                  <div class="invalid-feedback">Необхідно зробити вибір.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-4">
                  {{ Form::label('source_id', 'Джерело', ['class' => 'form-label']) }}
                  {{ Form::select('source_id', Delta::getFormData('sources'), null, ['class' => 'single-select-empty', 'required' => true]) }}
                  <div class="invalid-feedback">Необхідно зробити вибір.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-12">
                  {{ Form::label('tags', 'Теги', ['class' => 'form-label']) }}
                  {{ Form::select('tags[]', Delta::getFormData('tags'), null, ['class' => 'multiple-select-tags', 'multiple' => 'multiple']) }}
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>


                <h5 class="mb-0 mt-5">Статус | Користувачі</h5>
                <hr/>
                <div class="col-md-4">
                  {{ Form::label('agent_id', 'Агент', ['class' => 'form-label']) }}
                  {{ Form::select('agent_id', Delta::getFormData('agents'), Auth::id(), ['class' => 'single-select', 'required' => true]) }}
                  <div class="invalid-feedback">Необхідно зробити вибір.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-4">
                  {{ Form::label('officer_id', 'Офіцер', ['class' => 'form-label']) }}
                  {{ Form::select('officer_id', Delta::getFormData('officers'), 3, ['class' => 'single-select', 'required' => true]) }}
                  <div class="invalid-feedback">Необхідно зробити вибір.</div>
                  <div class="valid-feedback">Виглядає добре!</div>
                </div>
                <div class="col-md-2">
                  {{ Form::label('delta-result-yes', 'Обʼєкт відпрацьований?', ['class' => 'form-label']) }}
                  <div class="form-check">
                    {{ Form::radio('result', 1, false, ['class' => 'form-check-input', 'id' => 'delta-result-yes', 'required' => true]) }}
                    {{ Form::label('delta-result-yes', 'Так', ['class' => 'form-check-label']) }}
                  </div>
                  <div class="form-check mb-3">
                    {{ Form::radio('result', 0, true, ['class' => 'form-check-input', 'id' => 'delta-result-no', 'required' => true]) }}
                    {{ Form::label('delta-result-no', 'Ні', ['class' => 'form-check-label']) }}
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>
                <div class="col-md-2">
                  {{ Form::label('delta-status-yes', 'Обʼєкт в роботі?', ['class' => 'form-label']) }}
                  <div class="form-check">
                    {{ Form::radio('status', 1, false, ['class' => 'form-check-input', 'id' => 'delta-status-yes', 'required' => true]) }}
                    {{ Form::label('delta-status-yes', 'Так', ['class' => 'form-check-label']) }}
                  </div>
                  <div class="form-check mb-3">
                    {{ Form::radio('status', 0, true, ['class' => 'form-check-input', 'id' => 'delta-status-no', 'required' => true]) }}
                    {{ Form::label('delta-status-no', 'Ні', ['class' => 'form-check-label']) }}
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>


                <div class="col-12">
                    <h5 class="mb-0">Координати</h5>
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
                        </div>
                      </div>
                </div>

               <div class="col-12">
                {{ Form::submit('Додати обʼєкт', ['class' => 'btn btn-primary']) }}
               </div>

              {{ Form::close() }}
           </div>
         </div>
       </div>

     </div>
   </div>
   <!--end row-->

@stop