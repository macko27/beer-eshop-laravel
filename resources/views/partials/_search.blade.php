<div class="container search">
    <form action="/beers" class="d-flex" role="search" method="GET">
        @csrf
        <input class="form-control" id="search-bar" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-custom" id="search-button" type="submit">Hľadaj</button>
    </form>

    <aside class="container text-body-secondary my-4 mb-xl-5 px-2 py-2">
        <form action="/beers" class="d-flex" method="get">
            @csrf
            <div class="row mb-2">
                <select class="form-select" id="selectMenu" name="search">
                    <option selected disabled>Filtre</option>
                    <option value="Zvolenský remeselný pivovar">Zvolenský remeselný pivovar</option>
                    <option value="Baran">Baran</option>
                    <option value="Vŕšky">Vŕšky</option>
                    <option value="Tmavé">Tmavé</option>
                    <option value="Polotmavé">Polotmavé</option>
                    <option value="Svetlé">Svetlé</option>
                    <option value="IPA">IPA</option>
                    <option value="APA">APA</option>
                </select>
            </div>
        </form>
    </aside>
</div>

