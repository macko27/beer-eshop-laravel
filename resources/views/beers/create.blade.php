<x-layout>
<div class="container-form-add">
    <form method="POST" action="/beers" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Názov</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old("name")}}">
        </div>
        @error('name')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="style" class="form-label">Štýl</label>
            <input type="text" class="form-control" id="style" name="style" value="{{old("style")}}">
        </div>
        @error('style')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="type" class="form-label">Druh</label>
            <input type="text" class="form-control" id="type" name="type" value="{{old("type")}}">
        </div>
        @error('type')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="price" class="form-label">Cena</label>
            <input type="text" min="0" class="form-control" id="price" name="price" value="{{old("price")}}">
        </div>
        @error('price')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="degree" class="form-label">Stupeň</label>
            <input type="text" min="0" class="form-control" id="degree" name="degree" value="{{old("degree")}}">
        </div>
        @error('degree')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="brewery" class="form-label">Pivovar</label>
            <input type="text" class="form-control" id="brewery" name="brewery" value="{{old("brewery")}}">
        </div>
        @error('brewery')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="picture" class="form-label">Vyber obrázok</label>
            <input class="form-control" type="file" id="picture" name="picture">
        </div>
        @error('picture')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-3">
            <label for="description" class="form-label"></label>
            <textarea class="form-control" id="description" name="description" rows="3">{{old("description")}}</textarea>
        </div>
        @error('description')
        <p class="text-re-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <button class="btn btn-custom" type="submit">Potvrdiť</button>

    </form>
</div>
</x-layout>
