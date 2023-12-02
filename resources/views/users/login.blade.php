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
                <span>Email</span>
                <input name="login" id="login" type="email" placeholder="napr. login">
                @error("login")
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                <span>Heslo</span>
                <input id="password" type="password" name="password" placeholder="***">
                @error("password")
                    <p class="text-red-500">{{$message}}</p>
                @enderror
                <button class="item btn-custom" type="submit" name="submit">Prihlásit</button>
            </form>
            <a href="/register">Registrácia</a>
        </div>
    </main>
</div>
</x-auth>
