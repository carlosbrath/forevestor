  <header class="position-fixed top-0 start-0 w-100 z-3 d-flex justify-content-center p-3">
      <nav class="navbar navbar-expand-lg navbar-light navbar-custom w-100 px-4" style="max-width: 1100px">
          <a class="navbar-brand d-flex align-items-center" href="{{route('home')}}">
              <img src="{{ asset('/assets/images/favicon.png') }}" width="60" height="40" alt="Forevestor Logo" />
              <span class="ms-2 fw-bold" style="color: var(--color-text-primary); font-size: 1.1rem;">Forevestor</span>
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
              aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div id="navMenu" class="collapse navbar-collapse justify-content-end">
              <ul class="navbar-nav align-items-center gap-3">
                  <!-- About -->
                  <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('plans') }}">Investment Plans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Account</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Resources</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                  <li class="nav-item ms-2">
                      @auth
                          <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary px-3"
                              style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">
                              <i class="bi bi-speedometer2"></i>
                              Dashboard
                          </a>
                      @else
                          <a href="{{ route('login') }}" class="btn btn-sm btn-primary px-3"
                              style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">
                              Sign In
                          </a>
                      @endauth
                  </li>
              </ul>
          </div>
      </nav>
  </header>