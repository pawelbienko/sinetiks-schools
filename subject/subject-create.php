<?php
function NK_subject_create () {
    require_once(ROOTDIR . DS . 'function'. DS . 'loadCSS.php');
    $id = $_POST["id"];
    $name = $_POST["name"];
    //insert
    if(isset($_POST['insert'])){
            global $wpdb;
            $wpdb->insert(
                    'school_subjects', //table
                    array('name' => $name), //data
                    array('%s', '%s') //data format			
            );
            $message.="Nauczyciel dodany !";
    }
    ?>
    <div class="container">
        <h2>Dodaj Lekcje</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
        <div class="form-group">
            <label for="nazwa">Nazwa Przedmiotu</label>
            <input type="text" class="form-control" name="name" id="nazwa" placeholder="Nazwa">
        </div>    
        <button type="submit" name="insert" class="btn btn-default">Zapisz</button>
        <a href="<?php echo admin_url('admin.php?page=NK_subject_list')?>">&laquo; Powróć do listy</a>
        </form>
    </div>
<?php
}