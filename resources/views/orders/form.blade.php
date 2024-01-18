<x-layout>
    <div class="container-form-add">
        <h2 class="mb-4">Celková cena: {{$price}}€</h2>
        <form method="POST" action="/order" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Meno a priezvisko</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old("name")}}" required>
            </div>
            @error('name')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Telefónne číslo</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{old("phoneNumber")}}" required>
            </div>
            @error('phoneNumber')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{old("email")}}" required>
            </div>
            @error('email')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="address" class="form-label">Ulica</label>
                <input type="text" min="0" class="form-control" id="address" name="address" value="{{old("address")}}" required>
            </div>
            @error('address')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="city" class="form-label">Mesto</label>
                <input type="text" min="0" class="form-control" id="city" name="city" value="{{old("city")}}" required>
            </div>
            @error('city')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-3">
                <label for="psc" class="form-label">PSČ</label>
                <input type="text" min="0" class="form-control" id="psc" name="psc" value="{{old("psc")}}" required>
            </div>
            @error('psc')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <select class="form-select mb-3" aria-label="Default select example">
                <label for="country" class="form-label">Krajina</label>
                <option selected disabled>Slovensko</option>
            </select>

            <div class="mb-3">
                <label for="description" class="form-label">Popis</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{old("description")}}</textarea>
            </div>
            @error('description')
            <p class="wrongInput text-re-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <button class="btn btn-custom" id="beerCreate" type="submit">Kúpiť</button>

        </form>
    </div>
</x-layout>
