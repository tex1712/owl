  {{-- Coordinates template for point type --}}
  <div class="coorditates-point-template d-none">
    <div class="coordinates-block coordinates-block-point p-3 mb-3">
      <button type="button" class="btn btn-danger rounded-0 btn-coordinates-block-delete"><ion-icon name="trash" class="m-0"></ion-icon></button>

      <label class="form-label">Введіть координати обʼєкта:</label>

      <div class="row row-cols-md-4">
        <div class="col-md-3 mt-3">
          <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
          <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
          <div class="valid-feedback">Виглядає добре!</div>
        </div>
        <div class="col-md-3 mt-3">
          <button type="button" class="btn btn-success d-block btn-coordinates-single-add">+</button>
        </div>
      </div>

      <div class="form-row mt-3">
        <textarea name="coordinates-content" class="form-control" class="w-100" minlength="10" ></textarea>
        <div class="invalid-feedback">Опишіть обʼєкт (мінімум 10 символів).</div>
        <div class="valid-feedback">Виглядає добре!</div>
      </div>
    </div>
  </div>

  {{-- One point coordinates template  --}}
  <div class="coordinates-single-point-template d-none">
    <div class="col mt-3 coordinates-single-point">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
        <button class="btn btn-danger btn-coordinates-single-point-delete" type="button"><ion-icon name="trash" class="m-0"></ion-icon></button>
        <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
        <div class="valid-feedback">Виглядає добре!</div>
      </div>
    </div>
  </div>

  {{-- Coordinates template for square type --}}
  <div class="coorditates-square-template d-none">
    <div class="coordinates-block coordinates-block-square p-3 mb-3">
      <button type="button" class="btn btn-danger rounded-0 btn-coordinates-block-delete"><ion-icon name="trash" class="m-0"></ion-icon></button>

      <label class="form-label">Введіть 4 точки координат:</label>

      <div class="row row-cols-md-4">
        <div class="col mt-3">
          <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
          <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
          <div class="valid-feedback">Виглядає добре!</div>
        </div>
        <div class="col mt-3">
          <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
          <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
          <div class="valid-feedback">Виглядає добре!</div>
        </div>
        <div class="col mt-3">
          <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
          <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
          <div class="valid-feedback">Виглядає добре!</div>
        </div>
        <div class="col mt-3">
          <input type="text" class="form-control" placeholder="55.752105, 37.617500" pattern="^([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?)$">
          <div class="invalid-feedback">Введіть координати у форматі: 55.752105, 37.617500</div>
          <div class="valid-feedback">Виглядає добре!</div>
        </div>
      </div>

      <div class="form-row mt-3">
        <textarea name="coordinates-content" class="form-control" class="w-100" minlength="10" ></textarea>
        <div class="invalid-feedback">Опишіть обʼєкт (мінімум 10 символів).</div>
        <div class="valid-feedback">Виглядає добре!</div>
      </div>
    </div>
  </div>