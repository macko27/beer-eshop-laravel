<x-layout>
    @foreach($beers as $beer)
        <p>{{$beer->name}}</p>
        <p>{{$beer->quantity}}</p>
    @endforeach
        <p>{{$price}}</p>
</x-layout>
