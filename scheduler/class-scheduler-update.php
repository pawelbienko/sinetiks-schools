<?php
function NK_schools_scheduler_update() {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    
    global $wpdb;
    
    $id   = $_GET["id"];
    $name = $_POST["name"];
    
    $subject  = $_POST["subject"];
    $teacher  = $_POST["teacher"];
    $class    = $_POST["class"];
    $lesson   = $_POST["lesson"];
    $class_room   = $_POST["class_room"];
    
    $rowsSubject  = $wpdb->get_results("SELECT id, name from school_subjects");
    $rowsTeachers = $wpdb->get_results("SELECT u.ID as id, user_login as name
                                        FROM `wp_users` as u
                                        LEFT JOIN `wp_usermeta` as m 
                                        ON u.ID = m.user_id
                                        WHERE m.meta_value LIKE '%teacher_role%'");
    $rowsClass    = $wpdb->get_results("SELECT id, name from school_class");
?>
    <div class="container">
        <h2>Klasa</h2>
        
        <?php    
            //update
        if(isset($_POST['update'])){	
            $wpdb->update(
                'school_scheduler', //table
                array(
                    'subject'     => $subject,
                    'teacher'     => $teacher,
                    'class'       => $class,
                    'lesson'      => $lesson,
                    'class_room'  => $class_room,     
                ), //data
                array( 'id' => $id ),    
                array('%d', '%d', '%d', '%d', '%d'), //data format	
                array('%d') //where format    
            );
        ?>    
            <div class="updated"><p>Dane poprawione</p></div>
            <a href="<?php echo admin_url('admin.php?page=NK_schools_scheduler')?>">&laquo; Powróć do listy</a>
        <?php    
        }else{//selecting value to update	
//            $class = $wpdb->get_results($wpdb->prepare("SELECT id, name FROM school_class WHERE id=%s",$id));
//            foreach ($class as $s ){
//                $name=$s->name;
//            }
        ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group">
              <label for="">Przedmiot</label>
              <select name="subject" class="form-control">
              <?php    
                foreach ($rowsSubject as $row ){
                   echo '<option value="'.$row->id.'">'. $row->name.'</option>';
                }
              ?>
              </select>
            </div>
            <div class="form-group">
              <label for="">Godzina Lekcyjna</label>
              <select name="lesson" class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
              </select>
            </div> 
            <div class="form-group">
              <label for="">Nauczyciel</label>
              <select name="teacher" class="form-control">
              <?php    
                foreach ($rowsTeachers as $row ){
                   echo '<option value="'.$row->id.'">'. $row->name.'</option>';
                }
              ?>
              </select>    
            </div>
            <div class="form-group">
              <label for="">Klasa</label>
              <select name="class" class="form-control">
              <?php    
                foreach ($rowsClass as $row ){
                   echo '<option value="'.$row->id.'">'. $row->name.'</option>';
                }
              ?>
              </select>  
            </div>  
            <div class="form-group">
              <label for="">Klasa Lekcyjna</label>
              <select name="class_room" class="form-control">
                <option>101</option>
                <option>102</option>
                <option>103</option>
              </select>
            </div>   
            <button type="submit" name="update" class="btn btn-default">Zapisz</button>
            <a href="<?php echo admin_url('admin.php?page=NK_schools_scheduler')?>">&laquo; Powróć do listy</a>
          </form>  
        <?php    
        }
        ?> 
    </div>
<?php
}