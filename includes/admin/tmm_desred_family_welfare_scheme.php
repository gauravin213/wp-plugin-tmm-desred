<?php

defined( 'ABSPATH' ) || exit;

//my_wp_list_table_{table_name} like  tmm_desred_family_welfare_scheme  tmm-desred-family-welfare-scheme 

/*add_action( 'admin_menu', 'tmm_desred_family_welfare_scheme_admin_menu_page_fun');
function tmm_desred_family_welfare_scheme_admin_menu_page_fun(){

    $title = "desred family welfare scheme ";
    $hook = add_menu_page( $title, $title, 'manage_options', 'tmm-desred-family-welfare-scheme', 'tmm_desred_family_welfare_scheme_admin_menu_fun');

    add_action( "load-$hook", 'tmm_desred_family_welfare_scheme_add_option');

}*/

function tmm_desred_family_welfare_scheme_admin_menu_fun(){
?>  
<div class="wrap">
        <?php
            global $wpdb;

            if ($_GET['action'] == 'add') {
                ?>
                <h2><?php _e( 'Add Family Welfare Scheme', 'tmm-desred-family-welfare-scheme-funds' ); ?></h2>
                <form id="form_tmm_desred_family_welfare_scheme" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-family-welfare-scheme-add-form", "normal", null); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-family-welfare-scheme-submit-btn", "side", null); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php
               
            }else if ($_GET['action'] == 'edit') {

                $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_family_welfare_scheme_tb WHERE ID=".$_GET['customer']);
               
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Edit Family Welfare Scheme', 'tmm-desred-family-welfare-scheme-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-family-welfare-scheme&action=add" class="page-title-action">
                    <?php _e( 'Add New', 'tmm-desred-family-welfare-scheme-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="form_tmm_desred_family_welfare_scheme" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                            <div id="postbox-container-2" class="postbox-container">
                                <!--normal-->
                               <?php do_meta_boxes("tmm-desred-family-welfare-scheme-edit-form", "normal", $result); ?>
                            </div>
                            <div id="postbox-container-1" class="postbox-container">
                                <!--side-->
                                <?php do_meta_boxes("tmm-desred-family-welfare-scheme-submit-btn", "side", $result); ?>
                            </div>
                        </div>
                        <br class="clear" />
                    </div>
                </form>
                <?php

               
            }else{

                $exampleListTable = new TmmDesredFamilyWelfareScheme();
                ?>
                <h1 class="wp-heading-inline"><?php _e( 'Family Welfare Scheme', 'tmm-desred-family-welfare-scheme-funds' ); ?></h1>
                <a href="<?php echo admin_url();?>admin.php?page=tmm-desred-family-welfare-scheme&action=add" class="page-title-action"><?php _e( 'Add New', 'tmm-desred-family-welfare-scheme-funds' ); ?></a>
                <hr class="wp-header-end">
                <form id="tmm_desred_family_welfare_scheme_form" method="get">
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                    <?php
                    $exampleListTable->prepare_items();
                    $exampleListTable->views();
                    $exampleListTable->search_box("Search Post(s)", "search_post_id");
                    $exampleListTable->display(); 
                    ?>
                </form>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery('#name_filter').select2({placeholder : "select me" });
                        jQuery('#city_filter').select2({placeholder : "select me" });
                    });
                </script>
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





function tmm_desred_family_welfare_scheme_edit_form_fun($result){

    $lm_number = $result[0]->lm_number;
    $level = $result[0]->level;
    $amount = $result[0]->amount;
    $card_number = $result[0]->card_number;
    $year = $result[0]->year;

   ?>
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <?php
        $lm_number = !empty( $lm_number ) ? $lm_number : '';
        $name = 'lm_number';
        $get_member = get_member($name, $lm_number);
        ?>
        <label for="lm_number" class="error"></label>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Level', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <select name="level" id="level" class="large-text" style="width: 99%;">
            <option value="">--select--</option>
            <option value="1"  <?php selected("1", $level);?> >Level 1</option>
            <option value="2" <?php selected("2", $level);?>>Level 2</option>
            <option value="3" <?php selected("3", $level);?>>Level 3</option>
            <option value="4" <?php selected("4", $level);?>>Level 4</option>
            <option value="5" <?php selected("5", $level);?>>Level 5</option>
        </select>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Amount', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <input type="text" name="amount" placeholder="amount" value="<?php echo $amount?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Card Number', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <input type="text" name="card_number" placeholder="Card Number" value="<?php echo $card_number?>" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Year', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <input type="text" name="year" placeholder="year" value="<?php echo $year?>" class="large-text"> 
    </div>

    <input type="hidden" name="customer" value="<?php echo $_GET['customer'];?>">

    <input type="hidden" name="mode" value="edit">

    <input type="hidden" name="action" value="tmm_desred_family_welfare_scheme_Form_Action">

   <?php

}

function tmm_desred_family_welfare_scheme_submit_btn_fun(){
    ?>
    <button name="btn_smt" class="button button-primary button-large">Submit</button>
    <?php
}


function tmm_desred_family_welfare_scheme_add_form_fun(){

    ?>
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <?php
        $lm_number = !empty( $lm_number ) ? $lm_number : '';
        $name = 'lm_number';
        $get_member = get_member($name, $lm_number);
        ?>
        <label for="lm_number" class="error"></label>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Level', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <select name="level" class="large-text" style="width: 99%;">
            <option value="">--select--</option>
        </select>
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Amount', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <input type="text" name="amount" placeholder="amount" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Card Number', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <input type="text" name="card_number" placeholder="Card Number" value="" class="large-text"> 
    </div>

    <div class="form_field">
        <label><strong><?php _e( 'Year', 'tmm-desred-family-welfare-scheme-funds' ); ?></strong></label>
        <input type="text" name="year" placeholder="year" value="<?php echo $year?>" class="large-text"> 
    </div>


    <input type="hidden" name="action" value="tmm_desred_family_welfare_scheme_Form_Action">

    <input type="hidden" name="mode" value="add">

    <script type="text/javascript">
    jQuery(document).ready(function(){


        jQuery(document).on('change', 'input[name=card_number]', function(){

            var target = jQuery(this);

            var card_number = target.val();

            jQuery.ajax({
                url: '<?php echo admin_url( 'admin-ajax.php');?>',
                type: "POST",
                data: {'action': 'card_number_check_sangh_action', 'card_number': card_number},
                cache: false,
                dataType: 'json',
                beforeSend: function(){
                },
                complete: function(){
                },
                success: function (response) { 


                    if (response['status'] == 'cart_no_exist') {
                        alert('This card number is already exist: '+card_number);
                        jQuery('input[name=card_number]').val("");
                    }

                    
                }
            });

        });

        jQuery(document).on('change', 'select[name=lm_number]', function(){

            var target = jQuery(this);

            var lm_number = target.find(':selected').val(); 

            jQuery.ajax({
                url: '<?php echo admin_url( 'admin-ajax.php');?>',
                type: "POST",
                data: {'action': 'my_level_action', 'lm_number': lm_number},
                cache: false,
                dataType: 'json',
                beforeSend: function(){
                },
                complete: function(){
                },
                success: function (response) { 
                    console.log(response);

                    count = parseInt(response['count']);

                    if (count == 5) {
                        alert("All levels are done");
                        return ;

                    }

                    var opt = "";

                    if (count == 0) {

                        opt += '<option value="1">Level 1</option>';

                    }else if (count == 1) {

                        opt += '<option value="2">Level 2</option>';

                    }else if (count == 2) {

                        opt += '<option value="3">Level 3</option>';

                    }else if (count == 3) {

                        opt += '<option value="4">Level 4</option>';

                    }if (count == 4) {

                        opt += '<option value="5">Level 5</option>';

                    }

                    jQuery('select[name=level]').html(opt);
                }
            });


        });

    });
    </script>
    <?php
}

function tmm_desred_family_welfare_scheme_add_option() {

    add_meta_box("tmm-desred-family-welfare-scheme-edit-form", "Member", "tmm_desred_family_welfare_scheme_edit_form_fun", "tmm-desred-family-welfare-scheme-edit-form", "normal");

    add_meta_box("tmm-desred-family-welfare-scheme-add-form", "Member", "tmm_desred_family_welfare_scheme_add_form_fun", "tmm-desred-family-welfare-scheme-add-form", "normal");

    add_meta_box("tmm-desred-family-welfare-scheme-submit-btn", "Publish", "tmm_desred_family_welfare_scheme_submit_btn_fun", "tmm-desred-family-welfare-scheme-submit-btn", "side");

    $option = 'per_page';
 
	$args = array(
	    'label' => 'Customer',
	    'default' => 10,
	    'option' => 'customer_list_per_page'
	);
	 
	add_screen_option( $option, $args );

    $exampleListTable = new TmmDesredFamilyWelfareScheme();

}


add_filter('set-screen-option', 'tmm_desred_family_welfare_scheme_set_option', 10, 3);
 
function tmm_desred_family_welfare_scheme_set_option($status, $option, $value) {
 
    if ( 'customer_list_per_page' == $option ) return $value;
 
    return $status;
 
}


add_action('admin_post_tmm_desred_family_welfare_scheme_Form_Action', 'tmm_desred_family_welfare_scheme_Form_Action');
add_action('admin_post_nopriv_tmm_desred_family_welfare_scheme_Form_Action', 'tmm_desred_family_welfare_scheme_Form_Action');
function tmm_desred_family_welfare_scheme_Form_Action(){

    global $wpdb;

    if ($_POST['mode'] == 'add') { 

        $wpdb->insert( 
            "{$wpdb->prefix}tmm_family_welfare_scheme_tb", 
            array( 
                'lm_number' => $_POST['lm_number'],
                'level' => $_POST['level'],
                'amount' => $_POST['amount'],
                'card_number' => $_POST['card_number'],
                'year' => $_POST['year'],
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

        //Add balance
        add_balance($_POST['amount']);

        if($wpdb->last_error !== '') { 

            $_SESSION['add_error_message_session'] = $wpdb->last_error;
            $redirect_url = admin_url().'admin.php?page=tmm-desred-family-welfare-scheme&action=add';
            wp_redirect($redirect_url);
            die();

        }else{

            $_SESSION['add_message_session'] = 'Save successfully';
            
        }


    }  


    if ($_POST['mode'] == 'edit') {

        $wpdb->update( 
            "{$wpdb->prefix}tmm_family_welfare_scheme_tb", 
            array( 
                'lm_number' => $_POST['lm_number'],
                'level' => $_POST['level'],
                'amount' => $_POST['amount'],
                'year' => $_POST['year'],
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

            $redirect_url = admin_url().'admin.php?page=tmm-desred-family-welfare-scheme&action=edit&customer='.$lastid;
            wp_redirect($redirect_url);
            die();

        }else{

           $_SESSION['edit_message_session'] = 'Updated successfully';
            
        }


        
        
    }

    $delete_nonce = wp_create_nonce( 'sp_delete_customer' );
    
    $redirect_url = admin_url().'admin.php?page=tmm-desred-family-welfare-scheme&action=edit&customer='.$lastid;
    wp_redirect($redirect_url);
    die();
}

function tmm_desred_family_welfare_scheme_admin_notice__success() {

  $screen = get_current_screen();

  //if ( $screen->id !== 'toplevel_page_tmm-desred-family-welfare-scheme') return;

    if (isset($_SESSION["add_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['add_message_session'], 'tmm-desred-family-welfare-scheme-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_message_session"]) {
            unset($_SESSION['add_message_session']);
        }
    }


    if (isset($_SESSION["edit_message_session"])) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( $_SESSION['edit_message_session'], 'tmm-desred-family-welfare-scheme-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["edit_message_session"]) {
            unset($_SESSION['edit_message_session']);
        }
    }

    if (isset($_SESSION["add_error_message_session"])) {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php _e( $_SESSION['add_error_message_session'], 'tmm-desred-family-welfare-scheme-funds' ); ?></p>
        </div>
        <?php
        if (basename($_SERVER['PHP_SELF']) != $_SESSION["add_error_message_session"]) {
            unset($_SESSION['add_error_message_session']);
        }
    }

}
add_action( 'admin_notices', 'tmm_desred_family_welfare_scheme_admin_notice__success' );