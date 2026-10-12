<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поддержка – Nuriddin Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600&family=Onest:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0d0f14;
            --surface: #13161d;
            --surface-2: #1a1e28;
            --border: rgba(255,255,255,0.07);
            --border-strong: rgba(255,255,255,0.14);
            --text: #e8eaf0;
            --muted: #6b7080;
            --accent: #52c47e;
            --accent-hover: #46b070;
            --accent-soft: rgba(82,196,126,0.12);
            --accent-glow: rgba(82,196,126,0.25);
            --danger: #e05252;
            --danger-soft: rgba(224,82,82,0.12);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Onest', sans-serif;
            font-weight: 300;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 60px 20px 80px;
            position: relative;
            overflow-x: hidden;
        }

        /* Background decor */
        body::before {
            content: '';
            position: fixed;
            top: -200px;
            right: -200px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(82,196,126,0.07) 0%, transparent 70%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -150px;
            left: -150px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(82,82,224,0.05) 0%, transparent 70%);
            pointer-events: none;
        }

        .wrapper {
            width: 100%;
            max-width: 680px;
            animation: fadeUp 0.6s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Header */
        .header {
            margin-bottom: 40px;
            animation: fadeUp 0.6s ease 0.05s both;
        }
        .app-name {
            font-family: 'Unbounded', sans-serif;
            font-size: 11px;
            font-weight: 300;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
        }
        h1 {
            font-family: 'Unbounded', sans-serif;
            font-size: clamp(24px, 5vw, 36px);
            font-weight: 600;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--text);
        }
        h1 span { color: var(--accent); }
        .subtitle {
            margin-top: 14px;
            font-size: 15px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* Cards */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 16px;
            transition: border-color 0.2s;
            animation: fadeUp 0.6s ease both;
        }
        .card:nth-of-type(1) { animation-delay: 0.1s; }
        .card:nth-of-type(2) { animation-delay: 0.18s; }

        .card-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Unbounded', sans-serif;
            font-size: 9px;
            font-weight: 400;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 16px;
        }
        .card-label .dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
        }
        .card h2 {
            font-family: 'Unbounded', sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: -0.01em;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.65;
        }

        /* Form */
        form { margin-top: 24px; display: flex; flex-direction: column; gap: 18px; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .field { display: flex; flex-direction: column; gap: 8px; min-width: 0; }
        .field label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
        }
        .field label .req { color: var(--accent); margin-left: 2px; }

        .input, .select, .textarea {
            width: 100%;
            padding: 12px 14px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-family: 'Onest', sans-serif;
            font-size: 15px;
            font-weight: 400;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input::placeholder, .textarea::placeholder { color: var(--muted); opacity: 0.7; }
        .input:hover, .select:hover, .textarea:hover { border-color: var(--border-strong); }
        .input:focus, .select:focus, .textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-soft);
        }
        .select {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7080' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 14px;
            padding-right: 40px;
        }
        .select option { background: var(--surface-2); color: var(--text); }
        .textarea { min-height: 150px; resize: vertical; line-height: 1.55; }

        .field.has-error .input,
        .field.has-error .select,
        .field.has-error .textarea { border-color: var(--danger); }
        .error {
            font-size: 12.5px;
            color: #f0a0a0;
            font-weight: 400;
        }
        .hint {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 12px;
            color: var(--muted);
        }

        /* Button */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            align-self: flex-start;
            margin-top: 4px;
            padding: 13px 26px;
            background: var(--accent);
            color: #0d0f14;
            border: none;
            border-radius: 10px;
            font-family: 'Onest', sans-serif;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.01em;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        }
        .btn:hover {
            background: var(--accent-hover);
            box-shadow: 0 0 28px var(--accent-glow);
            transform: translateY(-1px);
        }
        .btn:active { transform: translateY(0); }
        .btn:disabled { opacity: 0.6; cursor: default; transform: none; box-shadow: none; }
        .btn svg { width: 15px; height: 15px; }

        /* Success */
        .success {
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }
        .success-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .success-icon svg { width: 22px; height: 22px; color: var(--accent); }
        .success .btn { margin-top: 18px; }

        /* Contacts */
        .contact-block {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 18px;
            padding: 14px 18px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 10px;
        }
        .contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .contact-icon svg { width: 16px; height: 16px; color: var(--accent); }
        .contact-info { flex: 1; min-width: 0; }
        .contact-info small {
            display: block;
            font-size: 11px;
            color: var(--muted);
            font-weight: 400;
            margin-bottom: 2px;
            letter-spacing: 0.03em;
        }
        .contact-info a {
            color: var(--text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            word-break: break-all;
            transition: color 0.2s;
        }
        .contact-info a:hover { color: var(--accent); }

        /* Footer */
        .footer {
            margin-top: 40px;
            text-align: center;
            animation: fadeUp 0.6s ease 0.3s both;
        }
        .footer p { font-size: 13px; color: var(--muted); line-height: 1.7; }
        .footer a {
            color: var(--text);
            text-decoration: underline;
            text-underline-offset: 3px;
            text-decoration-color: var(--border-strong);
            transition: color 0.2s;
        }
        .footer a:hover { color: var(--accent); }

        @media (max-width: 560px) {
            body { padding: 40px 16px 60px; }
            .card { padding: 22px 18px; }
            .row { grid-template-columns: 1fr; }
            .btn { align-self: stretch; }
        }
    </style>
</head>
<body>

<div class="wrapper">

    {{-- Заголовок --}}
    <div class="header">
        <div class="app-name">Nuriddin Tour</div>
        <h1>Служба <span>поддержки</span></h1>
        <p class="subtitle">
            Опишите вашу проблему или вопрос — мы свяжемся с вами
            по почте или телефону в течение рабочего дня.
        </p>
    </div>

    {{-- Форма обращения --}}
    <div class="card">
        @if(session('success'))
            <div class="success">
                <div class="success-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                </div>
                <div>
                    <h2>Обращение отправлено</h2>
                    <p>Спасибо! Мы получили ваш запрос и ответим в ближайшее время на указанную почту или телефон.</p>
                    <a href="{{ route('support') }}" class="btn">Отправить ещё одно обращение</a>
                </div>
            </div>
        @else
            <div class="card-label">
                <span class="dot"></span>
                Новое обращение
            </div>
            <h2>Напишите нам</h2>
            <p>Все поля обязательны для заполнения.</p>

            <form method="post" action="{{ route('support.store') }}" id="support-form" novalidate>
                @csrf

                <div class="field @error('subject') has-error @enderror">
                    <label for="subject">Тема обращения<span class="req">*</span></label>
                    <select id="subject" name="subject" class="select" required>
                        <option value="" disabled @selected(!old('subject'))>Выберите тему</option>
                        @foreach($subjects as $key => $label)
                            <option value="{{ $key }}" @selected(old('subject') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('subject')<span class="error">{{ $message }}</span>@enderror
                </div>

                <div class="row">
                    <div class="field @error('email') has-error @enderror">
                        <label for="email">Почта<span class="req">*</span></label>
                        <input type="email" id="email" name="email" class="input"
                               value="{{ old('email') }}" placeholder="name@example.com"
                               autocomplete="email" required>
                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('phone') has-error @enderror">
                        <label for="phone">Телефон<span class="req">*</span></label>
                        <input type="tel" id="phone" name="phone" class="input"
                               value="{{ old('phone') }}" placeholder="+7 777 123 45 67"
                               autocomplete="tel" inputmode="tel" required>
                        @error('phone')<span class="error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="field @error('message') has-error @enderror">
                    <label for="message">Опишите проблему<span class="req">*</span></label>
                    <textarea id="message" name="message" class="textarea" maxlength="5000"
                              placeholder="Что произошло, на каком экране, когда началась проблема…"
                              required>{{ old('message') }}</textarea>
                    <div class="hint">
                        @error('message')<span class="error">{{ $message }}</span>@else<span>Минимум 10 символов</span>@enderror
                        <span id="counter">0 / 5000</span>
                    </div>
                </div>

                <button type="submit" class="btn" id="submit-btn">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                    </svg>
                    Отправить обращение
                </button>
            </form>
        @endif
    </div>

    {{-- Другие способы связи --}}
    <div class="card">
        <div class="card-label">
            <span class="dot"></span>
            Другие способы связи
        </div>
        <h2>Напишите на почту</h2>
        <p>Если форма не работает, отправьте письмо напрямую — укажите номер телефона, привязанный к аккаунту.</p>

        <div class="contact-block">
            <div class="contact-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0l-9.75 6.75L2.25 6.75"/>
                </svg>
            </div>
            <div class="contact-info">
                <small>Электронная почта</small>
                <a href="mailto:{{ config('app.support_email', 'support@nuriddin.tours') }}">
                    {{ config('app.support_email', 'support@nuriddin.tours') }}
                </a>
            </div>
        </div>
    </div>

    {{-- Подвал --}}
    <div class="footer">
        <p>
            <a href="{{ route('privacy-policy') }}">Политика конфиденциальности</a>
            &nbsp;·&nbsp;
            <a href="{{ route('delete-account') }}">Удаление аккаунта</a>
        </p>
    </div>

</div>

<script>
    (function () {
        var phone = document.getElementById('phone');
        var message = document.getElementById('message');
        var counter = document.getElementById('counter');
        var form = document.getElementById('support-form');

        if (phone) {
            var formatPhone = function (value) {
                var x = value.replace(/\D/g, '');
                if (!x) return '';
                if (x[0] === '8') x = '7' + x.slice(1);
                if (x[0] !== '7') x = '7' + x;
                x = x.slice(0, 11);

                var formatted = '+7';
                if (x.length > 1) formatted += ' ' + x.substring(1, 4);
                if (x.length > 4) formatted += ' ' + x.substring(4, 7);
                if (x.length > 7) formatted += ' ' + x.substring(7, 9);
                if (x.length > 9) formatted += ' ' + x.substring(9, 11);
                return formatted;
            };

            phone.value = formatPhone(phone.value);
            phone.addEventListener('input', function (e) {
                e.target.value = formatPhone(e.target.value);
            });
        }

        if (message && counter) {
            var updateCounter = function () {
                counter.textContent = message.value.length + ' / 5000';
            };
            updateCounter();
            message.addEventListener('input', updateCounter);
        }

        if (form) {
            var submitBtn = document.getElementById('submit-btn');
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
            });
            // Re-enable when the page is restored from the back/forward cache
            window.addEventListener('pageshow', function () {
                submitBtn.disabled = false;
            });
        }
    })();
</script>
</body>

</html>
