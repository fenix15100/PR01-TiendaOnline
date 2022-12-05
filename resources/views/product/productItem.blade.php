@foreach($products as $p)
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem;">
                {{ $p->stock != 0 ? 'Sale' : 'Out of Stock' }}
            </div>
            <!-- Product image-->
            <a class="link-info" href="{{route('product.show',["id"=>$p->id])}}">
                <img class="card-img-top" src="{{asset($p->image)}}" alt="..." />
            </a>
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">{{$p->name}}</h5>
                    <!-- Product reviews-->
                    <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <!-- Product price-->
                    <span class="text-black">{{$p->price}}€</span>
                </div>
            </div>

            <!-- Product actions-->
            @if($p->stock != 0)
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route("addProductToCart",['id'=>$p->id,'quantity'=>1])}}">Add to cart</a></div>
                </div>
            @else
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center disabled"><a class="btn btn-danger disabled mt-auto" href="#">Add to cart</a></div>
                </div>
            @endif
        </div>
    </div>
@endforeach

