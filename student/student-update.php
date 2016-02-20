<?php
function NK_student_update () {
    global $wpdb;
    
    $id   = $_GET["id"];
    $name = $_POST["name"];
?>
    <div class="container">
        <h2>Uczeń</h2>
        
        <?php    
            //update
        if(isset($_POST['update'])){	
            $wpdb->update(
                'school_students', //table
                array('name' => $name), //data
                array( 'ID' => $id ), //where
                array('%s'), //data format
                array('%s') //where format
            );
        ?>    
            <div class="updated"><p>Uczeń poprawiony</p></div>
            <a href="<?php echo admin_url('admin.php?page=NK_student_list')?>">&laquo; Powróć do listy</a>
        <?php    
        }else{//selecting value to update	
            $schools = $wpdb->get_results($wpdb->prepare("SELECT id,name from school_students where id=%s",$id));
            foreach ($schools as $s ){
                $name=$s->name;
            }
        ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="form-group">
                    <label for="nazwa">Nazwa</label>
                    <input type="text" class="form-control" name="name" id="nazwa" placeholder="Nazwa" value="<?php echo $name;?>">
                </div>
                <button type="submit"  name="update" class="btn btn-default">Zapisz</button>
                <a href="<?php echo admin_url('admin.php?page=NK_students_list')?>">&laquo; Powróć do listy</a>
            </form>
        <?php    
        }
        ?> 
    </div>
<?php
}