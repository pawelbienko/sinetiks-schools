<?php
function NK_student_list() {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
?>

    <div class="container">
        <h2>Uczniowie</h2>
        
        <?php
            if(isset($_POST['delete'])){
                $id = $_POST['id'];
                $wpdb->query($wpdb->prepare("DELETE FROM school_students WHERE id = %s",$id));
                $message.="Uczeń usunięty !";
            }
             if (isset($message)): ?>
            <div class="updated">
                <p><?php echo $message;?></p>
            </div>
            <?php endif;
        ?>
        
        <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_student_create'); ?>">Dodaj</a>
        <?php
            $rows = $wpdb->get_results("SELECT stu.id, stu.name, wpu.display_name as guardian, cl.name as id_class
                                        FROM school_students as stu
                                        LEFT JOIN wp_users as wpu
                                        ON stu.guardian = wpu.ID
                                        LEFT JOIN school_class as cl
                                        ON stu.id_class = cl.id");
        ?>
        <table class="table">
            <tr><!--<th>ID</th>--><th>Nazwa</th><th>Opiekun</th><th>Klasa</th><th>Akcje</th></tr>
            <?php
            foreach ($rows as $row ){
                echo "<tr>";
                    echo "<td>$row->name</td>";
                    echo "<td>$row->guardian</td>";
                    echo "<td>$row->id_class</td>";
            ?>        
                    <td class="col-md-5">
                        <div class="col-md-3">
                            <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_student_update&id='.$row->id)?>">Popraw dane</a>
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
            }?>
        </table>
    </div>
    <?php
}