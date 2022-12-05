<!DOCTYPE html>
<html lang="en">
@include('base.head')
<body>
@include('base.navbar')
@include('base.header')
<section class="h-100 h-custom" style="background-color: #d2c9ff;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted">{{count($cart)}} items</h6>
                                    </div>
                                    <hr class="my-4">

                                    @foreach($cart as $item)

                                        <div class="row mb-4 d-flex justify-content-between align-items-center">

                                            <div class="col-md-2 col-lg-2 col-xl-2">

                                                <a href="{{route('product.show',['id'=>$item->productId])}}"><img
                                                    src="{{asset($item->product->image)}}"
                                                    class="img-fluid rounded-3" alt="ropa">
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <h6 class="text-black mb-0">{{$item->product->name}}</h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                <input id="{{$item->productId}}-quantity" min="0" name="quantity" value="{{$item->quantity}}" type="number"
                                                       class="form-control form-control-sm" />
                                                <img id="{{$item->productId}}-reload" src="{{asset('storage/cart/reload.png')}}" class="reload img-thumbnail img-fluid" width="25%" height="25%" style="margin-left: 5px">


                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h6 class="mb-0">€ {{($item->product->price*$item->quantity)}}</h6>
                                                <img id="{{$item->productId}}-remove" src="{{asset('storage/cart/remove.png')}}" class="remove img-thumbnail img-fluid" width="25%" height="25%" style="padding-left: 5px">
                                            </div>

                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                            </div>
                                        </div>

                                        <hr class="my-4">
                                    @endforeach

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="{{route('home')}}" class="text-body"><i
                                                    class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">items {{count($cart)}}</h5>
                                        <h5>€ {{$totalPrice}}</h5>
                                    </div>

                                    <h5 class="text-uppercase mb-3">Shipping</h5>

                                    <div class="mb-4 pb-2">
                                        <select class="select">
                                            <option value="1">Standard-Delivery- €5.00</option>
                                        </select>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5 id="totalPrice">€ {{$totalPrice+5}}</h5>
                                    </div>
                                    <h5 class="text-uppercase mb-3">Billing Details:</h5>
                                    <form id="checkout">
                                        <input id=csrf type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Full Name</label>
                                            <input type="text"  required class="form-control" id="fullName" aria-describedby="fullNameHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" required class="form-control" id="email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="billingAddress">Billing Adress</label>
                                            <input type="text"  required class="form-control" id="billingAddress">
                                        </div>
                                        <div class="mb-3">
                                            <label for="shippingAddress">Shipping Adress</label>
                                            <input type="text" required class="form-control" id="shippingAddress">
                                        </div>
                                        <div class="mb-3">
                                            <label for="country">Country</label>
                                            <input type="text"  required class="form-control" id="country">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="tel" class="form-control" id="phone">
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-block btn-lg checkout"
                                                data-mdb-ripple-color="dark">Checkout</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('base.footer')
@include('base.assetsjs')
<script src="{{asset('js/cart/cart.js')}}"></script>
</body>
</html>
