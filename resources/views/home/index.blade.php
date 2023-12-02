<x-layout>

<div class="container-carousel">
    <div id="carouselExampleCaptions" class="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset("images/index/pivo.jpg")}}" class="d-block w-100" alt="obrázok piva">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset("images/index/pivo2.jpg")}}" class="d-block w-100" alt="obrázok Zvolena">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset("images/index/pivo3.png")}}" class="d-block w-100" alt="obrázok Zvolena">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="index container px-5 py-5">
        <div class="text-center mt-4 mb-4">
            <h1>Pivo z okolia Zvolena</h1>
        </div>

        <div class="text-center mt-4 mb-4">
            <img src="{{asset("images/index/zvolen3.jpg")}}" alt="Obrázok" class="index img-fluid w-25">
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <p>Vitajte na našej stránke, kde zatiaľ objavíte tri jedinečné druhy pív: Vŕšky, Zvolenský remeselný pivovar a Baran. Poďte s nami na cestu do sveta neodolateľných chutí a tradícií pivného umenia.</p>
            </div>
            <div class="col-md-6">
                <p>V našom e-shope nájdete pivá zo Zvolena a jeho oklia. Toto miesto ponúka jedinečné spojenie kultúrneho dedičstva s prírodou a zároveň predstavuje výnimočnú pivnú tradíciu</p>
            </div>
        </div>

        <div class="text-center mt-4 mb-4">
            <a href="/beers" class="btn btn-custom">Nakupovať</a>
        </div>
    </div>
</div>

</x-layout>
