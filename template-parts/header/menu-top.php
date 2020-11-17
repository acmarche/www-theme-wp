<?php

namespace AcMarche\Theme;

use AcMarche\Theme\Lib\Menu;

$menu = new Menu();
?>
<div class="all d-ls-flex align-items-ls-center justify-content-ls-center">
    <a href="#" class="icon_custom position-relative">
        <i class="icon_nav i-bars"></i>
        <i class="i-bars i-dark-primary"></i>
        <span>Vivre à Marche</span>
        <!--<input type="radio" name="subnav" value="1" class="w-100 h-100">-->
    </a>

    <!--subnav-->
    <div class="subnav">
        <ul>
            <li class="d-flex flex-row align-items-center p-24px d-xl-none col-ls-12">
                <h3 class="flex-grow-1 text-white text-left">Vivre à Marche</h3>
                <a href="#"
                   class="position-relative w-24px h-24px d-flex justify-content-center align-items-center p-0 icon_custom">
                    <i class="i-times i-white"></i>
                    <!--<input type="radio" name="subnav" value="0" class="w-100 h-100">-->
                </a>
            </li>

            <!--administration-->
            <li class="c-adm col-xl-5 mt-xl-12px col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Administration<i
                            class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Administration</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(2);
                    ?>
                </div>
            </li>

            <!--citoyen-->
            <li class="c-cit col-xl-5 col-ls-6 col-ls-xl-5">
                <a href="category.html" class="icon_custom">Citoyen<i
                            class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Citoyen</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(1);
                    ?>
                </div>
            </li>

            <!--culture-->
            <li class="c-cul col-xl-5 col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Culture<i class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Culture</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(11);
                    ?>
                </div>
            </li>

            <!--economie-->
            <li class="c-eco col-xl-5 col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Économie<i class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Économie</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(3);
                    ?>
                </div>
            </li>

            <!--enfance/jeunesse-->
            <li class="c-enf col-xl-5 col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Enfance-Jeunesse<i
                            class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Enfance-Jeunesse</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(14);
                    ?>
                </div>
            </li>

            <!--sante-->
            <li class="c-san col-xl-5 col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Santé<i class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Santé</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(6);
                    ?>
                </div>
            </li>

            <!--social-->
            <li class="c-soc col-xl-5 col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Social<i class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Social</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(7);
                    ?>
                </div>
            </li>

            <!--sport-->
            <li class="c-spo col-xl-5 col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Sport<i class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Sport</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(5);
                    ?>
                </div>
            </li>

            <!--tourisme-->
            <li class="c-tou col-xl-5 mb-xl-12px col-ls-6 col-ls-xl-5">
                <a href="#" class="icon_custom">Tourisme<i class="i-angle-right i-white bg-size-50"></i></a>

                <div class="col-xl-7">
                    <div class="p-24px d-xl-none col-ls-12">
                        <h3 class="text-left">Tourisme</h3>
                        <span class="d-flex flex-row align-items-center pt-8px">
                                           <a href="#"
                                              class="d-flex flex-grow-1 align-items-center fs-short-2 text-dark-primary icon_custom"><i
                                                       class="i-angle-left bg-size-40 bg-position-left"></i>Retour sur Vivre à Marche</a>
                                           <a href="#"
                                              class="position-relative w-24px h-24px d-flex justify-content-center align-items-center icon_custom">
                                               <i class="i-times"></i>
                                           </a>
                                       </span>
                    </div>
                    <?php
                    echo $menu->getMenu(4);
                    ?>
                </div>
            </li>
        </ul>
    </div>
</div>
