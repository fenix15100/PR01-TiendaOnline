<!DOCTYPE html>
<html lang="en">
@include('base.head')
<body>
@include('base.navbar')
@include('base.header')
<!-- Section-->
@include('base.messages')
<div id="data[products-container]" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
    <div class="col mb-5 p-3">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem;">
                {{ $p->stock != 0 ? 'Sale' : 'Out of Stock' }}
            </div>
            <!-- Product image-->
            <img class="card-img-top" src="{{asset($p->image)}}" alt="..." />
        </div>
    </div>
    <div class="card-body p-4">
        <div class="text-start">
            <!-- Product name-->
            <h5 class="fw-bolder">{{$p->name}}</h5>
            <!-- Product description-->
            <h5 class="fw-light">{{$p->description}}</h5>
            <!-- Product stock-->
            <h5 class="fw-light">Unidades disponibles: {{$p->stock}}</h5>
            <!-- Product reviews-->
            <div class="d-flex justify-content-start text-warning mb-2">
                <div class="bi-star-fill"></div>
                <div class="bi-star-fill"></div>
                <div class="bi-star-fill"></div>
                <div class="bi-star-fill"></div>
                <div class="bi-star-fill"></div>
            </div>
            <!-- Product price-->
            <span class="text-black h1">{{$p->price}}€</span>


            <!-- Product actions-->
            @if($p->stock != 0)
                <br/>
                <div class="text-start"><a id="addTocart" class="btn btn-outline-dark mt-auto" href="{{route("addProductToCart",['id'=>$p->id,'quantity'=>1])}}">Add to cart</a></div>
            @else
                <br/>
                <div id="addTocart" class="text-start disabled"><a class="btn btn-danger disabled mt-auto" href="#">Add to cart</a></div>
            @endif

        </div>

    </div>
</div>

@include('base.footer')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cantidad = document.getElementById("cantidad");

        cantidad.addEventListener("keyup", (event)=>{
            cantidad.nodeValue = event.target.value
            document.getElementById("addTocart").href =
                "{{route("addProductToCart",['id'=>$p->id])."?quantity="}}"+event.target.value
        });
    });
</script>
</body>
</html>
