<section id="password-section">
    <header>
        <h2 class="text-lg font-medium">
            Modifica Password
        </h2>

        <p class="mt-2 text-sm">
            Per garantire la sicurezza del tuo account, assicurati che la password utilizzata sia lunga e casuale. Inoltre deve essere di almeno 8 caratteri tra cui almeno una lettera ed un numero
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-2">
            <label for="current_password">Password Attuale</label>
            <input class="mt-2 form-control" type="password" name="current_password" id="current_password" autocomplete="current-password">
            @error('current_password')
            <span class="invalid-feedback mt-2" role="alert">
                <strong>{{ $errors->updatePassword->get('current_password') }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="password">Nuova Password</label>
            <input class="mt-2 form-control" type="password" name="password" id="password" autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback mt-2" role="alert">
                <strong>{{ $errors->updatePassword->get('password')}}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-2">

            <label for="password_confirmation">Conferma Password</label>
            <input class="mt-2 form-control" type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password">
            @error('password_confirmation')
            <span class="invalid-feedback mt-2" role="alert">
                <strong>{{ $errors->updatePassword->get('password_confirmation')}}</strong>
            </span>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-outline-warning mt-4">Modifica Password</button>

            @if (session('status') === 'password-updated')
            <script>
                const show = true;
                setTimeout(() => show = false, 2000)
                const el = document.getElementById('status')
                if (show) {
                    el.style.display = 'block';
                }
            </script>
            <p id='status' class=" fs-5 text-muted">Password modificata con successo!</p>
            @endif
        </div>
    </form>
</section>
