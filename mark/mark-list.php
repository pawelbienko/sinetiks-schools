<?php
function NK_mark_list () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
?>
    <div class="container">
    <h2>Oceny</h2>
    <?php
        if(isset($_POST['delete'])){
            $id = $_POST['id'];
            $wpdb->query($wpdb->prepare("DELETE FROM school_marks WHERE id = %s",$id));

            $message.="Ocena usunięta !";
        }
        if (isset($message)): ?>
            <div class="updated">
                <p><?php echo $message;?></p>
            </div>
        <?php endif;
    ?>
    <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_mark_create'); ?>">Dodaj</a>
    <?php

    $rows = $wpdb->get_results("SELECT marks.id, stu.name as stu_name, mark, sub.name as sub_name, date_time 
                                FROM school_marks as marks
                                LEFT JOIN school_students as stu ON marks.id_student = stu.id
                                LEFT JOIN school_subjects as sub ON marks.id_lesson = sub.id"
                            );
    echo "<table class='table'>";
    echo "<tr><th>Uczeń</th><th>Ocena</th><th>Przedmiot</th><th>Data</th><th>Akcje</th></tr>";
    foreach ($rows as $row ){
            echo "<tr>";
            echo "<td>$row->stu_name</td>";
            echo "<td>$row->mark</td>";
            echo "<td>$row->sub_name</td>";
            echo "<td>$row->date_time</td>";
            ?>
            <td class="col-md-5">
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
}