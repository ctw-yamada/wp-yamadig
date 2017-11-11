{% extends "layouts.php" %}
{% block content %}
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">


{% for maker in makers%}
  <div class="grid-posts-holder">
    <div class="titlecatholder"><span><a href='/{{maker.post_name}}'>{{maker.post_title}}</a></span></div>
    {% for post in maker.posts%}
      <div class="grid-posts-small" itemprop="image">
      {% if post.thumbnail != '' %}
         <a href="{{post.permalink}}" class="thumbnail-wrapper">
         <img src="{{post.thumbnail_url}}" alt="{{post.post_title}}" />'</a>
      {%else%}
         <a href="{{post.permalink}}" class="thumbnail-wrapper">
          echo '<img src="';
          echo esc_url( get_template_directory_uri() );
          echo '/img/gridpostsmall.jpg" alt="';the_title();
          echo '" />';
          echo '</a>';
      {%endif%}
      <h2 itemprop="headline">
          <a href="{{post.permalink}}" rel="bookmark">{{post.post_title}}</a>
      </h2>
      </div>
    {% endfor %}
  </div>
{% endfor %}

<!--Grid Posts-->





    </main>
</div>
{% endblock %}