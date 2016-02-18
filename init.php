<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

define('DS', DIRECTORY_SEPARATOR);

add_action( 'show_user_profile', 'my_extra_user_fields' );
add_action( 'edit_user_profile', 'my_extra_user_fields' );
function my_extra_user_fields( $user ) 
{ ?>
    <h3>User avatar</h3>

    <table class="form-table">
        <tr>
            <th><label for="user_avatar">User avatar</label></th>
            <td>
                <input id="user_avatar" name="user_avatar" type="text" value="
                    <?php $user_avatar = get_the_author_meta( 'user_avatar', $user->ID ); 
                        echo $user_avatar ? $user_avatar : '';?>" />
                <span class="description"><?php _e("Please enter Avatar URL."); ?></span>
            </td>
        </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_my_extra_user_fields' );
add_action( 'edit_user_profile_update', 'save_my_extra_user_fields' );

function save_my_extra_user_fields( $user_id ) 
{
    if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }else{

        if(isset($_POST['user_avatar']) && $_POST['user_avatar'] != ""){
            update_usermeta( $user_id, 'user_avatar', $_POST['user_avatar'] );
        }
    }
}

//menu items
add_action('admin_menu','NK_schools_modifymenu');
function NK_schools_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Klasy', //page title
            'Klasy', //menu title
            'read', //capabilities
            'NK_class_list', //menu slug
            'NK_class_list' //function
	);
	
	//this is a submenu
	add_submenu_page('NK_class_list', //parent slug
            'Dodaj nową klasę', //page title
            'Dodaj nową', //menu title
            'manage_options', //capability
            'NK_class_create', //menu slug
            'NK_class_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw Klasę', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_class_update', //menu slug
            'NK_class_update'//function
        ); 
        
        add_menu_page( //parent slug
            'Plan zajęć', //page title
            'Plan zajęć', //menu title
            'manage_options', //capability
            'NK_schools_scheduler', //menu slug
            'NK_schools_scheduler'//function
        );
        
        add_menu_page( //parent slug
            'Nauczyciele', //page title
            'Nauczyciele', //menu title
            'manage_options', //capability
            'NK_teacher_list', //menu slug
            'NK_teacher_list'//function
        );
        
        //this is a submenu
	add_submenu_page('NK_teacher_list', //parent slug
            'Dodaj nowego Nauczyciela', //page title
            'Dodaj nowego', //menu title
            'manage_options', //capability
            'NK_teacher_create', //menu slug
            'NK_teacher_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw Nauczyciela', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_teacher_update', //menu slug
            'NK_teacher_update'//function
        ); 
        
        add_menu_page( //parent slug
            'Przedmioty', //page title
            'Przedmioty', //menu title
            'manage_options', //capability
            'NK_subject_list', //menu slug
            'NK_subject_list'//function
        );
        
        //this is a submenu
	add_submenu_page('NK_subject_list', //parent slug
            'Dodaj nowy przedmiot', //page title
            'Dodaj nowego', //menu title
            'manage_options', //capability
            'NK_subject_create', //menu slug
            'NK_subject_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw przedmiot', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_subject_update', //menu slug
            'NK_subject_update'//function
        ); 
        
        add_menu_page( //parent slug
            'Uczniowie', //page title
            'Uczniowie', //menu title
            'manage_options', //capability
            'NK_student_list', //menu slug
            'NK_student_list'//function
        );
        
        //this is a submenu
	add_submenu_page('NK_subject_list', //parent slug
            'Dodaj nowego ucznia', //page title
            'Dodaj nowego', //menu title
            'manage_options', //capability
            'NK_student_create', //menu slug
            'NK_student_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw ucznia', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_student_update', //menu slug
            'NK_student_update'//function
        ); 
}
define('ROOTDIR', plugin_dir_path(__FILE__));
$class     = 'class';
$teacher   = 'teacher';
$scheduler = 'scheduler';
$subject   = 'subject';
$student   = 'student';
require_once(ROOTDIR . DS .$class. DS .$class. '-list.php');
require_once(ROOTDIR . DS .$class. DS .$class. '-create.php');
require_once(ROOTDIR . DS .$class. DS .$class. '-update.php');

require_once(ROOTDIR . DS .$teacher. DS . $teacher. '-list.php');
require_once(ROOTDIR . DS .$teacher. DS . $teacher. '-create.php');
require_once(ROOTDIR . DS .$teacher. DS . $teacher. '-update.php');

require_once(ROOTDIR . DS .$subject. DS . $subject. '-list.php');
require_once(ROOTDIR . DS .$subject. DS . $subject. '-create.php');
require_once(ROOTDIR . DS .$subject. DS . $subject. '-update.php');

require_once(ROOTDIR . DS .$student. DS . $student. '-list.php');
require_once(ROOTDIR . DS .$student. DS . $student. '-create.php');
require_once(ROOTDIR . DS .$student. DS . $student. '-update.php');

require_once(ROOTDIR . DS .$scheduler. DS . 'class-scheduler.php');

require_once(ROOTDIR . DS . $scheduler. DS . 'calendar.php');
///require_once(ROOTDIR . DS .$scheduler. DS . 'teacher-update.php');