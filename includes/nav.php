<?php include 'includes/header.php'; ?>

<nav class="navbar navbar-expand-lg site-navbar sticky-top" role="navigation" aria-label="Hauptnavigation">
  <div class="container">
    <!-- Logo (links) -->
    <a class="navbar-brand d-flex align-items-center gap-2" href="/" aria-label="Startseite">
      <img src="/assets/logo/logo.webp" width="100%" height="56" alt="Firmenlogo">
    </a>

    <!-- Burger -->
    <button class="navbar-toggler border-0 shadow-none" type="button"
      data-bs-toggle="collapse" data-bs-target="#mainNav"
      aria-controls="mainNav" aria-expanded="false" aria-label="Menü umschalten">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Mitte: Links | Rechts: CTA -->
    <div class="collapse navbar-collapse justify-content-center" id="mainNav">
      <ul class="navbar-nav mx-lg-auto align-items-lg-center gap-lg-1" id="primaryNav">
        <li class="nav-item">
          <a class="nav-link" href="/" data-match="^/$|index\.(html|php)$">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ueber-uns.php" data-match="ueber-uns">ÜBER UNS</a>
        </li>
        <li class="nav-item dropdown dropdown-animate">
          <a class="nav-link dropdown-toggle" href="/services" id="servicesDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false" data-match="^/services">
            SERVICES
          </a>
          <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
            <li><a class="dropdown-item" href="/webentwicklung.php" data-match="webentwicklung-webdesign">Webentwicklung &amp; Webdesign</a></li>
            <li><a class="dropdown-item" href="/mobile-app.php" data-match="mobile-app-entwicklung">Mobile App Entwicklung</a></li>
            <li><a class="dropdown-item" href="/frontend-backend.php" data-match="frontend-backend">Frontend &amp; Backend</a></li>
            <li><a class="dropdown-item" href="/hosting.php" data-match="hosting">Hosting</a></li>
            <li><a class="dropdown-item" href="/apis.php" data-match="apis">APIs</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/kontakt.php" data-match="kontakt">KONTAKT</a>
        </li>
      </ul>

      <!-- CTA (rechts) -->
      <div class="d-lg-flex ms-lg-3 align-items-center cta-wrap" itemscope itemtype="https://schema.org/Organization">
        <a class="btn btn-primary rounded-pill px-3 cta-tel" href="tel:+436606448008" itemprop="telephone"
          aria-label="Jetzt anrufen: +43 660 644 8008">
          <i class="bi bi-telephone-outbound me-1" aria-hidden="true"></i>
          <span class="d-none d-sm-inline">+43 660 644 8008</span>
          <span class="d-inline d-sm-none">Anrufen</span>
        </a>
      </div>
    </div>
  </div>
</nav>
