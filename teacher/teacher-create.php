<?php
function NK_teacher_create () {
$id = $_POST["id"];
$name = $_POST["name"];
//insert
if(isset($_POST['insert'])){
	global $wpdb;
	$wpdb->insert(
		'school_teachers', //table
		array('name' => $name), //data
		array('%s','%s') //data format			
	);
	$message.="Nauczyciel dodany !";
}
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/css/style-admin.css" rel="stylesheet" />
<div class="wrap">
<h2>Dodaj Nauczyciela</h2>
<?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<p>Nazwa Klasy</p>
<table class='wp-list-table widefat fixed'>
<tr><th>Nazwa</th><td><input type="text" name="name" value="<?php echo $name;?>"/></td></tr>
</table>
<input type='submit' name="insert" value='Save' class='button'>
</form>
</div>
<?php
}