<?php
/*
Plugin Name: Schools
Description:
Version: 1
Author: NK
*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/css/style-admin.css" rel="stylesheet" />
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/css/style-calendar.css" rel="stylesheet" />
<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/css/bootstrap.min.css" rel="stylesheet" />

<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOTDIR', plugin_dir_path(__FILE__));

require_once(ROOTDIR . DS .'function'. DS .'include-file.php');

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
            'manage_options', //capability
            'NK_mark_list', //menu slug
            'NK_mark_list'//function
        );
        
        //this is a submenu
	add_submenu_page('NK_mark_list', //parent slug
            'Dodaj nową oceną', //page title
            'Dodaj nowe', //menu title
            'manage_options', //capability
            'NK_mark_create', //menu slug
            'NK_mark_create'//function
        ); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
            'Popraw ocene', //page title
            'Popraw', //menu title
            'manage_options', //capability
            'NK_mark_update', //menu slug
            'NK_mark_update'//function
        ); 
}
