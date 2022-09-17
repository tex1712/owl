<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0 align-items-center">
          <li class="breadcrumb-item"><a href="/">
              <ion-icon name="home-outline"></ion-icon>
            </a>
          </li>
          @yield('breadcrumb')
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        @yield('controls')
      </div>
    </div>
  </div>