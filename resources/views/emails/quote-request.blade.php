<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Quote Request — Touch2finish</title>
    <style>
        /* ── Reset ── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* ── Brand tokens (from app.css) ── */
        :root {
            --brand-navy: #071b3b;
            /* section-heading / dark surfaces     */
            --brand-gold: #e2ae49;
            /* btn-primary / eyebrow / accents      */
            --brand-gold-h: #d9a43e;
            /* gold hover                           */
            --brand-teal: #157d9a;
            /* btn-secondary / links                */
            --brand-teal-d: #0d5876;
            /* teal dark / hover                    */
            --brand-slate: #485465;
            /* body text                            */
            --brand-slate-l: #8995a3;
            /* muted / labels                       */
            --surface: #f7f9fb;
            /* card backgrounds                     */
            --border: #e5e9ef;
            /* borders                              */
        }

        body {
            background-color: #f0f4f8;
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
            color: var(--brand-slate);
            padding: 2rem 1rem;
        }

        /* ── Shell ── */
        .email-shell {
            max-width: 620px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        /* ── Header ── */
        .email-header {
            background: var(--brand-navy);
            padding: 1.75rem 2.25rem;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-mark {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: var(--brand-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .logo-name {
            font-family: "Sora", "Inter", system-ui, sans-serif;
            font-size: 19px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.02em;
        }

        .logo-tagline {
            font-size: 10.5px;
            color: var(--brand-gold);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .header-badge {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(226, 174, 73, 0.12);
            border: 1px solid rgba(226, 174, 73, 0.3);
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 11.5px;
            color: var(--brand-gold);
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--brand-gold);
            flex-shrink: 0;
        }

        /* ── Body ── */
        .email-body {
            padding: 1.75rem 2.25rem;
        }

        .intro {
            font-size: 13.5px;
            color: var(--brand-slate);
            line-height: 1.65;
            margin-bottom: 1.5rem;
            border-left: 3px solid var(--brand-gold);
            background: rgba(226, 174, 73, 0.06);
            border-radius: 0 8px 8px 0;
            padding: 10px 14px;
        }

        .intro strong {
            color: var(--brand-navy);
            font-weight: 600;
        }

        /* Eyebrow — mirrors .eyebrow component */
        .eyebrow {
            display: inline-block;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-size: 10px;
            color: var(--brand-gold);
            background: rgba(226, 174, 73, 0.1);
            border-radius: 20px;
            padding: 3px 10px;
            margin-bottom: 10px;
        }

        /* ── Client detail grid ── */
        .field-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 1.25rem;
        }

        .field {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 11px 14px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field-label {
            font-size: 10.5px;
            color: var(--brand-slate-l);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-bottom: 4px;
        }

        .field-value {
            font-size: 13.5px;
            color: var(--brand-navy);
            font-weight: 500;
        }

        .field-value a {
            color: var(--brand-teal);
            text-decoration: none;
        }

        /* ── Service pill ── */
        .service-wrap {
            margin-bottom: 1.25rem;
        }

        .service-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(21, 125, 154, 0.08);
            border: 1px solid rgba(21, 125, 154, 0.2);
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 13px;
            color: var(--brand-teal-d);
            font-weight: 600;
        }

        /* ── Divider — gold-rule inspired ── */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 1.25rem 0;
        }

        /* ── Message panel ── */
        .message-box {
            background: var(--surface);
            border-left: 3px solid var(--brand-gold);
            border-radius: 0 10px 10px 0;
            padding: 1rem 1.25rem;
            margin-top: 10px;
        }

        .message-text {
            font-size: 13.5px;
            color: var(--brand-slate);
            line-height: 1.7;
            font-style: italic;
        }

        /* ── CTAs — mirrors btn-primary / btn-secondary ── */
        .cta-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--brand-gold);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 11px 20px;
            font-size: 13.5px;
            font-family: "Inter", system-ui, sans-serif;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 20px -2px rgba(226, 174, 73, 0.35);
        }

        .btn-primary:hover {
            background: var(--brand-gold-h);
            box-shadow: 0 10px 28px -4px rgba(226, 174, 73, 0.48);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--brand-teal);
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 11px 18px;
            font-size: 13.5px;
            font-family: "Inter", system-ui, sans-serif;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 4px 16px -2px rgba(21, 125, 154, 0.25);
        }

        .deadline {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #c0392b;
            font-weight: 600;
            white-space: nowrap;
        }

        /* ── Footer ── */
        .email-footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            padding: 1.1rem 2.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-text {
            font-size: 11.5px;
            color: var(--brand-slate-l);
            line-height: 1.5;
        }

        .footer-text a {
            color: var(--brand-teal);
        }

        .footer-brand {
            margin-left: auto;
            font-family: "Sora", "Inter", system-ui, sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: var(--brand-gold);
            letter-spacing: -0.01em;
        }

        /* ── Responsive ── */
        @media (max-width: 520px) {

            .email-body,
            .email-header,
            .email-footer {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }

            .field-grid {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: 1;
            }

            .cta-row {
                flex-direction: column;
                align-items: stretch;
            }

            .deadline {
                margin-left: 0;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="email-shell">

        {{-- ── Header ── --}}
        <div class="email-header">
            <div class="logo-mark">
                {{-- Inline SVG so it renders in all email clients --}}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 2.5C7.3 2.5 3.5 6.3 3.5 11c0 2.8 1.4 5.3 3.5 6.8V21l2.5-1.8c.8.2 1.6.3 2.5.3 4.7 0 8.5-3.8 8.5-8.5S16.7 2.5 12 2.5z"
                        fill="#071b3b" opacity="0.25" />
                    <path d="M8 10.8l2.8 2.8 5.2-5.6" stroke="#fff" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="logo-text">
                <span class="logo-name">Touch2finish</span>
                <span class="logo-tagline">Professional Finishing Services</span>
            </div>
            <div class="header-badge">
                <div class="badge-dot"></div>
                New enquiry
            </div>
        </div>

        {{-- ── Body ── --}}
        <div class="email-body">

            <p class="intro">
                A new quote request has arrived via the Touch2finish website.
                Please review the details and respond within <strong>24 hours</strong>
                to maintain your service standard.
            </p>

            {{-- Client details --}}
            <span class="eyebrow">Client details</span>
            <div class="field-grid">
                <div class="field">
                    <div class="field-label">Name</div>
                    <div class="field-value">{{ $quoteData['name'] }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Phone</div>
                    <div class="field-value">{{ $quoteData['phone'] }}</div>
                </div>
                <div class="field full">
                    <div class="field-label">Email</div>
                    <div class="field-value">
                        <a href="mailto:{{ $quoteData['email'] }}">{{ $quoteData['email'] }}</a>
                    </div>
                </div>
            </div>

            {{-- Service --}}
            <span class="eyebrow">Service requested</span>
            <div class="service-wrap">
                <span class="service-pill">{{ $quoteData['service'] }}</span>
            </div>

            <div class="divider"></div>

            {{-- Project details --}}
            <span class="eyebrow">Project details</span>
            <div class="message-box">
                <p class="message-text">{{ $quoteData['message'] }}</p>
            </div>

            {{-- CTAs --}}
            <div class="cta-row">
                <a class="btn-primary"
                    href="mailto:{{ $quoteData['email'] }}?subject=Re: Your Touch2finish Quote Request for {{ urlencode($quoteData['service']) }}">
                    ✉ Reply to {{ $quoteData['name'] }}
                </a>
                <a class="btn-secondary" href="tel:{{ $quoteData['phone'] }}">
                    ☎ Call client
                </a>
                <div class="deadline">⏱ Within 24 hrs</div>
            </div>

        </div>{{-- /email-body --}}

        {{-- ── Footer ── --}}
        <div class="email-footer">
            <div class="footer-text">
                Auto-generated by the Touch2finish system. Reply directly — client reply-to is set.<br>
                <a href="mailto:info@touch2finish.co.uk">info@touch2finish.co.uk</a>
            </div>
            <div class="footer-brand">Touch2finish</div>
        </div>

    </div>{{-- /email-shell --}}

</body>

</html>
