@if( Session::has( 'success' ))
    <div id="flash" class="alert alert-success"  role="alert">
        {{ Session::get( 'success' ) }}
    </div>
@elseif( Session::has( 'warning' ))
    <div id="flash" class="alert alert-warning"  role="alert">
        {{ Session::get( 'warning' ) }}
    </div>
@elseif( Session::has( 'error' ))
    <div id="flash" class="alert alert-error"  role="alert">
        {{ Session::get( 'error' ) }}
    </div>
@elseif( Session::has( 'info' ))
    <div id="flash" class="alert alert-info"  role="alert">
        {{ Session::get( 'info' ) }}
    </div>
@endif

