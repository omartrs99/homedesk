# One Page COD - Plugin WordPress WooCommerce

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![WordPress](https://img.shields.io/badge/WordPress-5.8+-brightgreen)
![WooCommerce](https://img.shields.io/badge/WooCommerce-5.0+-purple)
![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4)

## 📋 Description

**One Page COD** est un plugin WordPress puissant qui ajoute un formulaire de commande directe sur vos pages produits WooCommerce. Il permet à vos clients de passer commande rapidement sans passer par le panier ou la page de paiement, idéal pour :

- ✅ Campagnes publicitaires Facebook/Instagram
- ✅ Landing pages optimisées pour la conversion
- ✅ Ventes avec paiement à la livraison (COD)
- ✅ Réduction du taux d'abandon de panier
- ✅ Processus de commande simplifié

## ✨ Fonctionnalités principales

### 🎯 Auto-détection du produit
- Détection automatique du produit sur la page
- Intégration transparente avec WooCommerce
- Affichage automatique ou via shortcode

### 🔀 Support des produits variables
- Gestion complète des attributs et variations
- Sélection dynamique des options
- Affichage du prix en temps réel
- Vérification du stock par variation

### 📝 Formulaire personnalisable
- Champs de contact essentiels (nom, téléphone, adresse)
- Champs optionnels configurables
- Messages personnalisables
- Validation côté client et serveur

### 🛒 Création de commande automatique
- Enregistrement direct dans WooCommerce
- Bypass du panier et du checkout
- Notifications email automatiques
- Statut de commande configurable

### ⚙️ Configuration flexible
- Interface d'administration intuitive
- Multiple méthodes de paiement supportées
- Redirection personnalisable après commande
- Shortcode pour placement manuel

## 📦 Installation

### Installation manuelle

1. **Téléchargez** le plugin et décompressez le fichier ZIP
2. **Uploadez** le dossier `one-page-cod` dans `/wp-content/plugins/`
3. **Activez** le plugin via le menu "Extensions" de WordPress
4. **Configurez** le plugin via WooCommerce → One Page COD

### Via WordPress

1. Allez dans **Extensions → Ajouter**
2. Recherchez "One Page COD"
3. Cliquez sur **Installer** puis **Activer**
4. Configurez via **WooCommerce → One Page COD**

## 🚀 Utilisation

### Affichage automatique

Le formulaire s'affiche automatiquement sur les pages produits WooCommerce si l'option "Auto-détection" est activée dans les paramètres.

### Utilisation du shortcode

#### Sur une page produit
```
[one_page_cod]
```

#### Sur n'importe quelle page avec un ID produit spécifique
```
[one_page_cod product_id="123"]
```

### Exemples d'intégration

#### Dans un article de blog
```
<h2>Achetez notre produit phare</h2>
[one_page_cod product_id="456"]
```

#### Dans une landing page
```
[one_page_cod product_id="789"]
```

#### Dans un template PHP
```php
<?php echo do_shortcode('[one_page_cod product_id="123"]'); ?>
```

## ⚙️ Configuration

### Paramètres généraux

**Auto-détection du produit**
- Active l'affichage automatique du formulaire sur les pages produits
- Désactivez si vous préférez utiliser uniquement le shortcode

**Support des produits variables**
- Active la gestion des produits avec variations
- Affiche les sélecteurs d'attributs (couleur, taille, etc.)
- Calcul automatique du prix selon la variation

**Position du formulaire**
- Après le bouton "Ajouter au panier" (par défaut)
- Avant le bouton "Ajouter au panier"
- Shortcode uniquement

### Paramètres de commande

**Méthode de paiement**
- Paiement à la livraison (COD) - recommandé
- Toute autre méthode de paiement active

**Statut de commande par défaut**
- En traitement (processing)
- En attente de paiement (pending)
- En attente (on-hold)
- Personnalisé

**Notifications email**
- Active/désactive l'envoi des emails de notification
- Email au client et au gestionnaire de boutique

### Paramètres du formulaire

**Texte du bouton**
- Personnalisez le texte du bouton de soumission
- Exemple : "Commander maintenant", "Acheter en 1 clic"

**Message de succès**
- Message affiché après la création réussie d'une commande
- Peut inclure du HTML simple

**Redirection après commande**
- URL de redirection après commande (optionnel)
- Page de remerciement personnalisée
- Landing page de suivi

**Champs requis**
- Email (optionnel par défaut)
- Code postal (optionnel par défaut)
- Nom, téléphone, adresse, ville sont toujours requis

## 🎨 Personnalisation CSS

### Classes CSS disponibles

```css
/* Container principal */
.opc-form-container { }

/* Titre du formulaire */
.opc-form-title { }

/* Champs du formulaire */
.opc-input { }

/* Bouton de soumission */
.opc-submit-btn { }

/* Messages */
.opc-message-success { }
.opc-message-error { }

/* Section variations */
.opc-variations-section { }
```

### Exemple de personnalisation

```css
/* Changer la couleur du bouton */
.opc-submit-btn {
    background: #e91e63;
}

.opc-submit-btn:hover {
    background: #c2185b;
}

/* Modifier le container */
.opc-form-container {
    background: #f5f5f5;
    border-radius: 15px;
}
```

## 🔌 Hooks et Filtres

### Actions disponibles

#### Après la création d'une commande
```php
add_action('opc_order_created', 'custom_after_opc_order', 10, 2);
function custom_after_opc_order($order_id, $customer_data) {
    // Votre code personnalisé
    // Par exemple : envoyer une notification SMS
    // ou ajouter le client à une liste MailChimp
}
```

### Filtres disponibles

#### Modifier le titre du formulaire
```php
add_filter('opc_form_title', 'custom_opc_form_title');
function custom_opc_form_title($title) {
    return 'Commandez en 30 secondes';
}
```

## 📊 Gestion des commandes

### Identifier les commandes OPC

Les commandes créées via One Page COD sont automatiquement marquées avec :
- Une icône dans la liste des commandes
- Une métadonnée `_opc_order` = 'yes'
- Une section dédiée dans les détails de commande

### Filtrer les commandes

Dans l'admin WooCommerce, utilisez le filtre déroulant pour :
- Afficher uniquement les commandes OPC
- Afficher uniquement les commandes non-OPC
- Afficher toutes les commandes

### Exporter les commandes OPC

```php
// Récupérer toutes les commandes OPC
$opc_orders = OPC_Order::get_instance()->get_opc_orders();

foreach ($opc_orders as $order) {
    // Traiter les commandes
}
```

## 🔒 Sécurité

Le plugin implémente plusieurs mesures de sécurité :

- ✅ Vérification des nonces AJAX
- ✅ Validation côté serveur de toutes les données
- ✅ Échappement et sanitization des inputs
- ✅ Vérification des capacités utilisateur
- ✅ Protection CSRF
- ✅ Validation des emails et numéros de téléphone

## 🌐 Traductions

Le plugin est prêt pour la traduction (i18n).

### Fichiers de traduction

Placez vos fichiers .po et .mo dans :
```
/wp-content/plugins/one-page-cod/languages/
```

### Text Domain
```
one-page-cod
```

## 🐛 Dépannage

### Le formulaire ne s'affiche pas

1. Vérifiez que WooCommerce est activé
2. Vérifiez que l'auto-détection est activée dans les paramètres
3. Assurez-vous d'être sur une page produit
4. Videz le cache de votre site

### Les variations ne fonctionnent pas

1. Vérifiez que le support des variations est activé
2. Assurez-vous que le produit a des variations configurées
3. Vérifiez la console JavaScript pour les erreurs
4. Testez avec le thème par défaut de WordPress

### Les emails ne sont pas envoyés

1. Vérifiez que l'option "Notifications email" est activée
2. Testez l'envoi d'email de WooCommerce
3. Vérifiez les paramètres SMTP de votre serveur
4. Utilisez un plugin SMTP si nécessaire

### Les commandes ne se créent pas

1. Vérifiez les logs d'erreur PHP
2. Assurez-vous que tous les champs requis sont remplis
3. Vérifiez que le produit est en stock
4. Testez avec la console développeur du navigateur

## 📋 Prérequis

- WordPress 5.8 ou supérieur
- WooCommerce 5.0 ou supérieur
- PHP 7.4 ou supérieur
- MySQL 5.6 ou supérieur

## 📄 Licence

Ce plugin est distribué sous licence GPL v2 ou ultérieure.

## 🤝 Support

Pour obtenir de l'aide :

1. Consultez la documentation complète
2. Vérifiez les questions fréquentes
3. Contactez le support via votresite.com/support

## 🔄 Changelog

### Version 1.0.0 (2024)
- 🎉 Version initiale
- ✅ Auto-détection des produits
- ✅ Support des produits variables
- ✅ Création automatique de commandes
- ✅ Interface d'administration
- ✅ Shortcode flexible
- ✅ Validation côté client et serveur
- ✅ Responsive design
- ✅ Prêt pour la traduction

## 🚀 Fonctionnalités à venir

- [ ] Support multi-devises
- [ ] Intégration avec Google Analytics
- [ ] Templates de formulaires personnalisés
- [ ] Champs personnalisés conditionnels
- [ ] Export CSV des commandes OPC
- [ ] Intégration avec les constructeurs de pages
- [ ] Mode popup/modal
- [ ] A/B testing intégré

## 👨‍💻 Développement

### Structure du projet

```
one-page-cod/
├── assets/
│   ├── css/
│   │   └── opc-styles.css
│   └── js/
│       └── opc-scripts.js
├── includes/
│   ├── class-opc-form.php
│   ├── class-opc-order.php
│   ├── class-opc-settings.php
│   ├── class-opc-shortcode.php
│   └── opc-functions.php
├── languages/
├── one-page-cod.php
└── README.md
```

### Contribuer

Les contributions sont les bienvenues ! N'hésitez pas à :

1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Committer vos changements
4. Pousser vers la branche
5. Ouvrir une Pull Request

## 📞 Contact

- Site web : votresite.com
- Email : contact@votresite.com
- Support : votresite.com/support

---

Développé avec ❤️ pour optimiser vos conversions WooCommerce
