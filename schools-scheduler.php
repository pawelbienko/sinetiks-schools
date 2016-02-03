<?php
require_once(ROOTDIR . 'calendar.php');

function sinetiks_schools_scheduler () {
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-calendar.css" rel="stylesheet" />
<div class="wrap">
<h2>Schools</h2>
<?php
    $calendar = new Calendar();
    echo $calendar->show();
?>
</div>
<?php
}