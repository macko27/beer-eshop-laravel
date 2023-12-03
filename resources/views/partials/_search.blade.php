<div class="container search">
    <form action="/beers" class="d-flex" role="search" method="GET">
        @csrf
        <input class="form-control" id="search-bar" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-custom" id="search-button" type="submit">Hľadaj</button>
    </form>
</div>
