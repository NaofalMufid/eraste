<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 nav-dark bg-light border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Eraste</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="{{route('product.index')}}">Product</a>
      <a class="p-2 text-dark" href="{{route('order.index')}}">Orders</a>
      <a class="p-2 text-dark" href="{{route('customer.index')}}">Customers</a>
      <a class="p-2 text-dark" href="{{route('user.index')}}">Users</a>
    </nav>
    <form action="{{route('logout')}}" method="POST">
      @csrf
      <button class="dropdown-item" style="cursor:pointer">Sign Out</button>
    </form>
</div>