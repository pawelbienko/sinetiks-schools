<?php
/*
Plugin Name: Dziennik Szkolny
Description: Dziennik szkolny
Version: 1
Author: Natalia Kapinos
*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOTDIR', plugin_dir_path(__FILE__));

require_once(ROOTDIR . DS .'function'. DS .'include-file.php');

add_action( 'user_new_form', 'my_extra_user_fields');
add_action( 'show_user_profile', 'my_extra_user_fields' );
add_action( 'edit_user_profile', 'my_extra_user_fields' );

add_action( 'user_register', 'save_my_extra_user_fields' );
add_action( 'personal_options_update', 'save_my_extra_user_fields' );
add_action( 'edit_user_profile_update', 'save_my_extra_user_fields' ); 
register_activation_hook( __FILE__, 'add_roles_on_plugin_activation' );

//menu items
add_action('admin_menu','NK_schools_modifymenu');

function NK_schools_modifymenu() {
    //this is the main item for the menu
    add_menu_page('Klasy', //page title
        'Klasy', //menu title
        'manage_options', //capabilities
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

    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
        'Popraw plan zajęć', //page title
        'Popraw', //menu title
        'manage_options', //capability
        'NK_schools_scheduler_update', //menu slug
        'NK_schools_scheduler_update'//function
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
    add_submenu_page('NK_student_list', //parent slug
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

    add_menu_page( //parent slug
        'Oceny', //page title
        'Oceny', //menu title
        'read', //capability
        'NK_mark_list', //menu slug
        'NK_mark_list'//function
    );

    //this is a submenu
    add_submenu_page('NK_mark_list', //parent slug
        'Dodaj nową oceną', //page title
        'Dodaj', //menu title
        'read', //capability
        'NK_mark_create', //menu slug
        'NK_mark_create'//function
    ); 

    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
        'Popraw ocene', //page title
        'Popraw', //menu title
        'read', //capability
        'NK_mark_update', //menu slug
        'NK_mark_update'//function
    ); 

    add_menu_page( //parent slug
        'Obecności', //page title
        'Obecności', //menu title
        'read', //capability
        'NK_attendance_list', //menu slug
        'NK_attendance_list'//function
    );

    //this is a submenu
    add_submenu_page('NK_attendance_list', //parent slug
        'Dodaj obecność', //page title
        'Dodaj', //menu title
        'read', //capability
        'NK_attendance_create', //menu slug
        'NK_attendance_create'//function
    ); 

    //this submenu is HIDDEN, however, we need to add it anyways
    add_submenu_page(null, //parent slug
        'Popraw obecność', //page title
        'Popraw', //menu title
        'read', //capability
        'NK_attendance_update', //menu slug
        'NK_attendance_update'//function
    );
}
