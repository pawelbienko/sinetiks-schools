<?php
function NK_student_create () {   
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
    $rowsUsers  = $wpdb->get_results("SELECT u.ID as ID, user_login 
                                      FROM `wp_users` as u
                                      LEFT JOIN `wp_usermeta` as m 
                                      ON u.ID = m.user_id
                                      WHERE m.meta_value LIKE '%guard_role%'"
            );

    $rowsClass    = $wpdb->get_results("SELECT id, name FROM school_class");

    $name     = $_POST["name"];
    $guardian = $_POST["guardian"];
    $class    = $_POST["class"];

    if(isset($_POST['insert'])){
        global $wpdb;
        $wpdb->insert(
            'school_students', //table
            array(
                'name' => $name,
                'guardian' => $guardian,
                'id_class' => $class
            ), //data
            array('%s','%s','%s') //data format			
        );
        $message.="Uczeń dodany !";
    }
    ?>
    <div class="container">
        <h2>Dodaj Ucznia</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>

        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group">
                <label for="nazwa">Nazwa</label>
                <input type="text" class="form-control" name="name" id="nazwa" placeholder="Nazwa">
            </div>
            <div class="form-group">
                <label for="">Opiekun</label>
                <select name="guardian" class="form-control">
                <?php    
                  foreach ($rowsUsers  as $row ){
                     echo '<option value="'.$row->ID.'">'. $row->user_login.'</option>';
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
            <button type="submit" name="insert" class="btn btn-default">Zapisz</button>
            <a href="<?php echo admin_url('admin.php?page=NK_student_list')?>">&laquo; Powróć do listy</a>
        </form>
    </div>
<?php
}
