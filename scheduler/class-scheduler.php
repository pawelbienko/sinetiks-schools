<?php

function NK_schools_scheduler () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
?>
    <div class="container">
    <h2>Plan zajęć</h2>
    <?php
    
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $wpdb->query($wpdb->prepare("DELETE FROM school_scheduler WHERE id = %s",$id));
        
        $message.="Lekcja usunięta !";
    }    
    if (isset($message)): ?>
        <div class="updated">
            <p><?php echo $message;?></p>
        </div>
    <?php endif;
    
    $rowsSubject  = $wpdb->get_results("SELECT id, name from school_subjects");
    $rowsTeachers = $wpdb->get_results("SELECT u.ID as id, user_login as name
                                        FROM `wp_users` as u
                                        LEFT JOIN `wp_usermeta` as m 
                                        ON u.ID = m.user_id
                                        WHERE m.meta_value LIKE '%teacher_role%'");
    $rowsClass    = $wpdb->get_results("SELECT id, name from school_class");

    if(isset($_GET['day'])){

        $day   = $_GET['day'];
        $month = $_GET['month'];
        $year  = $_GET['year'];
        $date  = $year.'-'.$month.'-'.$day;

        $subject  = $_POST["subject"];
        $teacher  = $_POST["teacher"];
        $class    = $_POST["class"];
        $lesson   = $_POST["lesson"];
        $class_room   = $_POST["class_room"];
        //insert
        if(isset($_POST['insert'])){
            global $wpdb;
            $wpdb->insert(
                'school_scheduler', //table
                array(
                    'subject'     => $subject,
                    'teacher'     => $teacher,
                    'class'       => $class,
                    'lesson'      => $lesson,
                    'class_room'  => $class_room,
                    'subject_date'=> $date        
                ), //data
                array('%s','%s', '%s', '%s') //data format			
            );
            $message.="Dodano do planu lekcji !";
        }
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
            <button type="submit" name="insert" class="btn btn-default">Zapisz</button>
          </form>  
        <?php
        $rowsScheduler = $wpdb->get_results("SELECT sch.id, sub.name as subject, tea.display_name as teacher, cla.name as class, lesson, class_room 
                                            FROM
                                            school_scheduler as sch 
                                            LEFT JOIN school_class as cla ON sch.class = cla.id 
                                            LEFT JOIN wp_users as tea ON sch.teacher = tea.id
                                            LEFT JOIN school_subjects as sub ON sch.subject = sub.id 
                                            WHERE subject_date = '$date' ORDER BY class ASC"
        );
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Przedmiot</th><th>Nauczyciel</th><th>Klasa</th><th>Godzina lekcyjna</th><th>Klasa Lekcyjna</th><th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
        <?php       
                foreach ($rowsScheduler as $row ){
                    echo '<tr>'
                      . '<td>'. $row->subject. '</td>'
                      . '<td>'. $row->teacher.'</td>'
                      . '<td>'. $row->class.'</td>'
                      . '<td>'. $row->lesson.'</td>'
                      . '<td>'. $row->class_room.'</td>';
                    ?>
                        <td class="col-md-5">
                            <div class="col-md-3">
                                <a class='btn btn-default' href="<?php echo admin_url('admin.php?page=NK_schools_scheduler_update&id='.$row->id)?>">Popraw dane</a>
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
                    echo '</tr>';
                }    
        ?>        
                </tbody>
            </table>
        <?php

    }else{

        $calendar = new Calendar();
        echo $calendar->show();
    }
    ?>
    </div>
<?php
}
