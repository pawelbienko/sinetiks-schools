<?php
function NK_class_create () {
    
    $id   = $_POST["id"];
    $name = $_POST["name"];
    //insert
    if(isset($_POST['insert'])){
        global $wpdb;
        $wpdb->insert(
            'school_class', //table
            array('name' => $name), //data
            array('%s','%s') //data format			
        );
        $message.="Klasa Dodana !";
    }
    ?>
    <div class="container">
        <h2>Dodaj Klasę</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message;?></p></div><?php endif;?>
        
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group">
                <label for="nazwa">Nazwa klasy </label>
                <input type="text" class="form-control" name="name" id="nazwa" placeholder="Nazwa">
            </div>
            <input type='submit' name="insert" value='Zapisz' class='button'>
            <a href="<?php echo admin_url('admin.php?page=NK_class_list')?>">&laquo; Powróć do listy</a>
        </form>
    </div>
<?php
}