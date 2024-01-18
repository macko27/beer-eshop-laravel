<x-layout>
    <h1>Osobné údaje</h1>
    <p>Meno: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    @foreach ($orders as $order)
        <p>Order ID: {{ $order->id }}</p>
        @foreach ($order->beers as $beer)
            <p>Beer id: {{ $beer["beer_id"] }}</p>
        @endforeach
    @endforeach
</x-layout>
