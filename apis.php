<!-- Kurz: konsolidiert, LCP-Preload für Hero, A11y (aria-*), saubere JSON-LD, keine doppelten Icon-CSS (Icons via styles.css @import), CLS-sichere Bilddimensionen, JS/CSS non-blocking. -->

<?php /* /apis.php */ ?>
<!DOCTYPE html>
<html lang="de-AT" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- SEO -->
  <title>API Entwicklung & Schnittstellen in Wien | Integration & Automation | SoftwareDirekt</title>
  <meta name="description" content="API-Entwicklung & Schnittstellen in Wien: sichere Integrationen, Automatisierung, Datenmigration, Monitoring & Support. Jetzt unverbindlich beraten lassen!">
  <meta name="robots" content="index, follow">
  <meta name="language" content="de-AT">
  <meta name="geo.region" content="AT-9">
  <meta name="geo.placename" content="Wien">
  <meta name="theme-color" content="#1571F7">
  <link rel="canonical" href="https://softwaredirekt.at/apis.php">

  <!-- Open Graph / Twitter -->
  <meta property="og:locale" content="de_AT">
  <meta property="og:type" content="website">
  <meta property="og:title" content="API Entwicklung & Schnittstellen in Wien | SoftwareDirekt">
  <meta property="og:description" content="Maßgeschneiderte APIs & sichere Integrationen: REST, GraphQL, Webhooks, OAuth2, Monitoring.">
  <meta property="og:url" content="https://softwaredirekt.at/apis.php">
  <meta property="og:site_name" content="SoftwareDirekt">
  <meta property="og:image" content="https://softwaredirekt.at/assets/img/apis-header.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="API Entwicklung & Schnittstellen in Wien | SoftwareDirekt">
  <meta name="twitter:description" content="Integrationen, Automatisierung & Datenmigration – sicher, performant, dokumentiert.">
  <meta name="twitter:image" content="https://softwaredirekt.at/assets/img/apis-header.jpg">
  <meta name="twitter:site" content="@SoftwareDirekt">

  <!-- Favicons -->
  <link rel="icon" href="https://softwaredirekt.at/assets/favicon.ico" type="image/x-icon">

  <!-- Resource Hints -->
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="image"
    href="/assets/img/web-banner.webp"
    imagesrcset="/assets/img/web-banner.webp 1400w, /assets/img/web-banner-1024.webp 1024w, /assets/img/web-banner-768.webp 768w"
    imagesizes="(min-width:1024px) 100vw, 100vw">
  <link rel="preload" href="/assets/fonts/Roboto.woff2" as="font" type="font/woff2" crossorigin>

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <!-- Icons kommen über styles.css via @import -->
  <link rel="stylesheet" href="/assets/css/styles.css">

  <!-- Trustpilot (nach Consent laden; Platzhalter async) -->
  <script src="https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async defer></script>

  <!-- JSON-LD: LocalBusiness -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "SoftwareDirekt",
      "image": "https://softwaredirekt.at/assets/img/apis-header.jpg",
      "url": "https://softwaredirekt.at/apis.php",
      "telephone": "+43-660-64-48-088",
      "email": "office@softwaredirekt.at",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Liesinger Hauptstraße 42",
        "addressLocality": "Wien",
        "addressRegion": "Wien",
        "postalCode": "1230",
        "addressCountry": "AT"
      },
      "areaServed": "AT",
      "sameAs": [
        "https://www.linkedin.com/company/softwaredirekt/",
        "https://www.facebook.com/softwaredirekt"
      ],
      "description": "API-Entwicklung & Schnittstellen Wien – sichere Integrationen, Automatisierung, Datenmigration, Monitoring & Support."
    }
  </script>

  <!-- JSON-LD: BreadcrumbList -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
          "@type": "ListItem",
          "position": 1,
          "name": "Startseite",
          "item": "https://softwaredirekt.at/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "API Entwicklung",
          "item": "https://softwaredirekt.at/apis.php"
        }
      ]
    }
  </script>

  <!-- JSON-LD: FAQPage (spiegelt die sichtbaren FAQs) -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [{
          "@type": "Question",
          "name": "Entwickeln Sie individuelle APIs oder nur Standardschnittstellen?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Wir entwickeln maßgeschneiderte APIs (REST, GraphQL, Webhooks, SOAP) und integrieren ebenso externe Systeme – passgenau zu Ihren Anforderungen."
          }
        },
        {
          "@type": "Question",
          "name": "Wie läuft ein API-Projekt bei Ihnen ab?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "1) Erstberatung & Analyse, 2) Schnittstellen-Design & Datenmodell, 3) Entwicklung & Tests, 4) Doku, Deployment, Monitoring & Support."
          }
        },
        {
          "@type": "Question",
          "name": "Welche Authentifizierung & Sicherheitsmaßnahmen setzen Sie ein?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "OAuth2, JWT, API-Keys, TLS, Rate Limiting, Logging, Monitoring. DSGVO-konforme Umsetzung und Security-Reviews inklusive."
          }
        },
        {
          "@type": "Question",
          "name": "Was kostet eine API-Entwicklung?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Der Preis hängt von Komplexität, Authentifizierung und Integrationsumfang ab. Nach dem Erstgespräch erhalten Sie ein verbindliches, transparentes Angebot."
          }
        }
      ]
    }
  </script>
</head>

<body>
  <a class="visually-hidden-focusable" href="#hauptinhalt">Zum Inhalt springen</a>

  <?php include 'includes/nav.php'; ?>



  <main id="hauptinhalt" role="main">
    <!-- HERO -->
    <section class="hero-section-web position-relative" id="web-hero" aria-labelledby="api-hero-title">
      <div class="hero-web-bg" aria-hidden="true"></div>
      <div class="container py-5">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-12 col-lg-8 text-white">
            <span class="hero-topic badge rounded-pill mb-3 px-4 py-2 fs-6 fw-semibold">API-Entwicklung & Schnittstellen aus Wien</span>
            <h1 id="api-hero-title" class="hero-main-title mb-3">
              Systeme verbinden, <span class="text-gradient">Prozesse automatisieren – sicher &amp; skalierbar</span>
            </h1>
            <p class="h4 fw-normal mb-3 text-light">Weniger manueller Aufwand. Saubere Daten. Schnellere Abläufe.</p>
            <p class="mb-4">
              Wir planen und entwickeln <strong>performante, dokumentierte und sichere APIs</strong> – von REST/GraphQL bis Webhooks.
              Mit sauberem Monitoring, klarer Doku und persönlichem Support direkt aus Wien.
            </p>
            <div class="d-flex gap-3 flex-wrap text-center justify-content-center">
              <a href="/kontakt.php?typ=api" class="btn btn-blue btn-lg px-5 hero-cta mb-3" aria-label="API-Beratung anfordern">
                <i class="bi bi-diagram-3 me-2" aria-hidden="true"></i>Jetzt API-Beratung sichern
              </a>
              <a href="/kontakt.php?typ=referenzen" class="btn btn-outline-light btn-lg px-4 rounded-4 mb-3" aria-label="API Referenzen anfordern">
                <i class="bi bi-collection me-2" aria-hidden="true"></i>Referenzen anfordern
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- USPs -->
    <section class="usp-section py-5 bg-white border-bottom" aria-labelledby="usp-title">
      <div class="container">
        <div class="row text-center">
          <div class="col-12">
            <h2 id="usp-title" class="fw-bold mb-2">Warum <span class="text-gradient">SoftwareDirekt</span>?</h2>
            <p class="text-secondary fs-5 mb-0">API-Entwicklung mit maximaler Sicherheit, Performance &amp; Zukunftssicherheit.</p>
          </div>
        </div>

        <div class="custom-divider my-5" role="img" aria-label="Dekoratives Trenner-Element mit Logo">
          <hr class="divider-line"><img src="/assets/logo/logo-small.png" alt="Logo SoftwareDirekt" class="divider-logo" width="120" height="42" loading="lazy" decoding="async">
          <hr class="divider-line">
        </div>

        <div class="row g-4 text-center" role="list">
          <div class="col-md-6 col-lg-3" role="listitem">
            <div class="usp-card p-4 rounded-4 shadow-sm h-100 bg-light">
              <span class="icon-badge grad-blue mb-3" aria-hidden="true"><i class="bi bi-shield-lock"></i></span>
              <div class="fw-bold mb-1">Sichere Authentifizierung</div>
              <div class="small text-muted">OAuth2, JWT, API-Keys, Rate-Limiting, DSGVO-ready.</div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3" role="listitem">
            <div class="usp-card p-4 rounded-4 shadow-sm h-100 bg-light">
              <span class="icon-badge grad-purple mb-3" aria-hidden="true"><i class="bi bi-diagram-3"></i></span>
              <div class="fw-bold mb-1">Flexible Protokolle</div>
              <div class="small text-muted">REST, GraphQL, SOAP, Webhooks, JSON, XML.</div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3" role="listitem">
            <div class="usp-card p-4 rounded-4 shadow-sm h-100 bg-light">
              <span class="icon-badge grad-green mb-3" aria-hidden="true"><i class="bi bi-cloud-arrow-up"></i></span>
              <div class="fw-bold mb-1">Cloud &amp; On-Premise</div>
              <div class="small text-muted">AWS, Azure, eigene Rechenzentren – sauber integriert.</div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3" role="listitem">
            <div class="usp-card p-4 rounded-4 shadow-sm h-100 bg-light">
              <span class="icon-badge grad-orange mb-3" aria-hidden="true"><i class="bi bi-activity"></i></span>
              <div class="fw-bold mb-1">Monitoring &amp; Support</div>
              <div class="small text-muted">Logging, Alerting, SLAs &amp; persönlicher Ansprechpartner.</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TECHSTACK -->
    <section class="techstack-section py-5 bg-gradient-app-problem border-bottom" aria-labelledby="stack-title">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 id="stack-title" class="fw-bold mb-3 text-white">Unser API-Stack</h2>
            <p class="text-white-50 mb-4">Bewährte Technologien für performante, sichere APIs &amp; Integrationen.</p>

            <div class="custom-divider mb-5" role="img" aria-label="Dekoratives Trenner-Element mit Logo">
              <hr class="divider-line"><img src="/assets/logo/logo-small.png" alt="Logo SoftwareDirekt" class="divider-logo" width="120" height="42" loading="lazy" decoding="async">
              <hr class="divider-line">
            </div>

            <div class="d-flex flex-wrap gap-3 justify-content-center">
              <span class="badge bg-primary fs-6 px-3 py-2">PHP 8+</span>
              <span class="badge bg-info fs-6 px-3 py-2">Node.js</span>
              <span class="badge bg-success fs-6 px-3 py-2">Laravel</span>
              <span class="badge bg-secondary fs-6 px-3 py-2">Swagger / OpenAPI</span>
              <span class="badge bg-dark fs-6 px-3 py-2">REST</span>
              <span class="badge bg-warning text-dark fs-6 px-3 py-2">GraphQL</span>
              <span class="badge bg-pink fs-6 px-3 py-2">MySQL</span>
              <span class="badge bg-light text-dark fs-6 px-3 py-2">Postman</span>
              <span class="badge bg-primary fs-6 px-3 py-2">OAuth2</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- WORKFLOW -->
    <section class="py-5 bg-white border-bottom" aria-labelledby="flow-title">
      <div class="container">
        <h2 id="flow-title" class="fw-bold text-center mb-5">So läuft Ihr API-Projekt</h2>
        <div class="row justify-content-center text-center g-4">
          <div class="col-6 col-md-3">
            <div class="step-card p-4 h-100">
              <i class="bi bi-people display-4 app-text-blue mb-3" aria-hidden="true"></i>
              <div class="fw-bold mb-1">Beratung</div>
              <div class="small text-muted">Kostenloser API-Check &amp; Ziele</div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="step-card p-4 h-100">
              <i class="bi bi-pencil-square display-4 app-text-pink mb-3" aria-hidden="true"></i>
              <div class="fw-bold mb-1">Konzeption</div>
              <div class="small text-muted">Datenmodell, Auth, Endpunkte</div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="step-card p-4 h-100">
              <i class="bi bi-code-slash display-4 app-text-green mb-3" aria-hidden="true"></i>
              <div class="fw-bold mb-1">Entwicklung &amp; Test</div>
              <div class="small text-muted">Implementierung, QA, Doku</div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="step-card p-4 h-100">
              <i class="bi bi-rocket-takeoff display-4 app-text-dark mb-3" aria-hidden="true"></i>
              <div class="fw-bold mb-1">Go-Live &amp; Betrieb</div>
              <div class="small text-muted">Deployment, Monitoring, Support</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- USE-CASE -->
    <section class="py-5 bg-gradient-app-problem text-white" aria-labelledby="case-title">
      <div class="container">
        <h2 id="case-title" class="fw-bold mb-4 text-center">Praxisbeispiel: eCommerce ↔ ERP</h2>
        <div class="row align-items-center g-4">
          <div class="col-lg-6">
            <figure class="mb-0">
              <img src="/assets/img/apis-banner.webp"
                alt="API Use Case – Shop mit ERP verbunden"
                class="img-fluid rounded-4 shadow-lg"
                loading="lazy" decoding="async"
                width="1200" height="720"
                srcset="/assets/img/apis-banner.webp 1200w, /assets/img/apis-banner-992.webp 992w, /assets/img/apis-banner-768.webp 768w"
                sizes="(min-width: 992px) 50vw, 100vw">
              <figcaption class="visually-hidden">Schematische Darstellung einer API-Integration zwischen Shop und ERP</figcaption>
            </figure>
          </div>
          <div class="col-lg-6">
            <p class="lead">
              Für CityClean Wien haben wir eine REST-API entwickelt, die Online-Shop, ERP und Buchhaltung verbindet – inkl. OAuth2, Logging/Monitoring und Live-Reporting.
              Ergebnis: <strong>100&nbsp;% fehlerfreie Übertragung</strong>, <strong>60&nbsp;% weniger manueller Aufwand</strong>.
            </p>
            <ul class="list-unstyled d-grid gap-3">
              <li class="d-flex align-items-center p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 shadow-sm">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3 bg-primary text-white" style="width:44px;height:44px;"><i class="bi bi-link-45deg" aria-hidden="true"></i></span>
                <div><span class="fw-semibold text-white d-block">REST API &amp; Doku</span><small class="text-white-50">PHP/Laravel, JSON, Swagger&nbsp;/&nbsp;OpenAPI</small></div>
              </li>
              <li class="d-flex align-items-center p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 shadow-sm">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3 bg-success text-white" style="width:44px;height:44px;"><i class="bi bi-lock" aria-hidden="true"></i></span>
                <div><span class="fw-semibold text-white d-block">OAuth2 &amp; Stabiler Betrieb</span><small class="text-white-50">Token-Rotation, strukturierte Logs, Rate-Limiting</small></div>
              </li>
              <li class="d-flex align-items-center p-3 rounded-4 bg-white bg-opacity-10 border border-white border-opacity-10 shadow-sm">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3 bg-warning text-dark" style="width:44px;height:44px;"><i class="bi bi-bar-chart" aria-hidden="true"></i></span>
                <div><span class="fw-semibold text-white d-block">Live-Reporting &amp; Dashboards</span><small class="text-white-50">KPIs &amp; Management-Übersichten in Echtzeit</small></div>
              </li>
            </ul>
            <div class="d-flex justify-content-center justify-content-lg-start mt-4">
              <a href="/kontakt.php?typ=api" class="btn btn-blue btn-lg px-5 rounded-4"><i class="bi bi-send me-2" aria-hidden="true"></i>Projekt anfragen</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- TRUST -->
    <section class="app-trust-section py-5 app-gradient-bg-white border-bottom" aria-labelledby="trust-title">
      <div class="container">
        <div class="row text-center mb-5">
          <div class="col-12">
            <h2 id="trust-title" class="app-section-title mb-2">Vertrauen von Kunden &amp; Partnern</h2>
            <p class="text-secondary mb-0">Echte Bewertungen &amp; langjährige Partnerschaften.</p>
          </div>
        </div>
        <div class="row justify-content-center text-center g-4">
          <div class="col-6 col-md-3">
            <div class="app-trust-card-modern p-4 rounded-4 shadow-sm bg-white h-100" role="group" aria-label="Über 30 API-Projekte">
              <i class="bi bi-star-fill app-icon-green mb-2" aria-hidden="true"></i>
              <div class="fw-bold fs-5 mb-1">30+ API-Projekte</div>
              <div class="small text-muted">KMU &amp; Konzerne</div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="app-trust-card-modern p-4 rounded-4 shadow-sm bg-white h-100" role="group" aria-label="Über 100 Kunden in Wien und Österreich">
              <i class="bi bi-people-fill app-icon-blue mb-2" aria-hidden="true"></i>
              <div class="fw-bold fs-5 mb-1">100+ Kunden</div>
              <div class="small text-muted">in Wien &amp; Österreich</div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="app-trust-card-modern p-4 rounded-4 shadow-sm bg-white h-100" role="group" aria-label="Zertifizierte Sicherheit">
              <i class="bi bi-shield-check app-icon-dark mb-2" aria-hidden="true"></i>
              <div class="fw-bold fs-5 mb-1">Zertifizierte Sicherheit</div>
              <div class="small text-muted">DSGVO &amp; Audits</div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="app-trust-card-modern p-4 rounded-4 shadow-sm bg-white h-100" role="group" aria-label="Seit 2012 am Markt">
              <i class="bi bi-clock-history app-icon-pink mb-2" aria-hidden="true"></i>
              <div class="fw-bold fs-5 mb-1">Seit 2012 am Markt</div>
              <div class="small text-muted">Langjährige Erfahrung</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section py-5 bg-dark text-white" id="faq" aria-labelledby="faq-title">
      <div class="container">
        <div class="row justify-content-center mb-4">
          <div class="col-lg-8 text-center">
            <h2 id="faq-title" class="fw-bold display-6">Häufige Fragen <span class="text-primary">(FAQ)</span></h2>
            <p class="lead mb-0">Alles Wichtige zu API-Entwicklung, Integration &amp; Zusammenarbeit mit <span class="fw-semibold">SoftwareDirekt</span>.</p>
          </div>
        </div>

        <div class="custom-divider my-5" role="img" aria-label="Dekoratives Trenner-Element mit Logo">
          <hr class="divider-line"><img src="/assets/logo/logo-small.png" alt="Logo SoftwareDirekt" class="divider-logo" width="120" height="42" loading="lazy" decoding="async">
          <hr class="divider-line">
        </div>

        <div class="accordion accordion-flush" id="faqAccordion" role="region" aria-labelledby="faq-title">
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq1-heading">
              <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                Entwickeln Sie individuelle APIs oder nur Standardschnittstellen?
              </button>
            </h3>
            <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faq1-heading" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Maßgeschneiderte REST/GraphQL/Webhook-Lösungen oder Integration vorhandener Systeme – exakt passend zu Ihren Anforderungen.</div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header" id="faq2-heading">
              <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                Wie läuft ein API-Projekt bei Ihnen ab?
              </button>
            </h3>
            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2-heading" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Erstberatung &amp; Analyse → Schnittstellen-Design → Implementierung &amp; Tests → Dokumentation, Deployment, Monitoring &amp; Support.</div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header" id="faq3-heading">
              <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                Welche Authentifizierung &amp; Sicherheitsmaßnahmen setzen Sie ein?
              </button>
            </h3>
            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3-heading" data-bs-parent="#faqAccordion">
              <div class="accordion-body">OAuth2, JWT, API-Keys, TLS, Rate-Limiting, strukturierte Logs, Monitoring/Alerting – DSGVO-konform und auditierbar.</div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header" id="faq4-heading">
              <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                Was kostet eine API-Entwicklung?
              </button>
            </h3>
            <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4-heading" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Abhängig von Umfang &amp; Komplexität. Nach dem Erstgespräch erhalten Sie ein verbindliches, transparentes Angebot.</div>
            </div>
          </div>
        </div>

        <div class="btn-center d-flex justify-content-center mt-5">
          <a href="tel:+436606448088" class="btn btn-pink btn-lg" aria-label="Jetzt anrufen">
            <i class="bi bi-telephone me-1" aria-hidden="true"></i> Fragen? Rufen Sie uns an
          </a>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>

  <!-- JS (non-blocking) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous" defer></script>
  <script src="/assets/js/app.min.js" defer></script>
</body>

</html>
