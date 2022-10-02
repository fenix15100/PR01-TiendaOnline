<select id="categorias"
        class="form-select form-select- mb-3"
        aria-label=".form-select-lg example">
    @foreach($categorias as $c)
        <option value="{{$c->id}}">{{$c->name}}</option>
    @endforeach
</select>

