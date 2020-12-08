<?php
global $s;
$s = get_search_query();
$s = "Rechercher";
?>
<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" name="s" placeholder="Que cherchez-vous ?"
           class="border-0 rounded-pill h-32px pl-16px pr-48px fs-short-3">
    <button type="submit"
            class="position-absolute top-0 bottom-0 right-0 w-32px h-32px d-flex justify-content-center align-items-center p-0 border-0 rounded-right-pill bg-transparent icon_custom">
        <!--<i class="fa fa-search text-dark-primary"></i>-->
        <i class="i-search i-dark-primary w-16px h-16px"></i>
    </button>
</form>