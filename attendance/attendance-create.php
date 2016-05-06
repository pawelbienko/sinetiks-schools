<?php
function NK_attendance_create () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    
  //  $mailer = new PHPMailer;

    global $wpdb;
    $date  = date("Y-m-d");

    $rowsLesson = $wpdb->get_results("SELECT subject, lesson, sub.name
                                       FROM school_scheduler as sch
                                       LEFT JOIN school_subjects as sub
                                       ON sch.subject = sub.id
                                       WHERE subject_date = '$date'");
    
    $rowsStudent = $wpdb->get_results("SELECT id, name, guardian FROM school_students");
    
    $id_student = $_POST["id_student"];
    $id_lesson  = $_POST['id_lesson']; 
    $attend     = $_POST['attend'];
    //insert
    if(isset($_POST['insert'])){
        
        $rowStudent = $wpdb->get_results("SELECT id, name, guardian FROM school_students WHERE id = $id_student");
        
        $wpdb->insert(
                'school_attendance', //table
                array(
                    'student_id' => $id_student,
                    'lesson_id'  => $id_lesson,
                    'date'  => $date,
                    'attend' => $attend
                ), //data
                array('%s', '%s', '%s', '%s') //data format			
        );
        if($attend === '0' ){
            $guardian = $rowStudent[0]->guardian;

            $rowUsers  = $wpdb->get_results("SELECT *
                                      FROM `wp_users` as u
                                      LEFT JOIN `wp_usermeta` as m 
                                      ON u.ID = m.user_id
                                      WHERE m.meta_key LIKE 'phone_number' AND user_id = $guardian"
            );

            $to = $rowUsers[0]->user_email;
            $name = $rowUsers[0]->user_login;
            $studentName = $rowStudent[0]->name;
            $text = "$name Twoje dziecko $studentName  jest nieobecne w szkole";

            $mailMessage = wp_mail( $to, 'Nieobecność', $text );
            
            $contactNumber = $rowUsers[0]->meta_value;
            $smsMessage = sendSms($contactNumber, $text);
        }    
        $message.="Obecność dodana !";
    }
    ?>
    <div class="container">
        <h2>Dodaj obecność</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
        
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">   
        
        <div class="form-group">
          <label for="">Student</label>
          <select name="id_student" class="form-control">
          <?php    
            foreach ($rowsStudent as $row ){
               echo '<option value="'.$row->id.'">'. $row->name.'</option>';
            }
          ?>
          </select>
        </div>    
            
        <div class="form-group">
            <label for="">Lekcja</label>
            <select name="id_lesson" class="form-control">
            <?php    
                foreach ($rowsLesson as $row ){
                   echo '<option value="'.$row->lesson.'">Lekcja:'. $row->lesson. ' = ' . $row->name.'</option>';
                }
            ?>
            </select>
        </div>
            
        <div class="form-group">
          <label for="">Obecny</label>
          <select name="attend" class="form-control">
            <option value="1">Obecny</option>';
            <option value="0">Nieobecny</option>';
          </select>
        </div>
        <button type="submit" name="insert" class="btn btn-default">Zapisz</button>
        <a href="<?php echo admin_url('admin.php?page=NK_attendance_list')?>">&laquo; Powróć do listy</a>
        </form>
    </div>
<?php
}