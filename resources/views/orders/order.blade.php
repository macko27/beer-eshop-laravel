<x-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-center">
            @if (count($beers) > 0)
                <div class="table-responsive">
                    <table class="table">
                        @csrf
                        <thead>
                        <tr>
                            <th>Obrázok</th>
                            <th>Názov</th>
                            <th>Množstvo</th>
                            <th>Cena</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($beers as $beer)
                            <tr id="cartItem">
                                <td><img src="{{ asset("storage/" . $beer->picture) }}" alt="beer"></td>
                                <td>{{ $beer->name }}</td>
                                <td>
                                    <input class="text-center me-3 beer-quantity-change" data-beer-id="{{ $beer->id }}" type="number" value="{{ $beer->quantity }}" readonly>
                                </td>
                                <td>{{ $beer->price }}€</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h3 class="my-4" id="cart-price">Celková cena je: {{ $price }}€</h3>
                </div>
            @endif
        </div>
    </div>
</x-layout>
