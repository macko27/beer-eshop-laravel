<x-layout>
    <div class="container-form-add">
        <form method="POST" action="/order/{{$order->id}}/update" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Meno a priezvisko</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$order->name}}" required>
            </div>
            @error('name')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Telefónne číslo</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{$order->phoneNumber}}" required>
            </div>
            @error('phoneNumber')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$order->email}}" required>
            </div>
            @error('email')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <button class="btn btn-custom" id="beerCreate" type="submit">Upraviť</button>

        </form>
    </div>
</x-layout>
