<?php
/**
 * Entry portfolio items
 */

// Vars
$title_cat_position = get_post_meta( $sh_id, 'op_portfolio_title_cat_position', true );
$title_cat_position = $title_cat_position ? $title_cat_position : 'outside';
$title 				= get_post_meta( $sh_id, 'op_portfolio_title', true );
$title 				= $title ? $title : 'on';
$title_link 		= get_post_meta( $sh_id, 'op_portfolio_add_title_link', true );
$title_link 		= $title_link ? $title_link : 'on';
$heading 			= get_post_meta( $sh_id, 'op_portfolio_title_tag', true );
$heading 			= $heading ? $heading : 'h3';
$category 			= get_post_meta( $sh_id, 'op_portfolio_category', true );
$category 			= $category ? $category : 'on';
$image_target 		= get_post_meta( $sh_id, 'op_portfolio_image_target', true );
$image_target 		= $image_target ? $image_target : 'item';
$img_size 			= get_post_meta( $sh_id, 'op_portfolio_size', true );
$img_size 			= $img_size ? $img_size : 'medium';
$img_width 			= get_post_meta( $sh_id, 'op_portfolio_img_width', true );
$img_width 			= $img_width ? $img_width : '';
$img_height 		= get_post_meta( $sh_id, 'op_portfolio_img_height', true );
$img_height 		= $img_height ? $img_height : '';
$overlay_icons 		= get_post_meta( $sh_id, 'op_portfolio_img_overlay_icons', true );
$overlay_icons 		= $overlay_icons ? $overlay_icons : 'on';
$link_icon 			= get_post_meta( $sh_id, 'op_portfolio_img_overlay_link_icon', true );
$link_icon 			= $link_icon ? $link_icon : 'on';
$lightbox_icon 		= get_post_meta( $sh_id, 'op_portfolio_img_overlay_lightbox_icon', true );
$lightbox_icon 		= $lightbox_icon ? $lightbox_icon : 'on';

// If external link
$meta = get_post_meta( get_the_ID(), 'op_external_url', true );
if ( ! empty( $meta ) ) {
    $link = $meta;
    $image_link = $meta;
} else {
    $link = get_the_permalink();
    $image_link = get_the_permalink();
}

// External link target
$target = get_post_meta( get_the_ID(), 'op_external_url_target', true );
$target = $target ? $target: 'self';

// Thumbnail type.
$thumbnail_type = get_post_meta( get_the_ID(), 'op_portfolio_post_thubnail_type', true );
$thumbnail_type = $thumbnail_type ? $thumbnail_type: 'image';

// Image attr
$img_id  = get_post_thumbnail_id( get_the_ID(), 'full' );
$img_url = wp_get_attachment_image_src( $img_id, 'full', true );

// Class
$classes = array( 'thumbnail-link' );

// Link target
if ( 'lightbox' == $image_target ) {
    $image_link 	= wp_get_attachment_url( $img_id );
    $target = 'self';
    $classes[] = 'portfolio-lightbox';
    $classes[] = 'no-lightbox';
} else {
    $classes[] = 'op-link';
}

// Turn classes into space seperated string
$classes = implode( ' ', $classes );

// Image data
$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $img_size );

$data_size = '';
if (is_array($image) && count($image) >= 3) {
	$data_size = esc_attr($image[1]) . 'x' . esc_attr($image[2]);
}

$video = op_get_post_video_html(); ?>

<div class="portfolio-entry-inner clr">

    <?php
    // Featured image
    if ( has_post_thumbnail() && 'image' === $thumbnail_type ) { ?>

        <div class="portfolio-entry-thumbnail">

            <a href="<?php echo esc_url( $image_link ); ?>" class="<?php echo esc_attr( $classes ); ?>" target="_<?php echo esc_attr( $target ); ?>" data-size="<?php echo esc_attr($data_size); ?>" itemprop="contentUrl">

                <?php
                // If Ocean Extra is active
                if ( class_exists( 'Ocean_Extra' ) ) {

                    // Image attrs
                    $img_atts 	= ocean_extra_image_attributes( $img_url[1], $img_url[2], $img_width, $img_height );

                    // Display post thumbnail
                    if ( 'custom' == $img_size
                        && ! empty( $img_atts ) ) { ?>
                        <img src="<?php echo ocean_extra_resize( $img_url[0], $img_atts[ 'width' ], $img_atts[ 'height' ], $img_atts[ 'crop' ], true, $img_atts[ 'upscale' ] ); ?>" alt="<?php esc_attr( the_title() ); ?>" width="<?php echo esc_attr( $img_width ); ?>" height="<?php echo esc_attr( $img_height ); ?>" itemprop="image" />
                    <?php
                    } else {
                        the_post_thumbnail( $img_size, array(
                            'alt'		=> get_the_title(),
                            'itemprop' 	=> 'image',
                        ) );
                    }

                } ?>

                <div class="overlay"></div>

            </a>

            <?php
            // Overlay content
            if ( 'on' == $overlay_icons || 'inside' == $title_cat_position ) { ?>
                <div class="portfolio-overlay-content">
                    <?php
                    // Overlay icons
                    if ( 'on' == $overlay_icons ) { ?>
                        <ul class="portfolio-overlay-icons">
                            <?php
                            // Overlay link icon
                            if ( 'on' == $link_icon ) { ?>
                                <li>
                                    <a href="<?php echo esc_url( $link ); ?>" class="op-link" target="_<?php echo esc_attr( $target ); ?>" itemprop="contentUrl"><?php op_svg_icon( 'link' ); ?></a>
                                </li>
                            <?php }

                            // Overlay lightbox icon
                            if ( 'on' == $lightbox_icon
                                && 'lightbox' != $image_target ) { ?>
                                <li>
                                    <a href="<?php echo esc_url( wp_get_attachment_url( $img_id ) ); ?>" class="portfolio-lightbox no-lightbox" data-size="<?php echo esc_attr($data_size); ?>" itemprop="contentUrl"><?php op_svg_icon( 'search' ); ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php }

                    // If title or category
                    if ( 'inside' == $title_cat_position
                        && ( 'on' == $title || 'on' == $category ) ) {

                        // Class
                        $class = '';
                        if ( 'on' == $overlay_icons ) {
                            $class = ' has-icons';
                        } ?>

                        <div class="portfolio-inside-content clr<?php echo esc_attr( $class ); ?>">
                            <?php
                            // If title
                            if ( 'on' == $title ) { ?>
                                <<?php echo esc_attr( $heading ); ?> class="portfolio-entry-title entry-title">
                                    <?php
                                    // If title link
                                    if ( 'on' == $title_link ) { ?>
                                        <a href="<?php echo esc_url( $link ); ?>" class="op-link" title="<?php the_title_attribute(); ?>" rel="bookmark" target="_<?php echo esc_attr( $target ); ?>" itemprop="contentUrl">
                                    <?php
                                    }
                                            the_title();
                                    // If title link
                                    if ( 'on' == $title_link ) { ?>
                                        </a>
                                    <?php
                                    } ?>
                                </<?php echo esc_attr( $heading ); ?>>
                            <?php
                            }

                            // If category
                            if ( 'on' == $category ) {
                                if ( $categories = op_portfolio_category_meta() ) {?>
                                    <div class="categories"><?php echo $categories; ?></div>
                                <?php }
                            } ?>
                        </div>

                    <?php } ?>
                </div>
            <?php } ?>

            <?php
            // If title or category
            if ( 'outside' == $title_cat_position
                && ( 'on' == $title || 'on' == $category ) ) { ?>
                <div class="triangle-wrap"></div>
            <?php } ?>

        </div>

    <?php
    } else if ( $video && 'video' === $thumbnail_type ) {
		?>
		<div class="portfolio-entry-thumbnail">

			<?php echo $video; ?>


			<?php
			// If title or category
			if ( 'outside' == $title_cat_position
				&& ( 'on' == $title || 'on' == $category ) ) { ?>
				<div class="triangle-wrap"></div>
			<?php } ?>
		</div>
		<?php
	} else {
		?>
		<div class="portfolio-entry-thumbnail has-placeholder">
			<?php
			$has_svg = '<svg height="200" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><g id="Layer_2" data-name="Layer 2"><path d="m28.22 1.5h-24.44a2.28 2.28 0 0 0 -2.28 2.28v24.44a2.28 2.28 0 0 0 2.28 2.28h24.44a2.28 2.28 0 0 0 2.28-2.28v-24.44a2.28 2.28 0 0 0 -2.28-2.28zm-24.44 1h24.44a1.28 1.28 0 0 1 1.28 1.28v12.86l-5.18 1.73a10.62 10.62 0 0 1 -6.64 0l-2.22-.74a11.42 11.42 0 0 0 -6.94-.11l-6 1.81v-15.55a1.28 1.28 0 0 1 1.26-1.28zm24.44 27h-24.44a1.28 1.28 0 0 1 -1.28-1.28v-7.85l6.31-1.89a10.44 10.44 0 0 1 6.33.09l2.23.75a11.55 11.55 0 0 0 7.26 0l4.87-1.63v10.53a1.28 1.28 0 0 1 -1.28 1.28z"/><path d="m24 11.5a2.5 2.5 0 1 0 -2.5-2.5 2.5 2.5 0 0 0 2.5 2.5zm0-4a1.5 1.5 0 1 1 -1.5 1.5 1.5 1.5 0 0 1 1.5-1.5z"/></g></svg>';
			$has_svg = apply_filters( 'op_entry_thumbnail_placeholder', $has_svg );

			echo $has_svg;
			?>
		</div>
		<?php
	}

    // If title or category
    if ( 'outside' == $title_cat_position
        && ( 'on' == $title || 'on' == $category ) ) { ?>

        <div class="portfolio-content clr">
            <?php
            // If title
            if ( 'on' == $title ) { ?>
                <<?php echo esc_attr( $heading ); ?> class="portfolio-entry-title entry-title">
                    <?php
                    // If title link
                    if ( 'on' == $title_link ) { ?>
                        <a href="<?php echo esc_url( $link ); ?>" class="op-link" title="<?php the_title_attribute(); ?>" rel="bookmark" target="_<?php echo esc_attr( $target ); ?>" itemprop="contentUrl">
                    <?php
                    }
                            the_title();
                    // If title link
                    if ( 'on' == $title_link ) { ?>
                        </a>
                    <?php
                    } ?>
                </<?php echo esc_attr( $heading ); ?>>
            <?php
            }

            // If category
            if ( 'on' == $category ) {
                if ( $categories = op_portfolio_category_meta() ) {?>
                    <div class="categories"><?php echo $categories; ?></div>
                <?php }
            } ?>
        </div>

    <?php } ?>

</div>
