@include('layouts.admin.top')

@include('layouts.admin.nav')
  
      <div class="container">
        {{-- @include('layouts.content')         --}}
        @yield('content')
  
        @include('layouts.admin.footer')
      </div>
@include('layouts.admin.js')  

    