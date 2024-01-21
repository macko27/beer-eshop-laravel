<x-layout>
    <div class="container py-4">
        <h1>Tvoj nákupný košík</h1>
        <div class="d-flex justify-content-center">
            @if (count($cartItems) > 0)
                <div class="table-responsive">
                    <table>
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
                        @foreach ($cartItems as $cartItem)
                            <tr id="cartItem">
                                <td><img src="{{asset("storage/" . $cartItem['beer']->picture)}}" alt="beer"></td>
                                <td>{{ $cartItem['beer']->name }}</td>

                                <td>
                                    <input class="text-center me-3 beer-quantity-change" data-beer-id="{{ $cartItem['beer']->id }}" type="number" value="{{ $cartItem['quantity'] }}">
                                </td>
                                <td>{{ $cartItem['beer']->price * $cartItem['quantity'] }}€</td>
                                <td>
                                    <button class="cart-delete" data-beer-id="{{ $cartItem['beer']->id }}"><i class="bi bi-x-lg"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <p class="my-4" id="cart-price">Celková cena je: {{$price}}€</p>

                    <a class="my-4 btn btn-custom" href="/cart/order">Pokračovať</a>
                </div>
            @else
                <p>Tvoj košík je prázdny.</p>
            @endif
        </div>
    </div>
</x-layout>
