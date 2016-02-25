<?php
function NK_mark_update () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    global $wpdb;
    
    $id   = $_GET["id"];
    $mark = $_POST["mark"];
?>
    <div class="container">
        <h2>Przedmiot</h2>
        
        <?php    
            //update
        if(isset($_POST['update'])){	
            $wpdb->update(
                'school_marks', //table
                array('mark' => $mark), //data
                array( 'id' => $id ), //where
                array('%s'), //data format
                array('%s') //where format
            );
        ?>    
            <div class="updated"><p>Ocena poprawiona</p></div>
            <a href="<?php echo admin_url('admin.php?page=NK_mark_list')?>">&laquo; Powróć do listy</a>
        <?php    
        }else{//selecting value to update	
            $marks = $wpdb->get_results($wpdb->prepare("SELECT id, mark from school_marks where id=%s",$id));
            foreach ($marks as $s ){
                $mark = $s->mark;
            }
        ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="form-group">
                    <label for="nazwa">Ocena</label>
                    <input type="text" class="form-control" name="mark" id="nazwa" placeholder="Ocena" value="<?php echo $mark;?>">
                </div>
                <button type="submit"  name="update" class="btn btn-default">Zapisz</button>
                <a href="<?php echo admin_url('admin.php?page=NK_mark_list')?>">&laquo; Powróć do listy</a>
            </form>
        <?php    
        }
        ?> 
    </div>
<?php
}
