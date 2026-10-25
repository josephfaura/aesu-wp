<?php
/**
 * The sidebar containing the main widget area
 *
 * @package AWI_Revamped
 */
?>

<?php if (is_home() || is_single() || is_archive()) { ?>

    <div class="sidebar">
        <ul>
            <?php dynamic_sidebar(); ?>
        </ul>
    </div>

<?php } else { ?>

    <?php the_field('sidebar_block', get_queried_object_id()); ?>

<?php } ?>