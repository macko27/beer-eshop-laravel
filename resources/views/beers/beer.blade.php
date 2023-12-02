<x-layout>
<div class="container-beer container px-4 py-5 px-lg-5 my-5">
    <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
            <img class="mx-auto d-block" src="{{asset("storage/" . $beer->picture)}}" alt="beer">
        </div>
        <div class="col-md-6">
            <h1 class="fw-bolder mt-4">{{$beer->name}}</h1>
            <div class="fs-5 mb-5">
                <h3>Cena: {{$beer->price}} EUR</h3>
            </div>
            <p class="lead mb-4 pb-4">{{$beer->description}}</p>
            <div class="d-flex">
                <input class="form-control text-center me-3" id="beerQuantity" type="num" value="1">
                <div class="ml-4">
                    <button type="button" class="btn btn-custom">Pridať do košíka</button>
                    <form method="POST" action="/beers/{{$beer->id}}">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-custom">Vymazať</button>
                    </form>
                    <a href="/beers/{{$beer->id}}/edit" class="btn btn-custom" type="submit">Upraviť</a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
