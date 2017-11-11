{% extends "layouts.php" %}
{% block content %}
<div class="main-outer container">
  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
{% for post in posts %}
  <pre>
{{dump(post)}}
  </pre>
  <article id="post-{{post.ID}}" class="{{post.class}}" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
    <header class="entry-header">
      <h1 class="entry-title" itemprop="text">{{post.post_title}}</h1>

      <div class="entry-meta">
        <div class="postdcp"><?php drag_themes_posted_on(); ?></div>
      </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <?php
     if(get_theme_mod('aqueduct_featured_toggle', false)){
       if ( get_the_post_thumbnail() != '' ) {
       echo '<a href="'; the_permalink(); echo '" class="thumbnail-wrapper">';
       $source_image_url = get_the_post_thumbnail_url($post->ID, 'aqueduct-xlarge');
        echo '<img src="';
        echo $source_image_url;
        echo '" alt="';the_title();
        echo '" />';
         echo '</a>';
         }
     }
     ?>
    <div class="entry-content" itemprop="text">
      <?php the_content(); ?>
      <?php
        wp_link_pages( array(
          'before' => '<div class="page-links">' . __( 'Pages:', 'aqueduct' ),
          'after'  => '</div>',
        ) );
      ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
      <h4>メーカー</h4>
      <?php
        $html_a = "<a href='%s'>
          <button type='button' class='btn btn-primary'>
          %s<span class='badge badge-light'>9</span>
          <span class='sr-only'></span>
          </button>
        </a>";
        
        $relations = rpt_get_object_relation(get_the_ID(), 'maker');
        $args = [ 'post_type' => 'maker' ,
                'post__in' => $relations
              ];
        if($relations){
          $the_query = new WP_Query( $args );
          if( $the_query->have_posts() ){
            while ( $the_query->have_posts() ) : $the_query->the_post();
              $post_id = get_the_ID();
              echo sprintf($html_a, get_permalink( $post_id), get_the_title($post_id));
            endwhile;
            wp_reset_postdata();
          }
        }
      ?>
      <?php drag_themes_entry_footer(); ?>
    </footer><!-- .entry-footer -->
  </article><!-- #post-## -->






















            <div class="post-navss">
      <?php the_post_navigation(); ?>
            </div>
{% endfor %}
{% endblock %}