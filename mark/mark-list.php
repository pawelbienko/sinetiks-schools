<?php
function NK_mark_list () {
?>
<div class="container">
<h2>Przedmioty</h2>
<a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_mark_create'); ?>">Dodaj</a>
<?php
global $wpdb;
$rows = $wpdb->get_results("SELECT id, id_student, mark, id_lesson, date_time from school_marks");
echo "<table class='table'>";
echo "<tr><th>ID</th><th>Uczeń</th><th>Ocena</th><th>Przedmiot</th><th>Data</th><th>Akcje</th></tr>";
foreach ($rows as $row ){
	echo "<tr>";
	echo "<td>$row->id</td>";
	echo "<td>$row->id_student</td>";
        echo "<td>$row->mark</td>";
        echo "<td>$row->id_lesson</td>";
        echo "<td>$row->date_time</td>";
        ?>
        <td>
            <div class="col-md-3">
                <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_mark_update&id='.$row->id)?>">Popraw dane</a>
            </div>
            <div class="col-md-2">
                <form class="form-inline" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <input type="hidden" name="id" hidden="" value="<?php echo $row->id ?>">
                   <button type='submit' name='delete' class='btn btn-default' onclick="return confirm('Czy na pewno chcesz usunąc pozycje z listy ?')">
                   Usuń</button>
                </form>
            </div>    
        </td>
        <?php
	echo "</tr>";       
    }
echo "</table>";
?>
</div>
<?php

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $wpdb->query($wpdb->prepare("DELETE FROM school_marks WHERE id = %s",$id));
        
        $message.="Ocena usunięta !";
    }
    if (isset($message)): ?><div class="updated">
        <a href="<?php echo admin_url('admin.php?page=NK_mark_list')?>">Odśwież listę</a>
        <p><?php echo $message;?></p>
    </div><?php endif;
    

}