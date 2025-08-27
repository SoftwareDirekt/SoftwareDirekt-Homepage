# SoftwareDirekt-Homepage

Dies ist die Projekt-Dokumentation für die Kundenwebseite **SoftwareDirekt**.
Der Mailversand erfolgt über **PHPMailer**.

---

## 📧 Wichtiger Hinweis zum Mailversand

Damit das Kontaktformular funktioniert, **muss die Datei `config.php` angepasst werden**.
Dort stehen die SMTP-Zugangsdaten (Mailserver, Benutzername, Passwort, Port, Verschlüsselung).
Ohne diese Anpassung ist kein E-Mail-Versand möglich.

---

## 🔧 Vorgehen

1. Öffne die Datei `config.php` im Projekt.
2. Trage deine SMTP-Daten ein (Mail-Provider oder eigener Server).

Beispiel:

```php
<?php
return [
    'host'       => 'smtp.deinprovider.at',   // Mailserver
    'username'   => 'info@deinedomain.at',    // Benutzername
    'password'   => 'DEIN_PASSWORT',          // Passwort
    'port'       => 587,                      // 465 bei SSL
    'encryption' => 'tls',                    // 'ssl' oder 'tls'
    'from_email' => 'info@deinedomain.at',    // Absender-Adresse
    'from_name'  => 'SoftwareDirekt Website', // Absender-Name
];
