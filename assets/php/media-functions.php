<?php

/**
 *
 * OGK BASE - Media Functions
 *
 */


function ogk_get_background_image_css($image_id, $id) {

  global $theme_setup;

  //$lazy = (isset($vars['lazy'])) ? $vars['lazy'] : false;
  //$lazy = true;

  ob_start();
  ?>
  <style type=text/css>
    <?php
    $count = 0;
    foreach ($theme_setup['css_breakpoints'] as $key => $data) :

      //$image_url = wp_get_attachment_url($image_id);

      $main_image_key = $data['main_image'];
      $main_image = wp_get_attachment_image_src($image_id, $main_image_key)[0];
      $main_image_webp = str_replace("uploads", "uploads-webpc/uploads", $main_image);
      $main_image_webp = $main_image_webp . '.webp';
      //echo '<pre>'; print_r($main_image); echo '</pre>';

      //$retina_image_key = $data['retina_image'];
      //$retina_image = ($data['retina_image'] == 'full') ? $image_url : wp_get_attachment_image_src($image_id, $retina_image_key)[0];
      //$retina_image_webp = str_replace("uploads", "uploads-webpc", $retina_image);
      //echo '<pre>'; print_r($retina_image); echo '</pre>';
      ?>
    <?php
    if ( $count == 0 ) :
     ?>

    @media only screen and (min-width: <?php echo $data['max_width']+1; ?>px) {
    <?php echo '#'.$id ;?> {
      background: url(<?php echo $main_image; ?>) no-repeat center / cover;
    }
    <?php if ( $theme_setup['conditional_webp'] ) : ?>
    <?php echo '.webp #'.$id ;?> {
      background: url(<?php echo $main_image_webp; ?>) no-repeat center / cover;
    }
    <?php endif; ?>
    }

    <?php
    endif;
    ?>

    @media only screen and (max-width: <?php echo $data['max_width']; ?>px) {
    <?php echo '#'.$id ;?> {
      background: url(<?php echo $main_image; ?>) no-repeat center / cover;
    }
    <?php if ( $theme_setup['conditional_webp'] ) : ?>
    <?php echo '.webp #'.$id ;?> {
      background: url(<?php echo $main_image_webp; ?>) no-repeat center / cover;
    }
    <?php endif; ?>
    }

    <?php
    $count++;
    endforeach;
    ?>
  </style>
  <?php

  echo ob_get_clean();


}


function ogk_get_picture($image_id, $vars = array()) {

  global $theme_setup;

  $lazy = (isset($vars['lazy'])) ? $vars['lazy'] : false;
  //$lazy = true;

  ob_start();
  ?>

  <picture>
    <?php
    $count = 0;
    foreach ($theme_setup['css_breakpoints'] as $key => $data) :

      $image_url = wp_get_attachment_url($image_id);

      $main_image_key = $data['main_image'];
      $main_image = wp_get_attachment_image_src($image_id, $main_image_key)[0];

      if ( $theme_setup['conditional_webp'] ) :
        $main_image_webp = str_replace("uploads", "uploads-webpc/uploads", $main_image);
        $main_image_webp = $main_image_webp . '.webp';
      endif;
      //echo '<pre>'; print_r($main_image); echo '</pre>';

      $retina_image_key = $data['retina_image'];
      $retina_image = ($data['retina_image'] == 'full') ? $image_url : wp_get_attachment_image_src($image_id, $retina_image_key)[0];

      if ( $theme_setup['conditional_webp'] ) :
        $retina_image_webp = str_replace("uploads", "uploads-webpc/uploads", $retina_image);
        $retina_image_webp = $retina_image_webp . '.webp';
      endif;
      //echo '<pre>'; print_r($retina_image); echo '</pre>';
      ?>

      <?php
      if ( $count == 0 ) :
        ?>
        <source
                media="(min-width: <?php echo $data['max_width'] + 1; ?>px)"
        <?php echo ($lazy == true) ? 'data-srcset=' : 'srcset='; ?>"<?php echo $main_image; ?> 1x,
        <?php echo $retina_image; ?> 2x"/>
      <?php
      endif;
      ?>

      <source
              media="(max-width: <?php echo $data['max_width']; ?>px)"
      <?php echo ($lazy == true) ? 'data-srcset=' : 'srcset='; ?>"<?php echo $main_image; ?> 1x,
      <?php echo $retina_image; ?> 2x"/>

      <?php if ( $theme_setup['conditional_webp'] ) : ?>
      <source
              media="(max-width: <?php echo $data['max_width']; ?>px)"
              type="image/webp"
      <?php echo ($lazy == true) ? 'data-srcset=' : 'srcset='; ?>"<?php echo $main_image_webp; ?> 1x,
      <?php echo $retina_image_webp; ?> 2x"/>
    <?php endif; ?>

      <?php
      $count++;
    endforeach;
    ?>

    <img class="<?php echo ($lazy == true) ? 'lazy' : ''; ?>" alt="" <?php echo ($lazy == true) ? 'data-srcset=' : 'srcset='; ?>
    "https://via.placeholder.com/1024x576?text=Horizontal+Image"/>

  </picture>

  <?php

  echo ob_get_clean();

}