<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img src="{{ asset('/theme/images/logo-icon-2.png') }}" class="logo-icon" alt="logo icon">
      </div>
      <div>
        <h4 class="logo-text">OWL</h4>
      </div>
      <div class="toggle-icon ms-auto">
        <ion-icon name="menu-sharp"></ion-icon>
      </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
      <li>
        <a href="/">
          <div class="parent-icon">
            <i class="bi bi-house-door"></i>
          </div>
          <div class="menu-title">Зведення</div>
        </a>
      </li>

      <li class="menu-label">Розвід дані</li>
      <li>
        <a class="has-arrow" href="javascript:;">
          <div class="parent-icon">
            <i class="bi bi-map"></i>
          </div>
          <div class="menu-title">Дельта</div>
        </a>
        <ul>
          <li> <a href="{{ route('delta.index') }}">
              <i class="bi bi-list"></i>Список обʼєктів
            </a>
          </li>
          <li> <a href="{{ route('delta.create') }}">
              <i class="bi bi-plus"></i>Додати новий
            </a>
          </li>
        </ul>
      </li>

    </ul>
    <!--end navigation-->
  </aside>