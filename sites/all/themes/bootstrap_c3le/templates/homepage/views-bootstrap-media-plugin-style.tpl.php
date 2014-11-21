<div id="views-bootstrap-media-<?php print $id ?>" class="<?php print $classes ?>">
  <ul class="media-list">
    <?php foreach ($items as $key => $item): ?>
      <li class="media">
        <?php if ($item['image_field']): ?>
          <div class="<?php if ($key % 2 == 0){print 'pull-left';}else{print 'pull-right';} ?> col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php print $item['image_field'] ?>
          </div>
        <?php endif ?>

        <div class="media-body col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <?php if ($item['heading_field']): ?>
            <h4 class="media-heading">
              <?php print $item['heading_field'] ?>
            </h4>
          <?php endif ?>

          <?php print $item['body_field'] ?>
        </div>
      </li>
    <?php endforeach ?>
  </ul>
</div>
