<?php

defined( 'ABSPATH' ) || exit;

require_once 'admin/TmmDesredMembers.php';
require_once 'admin/tmm_desred_members.php';
require_once 'admin/TmmDesredSangh.php';
require_once 'admin/tmm_desred_sangh.php';
require_once 'admin/TmmDesredMahasangh.php';
require_once 'admin/tmm_desred_mahasangh.php';
require_once 'admin/TmmDesredAnshdan.php';
require_once 'admin/tmm_desred_anshdan.php';
require_once 'admin/TmmDesredFamilyWelfareScheme.php';
require_once 'admin/tmm_desred_family_welfare_scheme.php';
require_once 'admin/TmmDesredBuildingFund.php';
require_once 'admin/tmm_desred_building_fund.php';
require_once 'admin/TmmDesredMahaAdhiveshan.php';
require_once 'admin/tmm_desred_maha_adhiveshan.php';
require_once 'admin/TmmDesredExpenses.php';
require_once 'admin/tmm_desred_expenses.php';

function TmmDesred_register_session() {

    if (!session_id())
        session_start();
}

add_action('init', 'TmmDesred_register_session');


add_action('admin_enqueue_scripts', 'TmmDesred_admin_enqueue_scripts', 10, 1);

function TmmDesred_admin_enqueue_scripts(){ 

  wp_enqueue_style('TmmDesred_admin_style', TmmDesred_URL.'assets/css/TmmDesred_admin.css', array(), '1.0', 'all');

  wp_register_script('TmmDesred_admin_script', TmmDesred_URL.'assets/js/TmmDesred_admin.js', array('jquery'), '1.0', true);
  wp_enqueue_script( 'TmmDesred_admin_script' );
  

  wp_enqueue_script( 'common' );
  wp_enqueue_script( 'wp-lists' );
  wp_enqueue_script( 'postbox' );


  wp_enqueue_script('select2-admin-js', TmmDesred_URL.'assets/js/select2.js', array('jquery'), '1.0', true);
  wp_enqueue_style('select2-admin-css', TmmDesred_URL.'assets/css/select2.css', array(), '1.0', 'all');

}


add_action( 'admin_menu', 'TmmDesred_admin_menu_page_fun');
function TmmDesred_admin_menu_page_fun(){

    $title = "Desred";
    add_menu_page( $title, $title, 'manage_options', 'tmm-desred', 'TmmDesred_admin_menu_fun');

    $title = "Members";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-members', 'tmm_desred_members_admin_menu_fun' );
    add_action( "load-$hook", 'tmm_desred_members_add_option');

    $title = "Sangh";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-sangh', 'tmm_desred_sangh_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_sangh_add_option');

    $title = "Mahasangh";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-mahasangh', 'tmm_desred_mahasangh_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_mahasangh_add_option');

    $title = "Family welfare scheme ";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-family-welfare-scheme', 'tmm_desred_family_welfare_scheme_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_family_welfare_scheme_add_option');

    $title = "Anshdan";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-anshdan', 'tmm_desred_anshdan_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_anshdan_add_option');

    $title = "Building fund";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-building-fund', 'tmm_desred_building_fund_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_building_fund_add_option');

    $title = "Maha adhiveshan";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-maha-adhiveshan', 'tmm_desred_maha_adhiveshan_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_maha_adhiveshan_add_option');

    $title = "Expenses ";
    $hook = add_submenu_page('tmm-desred', $title, $title, 'manage_options', 'tmm-desred-expenses', 'tmm_desred_expenses_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_expenses_add_option');

}

function TmmDesred_admin_menu_fun(){

  global $wpdb;

  ?>
  <div class="wrap">
    <?php _e( 'Engineer Sangh Rural Engineering Department(DESRED)', 'tmm-desred-sangh-funds' ); ?> 

        <!---->
        <?php
        if ( isset ( $_GET['tab'] ) ) ilc_admin_tabs($_GET['tab']); else ilc_admin_tabs('homepage');
        ?>
        <form method="post" action="<?php admin_url( 'themes.php?page=theme-settings' ); ?>">
        <?php
        wp_nonce_field( "ilc-settings-page" ); 

        if ( $_GET['page'] == 'tmm-desred' ){

           if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab'];
           else $tab = 'homepage';

           echo '<table class="form-table">';
           switch ( $tab ){
              case 'general' :
                 ?>
                 <tr>
                    <th>Tags with CSS classes:</th>
                    <td>
                       <input id="ilc_tag_class" name="ilc_tag_class" type="checkbox" <?php if ( $settings["ilc_tag_class"] ) echo 'checked="checked"'; ?> value="true" />
                       <label for="ilc_tag_class">Checking this will output each post tag with a specific CSS class based on its slug.</label>
                    </td>
                 </tr>
                 <?php
              break;
              case 'footer' :
                 ?>
                 <tr>
                    <th><label for="ilc_ga">Insert tracking code:</label></th>
                    <td>
                       Enter your Google Analytics tracking code:
                       <textarea id="ilc_ga" name="ilc_ga" cols="60" rows="5"><?php echo esc_html( stripslashes( $settings["ilc_ga"] ) ); ?></textarea><br />

                    </td>
                 </tr>
                 <?php
              break;
              case 'homepage' :
                 ?>
                 <tr>
                    <th><label for="ilc_intro">Introduction</label></th>
                    <td>
                       Enter the introductory text for the home page:
                       <textarea id="ilc_intro" name="ilc_intro" cols="60" rows="5" ><?php echo esc_html( stripslashes( $settings["ilc_intro"] ) ); ?></textarea>
                    </td>
                 </tr>
                 <?php
              break;
           }
           echo '</table>';
        }

        ?>
           <p class="submit" style="clear: both;">
              <input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
              <input type="hidden" name="ilc-settings-submit" value="Y" />
           </p>
        </form>
        <!---->



        <!---->
        <?php     
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');    
        ?>
        <div>
            <a href="#TB_inline?width=600&height=550&inlineId=modal-window-id" class="button button-primary thickbox">Add New User</a>
            <div id="modal-window-id" style="display:none;">  
                <div class="control-box ds_model">
                    <fieldset>
                    <legend>Add New User</legend>
                    <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                            <label for="UserName">UserName</label>
                            </th>
                            <td>
                                 <input type="text" name="custom_username" id="custom_username" value="" placeholder="UserName">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                            <label for="Email">Email</label>
                            </th>
                            <td>
                                 <input type="text" name="custom_email" id="custom_email"  value="" placeholder="Email">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                            <label for="role">Role</label>
                            </th>
                            <td class="radio_backend">
                                <p><input type="radio" name="custom_role" value="customer">Customer</p>
                                <p><input type="radio" name="custom_role" value="wholesale_customer">Wholesale Customer</p>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- <script type="text/javascript">
          jQuery(document).ready(function() {  

            setTimeout(function(){ 

              tb_show("", "TB_inline?width=600&height=550&inlineId=modal-window-id");
              return false;

            }, 1000);

            setTimeout(function(){ 

              tb_remove("", "TB_inline?width=600&height=550&inlineId=modal-window-id");
              return false;

            }, 3000);

          }); 
        </script> -->
        <!---->
  </div>
  <?php
}

function ilc_admin_tabs($current = 'homepage') { 

    $tabs = array( 'homepage' => 'Home Settings', 'general' => 'General', 'footer' => 'Footer' );
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<div class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? 'nav-tab-active' : '';
        echo "<a class='nav-tab $class' href='?page=tmm-desred&tab=$tab'>$name</a>";

    }
    echo '</div>';
}

function get_member_name_by_id($id){
  global $wpdb;
  $result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}tmm_members_tb WHERE ID=".$id);
  return $result[0]->name;
}

function get_member($name, $member_id){
  global $wpdb;
  $result = $wpdb->get_results("SELECT ID, name FROM {$wpdb->prefix}tmm_members_tb");
  ?>
  <select name="<?php echo $name;?>" id="<?php echo $name;?>">
  <option value="">select</option>
  <?php foreach ($result as $data) { ?>
  <option value="<?php echo $data->ID;?>" <?php selected($data->ID, $member_id); ?>><?php echo $data->name;?></option>
  <?php } ?>
  </select>
  <script type="text/javascript">
      jQuery(document).ready(function(){
          jQuery('#member_id').select2({
            placeholder : "select me",
            width: '99%'
          });
      });
  </script>
  <?php
}


function get_filter_by_colum_name($colums = array(), $tb_name){ 
  global $wpdb;
  unset($colums['cb']);
  ?>
  <!---->
  <div class="alignleft actions bulkactions">
  <?php foreach ($colums as $key => $value) { ?>


    <?php if ($key == 'member_id') { ?>

      <!---->
      <?php 
      $data = $wpdb->get_results("select DISTINCT ".$key." from {$wpdb->prefix}".$tb_name." WHERE  status = 'publish' ORDER BY ".$key." DESC", ARRAY_A);

      $count = count($data);
      ?>

      <?php if( $data ){ ?>

        <select name="<?php echo $key;?>_filter" id="<?php echo $key;?>_filter">
            <option value="">Filter by <?php echo $value;?></option>
            <?php foreach( $data as $customer ){ 
                $selected = '';
                if( $_REQUEST[$key.'_filter'] == $customer[$key] ){ 
                    $selected = ' selected = "selected"';   
                }

                $name = get_member_name_by_id($customer[$key]);
                ?>
                <option value="<?php echo $customer[$key]; ?>" <?php echo $selected;?> ><?php echo $name; ?></option>
            <?php } ?>
        </select>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#<?php echo $key;?>_filter').select2({placeholder : "<?php echo $value;?>" });
            });
        </script>

      <?php } ?> 
      <!---->

     
    <?php }else{ ?>

      <!---->
      <?php 
      $data = $wpdb->get_results("select DISTINCT ".$key." from {$wpdb->prefix}".$tb_name." WHERE  status = 'publish' ORDER BY ".$key." DESC", ARRAY_A);

      $count = count($data);
      ?>

      <?php if( $data ){ ?>

        <select name="<?php echo $key;?>_filter" id="<?php echo $key;?>_filter">
            <option value="">Filter by <?php echo $value;?></option>
            <?php foreach( $data as $customer ){ 
                $selected = '';
                if( $_REQUEST[$key.'_filter'] == $customer[$key] ){ 
                    $selected = ' selected = "selected"';   
                }
                ?>
                <option value="<?php echo $customer[$key]; ?>" <?php echo $selected;?> ><?php echo $customer[$key]; ?></option>
            <?php } ?>
        </select>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#<?php echo $key;?>_filter').select2({placeholder : "<?php echo $value;?>" });
            });
        </script>

      <?php } ?> 
      <!---->


    <?php } ?>

    

  <?php } ?>



<?php  if ($count != 0) { ?>
<input type="submit" name="filter_action" id="post-query-submit" class="button" value="Filter">
<?php } ?>


</div>
<!---->
<?php
}


function get_filter_by_colum_name_sql($colums = array()){

  unset($colums['cb']); 

  foreach ($colums as $key => $value) {

    //member_id_filter
    $member_id_filter = ( isset($_REQUEST[$key.'_filter']) ? $_REQUEST[$key.'_filter'] : '');
    if($member_id_filter != '') {
        $sql .= " AND ".$key." LIKE '" .$member_id_filter. "'";
    } else  {
        $sql .= '';
    } 

  }

  return $sql;
}








/*
* Featured image
*/
function tmm_desred_get_image($post_id, $sourse_type){ 

  global $wpdb;

  $q = "SELECT * FROM {$wpdb->prefix}tmm_images_tb WHERE post_id = '".$post_id."' AND sourse_type = '".$sourse_type."' ";
  $result = $wpdb->get_results($q);

  return $result[0]->thumbnail_id;

}


function tmm_desred_upload_image_save($post_id, $sourse_type){

  global $wpdb;

  if (isset($_POST['tmm_desred_upload_image'])) {

      $q = "SELECT * FROM {$wpdb->prefix}tmm_images_tb WHERE post_id = '".$post_id."' AND sourse_type = '".$sourse_type."' ";

        $result = $wpdb->get_results($q);

        $count = count($result);

        $image_url = wp_get_attachment_image_src( $_POST['tmm_desred_upload_image'], 'full' );

        $img_url = $image_url[0];

        if ($count == 0) { echo "11";

            $wpdb->insert( 
            "{$wpdb->prefix}tmm_images_tb", 
            array( 
                'post_id' => $post_id, 
                'sourse_type' => $sourse_type,
                'thumbnail_id' => $_POST['tmm_desred_upload_image'],
                'image_url' => $img_url,
                'status' => 'publish'
                ), 
            array( 
                '%s',   
                '%s',
                '%s',
                '%s'     
            )
        );

           
        }else{  

          $wpdb->update( 
            "{$wpdb->prefix}tmm_images_tb", 
            array( 
                'sourse_type' => $sourse_type,
                'thumbnail_id' => $_POST['tmm_desred_upload_image'],
                'image_url' => $img_url,
            ), 
            array( 'post_id' => $post_id ), 
            array( 
                '%s',   
                '%s',
                '%s'    
            ), 
            array( '%d' ) 
        );


        }
       
    }
}

function tmm_desred_upload_image($name, $id){

    echo tmm_desred_image_uploader_field( $name, $id);

    ?>
    <script type="text/javascript">
    jQuery(function($){
        /*
         * Select/Upload image(s) event
         */
        $('body').on('click', '.consultant_upload_image_button', function(e){
            e.preventDefault();
     
                var button = $(this),
                    custom_uploader = wp.media({
                title: 'Insert image',
                library : {
                    // uncomment the next line if you want to attach image to the current post
                    // uploadedTo : wp.media.view.settings.post.id, 
                    type : 'image'
                },
                button: {
                    text: 'Use this image' // button label text
                },
                multiple: false // for multiple image selection set to true
            }).on('select', function() { // it also has "open" and "close" events 
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:50%;display:block;" />').next().val(attachment.id).next().show();
            })
            .open();
        });
     
        /*
         * Remove image event
         */
        $('body').on('click', '.misha_remove_image_button', function(){
            $(this).hide().prev().val('').prev().addClass('button').html('Upload image');
            return false;
        });
     
    });
    </script>
     <?php

}


function tmm_desred_image_uploader_field( $name, $value = '') {

$image = ' button">Upload Image';
$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
$display = 'none'; // display state ot the "Remove image" button

if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
    $image = '"><img src="' . $image_attributes[0] . '" style="max-width:50%;display:block;" />';
    $display = 'inline-block';
}

return '<div>
    <a href="#" class="consultant_upload_image_button' . $image . '</a>
        <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
        <a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
    </div>';

}
/*
* Featured image
*/







/*
* Admin popup
*/
add_action('admin_footer', 'tmm_desred_admin_footer');
function tmm_desred_admin_footer(){
?>
<!---->
<?php     
wp_enqueue_style('thickbox');
wp_enqueue_script('thickbox');  


$screen = get_current_screen();

//echo "pppppppppppppppppppppppppppppppppppppppppppp<pre>"; print_r($screen->id); echo "</pre>";  
//echo 'pppppppppppppppppppppppppppppppppppppppppppppppppp :: '.$screen->id; echo "<br>";
//echo 'pppppppppppppppppppppppppppppppppppppppppppppppppp :: '.$page = str_replace("desred_page_","",$screen->id);
?>
<div>
    <div id="modal-window-id" style="display:none;"> 
    <input type="hidden" name="get_edit_url" id="get_edit_url" value="<?php echo $screen->id;?>"> 
     <a href="#" id="edit_url">Edit</a>
        <div class="control-box ds_model">
            <fieldset>
            <table class="form-table">
            <tbody id="tb_data_ppp">
            </tbody>
            </table>
            </fieldset>
        </div>
    </div>
</div>
<!---->

<script type="text/javascript">
jQuery(document).ready(function($){
    
    jQuery(document).on('click', '.view_data', function(e){ 

      e.preventDefault();

      var target = jQuery(this);

      var ID = target.attr('data-ID');

      var tbn = target.attr('data-tbn');

      var sourse_type = target.attr('data-sourse-type');

      var get_edit_url = jQuery('#get_edit_url').val();

      //
      jQuery.ajax({
        url: '<?php echo admin_url( 'admin-ajax.php');?>',
        type: "POST",
        data: {'action': 'tmm_desred_view_data_action', 'ID': ID, 'tbn': tbn, 'sourse_type': sourse_type, 'get_edit_url': get_edit_url},
        cache: false,
        dataType: 'json',
        beforeSend: function(){
          target.text('loading..');
        },
        complete: function(){
          target.text('View');
        },
        success: function (response) { console.log(response);

          jQuery('#edit_url').attr('href', response['edit_url']);
          jQuery('#tb_data_ppp').html(response['response']);
          tb_show("", "TB_inline?width=600&height=550&inlineId=modal-window-id");

        }
    });
      //

    });
});
</script>
<?php
}

add_action( 'wp_ajax_tmm_desred_view_data_action', 'tmm_desred_view_data_action_fun');
add_action( 'wp_ajax_nopriv_tmm_desred_view_data_action', 'tmm_desred_view_data_action_fun');
function tmm_desred_view_data_action_fun(){

    global $wpdb;

    $ID = $_POST['ID'];

    $tbn = $_POST['tbn']; 

    $sourse_type = $_POST['sourse_type']; 

    $get_edit_url = $_POST['get_edit_url'];
    $page = str_replace("desred_page_","",$get_edit_url);
    $sp_nonce_customer = wp_create_nonce( 'sp_nonce_customer' );
    $edit_url = admin_url()."admin.php?page=".$page."&action=edit&customer=".$ID."&_wpnonce".$sp_nonce_customer;

    $htm = "";

    if (!empty($sourse_type)) {
      
      $thumbnail_id = tmm_desred_get_image($ID, $sourse_type);
      if (!empty($thumbnail_id)) {
          $image = wp_get_attachment_image_src( $thumbnail_id, 'medium' );
          $url = $image[0];
      }else{
          $url = TmmDesred_URL.'assets/image/person-placeholder.png';
      }

      $htm .='<tr>
                <th scope="row">
                  <label for="UserName">Image</label>
                </th>
                <td>
                   <img src="'.$url.'"  style="max-width:100px;">
                </td>
              </tr>';

    }


    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}".$tbn." WHERE ID=".$ID);

    foreach ($result as $data) {
        
        foreach ($data as $key => $value) {

          if ($key == 'member_id') {

             $htm .='<tr>
              <th scope="row">
                <label for="UserName">'.$key.'</label>
              </th>
              <td>
                 <label for="UserName">'.$value.'</label>
              </td>
            </tr>';


            $htm .='<tr>
              <th scope="row">
                <label for="UserName">Member Name</label>
              </th>
              <td>
                 <label for="UserName">'.get_member_name_by_id($value).'</label>
              </td>
            </tr>';

          }else{

             $htm .='<tr>
              <th scope="row">
                <label for="UserName">'.$key.'</label>
              </th>
              <td>
                 <label for="UserName">'.$value.'</label>
              </td>
            </tr>';

          }
            
            
        }

    }


    

    $myArr = array(
        'response' => $htm,
        'result' => $result,
        'ID' => $ID,
        'tbn' => $tbn,
        'edit_url' => $edit_url,
        'sourse_type' => $sourse_type
    );
    $myJSON = json_encode($myArr); 
    echo $myJSON;
    die();
}

/*
* Admin popup
*/


//get_member_name_by_id