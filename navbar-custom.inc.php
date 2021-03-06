<?php

// This file was created by Wolfgang (markus@best-practice.se)
// To install, copy this into your observium install directory such as /opt/observium/html/includes/

$rendered_maps = array();
if ($weathermap_dir = opendir('weathermap/maps/')) { //Open directory
    while (false !== ($weathermap_file = readdir($weathermap_dir))) { //while there are files to process
        if (strpos($weathermap_file,'.html')) { //if filename contains the string ".html"
            $weathermap_name = str_replace('.html','',$weathermap_file); //save filename and strip file ending
            $rendered_maps[$weathermap_file] = $weathermap_name; //add filename and mapname in array
        }
    }
    closedir($weathermap_dir);
}
sort($rendered_maps);

$navbar['weathermap'] = array('icon' => $config['icon']['mibs'], 'title' => 'Weathermap');

$navbar['weathermap']['entries'][] = array('title' => 'All maps', 'url' => 'weathermap/maps/allmaps.php', 'icon' => $config['icon']['globe']);

foreach ($rendered_maps as $map_page => $map_name) {
    $weathermap_menu[] = array('title' => $map_name, 'url' => 'weathermap/maps/' . $map_name, 'icon' => $config['icon']['mibs']);
}
$navbar['weathermap']['entries'][] = array('title' => 'Weathermaps', 'url' => generate_url(array('page' => 'weathermap')), 'icon' => $config['icon']['mibs'], 'entries' => $weathermap_menu);

if ($_SESSION['userlevel'] >= '10') {
    $navbar['weathermap']['entries'][] = array('title' => 'Weathermap Editor', 'url' => 'weathermap/editor.php', 'icon' => $config['icon']['tools']);
}
 
?>
