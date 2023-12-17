@if(session()->has("message"))
    <div id="customAlert" class="alert alert-success position-fixed top-50 start-50 translate-middle-x" role="alert">
        d
        {{session("message")}}
    </div>
@endif
