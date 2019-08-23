
<?php wp_head(); ?>
<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="https://getbootstrap.com/docs/4.3/examples/blog/#">Subscribe</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="https://getbootstrap.com/docs/4.3/examples/blog/#">Large</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="text-muted" href="https://getbootstrap.com/docs/4.3/examples/blog/#">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"></circle><path d="M21 21l-5.2-5.2"></path></svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="https://getbootstrap.com/docs/4.3/examples/blog/#">Sign up</a>
      </div>
    </div>
  </header>

  <!-- We gonnna get all the categories -->
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-center">
      <?php 
        $categories = get_categories();
        foreach ($categories as $item) {
          # code...
          print "<a class=\"p-2 text-muted\"  href=\"".get_site_url()."/?cat=".$item->cat_ID."\">".$item->name."</a>";
        }
      ?>
    </nav>
  </div>

   <!-- Featured Post -->
   <?php 
      // select sticky post or most recent post if sticky isn't set
      $args = array( 
                    'numberposts' => 1,
                    'post__in' => get_option( 'sticky_posts' ),
                    'ignore_sticky_posts' => 1);
      $featured_post = wp_get_recent_posts( $args );
      $rendered_feature_post = array(
        "title" => "Untitled",
        "text" => "There is no post buddy.",
        "link" => site_url(),
        "background_image" => "",
        "date" => ""
      );
      if(sizeof($featured_post)>0){

        $rendered_feature_post['title'] = $featured_post[0]["post_title"];
        $rendered_feature_post['text'] = wp_trim_words( $featured_post[0]["post_content"], 23 );
        $rendered_feature_post['date'] = $featured_post[0]["post_date"];
        $rendered_feature_post['link'] = $featured_post[0]["guid"];
        $$rendered_feature_post['image']  = get_the_post_thumbnail_url( $featured_post[0]["ID"] );
      }
      $a="a";
    ?>
  <div style="background-image:url(<?php print $$rendered_feature_post['image'] ?>)" class="jumbotron  p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic"><?php print $rendered_feature_post['title']; ?></h1>
      <p class="lead my-3"><?php print $rendered_feature_post['text']; ?></p>
      <p class="lead mb-0"><a href="<?php print $rendered_feature_post['link']; ?>" class="text-white font-weight-bold">Continue reading...</a></p>
    </div>
  </div>

  <?php 
  // Featured posts row: 2 latest posts only
    $args = array(
      'numberposts' => 2,
      'exclude' => array(9)
    );
    $featured_posts = wp_get_recent_posts( $args );
  ?>
  <?php 
    if( sizeof($featured_posts) > 0 ): 
      print "<div class=\"row mb-2\">";
      foreach($featured_posts as $idx=> $item):
        // init
        $category_text = "General";
        $cat = get_the_category( $item['ID'] );
        $even_odd_classes = $idx % 2 == 0? "text-primary":"text-success";
        //$published_date = date_parse($item['post_date']);
        $published_date = date_format ( date_create($item['post_date']) , "M, Y" ); 
        if(sizeof($cat)>0)
          $category_text = $cat[0]->name;
        // endinit
  ?>
  
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 <?php print $even_odd_classes; ?>">
            <?php print $category_text." ".$even_odd; ?>
          </strong>
          <h3 class="mb-0"><?php print $item['post_title']; ?></h3>
          <div class="mb-1 text-muted"><?php print $published_date; ?></div>
          <p class="card-text mb-auto"><?php print wp_trim_words( $item['post_content'], 15 ); ?></p>
          <a href="<?php print $item['guid']; ?>" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img class="img" style="object-fit: cover;" width="200" height="250"  src="<?php print get_the_post_thumbnail_url($item['ID']); ?>" alt="">
        </div>
      </div>
    </div>

  
  <?php 
    endforeach;
    print "</div>";
    endif; 
  ?>
</div>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        From the Firehose
      </h3>

      <div class="blog-post">
        <h2 class="blog-post-title">Sample blog post</h2>
        <p class="blog-post-meta">January 1, 2014 by <a href="https://getbootstrap.com/docs/4.3/examples/blog/#">Mark</a></p>

        <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
        <hr>
        <p>Cum sociis natoque penatibus et magnis <a href="https://getbootstrap.com/docs/4.3/examples/blog/#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
        <blockquote>
          <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </blockquote>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <h2>Heading</h2>
        <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <h3>Sub-heading</h3>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        <pre><code>Example code block</code></pre>
        <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
        <h3>Sub-heading</h3>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <ul>
          <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
          <li>Donec id elit non mi porta gravida at eget metus.</li>
          <li>Nulla vitae elit libero, a pharetra augue.</li>
        </ul>
        <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
        <ol>
          <li>Vestibulum id ligula porta felis euismod semper.</li>
          <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
          <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
        </ol>
        <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
      </div><!-- /.blog-post -->

      <div class="blog-post">
        <h2 class="blog-post-title">Another blog post</h2>
        <p class="blog-post-meta">December 23, 2013 by <a href="https://getbootstrap.com/docs/4.3/examples/blog/#">Jacob</a></p>

        <p>Cum sociis natoque penatibus et magnis <a href="https://getbootstrap.com/docs/4.3/examples/blog/#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
        <blockquote>
          <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        </blockquote>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
      </div><!-- /.blog-post -->

      <div class="blog-post">
        <h2 class="blog-post-title">New feature</h2>
        <p class="blog-post-meta">December 14, 2013 by <a href="https://getbootstrap.com/docs/4.3/examples/blog/#">Chris</a></p>

        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <ul>
          <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
          <li>Donec id elit non mi porta gravida at eget metus.</li>
          <li>Nulla vitae elit libero, a pharetra augue.</li>
        </ul>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
        <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
      </div><!-- /.blog-post -->

      <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="https://getbootstrap.com/docs/4.3/examples/blog/#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="https://getbootstrap.com/docs/4.3/examples/blog/#" tabindex="-1" aria-disabled="true">Newer</a>
      </nav>

    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">
      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>

      <div class="p-4">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">March 2014</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">February 2014</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">January 2014</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">December 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">November 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">October 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">September 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">August 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">July 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">June 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">May 2013</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">April 2013</a></li>
        </ol>
      </div>

      <div class="p-4">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">GitHub</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">Twitter</a></li>
          <li><a href="https://getbootstrap.com/docs/4.3/examples/blog/#">Facebook</a></li>
        </ol>
      </div>
    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</main><!-- /.container -->

<?php get_footer(); ?>

