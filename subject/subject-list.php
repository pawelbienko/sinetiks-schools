<?php
function NK_subject_list () {
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/css/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Przedmioty</h2>
<a href="<?php echo admin_url('admin.php?page=NK_subject_create'); ?>">Dodaj</a>
<?php
global $wpdb;
$rows = $wpdb->get_results("SELECT id, name from school_subjects");
echo "<table class='wp-list-table widefat fixed'>";
echo "<tr><th>ID</th><th>Name</th><th>&nbsp;</th></tr>";
foreach ($rows as $row ){
	echo "<tr>";
	echo "<td>$row->id</td>";
	echo "<td>$row->name</td>";	
	echo "<td><a href='".admin_url('admin.php?page=NK_schools_update&id='.$row->id)."'>Update</a></td>";
	echo "</tr>";}
echo "</table>";
?>
</div>
<?php
}