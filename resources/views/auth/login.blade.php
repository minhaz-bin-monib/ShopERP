<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Manrope:wght@300;400;500;600;700&display=swap');

    :root {
        --ink: #1f1b16;
        --ink-soft: #4e463c;
        --line: #eadfce;
        --ocean: #2f6f74;
        --mint: #7cc9b0;
        --paper: #fffdf9;
        --shadow: 0 20px 60px rgba(33, 26, 18, 0.18);
    }

    body {
        background: linear-gradient(135deg, #f7f3ec, #f0ece5);
    }

    .auth-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 16px;
        font-family: 'Manrope', Arial, sans-serif;
    }

    .auth-card {
        width: 100%;
        max-width: 520px;
        background: var(--paper);
        border-radius: 24px;
        box-shadow: var(--shadow);
        border: 1px solid var(--line);
        overflow: hidden;
    }

    .auth-hero {
        padding: 26px 28px;
        background: linear-gradient(160deg, #2f6f74, #3c8f8a);
        color: #ffffff;
    }

    .auth-title {
        font-family: 'DM Serif Display', Georgia, serif;
        font-size: 28px;
        margin: 0;
    }

    .auth-body {
        padding: 24px 28px 28px;
    }

    .auth-logo {
        width: 200px;
        margin: 0 auto 12px;
        display: block;
    }

    .auth-label {
        font-weight: 600;
        color: var(--ink);
    }

    .auth-input {
        border-radius: 12px;
        border: 1px solid var(--line);
        padding: 10px 14px;
        height: 46px;
        font-size: 15px;
    }

    .auth-input:focus {
        border-color: var(--ocean);
        box-shadow: 0 0 0 3px rgba(47, 111, 116, 0.15);
    }

    .auth-btn {
        background: linear-gradient(135deg, var(--ocean), var(--mint));
        border: none;
        color: #ffffff;
        font-weight: 700;
        padding: 10px 22px;
        border-radius: 999px;
        box-shadow: 0 14px 30px rgba(47, 111, 116, 0.3);
    }
    .auth-btn:hover {
        color: #ffffff;
    }
</style>

<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-hero">
            <div class="auth-title">Login</div>
        </div>
        <div class="auth-body">
            <img class="auth-logo" src="{{ url('/') }}/img/logo.png" alt="Logo">
            <form action="{{ url('/login') }}" method="post">
                @csrf
                @if (Session::has('fail'))
                    <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                @endif
                <div class="form-row">
                    <div class="mb-2">
                        <label class="auth-label" for="email">Email<span class="text-danger"><b>*</b></span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="form-control auth-input" id="email">
                        <span class="text-danger">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label class="auth-label" for="password">Password<span class="text-danger"><b>*</b></span></label>
                        <input type="password" name="password" value="{{ old('password', $user->password) }}"
                            class="form-control auth-input" id="password">
                        <span class="text-danger">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn auth-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
