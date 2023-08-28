


    <nav class="navbar navbar-expand-lg bg-dark"  data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">livewire</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="/">Home</a>

            @guest
                 <a class="nav-link" href="/auth">login/regiter</a>
            @endguest
            @auth
                 <a class="nav-link" href="#"> {{  auth()->user()->name }} </a>
              @livewire('logout')
            @endauth
          </div>
        </div>
      </div>
    </nav>

