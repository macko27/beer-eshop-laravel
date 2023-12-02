@props(["beer"])

<div class="col beer-card">
    <div class="card mx-auto border-0">
        <img src="{{asset("storage/" . $beer->picture)}}" alt="pivo">
        <div class="card-body">
            <h4>{{$beer->name}}</h4><br>
            <h5>{{$beer->style}}</h5>
            <h6>{{$beer->degree}}</h6>
            <h6>Cena: {{$beer->price}} EUR</h6>
            <a href="/beers/{{$beer->id}}" class="stretched-link text-decoration-none"></a>
        </div>
    </div>
</div>
