<?php
function NK_class_list () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
?>
    <div class="container">
        <h2>Klasy</h2>
        <?php
        if(isset($_POST['delete'])){
            $id = $_POST['id'];
            $wpdb->query($wpdb->prepare("DELETE FROM school_class WHERE id = %s",$id));
            
            $message.="Klasa usunięta !";
        }
        if (isset($message)): ?>
            <div class="updated">
                <p><?php echo $message;?></p>
            </div>
        <?php endif;
        ?>
        
        <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_class_create'); ?>">Dodaj</a>
        <?php
            
            $rows = $wpdb->get_results("SELECT id,name from school_class");
            
            echo "<table class='table'>";
            echo "<tr><th>ID</th><th>Nazwa</th><th>Akcje</th></tr>";
            foreach ($rows as $row ){
                echo "<tr>";
                echo "<td>$row->id</td>";
                echo "<td>$row->name</td>";	
                ?>        
                <td class="col-md-5">
                    <div class="col-md-2">
                        <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_class_update&id='.$row->id)?>">Edytuj</a>
                    </div>
                    <div class="col-md-2">
                        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="hidden" name="id" hidden="" value="<?php echo $row->id ?>">
                           <button type='submit' name='delete' class='btn btn-default' onclick="return confirm('Czy na pewno chcesz usunąc pozycje z listy ?')">
                           Usuń</button>
                        </form>
                    </div>    
                </td>
            <?php
                echo "</tr>";}
            echo "</table>";
        ?>
    </div>
<?php
}