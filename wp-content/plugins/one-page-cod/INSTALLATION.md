# Guide d'installation - One Page COD

## Installation rapide

### Méthode 1 : Installation via l'admin WordPress (Recommandée)

1. **Téléchargez** le fichier ZIP du plugin
2. Connectez-vous à votre **administration WordPress**
3. Allez dans **Extensions → Ajouter**
4. Cliquez sur **Téléverser une extension**
5. Sélectionnez le fichier ZIP et cliquez sur **Installer maintenant**
6. Une fois l'installation terminée, cliquez sur **Activer**

### Méthode 2 : Installation via FTP

1. **Décompressez** le fichier ZIP du plugin
2. Connectez-vous à votre serveur via **FTP**
3. Uploadez le dossier `one-page-cod` dans `/wp-content/plugins/`
4. Allez dans votre **administration WordPress**
5. Accédez à **Extensions → Extensions installées**
6. Trouvez "One Page COD" et cliquez sur **Activer**

### Méthode 3 : Installation via SSH

```bash
# Se connecter au serveur
ssh user@votreserveur.com

# Aller dans le répertoire des plugins
cd /var/www/html/wp-content/plugins/

# Télécharger et décompresser (si vous avez un lien direct)
wget https://votresite.com/one-page-cod.zip
unzip one-page-cod.zip

# Définir les bonnes permissions
chown -R www-data:www-data one-page-cod
chmod -R 755 one-page-cod
```

Ensuite, activez le plugin depuis l'administration WordPress.

## Vérification de l'installation

### Prérequis système

Avant d'installer, assurez-vous que votre environnement répond aux exigences suivantes :

- ✅ WordPress 5.8 ou version supérieure
- ✅ WooCommerce 5.0 ou version supérieure
- ✅ PHP 7.4 ou version supérieure
- ✅ MySQL 5.6 ou version supérieure
- ✅ Extension PHP curl activée
- ✅ Extension PHP mbstring activée

### Vérifier les prérequis

Vous pouvez vérifier votre configuration PHP via **Outils → Santé du site → Informations** dans WordPress.

## Configuration initiale

### Étape 1 : Vérifier que WooCommerce est actif

Le plugin nécessite WooCommerce. Si WooCommerce n'est pas actif, vous verrez un message d'erreur.

Pour activer WooCommerce :
1. Allez dans **Extensions → Extensions installées**
2. Recherchez WooCommerce
3. Cliquez sur **Activer**

Si WooCommerce n'est pas installé :
1. Allez dans **Extensions → Ajouter**
2. Recherchez "WooCommerce"
3. Installez et activez

### Étape 2 : Accéder aux paramètres

1. Dans le menu WordPress, allez dans **WooCommerce**
2. Cliquez sur **One Page COD**
3. Vous accédez à la page de configuration du plugin

### Étape 3 : Configuration de base

#### Paramètres généraux recommandés

```
✓ Auto-détection du produit : Activé
✓ Support des produits variables : Activé
Position du formulaire : Après le bouton "Ajouter au panier"
```

#### Paramètres de commande recommandés

```
Méthode de paiement : Paiement à la livraison
Statut de commande : En traitement
✓ Notifications email : Activé
```

#### Paramètres du formulaire

```
Texte du bouton : Commander maintenant
Message de succès : Votre commande a été enregistrée avec succès !
Redirection après commande : (laisser vide ou URL de votre page de remerciement)
```

#### Champs requis

```
✓ Nom (toujours requis)
✓ Téléphone (toujours requis)
✓ Email (optionnel, recommandé de cocher)
✓ Adresse (toujours requis)
✓ Ville (toujours requis)
✓ Code postal (optionnel, recommandé de cocher)
```

### Étape 4 : Sauvegarder les paramètres

Cliquez sur **Enregistrer les modifications** en bas de la page.

## Test du plugin

### Test sur une page produit

1. Allez sur une **page produit** de votre boutique
2. Vous devriez voir le **formulaire de commande** s'afficher automatiquement
3. Testez en remplissant le formulaire avec des données de test
4. Soumettez le formulaire
5. Vérifiez que la commande est créée dans **WooCommerce → Commandes**

### Test avec un produit variable

1. Créez ou accédez à un **produit variable** (avec couleurs, tailles, etc.)
2. Allez sur la page du produit
3. Le formulaire doit afficher les **sélecteurs de variations**
4. Sélectionnez une variation et testez la commande
5. Vérifiez dans les détails de la commande que la variation est correctement enregistrée

### Test du shortcode

1. Créez une **nouvelle page** WordPress
2. Ajoutez le shortcode : `[one_page_cod product_id="123"]` (remplacez 123 par un ID de produit réel)
3. Publiez et consultez la page
4. Le formulaire doit s'afficher avec le produit spécifié

## Configuration de WooCommerce

### Configurer le paiement à la livraison

1. Allez dans **WooCommerce → Réglages → Paiements**
2. Activez **Paiement à la livraison (COD)**
3. Cliquez sur **Gérer** pour configurer
4. Paramètres recommandés :
   ```
   Activer/Désactiver : ✓ Activé
   Titre : Paiement à la livraison
   Description : Payez en espèces à la livraison
   Instructions : Vous paierez en espèces lors de la réception de votre commande
   Activer pour les méthodes de livraison : Toutes les méthodes
   ```
5. Cliquez sur **Enregistrer les modifications**

### Configurer les emails de notification

1. Allez dans **WooCommerce → Réglages → Emails**
2. Vérifiez que les emails suivants sont activés :
   - **Nouvelle commande** (pour vous informer)
   - **Commande en cours de traitement** (pour le client)
3. Testez l'envoi d'email depuis **WooCommerce → Réglages → Emails → Actions de test**

## Dépannage de l'installation

### Le plugin ne s'active pas

**Erreur : "WooCommerce requis"**
- Solution : Installez et activez WooCommerce d'abord

**Erreur : "Version PHP insuffisante"**
- Solution : Contactez votre hébergeur pour mettre à jour PHP vers 7.4 ou supérieur

**Erreur fatale au chargement**
- Solution : Vérifiez que tous les fichiers ont été uploadés correctement
- Réuploadez le plugin si nécessaire

### Le formulaire ne s'affiche pas

**Problème : Rien ne s'affiche sur la page produit**
1. Vérifiez que l'**auto-détection est activée** dans les paramètres
2. Videz le **cache** de votre site
3. Vérifiez qu'il n'y a pas de **conflit avec un autre plugin**
4. Testez avec le **thème par défaut** de WordPress (Twenty Twenty-Four)

**Problème : Le shortcode ne fonctionne pas**
1. Vérifiez la **syntaxe du shortcode**
2. Assurez-vous que l'**ID du produit existe**
3. Vérifiez les **erreurs JavaScript** dans la console du navigateur

### Les emails ne sont pas envoyés

1. Vérifiez que l'option est **activée dans les paramètres OPC**
2. Testez l'envoi d'email via **WooCommerce → Réglages → Emails**
3. Installez un plugin SMTP comme **WP Mail SMTP** ou **Easy WP SMTP**
4. Vérifiez les **logs du serveur** pour les erreurs d'envoi

### Problèmes de style/affichage

**Le formulaire ne s'affiche pas correctement**
1. Videz le **cache du navigateur** (Ctrl+Shift+R)
2. Videz le **cache du site** (plugin de cache, CDN)
3. Vérifiez qu'il n'y a pas de **conflit CSS** avec le thème
4. Inspectez les éléments dans le navigateur pour identifier les problèmes

**Les styles ne se chargent pas**
1. Vérifiez les **permissions des fichiers** (755 pour dossiers, 644 pour fichiers)
2. Vérifiez la console pour les **erreurs 404**
3. Régénérez les **URLs** en allant dans Réglages → Permaliens et en sauvegardant

## Mise à niveau depuis une version antérieure

### Sauvegarde avant mise à jour

Avant toute mise à jour, effectuez une sauvegarde :

1. **Base de données** : Via phpMyAdmin ou plugin de sauvegarde
2. **Fichiers du plugin** : Téléchargez le dossier /wp-content/plugins/one-page-cod/

### Procédure de mise à jour

1. **Désactivez** le plugin (vos paramètres seront conservés)
2. **Supprimez** l'ancienne version
3. **Installez** la nouvelle version
4. **Activez** le plugin
5. **Vérifiez** les paramètres dans WooCommerce → One Page COD
6. **Testez** le formulaire sur une page produit

## Désinstallation propre

### Désactiver le plugin

1. Allez dans **Extensions → Extensions installées**
2. Trouvez "One Page COD"
3. Cliquez sur **Désactiver**

### Supprimer le plugin

1. Après désactivation, cliquez sur **Supprimer**
2. Confirmez la suppression

### Nettoyer les données (optionnel)

Si vous souhaitez supprimer toutes les données du plugin :

```sql
-- Se connecter à la base de données
-- Supprimer les options du plugin
DELETE FROM wp_options WHERE option_name = 'opc_settings';

-- Supprimer les métadonnées des commandes
DELETE FROM wp_postmeta WHERE meta_key = '_opc_order';
DELETE FROM wp_postmeta WHERE meta_key = '_opc_order_date';
```

**⚠️ Attention** : Cette opération est irréversible. Faites une sauvegarde avant.

## Support technique

Si vous rencontrez des problèmes non résolus par cette documentation :

1. **Documentation complète** : Consultez le README.md
2. **FAQ** : Vérifiez la section dépannage
3. **Logs** : Activez le mode debug WordPress et consultez les logs
4. **Support** : Contactez votresite.com/support

## Mode Debug

Pour activer le mode debug WordPress et voir les erreurs détaillées :

Éditez le fichier `wp-config.php` et ajoutez :

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Les erreurs seront enregistrées dans `/wp-content/debug.log`

---

**Installation réussie ?** Consultez le README.md pour découvrir toutes les fonctionnalités du plugin !
