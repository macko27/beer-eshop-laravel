<x-auth>
    <div class="login-main-container">
        <main class="container-login">
            <nav class="login-logo">
                <a href="/">
                    <img src="{{asset("images/svg/logo.svg")}}" alt="logo">
                </a>
            </nav>
            <div class="form">
                <h1>Registrácia</h1>
                <form class="form-signin" method="POST" action="/users">
                    @csrf
                    <label for="name" class="form-label">Meno</label>
                    <input name="name" id="name" type="text" value="{{old("name")}}">
                    @error("name")
                    <p id="wrongInput" class="text-red-500">{{$message}}</p>
                    @enderror

                    <label for="email" class="form-label">Email</label>
                    <input name="email" id="email" type="email" value="{{old("email")}}">
                    @error("email")
                    <p id="wrongInput" class="text-red-500">{{$message}}</p>
                    @enderror

                    <label for="password" class="form-label">Heslo</label>
                    <input id="password" type="password" name="password">
                    @error("password")
                    <p id="wrongInput" class="text-red-500">{{$message}}</p>
                    @enderror

                    <label for="password_confirmation" class="form-label">Potvrď heslo</label>
                    <input id="password_confirmation" type="password" name="password_confirmation">
                    @error("password_confirmation")
                    <p id="wrongInput" class="text-red-500">{{$message}}</p>
                    @enderror

                    <button class="item btn-custom" type="submit" name="submit">Registrovať</button>
                </form>
            </div>
        </main>
    </div>
</x-auth>
