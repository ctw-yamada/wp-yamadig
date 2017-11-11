<?php
/**
 * Contains the post embed content template part
 *
 * When a post is embedded in an iframe, this file is used to create the content template part
 * output if the active theme does not include an embed-content.php template.
 *
 * @package WordPress
 * @subpackage Theme_Compat
 * @since 4.5.0
 */
?>
<style>
.wp-embed {
    padding: 12px;
    font-family: 'Helvetica', 'Arial', 'メイリオ', 'Meiryo', 'MS PGothic', sans-serif;
}
.wp-embed-site-title {
    float: left ;
}
.wp-embed-meta {
    float: right ;
}
.wp-embed-header {
}
.wp-embed-body {
    clear: both ;
    line-height: 2em;
}
.wp-embed-body a {
    font-size: 17px ;
    font-weight: bold ;
    color: #333 ;
}
.wp-embed-excerpt {
    color: #333 ;
}
.wp-embed-featured-image.square {
    max-height: 100px;
    max-width: 100px ;
    margin: 0 0 0 20px ;
    overflow: hidden;
    float: right ;
}
</style>
    <div <?php post_class( 'wp-embed' ); ?>>
        <?php
        $thumbnail_id = 0;

        if ( has_post_thumbnail() ) {
            $thumbnail_id = get_post_thumbnail_id();
        }

        if ( 'attachment' === get_post_type() && wp_attachment_is_image() ) {
            $thumbnail_id = get_the_ID();
        }

        $aspect_ratio = 1;
        $measurements = array( 1, 1 );
        $image_size   = 'full'; // Fallback.

        $meta = wp_get_attachment_metadata( $thumbnail_id );
        if ( ! empty( $meta['sizes'] ) ) {
            foreach ( $meta['sizes'] as $size => $data ) {
                if ( $data['width'] / $data['height'] > $aspect_ratio ) {
                    $aspect_ratio = $data['width'] / $data['height'];
                    $measurements = array( $data['width'], $data['height'] );
                    $image_size   = $size;
                }
            }
        }

        /**
         * Filter the thumbnail image size for use in the embed template.
         *
         * @since 4.4.0
         * @since 4.5.0 Added `$thumbnail_id` parameter.
         *
         * @param string $image_size   Thumbnail image size.
         * @param int    $thumbnail_id Attachment ID.
         */
        $image_size = apply_filters( 'embed_thumbnail_image_size', $image_size, $thumbnail_id );

        $shape = $measurements[0] / $measurements[1] >= 1.75 ? 'rectangular' : 'square';

        /**
         * Filter the thumbnail shape for use in the embed template.
         *
         * Rectangular images are shown above the title while square images
         * are shown next to the content.
         *
         * @since 4.4.0
         * @since 4.5.0 Added `$thumbnail_id` parameter.
         *
         * @param string $shape        Thumbnail image shape. Either 'rectangular' or 'square'.
         * @param int    $thumbnail_id Attachment ID.
         */
        $shape = apply_filters( 'embed_thumbnail_image_shape', $shape, $thumbnail_id );
?>


        <div class="wp-embed-heading">
         <?php $url_host = parse_url(get_the_permalink(), PHP_URL_HOST) ; ?>
            <a href="<?php echo get_bloginfo('home'); ?>" target="_blank"><img src="http://www.google.com/s2/favicons?domain=<?php echo $url_host; ?>" alt="<?= $url_host ?>" title="<?= $url_host ?>" class="favicon"/> <?php echo $url_host; ?></a>
            <?php //the_embed_site_title() ?>
            <div class="wp-embed-meta">
                <?php do_action( 'embed_content_meta'); ?>
            </div>
        </div>

        <div class="wp-embed-body">
        <div class="wp-embed-featured-image square">
            <a href="<?php the_permalink(); ?>" target="_top">
                <?php echo wp_get_attachment_image( $thumbnail_id, $image_size ); ?>
            </a>
        </div>

 
            <a href="<?php the_permalink(); ?>" target="_top">
                <?php the_title(); ?>
            </a>
        </div>

        <div class="wp-embed-excerpt"><?php the_excerpt_embed(); ?></div>

        <?php
        /**
         * Print additional content after the embed excerpt.
         *
         * @since 4.4.0
         */
        do_action( 'embed_content' );
        ?>

        <div class="wp-embed-footer">
            <a href="<?php the_permalink(); ?>" target="_blank"><small><?php the_date(); ?></small></a>
            <img src="http://s.st-hatena.com/entry.count.image?uri=<?php echo urlencode(get_the_permalink()); ?>" alt="" class="star-count" />
            <a href="http://b.hatena.ne.jp/entry/<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><img src="http://b.st-hatena.com/entry/image/<?php echo urlencode(get_the_permalink()); ?>" class="bookmark-count"/></a>

            <?php //the_embed_site_title() ?>

            <div class="wp-embed-meta">
                <?php
                /**
                 * Print additional meta content in the embed template.
                 *
                 * @since 4.4.0
                 */
                //do_action( 'embed_content_meta');
                ?>
            </div>
        </div>
    </div>
<?php