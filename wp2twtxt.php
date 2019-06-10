<?php
// Config here
$wp_site = "";
$twtxt = "";
$log = "";
$token = "";
$days_back = 7;
// Config end

parse_str($argv[1], $params);
if ($params['token'] == $token || $_GET['token'] == $token) {
  $now = date('Y-m-d\TH:i:s');
  $yesterday = date('Y-m-d\TH:i:s', strtotime('-'.$days_back.' day', strtotime($now)));

  $json = file_get_contents($wp_site."/wp-json/wp/v2/posts?after=".$yesterday);
  $posts = json_decode($json);

  $lines = file($twtxt, FILE_IGNORE_NEW_LINES);

  $written = 0;

  for ($i=0; $i < count($posts); $i++) { 
    $post = $posts[$i];
    $already_posted = false;
    for ($j=0; $j < count($lines); $j++) { 
      $line = $lines[$j];
      if (substr( $line, 0, 1 ) === "#") {
        continue;
      }
      $parts = explode("/?p=", $line);
      if ($post->id == $parts[1]) {
        $already_posted = true;
        break;
      }
    }
    if (!$already_posted) {
      $written++;
      array_push($lines, $post->date."\t".$post->title->rendered." ".$wp_site."/?p=".$post->id);
    }
  }
  file_put_contents($twtxt, implode("\n", $lines));

  $txt = $now.": ".$written." lines posted to ".$twtxt;
  $myfile = file_put_contents($log, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
} else {
  die(); // No Message to deter script kiddies ;-)
}
?>