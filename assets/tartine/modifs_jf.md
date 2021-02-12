icones accueil (home_search.html.twig)
---
**Textes icones plus grands**
Elargit div : mw-400px => mw-500px
Texte plus grand en gras : fs-short-3 => fs-short-1 ff-semibold
Centrage des textes : sur li col-3 => col-3 d-flex justify-content-center

Navigation (nav.scss)
---
**Texte dans menu plus grand**
Texte plus grand: ligne 616 : font-size: $shortFontSize-3=> font-size: $shortFontSize-1;


Dans config.scss
---
**Changer toutes les tailles des textes**
changé les valeurs de $shortFontSize-*

$shortFontSize-1: .975rem;
$shortFontSize-2: .95rem;
$shortFontSize-3: .875rem;

Dans objects.scss
---

**Je met l'alerte plus haut dans objects.scss**

.object-alert {
position: fixed;
/*top: auto;*/
top: 120px;
bottom: auto;

**Pour titre event en list**
max-height: de 30 a 40 ligne 758
h3 {
     max-height: 40px;
   }
ligne 681:   height: 40px;
**Pour news list**
ligne 676 de 45 a 55 px
h3 {
   max-height: 55px;
}
**Pour image par defaut fiche bottin**
ligne 893 default image .bg-img-directory-1
background-image: url(../../../images/commerce_default.png);

Retirer bouton lire plus
---
Dans article/base.html.twig mettre la class d-none sur span <span class="more"> et less

Tags
----
**Si trop s'affiche pas bien**
Retirer overflow-hidden dans base.html
