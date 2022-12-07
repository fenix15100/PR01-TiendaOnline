!DOCTYPE html>
<html lang="en">
@include('base.head')
<body>
@include('base.navbar')
@include('base.header')
<!-- Section-->
<section class="py-5">
    <div id="flash" class="alert alert-info" style="display: none" role="alert">
    </div>
    <div class="container px-4 px-lg-5 mt-5">
        <h2>Categorias:</h2>
        <table id=category-table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">created_at</th>
                <th scope="col">update_at</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr id="data[category-{{$categoria->id}}-item]">
                        <th scope="row">{{$categoria->id}}</th>
                        <td>{{$categoria->name}}</td>
                        <td>{{$categoria->description}}</td>
                        <td>{{$categoria->created_at}}</td>
                        <td>{{$categoria->updated_at}}</td>
                        <td><button id="category-{{$categoria->id}}-delete" class="btn btn-danger">Eliminar</button></td>
                        <td><button disabled id="category-{{$categoria->id}}-edit" class="btn btn-warning">Editar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categorias->links() }}
        <br/>
        <h2>Productos:</h2>
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Image</th>
                <th scope="col">created_at</th>
                <th scope="col">update_at</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($productos as $producto)
                <tr id="data[product-{{$producto->id}}-item]">
                    <th scope="row">{{$producto->id}}</th>
                    <td>{{$producto->name}}</td>
                    <td>{{$producto->description}}</td>
                    <td>{{$producto->price}}€</td>
                    <td>{{$producto->stock}}</td>
                    <td><img class="img-fluid" style="width: 150px" src="{{asset($producto->image)}}" alt="..." /></td>
                    <td>{{$producto->created_at}}</td>
                    <td>{{$producto->updated_at}}</td>
                    <td><button id="product-{{$producto->id}}-delete" class="btn btn-danger">Eliminar</button></td>
                    <td><button disabled id="product-{{$producto->id}}-edit" class="btn btn-warning">Editar</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $productos->links() }}
        <br/>
        <h2>Pedidos:</h2>
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre Cliente</th>
                <th scope="col">Email Cliente</th>
                <th scope="col">Direccion de Facturacion</th>
                <th scope="col">Direccion de Envio</th>
                <th scope="col">Pais</th>
                <th scope="col">Telefono</th>
                <th scope="col">Total pedido</th>
                <th scope="col">Lineas pedido</th>
                <th scope="col">Estado pedido</th>
                <th scope="col">Fecha Pedido</th>
                <th scope="col">created_at</th>
                <th scope="col">update_at</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pedidos as $pedido)
                <tr id="data[order-{{$pedido->id}}-item]">
                    <th scope="row">{{$pedido->id}}</th>
                    <td>{{$pedido->full_name}}</td>
                    <td>{{$pedido->order_email}}</td>
                    <td>{{$pedido->billing_address}}</td>
                    <td>{{$pedido->shipping_address}}</td>
                    <td>{{$pedido->country}}</td>
                    <td>{{$pedido->phone}}</td>
                    <td>{{$pedido->ammount}} €</td>
                    <td>
                        @foreach($pedido->ordersLines()->get() as $order_line)
                            {{json_encode($order_line->toArray())}}
                        @endforeach
                    </td>

                    <td>{{$pedido->order_date}}</td>
                    <td>{{$pedido->created_at}}</td>
                    <td>{{$pedido->updated_at}}</td>
                    <td><button  id="order-{{$pedido->id}}-delete" class="btn btn-danger">Eliminar</button></td>
                    <td><button disabled id="order-{{$pedido->id}}-edit" class="btn btn-warning">Editar</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $pedidos->links() }}
        <br/>
    </div>
</section>

@include('base.footer')
@include('base.assetsjs')
<script src="{{asset('js/admin/admin.js')}}"></script>

</body>
</html>
