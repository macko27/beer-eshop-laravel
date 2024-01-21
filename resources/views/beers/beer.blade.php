<x-layout>
    <div class="container-beer container px-4 py-5 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="mx-auto d-block" src="{{asset("storage/" . $beer->picture)}}" alt="beer">
            </div>
            <div class="col-md-6">
                <input type="hidden" value="{{$beer->id}}" class="beerID">
                @csrf
                <h1 class="fw-bolder mt-4">{{$beer->name}}</h1>
                <div class="fs-5 mb-5">
                    <h3>Cena: {{$beer->price}} EUR</h3>
                </div>
                <p class="lead mb-4 pb-4">{{$beer->description}}</p>
                <div class="container d-flex flex-wrap">
                    @csrf
                    <input class="input-control text-center mb-3 me-3" id="beerQuantity" type="number" value="1" min="1" max="10">
                    <button type="button" class="btn btn-custom me-2 mb-3 addToCart">Pridať do košíka</button>

                    @if(auth()->user()?->name == "admin")
                        <form method="POST" action="/beers/{{$beer->id}}">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-custom mb-3 me-2">Vymazať</button>
                        </form>
                        <a href="/beers/{{$beer->id}}/edit" class="btn btn-custom mb-3 me-2" type="submit">Upraviť</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
