<?php 
$group_nr = 1;                  // first group number
$last_row = count($rows) -1;    // last row
$wrapper  = 3;                  // put a wrapper around every 3 rows
?>

<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
  <?php if ($id % $wrapper == 0) {print '<div class="group row group-'.$group_nr.'">'; $i = 0; $group_nr++; } ?>
    <div class="medium-4 columns <?php $i++; if ($id == $last_row) print 'end'; ?>">
      <?php print $row; ?>
    </div>
  <?php if ($i == $wrapper || $id == $last_row) print '</div>'; ?>
<?php endforeach; ?>
