<?php
function NK_student_create () {
    
global $wpdb;
$rowsUsers  = $wpdb->get_results("SELECT ID, user_login from wp_users");    
    
$id   = $_POST["id"];
$name = $_POST["name"];
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
<h2>Dodaj Ucznia</h2>
<?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
<p>Nazwa Ucznia</p>
<table class='wp-list-table widefat fixed'>
<tr><th>Nazwa</th><td><input type="text" name="name" value="<?php echo $name;?>"/></td></tr>
<div class="form-group">
      <label for="">Opiekun</label>
      <select name="guardian" class="form-control">
      <?php    
        foreach ($rowsUsers  as $row ){
           echo '<option value="'.$row->ID.'">'. $row->user_login.'</option>';
        }
      ?>
      </select>    
    </div>
</table>
<input type='submit' name="insert" value='Save' class='button'>
</form>
</div>
<?php
}