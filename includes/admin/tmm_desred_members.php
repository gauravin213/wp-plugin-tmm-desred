<?php

defined( 'ABSPATH' ) || exit;

//my_wp_list_table_{table_name} like  tmm_desred_members  tmm-desred-members

/*add_action( 'admin_menu', 'tmm_desred_members_admin_menu_page_fun');
function tmm_desred_members_admin_menu_page_fun(){

    $title = "desred members";

    $hook = add_menu_page( $title, $title, 'manage_options', 'tmm-desred-members', 'tmm_desred_members_admin_menu_fun');

    add_action( "load-$hook", 'tmm_desred_members_add_option');
}*/

function tmm_desred_members_admin_menu_fun(){
?>  
<div class="wrap">
        <?php
            global $wpdb;

            if ($_GET['action'] == 'add') {
                ?>
                <h2><?php _e( 'Add Member', 'tmm-desred-members-funds' ); ?></h2>
                <form id="form_tmm_desred_members" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-members-add-form", "normal", null); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-members-side", "side", $result); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php
               
            }else if ($_GET['action'] == 'edit') {

                $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_members_tb WHERE ID=".$_GET['customer']);

                ?>

                <h1 class="wp-heading-inline"><?php _e( 'Edit Member', 'tmm-desred-members-funds' ); ?></h1>

                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-members&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-members-funds' ); ?></a>

                <hr class="wp-header-end">

                <form id="form_tmm_desred_members" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-members-edit-form", "normal", $result); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-members-side", "side", $result); ?>

                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php

               
            }else{

                $exampleListTable = new TmmDesredMembers();
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Members', 'tmm-desred-members-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-members&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-members-funds' ); ?></a>
                 <a href="<?php echo admin_url( 'admin-post.php?action=TmmDesredExportData&tb_name=tmm_members_tb' ); ?>" class="page-title-action">Export</a>
                <hr class="wp-header-end">
                <form id="tmm_desred_members_form" method="get">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                    <?php
                    $exampleListTable->prepare_items();
                    $exampleListTable->views();
                    $exampleListTable->search_box("Search Post(s)", "search_post_id");
                    $exampleListTable->display(); 
                    ?>
                </form>
                <?php

            }
        ?>
</div>
<div class="clear"></div>
<script type="text/javascript">
jQuery(document).ready(function($){
    jQuery(".if-js-closed").removeClass("if-js-closed").addClass("closed");
    postboxes.add_postbox_toggles( pagenow );
});
</script>
<?php
}

function tmm_desred_members_edit_form_fun($result){

    $name = $result[0]->name;
    $lm_number = $result[0]->lm_number;
    $siniority_list_number = $result[0]->siniority_list_number;
    $lm_number_mahasangh = $result[0]->lm_number_mahasangh;
    $gender = $result[0]->gender;
    $blood_group = $result[0]->blood_group;
    $local_address = $result[0]->local_address;
    $permanent_address = $result[0]->permanent_address;
    $date_of_joining = $result[0]->date_of_joining;
    $first_posting_city = $result[0]->first_posting_city;
    $assistant_engineers = $result[0]->assistant_engineers;
    $father_or_husband_name = $result[0]->father_or_husband_name;
    $date_of_birth = $result[0]->date_of_birth;
    $district = $result[0]->district;
    $circle = $result[0]->circle;
    $cast = $result[0]->cast;
    $dy_cast = $result[0]->dy_cast;
    $date_of_retirement = $result[0]->date_of_retirement;
    $appointment_letter_number_and_date = $result[0]->appointment_letter_number_and_date;
    $mobile_number = $result[0]->mobile_number;
    $whatsApp_number = $result[0]->whatsApp_number;
    $email = $result[0]->email;



    /*$screen = get_current_screen();
    $str = $screen->id;
    echo trim($str,"desred_page_");*/


    echo "<pre>"; print_r($screen->id); echo "</pre>";

   ?>

    <!--        LM Number        -->
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="lm_number" placeholder="lm_number" value="<?php echo $lm_number?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Name', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="name" placeholder="Name" value="<?php echo $name?>" class="large-text"> 
    </div>

     <div class="form_field">
        <label><strong><?php _e( 'Father/husband name', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="father_or_husband_name" placeholder="father/husband name" value="<?php echo $father_or_husband_name?>" class="large-text"> 
    </div>

    <!--     Gender        -->

    <div class="form_field">
        <label><strong><?php _e( 'Gender', 'tmm-desred-members-funds' ); ?></strong></label>
        <select name="gender" id="gender" class="large-text">
            <option value="male" <?php echo selected('male', $gender); ?>>Male</option>
            <option value="female" <?php echo selected('female', $gender); ?>>Female</option>
        </select>
         
    </div>
    <!--     Blood Group        -->

    <div class="form_field">
        <label><strong><?php _e( 'Blood-Group', 'tmm-desred-members-funds' ); ?></strong></label>
        <select name="blood_group" id="blood_group" class="large-text">
            <option value="a_positive" <?php echo selected('a_positive', $blood_group); ?>>A Positive</option>
            <option value="a_negative" <?php echo selected('a_negative', $blood_group); ?>>A Negative</option>
            <option value="b_positive" <?php echo selected('b_positive', $blood_group); ?>>B Positive</option>
            <option value="b_negative" <?php echo selected('b_negative', $blood_group); ?>>B Negative</option>
            <option value="ab_positive" <?php echo selected('ab_positive', $blood_group); ?>>AB Positive</option>
            <option value="ab_negative" <?php echo selected('ab_negative', $blood_group); ?>>AB Negative</option>
            <option value="o_positive" <?php echo selected('o_positive', $blood_group); ?>>O Positive</option>
            <option value="o_negative" <?php echo selected('o_negative', $blood_group); ?>>O Negative</option>
        </select> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Date of Birth', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="date_of_birth" placeholder="date of birth" value="<?php echo $date_of_birth?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Date of Retirement', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="date_of_retirement" placeholder="date of retirement" value="<?php echo $date_of_retirement?>" class="large-text"> 
    </div>
    
    <div class="form_field">
        <label><strong><?php _e( 'Cast', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="cast" placeholder="cast" value="<?php echo $cast?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Dy Cast', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="dy_cast" placeholder="dy cast" value="<?php echo $dy_cast?>" class="large-text"> 
    </div>

    <!--    local address --->
    <div class="form_field">
        <label><strong><?php _e( 'Address-Local', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="local_address" placeholder="Address" value="<?php echo $local_address?>" class="large-text"> 
    </div>

    <!--    Permanent address --->
    <div class="form_field">
        <label><strong><?php _e( 'Address-Permanent', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="permanent_address" placeholder="Address" value="<?php echo $permanent_address?>" class="large-text"> 
    </div>


    <div class="form_field">
        <label><strong><?php _e( 'Mobile Number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="mobile_number" placeholder="mobile number" value="<?php echo $mobile_number?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'WhatsApp Number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="whatsApp_number" placeholder="whatsApp number" value="<?php echo $whatsApp_number?>" class="large-text"> 
    </div>


    <div class="form_field">
        <label><strong><?php _e( 'Email', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="email" placeholder="email" value="<?php echo $email?>" class="large-text"> 
    </div>

    <!--        LM Number of Mahasangh       -->
    <div class="form_field">
        <label><strong><?php _e( 'L.M. No. Mahasangh', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="lm_number_mahasangh" placeholder="L.M. No. Mahasangh" value="<?php echo $lm_number_mahasangh?>" class="large-text"> 
    </div>


    <div class="form_field">
        <label><strong><?php _e( 'Siniority List Number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="siniority_list_number" placeholder="siniority_list_number" value="<?php echo $siniority_list_number?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Appointment Letter Number and Date', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="appointment_letter_number_and_date" placeholder="appointment letter number and date" value="<?php echo $appointment_letter_number_and_date?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Date of Joining', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="date_of_joining" placeholder="date of Joining" value="<?php echo $date_of_joining?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'First Posting City', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="first_posting_city" placeholder="City" value="<?php echo $first_posting_city?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Assistant Engineers', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="assistant_engineers" placeholder="assistant engineers" value="<?php echo $assistant_engineers?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'District', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="district" placeholder="district" value="<?php echo $district?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Circle', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="circle" placeholder="circle" value="<?php echo $circle?>" class="large-text"> 
    </div>


    

    <input type="hidden" name="customer" value="<?php echo $_GET['customer'];?>">

    <input type="hidden" name="mode" value="edit">

    <input type="hidden" name="action" value="tmm_desred_members_Form_Action">
   <?php

}

function tmm_desred_members_submit_btn_fun(){
    ?>
    <button name="btn_smt" class="button button-primary button-large">Submit</button>
    <?php
}


function tmm_desred_members_add_form_fun(){

    ?>

    <!--        LM Number        -->
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="lm_number" placeholder="lm_number" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Name', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="name" placeholder="Name" value="" class="large-text"> 
    </div>

     <div class="form_field">
        <label><strong><?php _e( 'Father/husband name', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="father_or_husband_name" placeholder="father/husband name" value="" class="large-text"> 
    </div>

    <!--     Gender        -->

    <div class="form_field">
        <label><strong><?php _e( 'Gender', 'tmm-desred-members-funds' ); ?></strong></label>
         <select name="gender" id="gender" class="large-text">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
         
    </div>
    <!--     Blood Group        -->

    <div class="form_field">
        <label><strong><?php _e( 'Blood-Group', 'tmm-desred-members-funds' ); ?></strong></label>
        <select name="blood_group" id="blood_group" class="large-text">
            <option value="a_positive">A Positive</option>
            <option value="a_negative">A Negative</option>
            <option value="b_positive">B Positive</option>
            <option value="b_negative">B Negative</option>
            <option value="ab_positive">AB Positive</option>
            <option value="ab_negative">AB Negative</option>
            <option value="o_positive">O Positive</option>
            <option value="o_negative">O Negative</option>
        </select> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Date of Birth', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="date_of_birth" placeholder="date of birth" value="" class="large-text"> 
    </div>

    
    <div class="form_field">
        <label><strong><?php _e( 'Date of Retirement', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="date_of_retirement" placeholder="date of retirement" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Cast', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="cast" placeholder="cast" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Dy Cast', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="dy_cast" placeholder="dy cast" value="" class="large-text"> 
    </div>

    <!--    local address --->
    <div class="form_field">
        <label><strong><?php _e( 'Address-Local', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="local_address" placeholder="Address" value="" class="large-text"> 
    </div>

    <!--    Permanent address --->
    <div class="form_field">
        <label><strong><?php _e( 'Address-Permanent', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="permanent_address" placeholder="Address" value="" class="large-text"> 
    </div>


    <div class="form_field">
        <label><strong><?php _e( 'Mobile Number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="mobile_number" placeholder="mobile number" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'WhatsApp Number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="whatsApp_number" placeholder="whatsApp number" value="" class="large-text"> 
    </div>


    <div class="form_field">
        <label><strong><?php _e( 'Email', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="email" placeholder="email" value="" class="large-text"> 
    </div>

    <!--        LM Number of Mahasangh       -->
    <div class="form_field">
        <label><strong><?php _e( 'L.M. No. Mahasangh', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="lm_number_mahasangh" placeholder="L.M. No. Mahasangh" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Siniority List Number', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="siniority_list_number" placeholder="siniority_list_number" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Appointment Letter Number and Date', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="appointment_letter_number_and_date" placeholder="appointment letter number and date" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Date of Joining', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="date_of_joining" placeholder="date of Joining" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'First Posting City', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="first_posting_city" placeholder="City" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Assistant Engineers', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="assistant_engineers" placeholder="assistant engineers" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'District', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="district" placeholder="district" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Circle', 'tmm-desred-members-funds' ); ?></strong></label>
        <input type="text" name="circle" placeholder="circle" value="" class="large-text"> 
    </div>



    


    
    <input type="hidden" name="action" value="tmm_desred_members_Form_Action">

    <input type="hidden" name="mode" value="add">
    <?php
}



function tmm_desred_featured_image_fun(){

    $thumbnail_id = tmm_desred_get_image($_GET['customer'], 'member');

    tmm_desred_upload_image('tmm_desred_upload_image', $thumbnail_id);
}

function tmm_desred_members_add_option() {

    add_meta_box("tmm-desred-members-edit-form", "Member", "tmm_desred_members_edit_form_fun", "tmm-desred-members-edit-form", "normal");

    add_meta_box("tmm-desred-members-add-form", "Member", "tmm_desred_members_add_form_fun", "tmm-desred-members-add-form", "normal");

    add_meta_box("tmm-desred-members-submit-btn", "Publish", "tmm_desred_members_submit_btn_fun", "tmm-desred-members-side", "side");

    add_meta_box("tmm-desred-featured-image", "Image", "tmm_desred_featured_image_fun", "tmm-desred-members-side", "side");

    $option = 'per_page';
 
	$args = array(
	    'label' => 'Customer',
	    'default' => 10,
	    'option' => 'customer_list_per_page'
	);
	 
	add_screen_option( $option, $args );

    $exampleListTable = new TmmDesredMembers();

}


add_filter('set-screen-option', 'tmm_desred_members_set_option', 10, 3);
 
function tmm_desred_members_set_option($status, $option, $value) {
 
    if ( 'customer_list_per_page' == $option ) return $value;
 
    return $status;
 
}


add_action('admin_post_tmm_desred_members_Form_Action', 'tmm_desred_members_Form_Action');
add_action('admin_post_nopriv_tmm_desred_members_Form_Action', 'tmm_desred_members_Form_Action');
function tmm_desred_members_Form_Action(){

    global $wpdb;

    if ($_POST['mode'] == 'add') { 

        $wpdb->insert( 
            "{$wpdb->prefix}tmm_members_tb", 
            array( 
                'name' => $_POST['name'], 
                'lm_number' => $_POST['lm_number'], 
                'siniority_list_number' => $_POST['siniority_list_number'],
                'lm_number_mahasangh' => $_POST['lm_number_mahasangh'],
                'gender' => $_POST['gender'],
                'blood_group' => $_POST['blood_group'], 
                'local_address' => $_POST['local_address'],
                'permanent_address' => $_POST['permanent_address'],
                'date_of_joining' => $_POST['date_of_joining'],
                'first_posting_city' => $_POST['first_posting_city'],                
                'assistant_engineers' => $_POST['assistant_engineers'],
                'father_or_husband_name' => $_POST['father_or_husband_name'],
                'date_of_birth' => $_POST['date_of_birth'],
                'district' => $_POST['district'],
                'circle' => $_POST['circle'],
                'cast' => $_POST['cast'],
                'dy_cast' => $_POST['dy_cast'],
                'date_of_retirement' => $_POST['date_of_retirement'],
                'appointment_letter_number_and_date' => $_POST['appointment_letter_number_and_date'],
                'mobile_number' => $_POST['mobile_number'],
                'whatsApp_number' => $_POST['whatsApp_number'],
                'email' => $_POST['email'],
                'status' => 'publish'
                ), 
            array( 
                '%s',   
                '%s',
                '%s',
                '%s'     
            )
        ); 


        $lastid = $wpdb->insert_id;  

        if($wpdb->last_error !== '') { 

            $_SESSION['add_error_message_session'] = $wpdb->last_error;
            $redirect_url = admin_url().'admin.php?page=tmm-desred-members&action=add';
            wp_redirect($redirect_url);
            die();

        }else{

            $_SESSION['add_message_session'] = 'Save successfully';
            
        }


    }  


    if ($_POST['mode'] == 'edit') {

        $wpdb->update( 
            "{$wpdb->prefix}tmm_members_tb", 
            array( 
                'name' => $_POST['name'], 
                'lm_number' => $_POST['lm_number'], 
                'siniority_list_number' => $_POST['siniority_list_number'],
                'lm_number_mahasangh' => $_POST['lm_number_mahasangh'], 
                'gender' => $_POST['gender'],
                'blood_group' => $_POST['blood_group'], 
                'local_address' => $_POST['local_address'],
                'permanent_address' => $_POST['permanent_address'],
                'date_of_joining' => $_POST['date_of_joining'],
                'first_posting_city' => $_POST['first_posting_city'],
                'assistant_engineers' => $_POST['assistant_engineers'],
                'father_or_husband_name' => $_POST['father_or_husband_name'],
                'date_of_birth' => $_POST['date_of_birth'],
                'district' => $_POST['district'],
                'circle' => $_POST['circle'],
                'cast' => $_POST['cast'],
                'dy_cast' => $_POST['dy_cast'],
                'date_of_retirement' => $_POST['date_of_retirement'],
                'appointment_letter_number_and_date' => $_POST['appointment_letter_number_and_date'],
                'mobile_number' => $_POST['mobile_number'],
                'whatsApp_number' => $_POST['whatsApp_number'],
                'email' => $_POST['email']
            ), 
            array( 'ID' => $_POST['customer'] ), 
            array( 
                '%s',   
                '%s',
                '%s'    
            ), 
            array( '%d' ) 
        );

        $lastid = $_POST['customer'];


        if($wpdb->last_error !== '') { 

            $_SESSION['add_error_message_session'] = $wpdb->last_error;

            $redirect_url = admin_url().'admin.php?page=tmm-desred-members&action=edit&customer='.$lastid;
            wp_redirect($redirect_url);
            die();

        }else{

           $_SESSION['edit_message_session'] = 'Updated successfully';
            
        }
    }

    tmm_desred_upload_image_save($lastid, 'member');

    $delete_nonce = wp_create_nonce( 'sp_delete_customer' );
    
    $redirect_url = admin_url().'admin.php?page=tmm-desred-members&action=edit&customer='.$lastid;
    wp_redirect($redirect_url);
    die();
}

function tmm_desred_members_admin_notice__success() {

  $screen = get_current_screen();

  //echo "<pre>"; print_r($screen); echo "</pre>";
  //if ( $screen->id !== 'toplevel_page_tmm-desred-members') return;

    if (isset($_SESSION["add_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['add_message_session'], 'tmm-desred-members-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_message_session"]) {
            unset($_SESSION['add_message_session']);
        }
    }


    if (isset($_SESSION["edit_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['edit_message_session'], 'tmm-desred-members-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["edit_message_session"]) {
            unset($_SESSION['edit_message_session']);
        }
    }

    if (isset($_SESSION["add_error_message_session"])) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( $_SESSION['add_error_message_session'], 'tmm-desred-members-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_error_message_session"]) {
            unset($_SESSION['add_error_message_session']);
        }
    }

}
add_action( 'admin_notices', 'tmm_desred_members_admin_notice__success' );