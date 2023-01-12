@extends('layouts.app')

@section('title', 'Додати новий обʼєкт')

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('target.index') }}">Список обʼєктів</a></li>
  <li class="breadcrumb-item active" aria-current="page">Додати новий</li>
@stop

@section('content')
   <div class="row target-form">
     <div class="col-xl-12 mx-auto">
       <h6 class="mb-0 text-uppercase">Заповніть дані</h6>
       <hr/>
       <div class="card">
         <div class="card-body">
           <div class="p-4 border rounded">
              {{ Form::open(['route' => 'target.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                
              @can('officer')
                <h5 class="mb-0 mt-5">Користувачі</h5>
                <hr/>
                <div class="row pe-0">
                  @can('admin')
                    <div class="col-md-4 mt-3">
                      {{ Form::label('officer_id', 'Офіцер', ['class' => 'form-label']) }}
                      {{ Form::select('officer_id', Users::getOfficersList(), null, ['id' => 'choose-officer-ajax', 'class' => 'single-select-empty-search', 'required' => true]) }}
                      <div class="invalid-feedback">Необхідно зробити вибір.</div>
                      <div class="valid-feedback">Виглядає добре!</div>
                    </div>
                  @endcan
                  <div class="col-md-4 mt-3">
                    {{ Form::label('agent_id', 'Агент', ['class' => 'form-label']) }}
                    {{ Form::select('agent_id', Users::getAgentsListByOfficerId(Auth::id()), null, ['id' => 'choose-agent-ajax', 'class' => 'single-select-empty-search', 'required' => true]) }}
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>
              @endcan              
              
              <h5 class="mb-0 mt-5">Основні дані</h5>
              <hr/>
              <div class="row pe-0">
                  <div class="col-md-4 mt-3">
                    {{ Form::label('target-location', 'Локація', ['class' => 'form-label']) }}
                    {{ Form::text('location', null, ['class' => 'form-control', 'id' => 'target-location', 'placeholder' => 'Місто, область', 'required' => true]) }}
                    <div class="invalid-feedback">Вкажіть локацію.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                  <div class="col-md-4 mt-3">
                    {{ Form::label('direction_id', 'Напрямок', ['class' => 'form-label']) }}
                    {{ Form::select('direction_id', Directions::getAll(), null, ['class' => 'single-select-empty', 'required' => true]) }}
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                  <div class="col-md-2 mt-3">
                    {{ Form::label('target-date', 'Дата', ['class' => 'form-label']) }}
                    {{ Form::date('date', null, ['class' => 'form-control', 'id' => 'target-date', 'required' => true]) }}
                    <div class="invalid-feedback">Виберіть дату.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                  <div class="col-md-2 mt-3">
                    {{ Form::label('target-time', 'Час', ['class' => 'form-label']) }}
                    {{ Form::time('time', null, ['class' => 'form-control', 'id' => 'target-time', 'required' => true]) }}
                    <div class="invalid-feedback">Виберіть час.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>


                <div class="row pe-0">
                  <div class="col-md-4 mt-3">
                    <label for="coorditates-type-choose" class="form-label">Координати обʼєкта/обʼєктів</label>
                    <select id="coorditates-type-choose" class="single-select-not-clear">
                      <option value="point">Точка координат</option>
                      <option value="square">Квадрат</option>
                    </select>
                  </div>
                  <div class="col-md-4 mt-3 d-flex align-items-end">
                    <button type="button" class="btn btn-success d-block btn-coordinates-block-add w-100">Додати поле координат</button>
                  </div>
                </div>

                <div id="coordinates-wrap"></div>
                <input type="text" name="coordinates" id="send-coordinates" class="d-none">
                

                <div class="row pe-0">
                  <div class="col-md-6 mt-3">
                    {{ Form::label('target-content', 'Додаткова інформація про обʼєкт', ['class' => 'form-label']) }}
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'id' => 'target-content', 'placeholder' => 'Детальний опис обʼєкта"', 'required' => true, 'minlength' => 40, 'rows' => 5]) }}
                    <div class="invalid-feedback">Опишіть обʼєкт (мінімум 40 символів).</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                  <div class="col-md-3 mt-3">
                    {{ Form::label('reliability', 'Надійність', ['class' => 'form-label']) }}
                    {{ Form::select('reliability', Targets::getFormData('reliability'), null, ['class' => 'single-select-empty', 'required' => true]) }}
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                  <div class="col-md-3 mt-3">
                    {{ Form::label('source_id', 'Джерело', ['class' => 'form-label']) }}
                    @if(Auth::user()->role === 'agent')
                      {{ Form::select('source_id', Sources::getByAgentId(Auth::id()), null, ['class' => 'single-select-empty-search', 'required' => true]) }}
                    @else
                      {{ Form::select('source_id', [], null, ['id' => 'choose-source-ajax', 'class' => 'single-select-empty-search', 'required' => true]) }}
                    @endif
                    <div class="invalid-feedback">Необхідно зробити вибір.</div>
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>

                <h5 class="mb-0 mt-5">Додатково</h5>
                <hr/>
                <div class="row pe-0">
                  <div class="col-md-12 mt-3">
                    {{ Form::label('tags', 'Теги', ['class' => 'form-label']) }}
                    {{ Form::select('tags[]', Targets::getAllTags(), null, ['class' => 'multiple-select-tags', 'multiple' => 'multiple']) }}
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>

                <div class="row pe-0">
                  <div class="col-md-4 mt-3">
                    {{ Form::label('civil', 'Чи присутні цивільні?', ['class' => 'form-label']) }}
                    {{ Form::select('civil', [1 => 'Так', 0 => 'Ні'], null, ['class' => 'single-select-empty']) }}
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                  <div class="col-md-4 mt-3">
                    {{ Form::label('correction', 'Чи можливе коригування?', ['class' => 'form-label']) }}
                    {{ Form::select('correction', [1 => 'Так', 0 => 'Ні'], null, ['class' => 'single-select-empty']) }}
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                  <div class="col-md-4 mt-3">
                    {{ Form::label('specific', 'Уточнення', ['class' => 'form-label']) }}
                    {{ Form::select('specific', Targets::getFormData('specific'), null, ['class' => 'single-select']) }}
                    <div class="valid-feedback">Виглядає добре!</div>
                  </div>
                </div>

              <div class="row pe-0">
                <div class="col-12 mt-3">
                  {{ Form::submit('Додати обʼєкт', ['class' => 'btn btn-warning text-uppercase w-100 mt-3']) }}
                 </div>
              </div>

              {{ Form::close() }}
           </div>
         </div>
       </div>

     </div>
   </div>
   <!--end row-->

   @include('target.components.coordinate-templates')

@stop