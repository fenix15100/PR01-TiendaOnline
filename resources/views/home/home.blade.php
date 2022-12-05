<!DOCTYPE html>
<html lang="en">
@include('base.head')
<body>
@include('base.navbar')
@include('base.header')
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        @include('base.messages')
        @include('category.category')
        <div id="data[products-container]" class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        </div>
    </div>
</section>
@include('base.footer')
@include('base.assetsjs')
<script src="{{asset('js/category/category.js')}}"></script>
</body>
</html>
