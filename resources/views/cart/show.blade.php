<x-layout>
    <div class="cart-container">
    <h1 class="mb-4">Tvoj nákupný košík</h1>

    @if (count($cartItems) > 0)
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
                <tr>
                    <td><img src="{{asset("storage/" . $cartItem['beer']->picture)}}" alt="beer"></td>
                    <td>{{ $cartItem['beer']->name }}</td>

                    <td>
                        <input class="text-center me-3 beer-quantity-change" data-beer-id="{{ $cartItem['beer']->id }}" type="number" value="{{ $cartItem['quantity'] }}">
                    </td>
                    <td>{{ $cartItem['beer']->price * $cartItem['quantity'] }}€</td>
                    <td>
                        <a href="#" class="cart-delete" data-beer-id="{{ $cartItem['beer']->id }}"><i class="bi bi-x-lg"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p class="total">Total: {{ array_sum(array_column($cartItems, 'quantity')) }} items</p>
        <p class="total">Total Price: {{ array_sum(array_map(function ($item) { return $item['beer']->price * $item['quantity']; }, $cartItems)) }}</p>

        <button class="addToCart" onclick="checkout()">Checkout</button>
    @else
        <p>Your cart is empty.</p>
    @endif
    </div>
</x-layout>
