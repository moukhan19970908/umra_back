<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление аккаунта – YourApp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600&family=Onest:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0d0f14;
            --surface: #13161d;
            --surface-2: #1a1e28;
            --border: rgba(255,255,255,0.07);
            --text: #e8eaf0;
            --muted: #6b7080;
            --accent: #e05252;
            --accent-soft: rgba(224,82,82,0.12);
            --accent-glow: rgba(224,82,82,0.25);
            --green: #52c47e;
            --green-soft: rgba(82,196,126,0.1);
            --amber: #e0a052;
            --amber-soft: rgba(224,160,82,0.1);
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
            background: radial-gradient(circle, rgba(224,82,82,0.07) 0%, transparent 70%);
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
            margin-bottom: 48px;
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
        h1 span {
            color: var(--accent);
        }
        .subtitle {
            margin-top: 14px;
            font-size: 15px;
            color: var(--muted);
            line-height: 1.6;
            font-weight: 300;
        }

        /* Divider */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 36px 0;
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
        .card:hover { border-color: rgba(255,255,255,0.12); }
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.18s; }
        .card:nth-child(3) { animation-delay: 0.26s; }
        .card:nth-child(4) { animation-delay: 0.34s; }

        .card-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Unbounded', sans-serif;
            font-size: 9px;
            font-weight: 400;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 16px;
        }
        .card-label .dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--muted);
            opacity: 0.5;
        }
        .card-label.accent { color: var(--accent); }
        .card-label.accent .dot { background: var(--accent); opacity: 1; }

        .card h2 {
            font-family: 'Unbounded', sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: -0.01em;
            margin-bottom: 10px;
            color: var(--text);
        }
        .card p {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.65;
            font-weight: 300;
        }

        /* Email method */
        .email-block {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 18px;
            padding: 14px 18px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 10px;
        }
        .email-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .email-icon svg { width: 16px; height: 16px; color: var(--accent); }
        .email-info { flex: 1; min-width: 0; }
        .email-info small {
            display: block;
            font-size: 11px;
            color: var(--muted);
            font-weight: 400;
            margin-bottom: 2px;
            letter-spacing: 0.03em;
        }
        .email-info a {
            color: var(--text);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: -0.01em;
            transition: color 0.2s;
        }
        .email-info a:hover { color: var(--accent); }

        /* Steps list */
        .steps {
            margin-top: 18px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .step {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 14px;
            color: var(--muted);
            line-height: 1.5;
        }
        .step-num {
            width: 22px;
            height: 22px;
            border-radius: 6px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Unbounded', sans-serif;
            font-size: 9px;
            font-weight: 600;
            color: var(--muted);
            flex-shrink: 0;
            margin-top: 1px;
        }

        /* Consequences list */
        .consequence-list {
            margin-top: 18px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .consequence-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 400;
            line-height: 1.45;
        }
        .consequence-item.warn {
            background: var(--accent-soft);
            color: #f0a0a0;
            border: 1px solid rgba(224,82,82,0.15);
        }
        .consequence-item.ok {
            background: var(--green-soft);
            color: #8de8b0;
            border: 1px solid rgba(82,196,126,0.12);
        }
        .consequence-item svg { width: 15px; height: 15px; flex-shrink: 0; }

        /* Retention note */
        .retention-note {
            display: flex;
            gap: 14px;
            padding: 16px 18px;
            background: var(--amber-soft);
            border: 1px solid rgba(224,160,82,0.15);
            border-radius: 12px;
            margin-top: 8px;
        }
        .retention-note svg { width: 16px; height: 16px; color: var(--amber); flex-shrink: 0; margin-top: 2px; }
        .retention-note p { font-size: 13.5px; color: #d4b07a; line-height: 1.6; font-weight: 400; }

        /* CTA Button */
        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 22px;
            padding: 13px 24px;
            background: var(--accent);
            color: #fff;
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
        .btn-danger:hover {
            background: #c94444;
            box-shadow: 0 0 28px var(--accent-glow);
            transform: translateY(-1px);
        }
        .btn-danger:active { transform: translateY(0); }
        .btn-danger svg { width: 15px; height: 15px; }

        /* Footer */
        .footer {
            margin-top: 48px;
            text-align: center;
            animation: fadeUp 0.6s ease 0.42s both;
        }
        .footer p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.7;
        }
        .footer a {
            color: var(--text);
            text-decoration: underline;
            text-underline-offset: 3px;
            text-decoration-color: var(--border);
            transition: color 0.2s, text-decoration-color 0.2s;
        }
        .footer a:hover { color: var(--accent); text-decoration-color: var(--accent); }
    </style>
</head>
<body>

<div class="wrapper">

    {{-- Заголовок --}}
    <div class="header">
        <div class="app-name">YourApp</div>
        <h1>Удаление <span>аккаунта</span></h1>
        <p class="subtitle">
            Если вы хотите удалить аккаунт и все связанные данные,<br>
            воспользуйтесь одним из способов ниже.
        </p>
    </div>

    {{-- Способ 1: Email --}}
    <div class="card">
        <div class="card-label accent">
            <span class="dot"></span>
            Способ 1
        </div>
        <h2>Запрос по электронной почте</h2>
        <p>Отправьте письмо на адрес поддержки, указав зарегистрированный email и запрос на удаление аккаунта.</p>

        <div class="email-block">
            <div class="email-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0l-9.75 6.75L2.25 6.75"/>
                </svg>
            </div>
            <div class="email-info">
                <small>Электронная почта</small>
                <a href="mailto:{{ config('app.support_email', 'support@nuriddin.tours') }}">
                    {{ config('app.support_email', 'support@nuriddin.tours') }}
                </a>
            </div>
        </div>

        <div class="steps">
            <div class="step">
                <div class="step-num">01</div>
                <span>Укажите адрес электронной почты, привязанный к аккаунту</span>
            </div>
            <div class="step">
                <div class="step-num">02</div>
                <span>В теме письма напишите: «Удаление аккаунта»</span>
            </div>
            <div class="step">
                <div class="step-num">03</div>
                <span>Мы обработаем запрос в течение рабочего дня</span>
            </div>
        </div>
    </div>

    {{-- Способ 2: Форма --}}
    <div class="card">
        <div class="card-label">
            <span class="dot"></span>
            Способ 2
        </div>
        <h2>Форма удаления аккаунта</h2>
        <p>Заполните форму прямо здесь — это самый быстрый способ подать запрос.</p>

        @if(isset($deletionFormEnabled) && $deletionFormEnabled)
            {{-- Вставьте сюда вашу форму --}}
            @include('partials.account-deletion-form')
        @else
            <form method="post" action="{{route('delete.account')}}">
                {{ csrf_field() }}
                <label>Телефон</label><br>
                <input type="text" id="phone" name="phone" required style="width: 100%; padding: 10px; margin-top: 6px; border-radius: 8px; border: 1px solid var(--border); background: var(--surface-2); color: var(--text);"><br>
                <label>Пароль</label>
                <input type="password" name="password" required style="width: 100%; padding: 10px; margin-top: 6px; border-radius: 8px; border: 1px solid var(--border); background: var(--surface-2); color: var(--text);"><br>
                <button type="submit"  class="btn-danger">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3h-3.32l-.94-1.94A1.5 1.5 0 0010.02 3H7.34m6.384 0a1.5 1.5 0 00-1.415-1h-2.95a1.5 1.5 0 00-1.414 1H3m6.384 0V4a1.5 1.5 0 013 0v1h-3z"/>
                    </svg>
                    Удалить аккаунт
                </button>
            </form>
        @endif
    </div>

    {{-- Что происходит после --}}
    <div class="card">
        <div class="card-label">
            <span class="dot"></span>
            После подачи запроса
        </div>
        <h2>Что произойдёт с вашими данными</h2>
        <p>После обработки запроса будут выполнены следующие действия:</p>

        <div class="consequence-list">
            <div class="consequence-item warn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
                Аккаунт будет удалён безвозвратно
            </div>
            <div class="consequence-item ok">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                Все персональные данные будут удалены в течение 30 дней
            </div>
        </div>
    </div>

    {{-- Хранение данных --}}
    <div class="card">
        <div class="card-label">
            <span class="dot"></span>
            Хранение данных
        </div>
        <h2>Исключения</h2>

        <div class="retention-note">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
            </svg>
            <p>
                Часть данных может быть сохранена, если это требуется по закону или необходимо
                для обеспечения безопасности и предотвращения мошенничества.
            </p>
        </div>
    </div>

    {{-- Подвал --}}
    <div class="footer">
        <p>
            Возникли вопросы? Свяжитесь с нами:<br>
            <a href="mailto:{{ config('app.support_email', 'support@yourapp.com') }}">
                {{ config('app.support_email', 'support@yourapp.com') }}
            </a>
        </p>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>

<script>
    document.getElementById('phone').addEventListener('input', function (e) {
        let x = e.target.value.replace(/\D/g, '').slice(0, 11);

        let formatted = '+7 ';

        if (x.length > 1) formatted += x.substring(1, 4);
        if (x.length >= 4) formatted += ' ' + x.substring(4, 7);
        if (x.length >= 7) formatted += ' ' + x.substring(7, 9);
        if (x.length >= 9) formatted += ' ' + x.substring(9, 11);

        e.target.value = formatted;
    });
</script>
</body>

</html>
