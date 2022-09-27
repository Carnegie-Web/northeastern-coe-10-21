<?php
if ($args['pages'] > 1) {
  echo paginate_links([
    'format' => '?pg=%#%',
    'current' => $args['current'],
    'total' => $args['pages'],
  ]);
  $base = $args['base'];
  $params = $_GET;
  $params['per'] = -1;
  $query = http_build_query($params);
  $all = "$base?$query";
  echo "<a href='$all' class='page-numbers'>View All</a>";
}
?>
