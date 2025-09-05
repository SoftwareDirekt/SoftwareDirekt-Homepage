<!DOCTYPE html>
<html lang="de-AT">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- SEO Title: Keyword, USP, Brand -->
  <title>Kontakt SoftwareDirekt Wien – Ihr direkter Draht zu Web & IT-Experten</title>

  <!-- Meta Description: Haupt- & Nebenkeywords, USP, CTA -->
  <meta name="description" content="Kontaktieren Sie SoftwareDirekt in Wien: Persönliche Beratung, individuelle Angebote, schnelle Hilfe für Webentwicklung, App, Hosting & IT-Service. Wir sind für Sie da!">

  <!-- Meta Keywords: lokal, spezifisch, Conversion-orientiert -->
  <meta name="keywords" content="Kontakt SoftwareDirekt, Kontakt Webagentur Wien, Anfrage Webentwicklung, IT Support Kontakt Wien, Beratung Website, Angebot anfordern, Kontaktformular, Rückrufservice, Kontakt IT Dienstleister Wien, Kontakt App Entwicklung, SoftwareFirma Kontakt, Support Wien">

  <meta name="robots" content="index, follow">
  <meta name="language" content="de-AT">
  <meta name="geo.region" content="AT-9">
  <meta name="geo.placename" content="Wien">
  <meta name="author" content="SoftwareDirekt">

  <!-- Canonical: absolut, korrekt -->
  <link rel="canonical" href="https://softwaredirekt.at/kontakt.php">

  <!-- Favicon: absolut -->
  <link rel="icon" href="https://softwaredirekt.at/assets/favicon.ico" type="image/x-icon">

  <!-- Open Graph: absolut, lokal, kontakt-orientiert -->
  <meta property="og:locale" content="de_AT">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Kontakt SoftwareDirekt Wien – Ihr direkter Draht zu Web & IT-Experten">
  <meta property="og:description" content="Jetzt Kontakt aufnehmen: Persönliche Beratung & schnelle Hilfe zu Webentwicklung, App & IT-Service in Wien.">
  <meta property="og:url" content="https://softwaredirekt.at/kontakt.php">
  <meta property="og:site_name" content="SoftwareDirekt">
  <meta property="og:image" content="https://softwaredirekt.at/assets/img/kontakt-header.jpg">

  <!-- Twitter Card: absolut, USP/CTA -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Kontakt SoftwareDirekt Wien – Ihr direkter Draht zu Web & IT-Experten">
  <meta name="twitter:description" content="Direkter Kontakt zu SoftwareDirekt – schnelle Antwort, persönliche Beratung & individuelles Angebot für Ihr Projekt in Wien.">
  <meta name="twitter:image" content="https://softwaredirekt.at/assets/img/kontakt-header.jpg">
  <meta name="twitter:site" content="@SoftwareDirekt">

  <!-- Trustpilot TrustBox (optional, nachladen) -->
  <script type="text/javascript" src="https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>

  <!-- Stylesheets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/assets/css/styles.min.css">

  <!-- Strukturierte Daten: LocalBusiness, Kontakt, Wien -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "SoftwareDirekt",
      "image": "https://softwaredirekt.at/assets/img/kontakt-header.jpg",
      "url": "https://softwaredirekt.at/kontakt.php",
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
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "48.13513",
        "longitude": "16.28595"
      },
      "sameAs": [
        "https://www.linkedin.com/company/softwaredirekt/",
        "https://www.facebook.com/softwaredirekt"
      ],
      "description": "Kontaktieren Sie SoftwareDirekt in Wien – Ihr IT- und Web-Partner für Beratung, Support & individuelle Angebote.",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+43-660-64-48-088",
        "contactType": "customer support",
        "email": "office@softwaredirekt.at",
        "availableLanguage": ["de", "en"]
      }
    }
  </script>

</head>


<body>

  <?php include 'includes/nav.php'; ?>


  <main>

    <section class="py-5" id="contact-hero">
      <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col-lg-8 text-center">
            <h1>Kontakt</h1>
            <h2>Holen Sie sich Ihr unverbindliches Angebot</h2>
            <h3>Lassen Sie uns zusammenarbeiten!</h3>
            <p>
              Wir freuen uns darauf, von Ihnen zu hören und Ihre Vision in die Realität umzusetzen.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- New Contact Section -->
    <div class="container my-5 contact-section">

      <div class="row g-5 align-items-center">
        <!-- Image Section -->
        <div class="col-12 col-lg-6 contact-image">
          <img src="/assets/img/contact-us-1.webp" alt="Contact Us" class="img-fluid">
        </div>

        <!-- Form Section -->
        <div class="col-12 col-lg-6">
          <div class="contact-form p-4 p-lg-5">
            <form id="contactForm" action="/send_mail.php" method="post" autocomplete="off" novalidate>
              <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ihr Name" required>
                <div class="invalid-feedback">Bitte geben Sie Ihren Namen ein.</div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="ihre@email.com" required>
                <div class="invalid-feedback">Bitte geben Sie eine gültige E-Mail ein.</div>
              </div>

              <div class="mb-3">
                <label for="message" class="form-label fw-semibold">Nachricht</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Ihre Nachricht" required></textarea>
                <div class="invalid-feedback">Bitte geben Sie eine Nachricht ein.</div>
              </div>

              <!-- Honeypot -->
              <input type="text" name="website" id="website" class="d-none" tabindex="-1" autocomplete="off" aria-hidden="true">

              <div class="d-grid mt-4">
                <button class="btn btn-primary" id="btn-submit" type="submit" aria-label="Formular absenden">Absenden</button>
              </div>

              <!-- Rückmeldungen -->
              <div id="formResponse" class="mt-3" aria-live="polite"></div>
            </form>

          </div>
        </div>

        <!-- Form Section ENDE -->
      </div>
    </div>

    <section class="g-maps bg-white d-none d-md-block">
      <div class="container-full">
        <div class="row">
          <div class="col-lg-12"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2669.7492091897197!2d16.24702161286354!3d47.99923366066097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476db0fea388680d%3A0x774b82ab3a120249!2sBraitner%20Str.%20147%2C%202500%20Baden!5e0!3m2!1sde!2sat!4v1754670988670!5m2!1sde!2sat" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
      </div>
    </section>


  </main>


  <?php include 'includes/footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

  <script src="/assets/js/app.min.js" defer="defer"></script>

  <script>
    (function() {
      const form = document.getElementById('contactForm');
      const btn = document.getElementById('btn-submit');
      const resp = document.getElementById('formResponse');

      function setMsg(type, text) {
        resp.innerHTML = `<div class="alert alert-${type}" role="alert">${text}</div>`;
      }

      form.addEventListener('submit', async function(e) {
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
          form.classList.add('was-validated');
          return;
        }
        if (!window.fetch) return;

        e.preventDefault();
        btn.disabled = true;
        setMsg('info', 'Sende …');

        const controller = new AbortController();
        const t = setTimeout(() => controller.abort(), 15000);

        try {
          const formData = new FormData(form);
          const endpoint = form.getAttribute('action') || '/send_mail.php';
          const res = await fetch(endpoint, {
            method: 'POST',
            body: formData,
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json'
            },
            cache: 'no-store',
            credentials: 'same-origin',
            signal: controller.signal
          });

          let data = null;
          try {
            data = await res.json();
          } catch (_) {}

          if (!res.ok || !data || typeof data.success !== 'boolean') {
            const err = (data && data.message) ? data.message : `HTTP ${res.status}`;
            setMsg('danger', `Fehler beim Senden: ${err}`);
            return;
          }

          if (data.success) {
            setMsg('success', data.message || 'Vielen Dank! Ihre Nachricht wurde übermittelt.');
            form.reset();
            form.classList.remove('was-validated');
          } else {
            setMsg('danger', data.message || 'Senden fehlgeschlagen.');
          }
        } catch (err) {
          setMsg('danger', (err && err.name === 'AbortError') ? 'Zeitüberschreitung. Bitte erneut versuchen.' : 'Netzwerkfehler. Bitte später erneut versuchen.');
        } finally {
          clearTimeout(t);
          btn.disabled = false;
        }
      }, false);
    })();
  </script>


</body>

</html>
