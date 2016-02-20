<?php

function my_extra_user_fields( $user ) 
{ 
    $roles = array(
        'NO_ROLE',
        'ROLE_GUARD',
        'ROLE_TEACHER'
    );
    ?>
    <h3>Rola w szkole</h3>

    <table class="form-table">
        <tr>
            <th><label for="user_school_role">Rola w szkole</label></th>
            <td>
                <?php $user_school_role = get_the_author_meta( 'user_school_role', $user->ID ); ?>
                <select name="user_school_role" class="form-control">
                    <?php
                        foreach ($roles as $row ){
                            $selected = '';
                            if($row == $user_school_role){
                                    $selected = 'selected="selected"';
                            }
                            echo "<option $selected value=\"$row\"> $row </option>";
                        }
                    ?> 
                </select>
            </td>
        </tr>
    </table>
<?php    
}

function save_my_extra_user_fields( $user_id ) 
{
    if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }else{

        if(isset($_POST['user_school_role']) && $_POST['user_school_role'] != ""){
            update_usermeta( $user_id, 'user_school_role', $_POST['user_school_role'] );
        }
    }
}
