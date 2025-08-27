document.addEventListener('DOMContentLoaded', () => {
  const nav = document.querySelector('.site-navbar');

  /* 1) Active link + aria-current */
  const path = window.location.pathname.replace(/\/+$/, '') || '/';
  const links = document.querySelectorAll('#mainNav a.nav-link, #mainNav .dropdown-item');
  let anyActive = false;

  links.forEach(link => {
    const pattern = link.getAttribute('data-match');
    if (!pattern) return;

    const regex = new RegExp(pattern, 'i');
    const href = new URL(link.href, window.location.origin).pathname.replace(/\/+$/, '') || '/';

    const match = regex.test(path) || (href !== '/' && path.startsWith(href));
    if (match) {
      link.classList.add('active');
      link.setAttribute('aria-current', 'page');
      anyActive = true;

      const parentToggle = link.closest('.dropdown-menu')?.parentElement?.querySelector('.nav-link.dropdown-toggle');
      if (parentToggle) {
        parentToggle.classList.add('active');
        parentToggle.setAttribute('aria-current', 'page');
      }
    }
  });

  if (!anyActive && (path === '/' || /index\.(html|php)$/i.test(path))) {
    document.querySelectorAll('#mainNav a.nav-link[data-match^="^/$"]').forEach(a => {
      a.classList.add('active');
      a.setAttribute('aria-current', 'page');
    });
  }

  /* 2) Scroll shadow + auto-hide on scroll down (desktop+mobile) */
  let lastY = window.scrollY;
  const onScroll = () => {
    const y = window.scrollY;
    if (y > 8) nav.classList.add('scrolled'); else nav.classList.remove('scrolled');
    if (y > lastY && y > 120) nav.classList.add('nav-hide'); else nav.classList.remove('nav-hide');
    lastY = y;
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* 3) Dropdown A11y: focus first item when opened, close on ESC */
  document.querySelectorAll('.dropdown').forEach(dd => {
    dd.addEventListener('shown.bs.dropdown', () => {
      dd.querySelector('.dropdown-item')?.focus({ preventScroll: true });
    });
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
        const toggle = menu.parentElement.querySelector('[data-bs-toggle="dropdown"]');
        const instance = bootstrap.Dropdown.getInstance(toggle);
        instance && instance.hide();
        toggle?.focus({ preventScroll: true });
      });
      // collapse mobile menu if open
      const collapseEl = document.getElementById('mainNav');
      if (collapseEl?.classList.contains('show')) {
        const c = bootstrap.Collapse.getOrCreateInstance(collapseEl);
        c.hide();
      }
    }
  });

  /* 4) Desktop hover intent for dropdowns (keeps click on mobile) */
  const isDesktop = () => window.matchMedia('(hover:hover) and (pointer:fine) and (min-width: 992px)').matches;
  const toggles = document.querySelectorAll('.dropdown-toggle');
  toggles.forEach(t => {
    let timer;
    t.addEventListener('mouseenter', () => {
      if (!isDesktop()) return;
      clearTimeout(timer);
      bootstrap.Dropdown.getOrCreateInstance(t).show();
    });
    t.parentElement.addEventListener('mouseleave', () => {
      if (!isDesktop()) return;
      timer = setTimeout(() => bootstrap.Dropdown.getOrCreateInstance(t).hide(), 120);
    });
  });
});
