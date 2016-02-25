<?php
function NK_mark_create () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
    $rowsSubject = $wpdb->get_results("SELECT id, name FROM school_subjects");

    $rowsStudent = $wpdb->get_results("SELECT id, name FROM school_students");

    $id_student = $_POST["id_student"];
    $mark       = $_POST["mark"];
    $id_lesson  = $_POST['id_lesson'];
    $date_time  = date("Y-m-d H:i:s");
    //insert
    if(isset($_POST['insert'])){
            global $wpdb;
            $wpdb->insert(
                    'school_marks', //table
                    array(
                        'id_student' => $id_student,
                        'mark'       => $mark,
                        'id_lesson'  => $id_lesson,
                        'date_time'  => $date_time
                    ), //data
                    array('%s', '%s', '%s', '%s') //data format			
            );
            $message.="Ocena dodana !";
    }
    ?>
    <div class="container">
        <h2>Dodaj ocenę</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">   
        
        <div class="form-group">
          <label for="">Przedmiot</label>
          <select name="id_student" class="form-control">
          <?php    
            foreach ($rowsStudent as $row ){
               echo '<option value="'.$row->id.'">'. $row->name.'</option>';
            }
          ?>
          </select>
        </div>    
            
        <div class="form-group">
            <label for="">Ocena</label>
            <select name="mark" class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              <option>6</option>
            </select>
        </div>
            
        <div class="form-group">
          <label for="">Przedmiot</label>
          <select name="id_lesson" class="form-control">
          <?php    
            foreach ($rowsSubject as $row ){
               echo '<option value="'.$row->id.'">'. $row->name.'</option>';
            }
          ?>
          </select>
        </div>
        <button type="submit" name="insert" class="btn btn-default">Zapisz</button>
        <a href="<?php echo admin_url('admin.php?page=NK_mark_list')?>">&laquo; Powróć do listy</a>
        </form>
    </div>
<?php
}