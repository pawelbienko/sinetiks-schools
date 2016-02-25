<?php
function NK_class_update () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    
    global $wpdb;
    
    $id   = $_GET["id"];
    $name = $_POST["name"];
?>
    <div class="container">
        <h2>Klasa</h2>
        
        <?php    
            //update
        if(isset($_POST['update'])){	
            $wpdb->update(
                'school_class', //table
                array('name' => $name), //data
                array( 'ID' => $id ), //where
                array('%s'), //data format
                array('%s') //where format
            );
        ?>    
            <div class="updated"><p>Klasa poprawiona</p></div>
            <a href="<?php echo admin_url('admin.php?page=NK_class_list')?>">&laquo; Powróć do listy</a>
        <?php    
        }else{//selecting value to update	
            $class = $wpdb->get_results($wpdb->prepare("SELECT id, name FROM school_class WHERE id=%s",$id));
            foreach ($class as $s ){
                $name=$s->name;
            }
        ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="form-group">
                    <label for="nazwa">Nazwa</label>
                    <input type="text" class="form-control" name="name" id="nazwa" placeholder="Nazwa" value="<?php echo $name;?>">
                </div>
                <button type="submit"  name="update" class="btn btn-default">Zapisz</button>
            </form>
        <?php    
        }
        ?> 
    </div>
<?php
}