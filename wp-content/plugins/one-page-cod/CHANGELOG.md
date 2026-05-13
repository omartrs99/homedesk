# Changelog - One Page COD

## Version 1.0.1 (Correction compatibilité WooCommerce)

### 🔧 Corrections
- ✅ **Ajout de la déclaration de compatibilité HPOS** (High-Performance Order Storage)
- ✅ **Amélioration de la détection de WooCommerce** (3 méthodes de vérification)
- ✅ **Mise à jour des en-têtes du plugin** pour WooCommerce 9.0+
- ✅ **Ajout de `Requires Plugins: woocommerce`** pour dépendances automatiques

### 📝 Détails techniques

#### Problème résolu
L'avertissement "WooCommerce a détecté que certaines de vos extensions actives sont incompatibles..." apparaissait car le plugin ne déclarait pas sa compatibilité avec le nouveau système de stockage des commandes de WooCommerce (HPOS/Custom Order Tables).

#### Solutions implémentées

**1. Déclaration de compatibilité HPOS**
```php
add_action('before_woocommerce_init', function() {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
    }
});
```

**2. Amélioration de la détection de WooCommerce**
- Vérification de l'existence de la classe `WooCommerce`
- Vérification dans les plugins actifs
- Support multisite
- Plus robuste et fiable

**3. Mise à jour des en-têtes**
- `WC tested up to: 9.0` (au lieu de 8.5)
- `Requires Plugins: woocommerce` (nouveau standard WordPress 6.5+)

### 📦 Fichier mis à jour
- `one-page-cod-fixed.zip` - Version corrigée prête à l'emploi

### 🚀 Installation de la correction

#### Si vous aviez déjà installé la version précédente :

**Option 1 : Mise à jour rapide**
1. Allez dans **Extensions → Extensions installées**
2. **Désactivez** One Page COD (vos paramètres seront conservés)
3. Cliquez sur **Supprimer**
4. Installez **one-page-cod-fixed.zip**
5. **Activez** le plugin
6. L'avertissement ne devrait plus apparaître

**Option 2 : Remplacement manuel des fichiers**
1. Via FTP, allez dans `/wp-content/plugins/one-page-cod/`
2. Remplacez uniquement le fichier `one-page-cod.php`
3. Allez dans WordPress admin
4. **Désactivez** puis **Réactivez** le plugin
5. L'avertissement disparaîtra

#### Si c'est une nouvelle installation :
Utilisez directement **one-page-cod-fixed.zip** - le problème n'apparaîtra pas.

### ✅ Vérification

Après l'installation de la version corrigée :

1. Allez dans **WooCommerce → État → Journaux**
2. L'avertissement de compatibilité ne devrait plus apparaître
3. Le plugin devrait apparaître dans la liste des extensions compatibles
4. Testez le formulaire de commande pour confirmer que tout fonctionne

### 🔍 Si l'avertissement persiste

**1. Videz tous les caches**
- Cache WordPress
- Cache du navigateur
- Cache serveur (si vous en utilisez un)

**2. Vérifiez la version**
- Allez dans **Extensions → Extensions installées**
- Vérifiez que "One Page COD" est bien la version corrigée

**3. Vérifiez HPOS dans WooCommerce**
- Allez dans **WooCommerce → Réglages → Avancé → Fonctionnalités**
- Si "High-performance order storage (HPOS)" est activé, notre plugin est maintenant compatible

**4. Désactivez/Réactivez**
Parfois WordPress a besoin de recharger les métadonnées du plugin :
- Désactivez One Page COD
- Rafraîchissez la page
- Réactivez One Page COD

### 📊 Compatibilité

Le plugin est maintenant entièrement compatible avec :
- ✅ WooCommerce 5.0 - 9.0+
- ✅ HPOS (High-Performance Order Storage)
- ✅ Custom Order Tables
- ✅ WordPress 5.8 - 6.5+
- ✅ PHP 7.4 - 8.3
- ✅ Multisite WordPress

### 🆘 Support

Si vous rencontrez toujours des problèmes :
1. Vérifiez que vous utilisez bien **one-page-cod-fixed.zip**
2. Consultez le fichier **INSTALLATION.md** pour le dépannage
3. Activez le mode debug WordPress pour voir les logs
4. Contactez le support technique

---

## Version 1.0.0 (Version initiale)

### ✨ Fonctionnalités
- Auto-détection du produit sur les pages WooCommerce
- Support des produits simples et variables
- Formulaire de commande directe
- Création automatique de commandes
- Shortcode `[one_page_cod]`
- Interface d'administration complète
- Validation côté client et serveur
- Design responsive
- Prêt pour la traduction (i18n)

### 📝 Note
Cette version contenait un avertissement de compatibilité WooCommerce qui a été corrigé dans la version 1.0.1.

---

**Dernière mise à jour :** 31 janvier 2026
**Version actuelle :** 1.0.1
