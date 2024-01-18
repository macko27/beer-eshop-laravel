<x-layout>

<div class="py-5 text-center container ">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Pivá z okolia Zvolena</h1>
            <p class="lead text-body-secondary">V ponuke máme zatiaľ tri druhy pív: Vŕšky, Zvolenský remeselný pivovar a Baran.</p>
            <p>
                <a href="#sell-container" class="btn btn-custom">Nakupovať</a>
            </p>
        </div>
    </div>
</div>

<div id="sell-container">
    @include("partials._search")

    <div class="album py-5">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 g-5">
                @unless(count($beers) == 0)
                @foreach($beers as $beer)

                <x-beer-card :beer="$beer"/>

                @endforeach
                @else
                    <p>Žiadne pivá</p>
                @endunless
                @if(auth()->user()?->name == "admin")
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/beers/create" id="BtnAddBeer" class="btn btn-custom" type="submit">Pridať</a>
                    </div>
                @endif
            </div>

            <div class="mt-4 p-4">
                {{ $beers->links() }}
            </div>

        </div>
    </div>
</div>
</x-layout>
