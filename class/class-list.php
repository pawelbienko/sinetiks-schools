<?php
function NK_class_list () {
?>
    <div class="container">
        <h2>Klasy</h2>
        <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_class_create'); ?>">Dodaj nową</a>
        <?php
            global $wpdb;
            $rows = $wpdb->get_results("SELECT id,name from school_class");
            
            echo "<table class='table'>";
            echo "<tr><th>ID</th><th>Name</th><th>&nbsp;</th></tr>";
            foreach ($rows as $row ){
                echo "<tr>";
                echo "<td>$row->id</td>";
                echo "<td>$row->name</td>";	
                ?>        
                <td>
                    <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_class_update&id='.$row->id)?>">Popraw dane</a>
                    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="id" hidden="" value="<?php echo $row->id ?>">
                       <button type='submit' name='delete' class='btn btn-default' onclick="return confirm('Czy na pewno chcesz usunąc pozycje z listy ?')">
                       Usuń</button>
                    </form>
                </td>
            <?php
                echo "</tr>";}
            echo "</table>";
        ?>
    </div>
<?php

     if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $wpdb->query($wpdb->prepare("DELETE FROM school_class WHERE id = %s",$id));
        
        ob_clean();
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
}