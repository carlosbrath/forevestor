  <header class="position-fixed top-0 start-0 w-100 z-3 d-flex justify-content-center p-3">
      <nav class="navbar navbar-expand-lg navbar-light navbar-custom w-100 px-4" style="max-width: 1100px">
          <a class="navbar-brand d-flex align-items-center" href="#">
              <img src="{{ asset('/assets/images/logo.png') }}" width="35" height="35" alt="Forevestor Logo" />
              <span class="ms-2 fw-bold" style="color: var(--color-text-primary); font-size: 1.1rem;">Forevestor</span>
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
              aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div id="navMenu" class="collapse navbar-collapse justify-content-end">
              <ul class="navbar-nav align-items-center gap-3">
                  <!-- About -->
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                          aria-expanded="false">About Us</a>
                      <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="#">About Forevestor</a></li>
                          <li><a class="dropdown-item" href="#">Our Team</a></li>
                          <li><a class="dropdown-item" href="#">Careers</a></li>
                          <li><a class="dropdown-item" href="#">Contact Us</a></li>
                      </ul>
                  </li>

                  <!-- Investment Plans -->
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                          aria-expanded="false">Investment Plans</a>


                      <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="#">1% Daily Returns</a></li>
                          <li> <a class="dropdown-item" href="#">Monthly Plans</a></li>
                          <li> <a class="dropdown-item" href="#">Premium Plans</a></li>
                      </ul>
                  </li>

                  <li class="nav-item"><a class="nav-link" href="#">Account</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Resources</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                  <li class="nav-item ms-2">
                      <a href="#" class="btn btn-sm btn-primary px-3"
                          style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">Sign
                          In</a>
                  </li>
              </ul>
          </div>
      </nav>
  </header>
