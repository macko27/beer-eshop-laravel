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

    <aside class="container text-body-secondary mb-3 mb-xl-5 px-2 py-2">
        <h2 class="h6 pt-4 pb-3 mb-4 border-bottom">Výber</h2>
        <nav class="small" id="toc">
            <ul class="list-unstyled">
                <li class="my-2">
                    <button class="btn d-inline-flex align-items-center border-0 collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#contents-collapse" aria-controls="contents-collapse">Pivovar</button>
                    <ul class="list-unstyled ps-3 collapse" id="contents-collapse" style="">
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="/zrp">Zvolenský remeselný pivovar</a></li>
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="/baran">Baran</a></li>
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="/vrsky">Vŕšky</a></li>
                    </ul>
                </li>
                <li class="my-2">
                    <button class="btn d-inline-flex align-items-center border-0 collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#forms-collapse" aria-controls="forms-collapse">Druh</button>
                    <ul class="list-unstyled ps-3 collapse" id="forms-collapse" style="">
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="#overview">Tmavé</a></li>
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="#disabled-forms">Polotmavé</a></li>
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="#sizing">Svetlé</a></li>
                    </ul>
                </li>
                <li class="my-2">
                    <button class="btn d-inline-flex align-items-center border-0 collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#components-collapse" aria-controls="components-collapse">Štýl</button>
                    <ul class="list-unstyled ps-3 collapse" id="components-collapse" style="">
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="#accordion">IPA</a></li>
                        <li><a class="d-inline-flex align-items-center rounded text-decoration-none" href="#alerts">APA</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>


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
