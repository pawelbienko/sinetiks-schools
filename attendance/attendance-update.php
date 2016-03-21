<?php
function NK_attendance_update () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
    
    $id   = $_GET["id"];
    $attend = $_POST["attend"];
?>
    <div class="container">
        <h2>Obecność</h2>
        
        <?php    
            //update
        if(isset($_POST['update'])){	
            $wpdb->update(
                'school_attendance', //table
                array('attend' => $attend), //data
                array( 'id' => $id ), //where
                array('%s'), //data format
                array('%s') //where format
            );
        ?>    
            <div class="updated"><p>Obecność poprawiona</p></div>
            <a href="<?php echo admin_url('admin.php?page=NK_attendance_list')?>">&laquo; Powróć do listy</a>
        <?php    
        }else{//selecting value to update	
            $attendance = $wpdb->get_results($wpdb->prepare("SELECT id, attend from school_attendance where id=%s",$id));
            foreach ($attendance as $s ){
                $attend= $s->attend;
            }
        ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="form-group">
                    <label for="nazwa">Obecny</label>
                    <select name="attend" class="form-control">
                        <option <?php if ($attend == 1 ) echo 'selected' ; ?> value="1">Tak</option>';
                        <option <?php if ($attend == 0 ) echo 'selected' ; ?> value="0">Nie</option>';
                    </select>
                </div>
                <button type="submit"  name="update" class="btn btn-default">Zapisz</button>
                <a href="<?php echo admin_url('admin.php?page=NK_attendance_list')?>">&laquo; Powróć do listy</a>
            </form>
        <?php    
        }
        ?> 
    </div>
<?php
}
