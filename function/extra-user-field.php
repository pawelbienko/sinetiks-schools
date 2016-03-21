<?php

function my_extra_user_fields($user) 
{ 
?>
    <table class="form-table">
        <tr>
            <th><label for="phone_number">Numer telefonu</label></th>
            <td><input type="text" name="phone_number" value="<?php echo get_the_author_meta( 'phone_number', $user->ID ); ?>"></td>
        </tr>
    </table>
<?php    
}

function save_my_extra_user_fields( $user_id ) 
{
    if ( !current_user_can( 'edit_user', $user_id ))
    { 
        return false; 
    }else{
        if(isset($_POST['user_school_role']) && $_POST['user_school_role'] != ""){
            update_usermeta( $user_id, 'user_school_role', $_POST['user_school_role'] );
        }
        if ( isset( $_POST['phone_number'] ) ) {
            update_user_meta( $user_id, 'phone_number', $_POST['phone_number'] );
        }
    }
}

function add_roles_on_plugin_activation() {
    add_role( 'guard_role', 'Opiekun', array('read' => false ) );
    add_role( 'teacher_role', 'Nauczyciel', array( 'read' => true ) );
}
