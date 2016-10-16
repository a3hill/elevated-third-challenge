<?php if ($teaser): ?>
  
  <article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <div class="row">
      <div class="medium-6 columns">
        <?php print render($content['field_image']); ?>
      </div>

      <div class="medium-6 columns">
        <div class="date"><?php print format_date($node->created, 'custom', 'F j, Y'); ?></div>
        <?php print render($title_prefix); ?>
        <?php if (!$page): ?>
          <?php if (!$page): ?>
            <h2<?php print $title_attributes; ?>>
              <a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
          <?php endif; ?>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        hide($content['field_tags']);
        print render($content);
        ?>

        <a href="/<?php print $node_url; ?>" class="button"><span>Learn More</span></a>
      </div>
    </div>

  </article>

<?php else: ?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>>
        <a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="posted">
      <?php if ($user_picture): ?>
        <?php print $user_picture; ?>
      <?php endif; ?>
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <?php
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);
  hide($content['field_tags']);
  print render($content);
  ?>

  <?php if (!empty($content['field_tags']) && !$is_front): ?>
    <?php print render($content['field_tags']) ?>
  <?php endif; ?>

  <?php print render($content['links']); ?>
  <?php print render($content['comments']); ?>

</article>

<?php endif; ?>
