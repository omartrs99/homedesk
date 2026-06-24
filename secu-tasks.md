# Sécurité WordPress — Tâches à implémenter

## État actuel — Déjà en place ✅
- `Options -Indexes` → pas de listing de répertoires
- `xmlrpc.php` bloqué via `.htaccess`
- `wp-config.php`, `readme.html`, `license.txt` inaccessibles
- Version WordPress masquée (`wp_generator` supprimé)
- Énumération users `/?author=` bloquée
- Plugin `wps-hide-login` → URL de login masquée

---

## Tâches à faire

### 🔴 CRITIQUE — 1. Bloquer l'exécution PHP dans `wp-content/uploads`

**Fichier à créer :** `wp-content/uploads/.htaccess`

La faille la plus dangereuse : si un attaquant uploade un fichier `.php` déguisé en image,
il peut exécuter du code arbitraire (webshell). `Options -Indexes` bloque le listing
mais pas l'exécution PHP.

```apache
# Bloquer l'exécution PHP — prévient les webshells uploadés
<FilesMatch "\.ph(p[0-9]?|tml)$">
    Order allow,deny
    Deny from all
</FilesMatch>

Options -ExecCGI
AddHandler cgi-script .php .php3 .php4 .phtml .pl .py .jsp .asp .htm .shtml .sh .cgi
```

**Vérification :** `http://localhost/homedesk/wp-content/uploads/test.php` → 403

---

### 🔴 CRITIQUE — 2. Désactiver l'éditeur de fichiers dans l'admin WP

**Fichier :** `wp-config.php` — ajouter avant `/* That's all, stop editing! */`

```php
define( 'DISALLOW_FILE_EDIT', true );
```

Empêche l'accès à Apparence → Éditeur et Extensions → Éditeur.
Si un admin est compromis, l'attaquant ne peut pas injecter du code PHP directement.

**Vérification :** Le menu "Éditeur" doit disparaître dans Apparence et Extensions.

---

### 🟠 IMPORTANT — 3. Bloquer l'énumération users via l'API REST

**Fichier :** `wp-content/themes/oceanwp/custom-functions.php`

`/?author=1` est bloqué mais `/wp-json/wp/v2/users` expose encore les logins et emails.

```php
add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( ! is_user_logged_in() ) {
        unset( $endpoints['/wp/v2/users'] );
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
} );
```

**Vérification :** `http://localhost/homedesk/wp-json/wp/v2/users` → doit retourner 401.

---

### 🟠 IMPORTANT — 4. Bloquer l'accès direct aux fichiers PHP dans `wp-includes`

**Fichier :** `.htaccess` racine — dans la section "Sécurité"

```apache
<IfModule mod_rewrite.c>
RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]
RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]
RewriteRule ^wp-includes/theme-compat/ - [F,L]
</IfModule>
```

**Vérification :** `http://localhost/homedesk/wp-includes/wp-db.php` → 403.

---

### 🟡 BON À AVOIR — 5. En-têtes de sécurité HTTP

**Fichier :** `.htaccess` racine — dans la section "Sécurité"

```apache
<IfModule mod_headers.c>
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-Content-Type-Options "nosniff"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
    Header always set Permissions-Policy "geolocation=(), microphone=(), camera=()"
</IfModule>
```

**Vérification :** Inspecter les headers HTTP de la page d'accueil (DevTools → Network).

---

## Récapitulatif

| # | Priorité | Action | Fichier |
|---|---|---|---|
| 1 | 🔴 Critique | Créer `uploads/.htaccess` (bloquer PHP exec) | nouveau fichier |
| 2 | 🔴 Critique | `DISALLOW_FILE_EDIT` | `wp-config.php` |
| 3 | 🟠 Important | Bloquer REST API `/wp/v2/users` | `custom-functions.php` |
| 4 | 🟠 Important | Bloquer `wp-includes` PHP direct | `.htaccess` racine |
| 5 | 🟡 Bon | En-têtes HTTP sécurité | `.htaccess` racine |
