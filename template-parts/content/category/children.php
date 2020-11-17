<?php
$cat_ID         = get_queried_object_id();
if (is_category($cat_ID)) :
    $args = ['parent' => $cat_ID, 'hide_empty' => false];
    $categories = get_categories($args);
    if(count($categories) ===0) {
        return;
    }
    ?>

    <div class="d-lg-none pr-12px border border-dark-primary mt-48px">
        <select name="categories" id="cat-select" class="fs-short-3 ff-semibold">
            <option value="0" selected>Tout</option>
            <?php
            foreach ($categories as $category) {
                ?>
                <option value="<?php echo $category->cat_ID ?>"><?php echo $category->name ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <!--OBJECT | TAGS-->
    <div class="d-none d-lg-block overflow-hidden w-100 pt-48px col-6 px-0">
        <ul class="object-tags">
            <li class="active pr-24px"><a href="#">Tout</a></li>
            <?php
            foreach ($categories as $category) {
                $url = get_category_link($category->term_id);
                ?>
                <li><a href="<?php echo $url ?>"><?php echo $category->name ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
<?php endif;
