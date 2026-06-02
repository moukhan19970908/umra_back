<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Политика конфиденциальности — Nuriddin Tour</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #f7f5f0;
            --surface:   #ffffff;
            --border:    #e8e4dc;
            --text:      #1a1814;
            --muted:     #7a756c;
            --accent:    #2b5c3f;
            --accent-lt: #edf4f0;
            --accent-md: #c4ddd0;
            --num:       #2b5c3f;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Geologica', sans-serif;
            font-weight: 300;
            font-size: 15px;
            line-height: 1.75;
            min-height: 100vh;
            padding: 56px 20px 80px;
        }

        .page {
            max-width: 740px;
            margin: 0 auto;
        }

        /* ── Header ── */
        .header {
            margin-bottom: 52px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--border);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            background: var(--accent-lt);
            border: 1px solid var(--accent-md);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 20px;
        }

        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
        }

        h1 {
            font-size: clamp(26px, 5vw, 38px);
            font-weight: 600;
            letter-spacing: -0.025em;
            line-height: 1.15;
            color: var(--text);
            margin-bottom: 14px;
        }

        .header-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--muted);
        }

        .meta-item svg { width: 14px; height: 14px; flex-shrink: 0; }

        /* ── Sections ── */
        .sections { display: flex; flex-direction: column; gap: 4px; }

        .section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: border-color .2s;
        }
        .section:hover { border-color: var(--accent-md); }

        .section-inner { padding: 28px 32px; }

        .section-head {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 18px;
        }

        .section-num {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--accent-lt);
            border: 1px solid var(--accent-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Geologica', sans-serif;
            font-size: 12px;
            font-weight: 600;
            color: var(--num);
            margin-top: 2px;
        }

        h2 {
            font-size: 17px;
            font-weight: 600;
            letter-spacing: -0.01em;
            color: var(--text);
            line-height: 1.3;
        }

        .section-body { padding-left: 48px; }

        .section-body p {
            font-size: 14.5px;
            color: #3d3a35;
            line-height: 1.75;
        }

        /* ── List ── */
        .pp-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .pp-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 14.5px;
            color: #3d3a35;
            line-height: 1.65;
        }

        .pp-list li::before {
            content: '';
            flex-shrink: 0;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--accent);
            margin-top: 9px;
        }

        /* ── Contact card ── */
        .contact-card {
            background: var(--accent-lt);
            border: 1px solid var(--accent-md);
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .contact-row svg { width: 16px; height: 16px; color: var(--accent); flex-shrink: 0; }

        .contact-row .label {
            font-size: 12px;
            color: var(--muted);
            min-width: 70px;
            font-weight: 400;
        }

        .contact-row .value { color: var(--text); font-weight: 500; }

        .contact-row a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }
        .contact-row a:hover { text-decoration: underline; }

        /* ── Footer ── */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 13px;
            color: var(--muted);
        }

        @media (max-width: 520px) {
            .section-inner { padding: 20px 18px; }
            .section-body { padding-left: 0; margin-top: 12px; }
            .section-head { gap: 12px; }
        }
    </style>
</head>
<body>

<div class="page">

    {{-- ─── Заголовок ─── --}}
    <header class="header">
        <div class="badge">Nuriddin Tour</div>
        <h1>Политика конфиденциальности</h1>
        <div class="header-meta">
            <div class="meta-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/>
                </svg>
                Дата вступления в силу: 28 мая 2026 г.
            </div>
            <div class="meta-item">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                </svg>
                8 разделов
            </div>
        </div>
    </header>

    {{-- ─── Разделы ─── --}}
    <div class="sections">

        {{-- 1. Какие данные мы собираем --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">01</div>
                    <h2>Какие данные мы можем собирать</h2>
                </div>
                <div class="section-body">
                    <ul class="pp-list">
                        <li>Имя и номер телефона пользователя</li>
                        <li>Адрес электронной почты</li>
                        <li>Данные, предоставленные при бронировании туров</li>
                        <li>Технические данные устройства (модель, версия ОС, язык)</li>
                        <li>Данные об использовании приложения</li>
                        <li>Данные геолокации (только при разрешении пользователя)</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 2. Как используются данные --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">02</div>
                    <h2>Как используются данные</h2>
                </div>
                <div class="section-body">
                    <ul class="pp-list">
                        <li>Предоставление услуг и работа приложения</li>
                        <li>Обработка заявок и бронирований</li>
                        <li>Связь с пользователем</li>
                        <li>Улучшение качества работы приложения</li>
                        <li>Обеспечение безопасности и предотвращение мошенничества</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 3. Передача данных третьим лицам --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">03</div>
                    <h2>Передача данных третьим лицам</h2>
                </div>
                <div class="section-body">
                    <p style="margin-bottom:14px;">
                        Мы не продаём и не передаём персональные данные третьим лицам, за исключением случаев:
                    </p>
                    <ul class="pp-list">
                        <li>Когда это необходимо для предоставления услуг</li>
                        <li>По требованию законодательства</li>
                        <li>Для работы сервисов аналитики и уведомлений</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- 4. Хранение и защита данных --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">04</div>
                    <h2>Хранение и защита данных</h2>
                </div>
                <div class="section-body">
                    <p>
                        Мы принимаем необходимые меры для защиты данных пользователей от
                        несанкционированного доступа, изменения, раскрытия или уничтожения.
                    </p>
                </div>
            </div>
        </div>

        {{-- 5. Разрешения устройства --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">05</div>
                    <h2>Разрешения устройства</h2>
                </div>
                <div class="section-body">
                    <p style="margin-bottom:14px;">Приложение может запрашивать доступ к:</p>
                    <ul class="pp-list">
                        <li>Интернету — для работы сервисов</li>
                        <li>Геолокации — для отображения маршрутов и туров</li>
                        <li>Телефону или уведомлениям — для связи и информирования пользователя</li>
                    </ul>
                    <p style="margin-top:14px;">
                        Все разрешения используются только в рамках функциональности приложения.
                    </p>
                </div>
            </div>
        </div>

        {{-- 6. Конфиденциальность детей --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">06</div>
                    <h2>Конфиденциальность детей</h2>
                </div>
                <div class="section-body">
                    <p>
                        Приложение не предназначено для детей младше 13 лет.
                        Мы не собираем персональные данные детей сознательно.
                    </p>
                </div>
            </div>
        </div>

        {{-- 7. Изменения политики --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">07</div>
                    <h2>Изменения политики</h2>
                </div>
                <div class="section-body">
                    <p>
                        Мы можем периодически обновлять настоящую Политику конфиденциальности.
                        Обновлённая версия будет опубликована в приложении или на официальной странице.
                    </p>
                </div>
            </div>
        </div>

        {{-- 8. Контакты --}}
        <div class="section">
            <div class="section-inner">
                <div class="section-head">
                    <div class="section-num">08</div>
                    <h2>Контакты</h2>
                </div>
                <div class="section-body">
                    <p style="margin-bottom:16px;">
                        Если у вас есть вопросы, связанные с Политикой конфиденциальности,
                        свяжитесь с нами:
                    </p>
                    <div class="contact-card">
                        <div class="contact-row">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
                            </svg>
                            <span class="label">Компания</span>
                            <span class="value">ТОО «НУРИДДИН» / Nuriddin Tour</span>
                        </div>
                        <div class="contact-row">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0l-9.75 6.75L2.25 6.75"/>
                            </svg>
                            <span class="label">Email</span>
                            <a href="mailto:{{ config('app.contact_email', 'bikokb@icloud.com') }}">
                                {{ config('app.contact_email', 'bikokb@icloud.com') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- /sections --}}

    {{-- ─── Footer ─── --}}
    <footer class="footer">
        <p>© {{ date('Y') }} ТОО «НУРИДДИН». Все права защищены.</p>
    </footer>

</div>

</body>
</html>
