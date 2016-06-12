<?php
function NK_attendance_list () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
    ?>
    <div class="container">
    <h2>Obecności</h2>
    <?php
    if(isset($_POST['delete'])){
            $id = $_POST['id'];
            $wpdb->query($wpdb->prepare("DELETE FROM school_attendance WHERE id = %s",$id));

            $message.="Obecność usunięta !";
    } 

     if (isset($message)): ?>
        <div class="updated">
            <p><?php echo $message;?></p>
        </div>
    <?php endif;

    ?>
    <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_attendance_create'); ?>">Dodaj</a>
    <?php
    $rows = $wpdb->get_results("SELECT att.id, stu.name as student_id, lesson_id, date, attend from school_attendance att
                                LEFT JOIN school_students as stu ON att.student_id = stu.id");
    echo "<table class='table'>";
    echo "<tr><th>Uczeń</th><th>Lekcja</th><th>Data</th><th>Obecność</th><th>Akcje</th></tr>";
    foreach ($rows as $row ){
            echo "<tr>";
            //echo "<td>$row->id</td>";
            echo "<td>$row->student_id</td>";
            echo "<td>$row->lesson_id</td>";
            echo "<td>$row->date</td>";
            $attend = $row->attend == 0 ? 'Nieobecny' : 'Obecny';
            echo "<td>".$attend."</td>";
            ?>
            <td class="col-md-5">
                <div class="col-md-2">
                    <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_attendance_update&id='.$row->id)?>">Edytuj</a>
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