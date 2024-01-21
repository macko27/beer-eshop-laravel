<x-auth>
    <div class="login-main-container">
        <main class="container-login">
            <nav class="login-logo">
                <a href="/">
                    <img src="{{asset("images/svg/logo.svg")}}" alt="logo">
                </a>
            </nav>
            <div class="form">
                <h1>Prihlásenie</h1>
                <form class="form-signin" method="POST" action="/users/authenticate">
                    @csrf
                    <label for="email" class="form-label">Email</label>
                    <input name="email" id="email" type="email">
                    @error("email")
                        <p id="wrongInput" class="text-red-500">{{$message}}</p>
                    @enderror

                    <label for="password" class="form-label">Heslo</label>
                    <input id="password" type="password" name="password" placeholder="***">
                    @error("password")
                        <p id="wrongInput" class="text-red-500">{{$message}}</p>
                    @enderror
                    <button class="item btn-custom" type="submit" name="submit">Prihlásit</button>
                </form>
                <a href="/register">Registrácia</a>
            </div>
        </main>
    </div>
</x-auth>
