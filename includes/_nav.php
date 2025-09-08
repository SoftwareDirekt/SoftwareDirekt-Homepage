<?php
// Robust normalisieren: /, /seite, /seite.php, /seite/ → slug "seite"; index ⇒ ""
$uri      = $_SERVER['REQUEST_URI'] ?? '/';
$pathOnly = strtok($uri, '?') ?: '/';                // Query abschneiden
$trimmed  = rtrim($pathOnly, '/');                   // rechten Slash entfernen (außer Root)
$slug     = ($trimmed === '' || $trimmed === '/')
  ? ''
  : strtolower(pathinfo($trimmed, PATHINFO_FILENAME));
if ($slug === 'index') {
  $slug = '';
}               // index = Home

function active_cls(string $target, string $current): string
{
  return $target === $current ? 'active' : '';
}

// Services (Slug ohne .php)
$services = [
  'webentwicklung'   => 'Webentwicklung & Webdesign',
  'mobile-app'       => 'Mobile App Entwicklung',
  'frontend-backend' => 'Frontend & Backend',
  'hosting'          => 'Hosting',
  'apis'             => 'APIs',
];
$servicesActive = array_key_exists($slug, $services) ? 'active' : '';
?>

<?php include 'includes/header.php'; ?>

<nav class="navbar navbar-expand-lg nav-white sticky-top" aria-label="Hauptnavigation">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/" aria-label="Zur Startseite">
      <img src="/assets/logo/logo.webp" alt="SoftwareDirektOG Logo" class="brand-img" width="160" height="56">
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
      aria-controls="navbarMain" aria-expanded="false" aria-label="Menü öffnen">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav mx-auto fw-semibold main-menu">
        <li class="nav-item">
          <a class="nav-link <?= $slug === '' ? 'active' : '' ?>" data-slug="" href="/" <?= $slug === '' ? 'aria-current="page"' : '' ?>>Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= active_cls('ueber-uns', $slug) ?>" data-slug="ueber-uns" href="/ueber-uns.php" <?= active_cls('ueber-uns', $slug) ? 'aria-current="page"' : '' ?>>Über uns</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= $servicesActive ?>" href="#" id="servicesDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">Services</a>

          <ul class="dropdown-menu shadow border-0 rounded-4 p-2" aria-labelledby="servicesDropdown">
            <?php foreach ($services as $s => $label): ?>
              <li>
                <a class="dropdown-item <?= active_cls($s, $slug) ?>" data-slug="<?= $s ?>" href="/<?= $s ?>.php" <?= active_cls($s, $slug) ? 'aria-current="page"' : '' ?>>
                  <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= active_cls('kontakt', $slug) ?>" data-slug="kontakt" href="/kontakt.php" <?= active_cls('kontakt', $slug) ? 'aria-current="page"' : '' ?>>Kontakt</a>
        </li>
      </ul>

      <a href="tel:+436606448088" class="btn btn-pink fw-semibold px-3 shadow-sm" aria-label="Jetzt anrufen">
        <i class="bi bi-telephone me-1"></i> 0660 64 48 088
      </a>
    </div>
  </div>
</nav>
