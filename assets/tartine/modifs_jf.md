icones accueil (home_search.html.twig)
---

Elargit div : mw-400px => mw-500px
Texte plus grand en gras : fs-short-3 => fs-short-1 ff-semibold
Centrage des textes : sur li col-3 => col-3 d-flex justify-content-center

Navigation (nav.scss)
___
Texte plus grand: ligne 606 : font-size: $shortFontSize-3=> font-size: $shortFontSize-1;
<!-- not do ligne 501 : font-size: $shortFontSize-3=> font-size: $shortFontSize-1; -->

Je met l'alerte plus haut
---
.object-alert {
    position: fixed;
    /*top: auto;*/
    top: 120px;

  bottom: auto; ligne 24

Dans config.scss
---

changé les valeurs de $shortFontSize-*

Retirer bouton lire plus
---

Dans objects.scss
---
**Pour retirer le lire plus**
A partir de la ligne 131, remplacer les max-height par 9999px
Retirer la ligne 534: overflow: hidden;
Dans base.html.twig mettre la class d-none sur span <span class="more"> et less

Pour titre event en list
max-height: de 30 a 40 ligne 753
h3 {
                        max-height: 40px;
                    }

ligne 889 default image .bg-img-directory-1
background-image: url(../../../images/commerce_default.png);

Tags
----

Retirer overflow-hidden dans base.html
