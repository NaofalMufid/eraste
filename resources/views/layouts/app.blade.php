@include('layouts.top')

@include('layouts.nav')
  
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Eraste Beautify</h1>
      </div>
  
      <div class="container">
        {{-- @include('layouts.content')         --}}
        @yield('content')
  
        @include('layouts.footer')
      </div>
@include('layouts.js')  

    