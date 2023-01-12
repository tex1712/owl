@extends('layouts.app')

@section('title', "Редагувати обʼєкт: ID $target->id")

@section('breadcrumb')
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('target.index') }}">Список обʼєктів</a></li>
  <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('target.show', $target->id) }}">Обʼєкт: ID {{ $target->id }}</a></li>
  <li class="breadcrumb-item active" aria-current="page">Редагувати</li>
@stop

@section('content')

   <div class="row target-form">
     <div class="col-xl-12 mx-auto">
       <h6 class="mb-0 text-uppercase">Внесіть необхідні правки</h6>
       <hr/>
       <div class="card">
         <div class="card-body">
           <div class="p-4 border rounded">
                {{ Form::open(['route' => ['target.update', $target->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data', 'class' => 'row g-3 needs-validation', 'novalidate' => true]) }}
                    

                    @can('officer')
                      <h5 class="mb-0 mt-5">Користувачі</h5>
                      <hr/>
                      <div class="row pe-0">
                        @can('admin')
                          <div class="col-md-4 mt-3">
                            {{ Form::label('officer_id', 'Офіцер', ['class' => 'form-label']) }}
                            {{ Form::select('officer_id', Users::getOfficersList(), $target->officer_id, ['id' => 'choose-officer-ajax', 'class' => 'single-select-search', 'required' => true]) }}
                            <div class="invalid-feedback">Необхідно зробити вибір.</div>
                            <div class="valid-feedback">Виглядає добре!</div>
                          </div>
                        @endcan
                        <div class="col-md-4 mt-3">
                          {{ Form::label('agent_id', 'Агент', ['class' => 'form-label']) }}
                          {{ Form::select('agent_id', Users::getAgentsListByOfficerId($target->officer_id), $target->agent_id, ['id' => 'choose-agent-ajax', 'class' => 'single-select-search', 'required' => true]) }}
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
                        {{ Form::text('location', $target->location, ['class' => 'form-control', 'id' => 'target-location', 'placeholder' => 'Місто, область', 'required' => true]) }}
                        <div class="invalid-feedback">Вкажіть локацію.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                      <div class="col-md-4 mt-3">
                        {{ Form::label('direction_id', 'Напрямок', ['class' => 'form-label']) }}
                        {{ Form::select('direction_id', Directions::getAll(), $target->direction_id, ['class' => 'single-select', 'required' => true]) }}
                        <div class="invalid-feedback">Необхідно зробити вибір.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                      <div class="col-md-2 mt-3">
                        {{ Form::label('target-date', 'Дата', ['class' => 'form-label']) }}
                        {{ Form::date('date', $target->date, ['class' => 'form-control', 'id' => 'target-date', 'required' => true]) }}
                        <div class="invalid-feedback">Виберіть дату.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                      <div class="col-md-2 mt-3">
                        {{ Form::label('target-time', 'Час', ['class' => 'form-label']) }}
                        {{ Form::time('time', $target->time, ['class' => 'form-control', 'id' => 'target-time', 'required' => true]) }}
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

                    <div id="coordinates-wrap">

                      @if(isset($coordinates->point))
                        @foreach ($coordinates->point as $point)
                          <div class="coordinates-block coordinates-block-point p-3 mb-3">
                            <button type="button" class="btn btn-danger rounded-0 btn-coordinates-block-delete"><ion-icon name="trash" class="m-0"></ion-icon></button>
                      
                            <label class="form-label">Введіть координати обʼєкта:</label>
                      
                            <div class="row row-cols-md-4">
                              @foreach ($point->coordinates as $coordinate)
                                @if ($loop->first)
                                  <div class="col-md-3 mt-3">
                                    <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$" value="{{ $coordinate }}">
                                    <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
                                    <div class="valid-feedback">Виглядає добре!</div>
                                  </div>
                                @else
                                  <div class="col-md-3 mt-3 coordinates-single-point">
                                    <div class="input-group">
                                      <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$" value="{{ $coordinate }}">
                                      <button class="btn btn-danger btn-coordinates-single-point-delete" type="button"><ion-icon name="trash" class="m-0"></ion-icon></button>
                                      <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
                                      <div class="valid-feedback">Виглядає добре!</div>
                                    </div>
                                  </div>
                                @endif
                              @endforeach
                              <div class="col mt-3">
                                <button type="button" class="btn btn-success d-block btn-coordinates-single-add">+</button>
                              </div>
                            </div>
                      
                            <div class="form-row mt-3">
                              <textarea name="coordinates-content" class="form-control" class="w-100" minlength="10" >{{ $point->description }}</textarea>
                              <div class="invalid-feedback">Опишіть обʼєкт (мінімум 10 символів).</div>
                              <div class="valid-feedback">Виглядає добре!</div>
                            </div>
                          </div>
                        @endforeach
                      @endif

                      @if(isset($coordinates->square))
                        @foreach ($coordinates->square as $square)
                          <div class="coordinates-block coordinates-block-square p-3 mb-3">
                            <button type="button" class="btn btn-danger rounded-0 btn-coordinates-block-delete"><ion-icon name="trash" class="m-0"></ion-icon></button>
                      
                            <label class="form-label">Введіть 4 точки координат:</label>
                      
                            <div class="row row-cols-md-4">
                              @foreach ($square->coordinates as $coordinate)
                                <div class="col-md-3 mt-3">
                                  <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$" value="{{ $coordinate }}">
                                  <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
                                  <div class="valid-feedback">Виглядає добре!</div>
                                </div>
                              @endforeach
                            </div>
              
                            <div class="form-row mt-3">
                              <textarea name="coordinates-content" class="form-control" class="w-100" minlength="10" >{{ $square->description }}</textarea>
                              <div class="invalid-feedback">Опишіть обʼєкт (мінімум 10 символів).</div>
                              <div class="valid-feedback">Виглядає добре!</div>
                            </div>
                          </div> 
                        @endforeach
                      @endif

                    </div>
                    <input type="text" name="coordinates" id="send-coordinates" class="d-none">



                    <div class="row pe-0">
                      <div class="col-md-6 mt-3">
                        {{ Form::label('target-content', 'Додаткова інформація про обʼєкт', ['class' => 'form-label']) }}
                        {{ Form::textarea('content', $target->content, ['class' => 'form-control', 'id' => 'target-content', 'placeholder' => 'Детальний опис обʼєкта"', 'required' => empty(Targets::getCoordinates($target->id)), 'minlength' => 40, 'rows' => 5]) }}
                        <div class="invalid-feedback">Опишіть обʼєкт (мінімум 40 символів).</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                      <div class="col-md-3 mt-3">
                        {{ Form::label('reliability', 'Надійність', ['class' => 'form-label']) }}
                        {{ Form::select('reliability', Targets::getFormData('reliability'), $target->reliability, ['class' => 'single-select', 'required' => true]) }}
                        <div class="invalid-feedback">Необхідно зробити вибір.</div>
                        <div class="valid-feedback">Виглядає добре!</div>
                     </div>
                        <div class="col-md-3 mt-3">
                          {{ Form::label('source_id', 'Джерело', ['class' => 'form-label']) }}
                          {{ Form::select('source_id', Sources::getByAgentId($target->agent_id), $target->source_id, ['id' => 'choose-source-ajax', 'class' => 'single-select-search', 'required' => true]) }}
                          <div class="invalid-feedback">Необхідно зробити вибір.</div>
                          <div class="valid-feedback">Виглядає добре!</div>
                        </div>
                    </div>

                    <h5 class="mb-0 mt-5">Додатково</h5>
                    <hr/>
                    
                    <div class="row pe-0">
                      <div class="col-md-12 mt-3">
                        {{ Form::label('tags', 'Теги', ['class' => 'form-label']) }}
                        {{ Form::select('tags[]', Targets::getAllTags(), Targets::getTagsByTargetId($target->id), ['class' => 'multiple-select-tags', 'multiple' => 'multiple']) }}
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                    </div>

                    <div class="row pe-0">
                      <div class="col-md-4 mt-3">
                        {{ Form::label('civil', 'Чи присутні цивільні?', ['class' => 'form-label']) }}
                        {{ Form::select('civil', [''=>'', 1 => 'Так', 0 => 'Ні'], $target->civil, ['class' => 'single-select']) }}
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                      <div class="col-md-4 mt-3">
                        {{ Form::label('correction', 'Чи можливе коригування?', ['class' => 'form-label']) }}
                        {{ Form::select('correction', [''=>'', 1 => 'Так', 0 => 'Ні'], $target->correction, ['class' => 'single-select']) }}
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                      <div class="col-md-4 mt-3">
                        {{ Form::label('specific', 'Уточнення', ['class' => 'form-label']) }}
                        {{ Form::select('specific', Targets::getFormData('specific'), $target->specific, ['class' => 'single-select']) }}
                        <div class="valid-feedback">Виглядає добре!</div>
                      </div>
                    </div>

                    <div class="row pe-0">
                      <div class="col-12 mt-3">
                        {{ Form::submit('Редагувати обʼєкт', ['class' => 'btn btn-warning text-uppercase w-100 mt-3']) }}
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
