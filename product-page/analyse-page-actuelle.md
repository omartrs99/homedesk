# Analyse de la page produit actuelle — homedesk.tn/produit/bureau-ergonomique/

> Audit réalisé le 18/10/2026 sur la version en ligne (mobile 390 px + desktop), croisé avec `context.md`.
> Lecture : **problème → pourquoi ça coûte des conversions → recommandation → comment le mesurer**.

---

## 1. Note globale

| Critère | Note /5 | Commentaire court |
|---|:-:|---|
| Clarté de l'offre au-dessus de la ligne de flottaison | 3 | Le bénéfice est compris, mais **le prix n'est visible qu'au milieu du formulaire** |
| Message-match avec les pubs Meta | 2 | Une seule page générique « mal de dos » pour toutes les audiences |
| Démonstration produit | 3 | Les vidéos sont là, mais ce sont des iframes YouTube (écran noir avant chargement, logo YouTube, sorties possibles) |
| Preuves sociales | 2 | « +200 professionnels / 4,9 » sans aucun avis lisible. Les avatars à initiales (MM, NH…) font génériques. Le carrousel de photos clients est tout en bas, **après** le formulaire |
| Traitement des objections | 1 | **Aucune FAQ.** Solidité, installation, taille, place occupée : rien de tout ça n'est traité directement |
| Réassurance (COD, garantie, livraison) | 4 | Points forts : paiement à la livraison, 3 jours d'essai, livraison gratuite |
| Formulaire de commande | 3 | Bon formulaire en une page, mais email obligatoire et bloc B2B qui distrait |
| Crédibilité / conformité | 2 | Allégations santé et chiffres non sourcés, incohérences entre les sections |
| Performance / technique mobile | 3 | Un bloc invisible tant que le JS ne s'est pas déclenché, YouTube lourd, pas de CTA collant |

**Score estimé : 23/45.** La base est solide (COD, garantie, vraies photos, tableau comparatif, choix de taille). La page perd surtout des ventes sur **l'ordre des sections, les preuves, les objections et la cohérence des infos**.

---

## 2. Points forts à conserver

1. **Le paiement à la livraison et les 3 jours d'essai** sont annoncés dès la barre du haut. C'est le levier n°1 pour un acheteur COD tunisien.
2. **Le formulaire est sur la page**, sans passer par le panier. Le parcours est court.
3. **L'aide au choix de taille** (« Vous mesurez plus de 1,87 m ? → Large ») est claire et rassurante.
4. **Le sac offert avec une valeur barrée (85 DT → gratuit)** ancre bien la valeur.
5. **L'option « Retirer le sac et économiser 30 DT »** sert de deuxième porte d'entrée prix sans casser la valeur de l'offre principale.
6. **Le champ « Profil »** permet de segmenter les ventes par audience. C'est précieux pour les 5 landing pages.
7. **Le tableau comparatif Medium / Large** est lisible et complet.
8. **Les photos sont réelles et variées**, avec un slider avant/après interactif.

---

## 3. Points faibles et recommandations

### 3.1 Le H1 et les allégations santé — PRIORITÉ HAUTE
- **Constat :** le H1 dit « Dites adieu au mal de dos ». On trouve aussi « Posture parfaite », « Votre dos vous remercie dès le Jour 1 » et « Chaque heure passée assis… détériore silencieusement vos disques vertébraux ».
- **Pourquoi c'est un problème :**
  - (a) Ces formulations promettent un résultat médical, ce que `context.md` demande d'éviter.
  - (b) Meta restreint les pubs et landing pages santé, avec un risque de rejet ou de compte limité.
  - (c) Un visiteur sceptique décroche face à une promesse trop forte.
  - (d) Le seul angle « dos » exclut les visiteurs venus pour la mobilité, la productivité ou le design.
- **Recommandation :** construire le H1 sur la transformation (« Votre bureau devient assis-debout, sans changer de bureau ») et garder le dos comme bénéfice secondaire, avec des mots prudents (« aide à réduire l'inconfort lié à la position assise prolongée »).
- **Mesure :** taux de rejet des pubs, CTR pub → LP, taux de clic sur le CTA du hero.

### 3.2 Chiffres non sourcés
- **Constat :** « +40 % productivité », « Confort immédiat », « Posture parfaite ».
- **Pourquoi :** sans source, un chiffre précis passe pour du marketing et fait perdre en crédibilité.
- **Recommandation :** supprimer « +40 % ». Le remplacer par un bénéfice concret et vérifiable : « passez d'une position à l'autre en 5 secondes », « montage sans outil ».

### 3.3 Incohérences entre les sections — PRIORITÉ HAUTE
| Élément | Version A | Version B |
|---|---|---|
| Délai de livraison | « sous 72h » (barre de réassurance) | « sous 48h » (bloc final) |
| Poids | « Poids max supporté : 5 kg » (formulaire) | « Poids du support : 5 kg / 7 kg » (tableau) et « Poids supporté : 10 kg » (visuels techniques) |
| Montage | « 5 sec — montage sans outil » | « assemblées en quelques minutes sans outil » (description) |
| Nom de l'offre sans sac | « Basic HomeDesk (Sans sac) » | « Essentiel » (stratégie) |
| Sac | « Sac offert : inclus » dans le tableau | Alors qu'une version sans sac existe |

- **Pourquoi :** un acheteur COD hésitant compare les infos. Une contradiction le fait douter de tout le reste et augmente les refus à la livraison.
- **Recommandation :** une seule source de vérité. Les landing pages utilisent **72h** (la valeur la plus prudente) et parlent du **poids du support** (5 kg / 7 kg) plutôt que d'une charge max. **À trancher de ton côté : le délai réel et la charge maximale réelle.** Renommer « Basic » en **« Essentiel »** partout.

### 3.4 Le prix arrive trop tard
- **Constat :** le prix (199 DT) n'apparaît qu'au milieu du formulaire, après environ 60 % de la page.
- **Pourquoi :** en COD, le visiteur veut savoir vite si c'est dans son budget. Sans prix, il scrolle pour le chercher ou quitte la page.
- **Recommandation :** afficher « À partir de 169 DT · Paiement à la livraison » dans le hero, sous le CTA.

### 3.5 Pas de FAQ ni de traitement des objections — PRIORITÉ HAUTE
- **Constat :** aucune réponse visible à « C'est solide ? », « Ça prend de la place ? », « Quelle taille ? », « Pourquoi pas un vrai bureau assis-debout ? », « Comment se passe le retour ? ».
- **Recommandation :** une FAQ de 5 à 7 questions (accordéon) juste après le formulaire, plus un bloc « objection principale » spécifique à chaque audience.
- **Mesure :** messages WhatsApp « pré-achat » qui reposent la même question, taux de confirmation COD.

### 3.6 Ordre des sections sous-optimal
- **Constat actuel :** Hero → 4 transformations → sac → vidéos → galerie → **formulaire** → avant/après → paragraphe émotionnel → description → **avis clients** → tableau.
- **Pourquoi :** le formulaire arrive avant les preuves (avis, avant/après). Le visiteur à qui il manque un argument ne le trouve qu'en scrollant *au-delà* du formulaire, puis il doit remonter.
- **Recommandation :** Problème → Solution/démo → Bénéfices → Avant/Après → **Avis** → Choix de version → **Formulaire** → Garantie → FAQ → CTA final (voir `regles-product-page.md`).

### 3.7 Preuves sociales faibles
- **Constat :** les avatars à initiales colorées (MM, NH, OT, MH) font génériques. Les photos clients n'ont ni prénom, ni métier, ni citation.
- **Recommandation :**
  - De vrais avis : prénom, ville, métier, citation courte et photo du setup.
  - Des captures WhatsApp.
  - Le carrousel UGC remonté **avant** le formulaire.

### 3.8 Un bloc invisible sans JavaScript
- **Constat :** le bloc « Sac offert » (`.pgb-hero`) est à `opacity: 0` tant que l'IntersectionObserver ne l'a pas révélé. Sur capture pleine page, il laisse un grand trou blanc d'environ 1 500 px sur mobile.
- **Pourquoi :** si le JS est différé, bloqué ou lent (cache LiteSpeed, `defer` sur `oceanwp-custom`), le visiteur voit un vide en plein milieu de la page.
- **Recommandation :** contenu visible par défaut, animation seulement en amélioration (`.js .pgb { opacity: 0 }`).

### 3.9 Vidéos YouTube
- **Constat :** deux iframes YouTube. On voit des rectangles noirs avant le chargement, le JS YouTube est lourd, et le logo ou les vidéos suggérées peuvent faire sortir le visiteur.
- **Recommandation :** utiliser une vidéo MP4 hébergée sur le site (`muted autoplay loop playsinline`) avec une image d'aperçu, comme `home-desk-.mp4`, déjà présente dans `uploads`.

### 3.10 Frictions du formulaire
- **L'email est obligatoire.** En Tunisie COD, beaucoup de clients n'en ont pas sous la main. Le rendre **optionnel**, le téléphone suffit pour confirmer.
- **Le bloc « Vos équipes souffrent-elles de maux de dos ? »** est placé dans le formulaire, juste sous le bouton. Ça distrait au moment critique. Le déplacer dans le footer.
- **Pas de rappel de garantie ni de COD au niveau du bouton.** Ajouter « Vous payez à la réception · 3 jours pour essayer » juste sous le CTA.

### 3.11 Pas de CTA collant sur mobile, pas de WhatsApp visible
- **Constat :** aucun bouton « Commander » ne reste visible sur mobile pendant le scroll. Le widget WhatsApp n'est pas détecté sur la page produit, alors que le plugin est actif.
- **Recommandation :** une barre collante en bas sur mobile (prix + bouton qui descend au formulaire) et un bouton WhatsApp flottant pour les questions pré-achat.

### 3.12 Navigation qui fait sortir
- **Constat :** le menu (Accueil, Notre solution, Contact…) et le panier sont visibles. Sur une landing page de pub, chaque lien est une fuite.
- **Recommandation :** sur les LP Meta, garder un header réduit au logo (non cliquable ou vers l'ancre du formulaire) et, éventuellement, WhatsApp.

### 3.13 Une seule page pour toutes les audiences
- **Constat :** le développeur, l'étudiant et la personne qui a mal au dos atterrissent sur le même message.
- **Recommandation :** une landing page par audience (les 5 pages de ce dossier) : même offre et même formulaire, mais un H1, un problème, des visuels, des témoignages, une objection principale et une version mise en avant différents. Le champ « Profil » est pré-rempli selon la page.
- **Mesure :** taux de conversion LP par audience (UTM + champ Profil), CAC par audience.

---

## 4. Plan d'action priorisé (sur le site actuel)

| # | Action | Effort | Impact attendu |
|---|---|:-:|:-:|
| 1 | Corriger les incohérences (72h/48h, poids, Basic/Essentiel, montage) | Faible | Élevé |
| 2 | Retirer « +40 % », « disques vertébraux », « posture parfaite » ; reformuler le H1 | Faible | Élevé |
| 3 | Prix « à partir de » dans le hero + rappel COD/garantie sous chaque CTA | Faible | Élevé |
| 4 | FAQ de 5 à 7 questions | Faible | Élevé |
| 5 | Email optionnel, bloc B2B sorti du formulaire | Faible | Moyen |
| 6 | Remonter avis et avant/après **avant** le formulaire | Moyen | Élevé |
| 7 | CTA collant mobile + WhatsApp | Moyen | Moyen |
| 8 | Bloc sac visible sans JS | Faible | Moyen |
| 9 | MP4 local à la place de YouTube | Moyen | Moyen |
| 10 | Landing pages par audience (ce dossier) | Élevé | Élevé |
