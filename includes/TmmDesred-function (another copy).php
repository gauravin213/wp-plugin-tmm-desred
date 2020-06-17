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

  if ( ! did_action( 'wp_enqueue_media' ) ) {
      wp_enqueue_media();
  }

  wp_enqueue_style('TmmDesred_admin_style', TmmDesred_URL.'assets/css/TmmDesred_admin.css', array(), '1.0', 'all');

  wp_register_script('TmmDesred_admin_script', TmmDesred_URL.'assets/js/TmmDesred_admin.js', array('jquery'), '1.0', true);
  wp_enqueue_script( 'TmmDesred_admin_script' );


  wp_enqueue_style('TmmDesred_admin_validation_style', TmmDesred_URL.'assets/css/screen.css', array(), '1.0', 'all');

  wp_enqueue_script('TmmDesred_admin_validation_script', TmmDesred_URL.'assets/js/jquery.validate.min.js', array('jquery'), '1.0', true);
  

  wp_enqueue_script( 'common' );
  wp_enqueue_script( 'wp-lists' );
  wp_enqueue_script( 'postbox' );


  wp_enqueue_script('select2-admin-js', TmmDesred_URL.'assets/js/select2.js', array('jquery'), '1.0', true);
  wp_enqueue_style('select2-admin-css', TmmDesred_URL.'assets/css/select2.css', array(), '1.0', 'all');

  wp_enqueue_script( 'jquery-ui-datepicker' );

  wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );


  wp_enqueue_script('chart-admin-js', TmmDesred_URL.'assets/chart/Chart.js', array('jquery'), '1.0', false);
  wp_enqueue_script('chart-utils-admin-js', TmmDesred_URL.'assets/chart/utils.js', array('jquery'), '1.0', false);

}


add_action( 'admin_menu', 'TmmDesred_admin_menu_page_fun');
function TmmDesred_admin_menu_page_fun(){

    $title = "Desred";
    $hook = add_menu_page( $title, $title, 'manage_options', 'tmm-desred', 'TmmDesred_admin_menu_fun');
    add_action( "load-$hook", 'tmm_desred_add_option');

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


function tmm_desred_add_option() {

  add_meta_box("tmm-desred-edit-form", "Balance", "tmm_desred_add_form_fun", "tmm-desred-add-form", "normal");

  add_meta_box("tmm-desred-edit-form", "Members", "tmm_desred_edit_form_fun", "tmm-desred-edit-form", "side");
}

function tmm_desred_add_form_fun(){
?>
  <div>
    <label>Balance</label>
    <?php echo '&#x20b9; '.$get_total_balance = get_total_balance();?>
  </div>
  <?php
}

function tmm_desred_edit_form_fun(){

  echo get_member_count();

}

function TmmDesred_admin_menu_fun(){

  global $wpdb;

?>
<div class="wrap">

  <hr class="wp-header-end">



  <div id="welcome-panel" class="welcome-panel">
    <!---->
    <style>
    canvas{
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
    }
    </style>
    <div style="width:75%;">
    <canvas id="canvas"></canvas>
    </div>
    <br>
    <br>
    <button id="randomizeData">Randomize Data</button>
    <button id="addDataset">Add Dataset</button>
    <button id="removeDataset">Remove Dataset</button>
    <button id="addData">Add Data</button>
    <button id="removeData">Remove Data</button>
    <!---->
  </div>

  <div id="dashboard-widgets-wrap">

      <div id="dashboard-widgets" class="metabox-holder">

        <div id="postbox-container-1" class="postbox-container">
            <!--normal-->
           <?php do_meta_boxes("tmm-desred-add-form", "normal", null); ?>
        </div>
        <div id="postbox-container-1" class="postbox-container">
            <!--side-->
            <?php do_meta_boxes("tmm-desred-edit-form", "side", null); ?>
        </div>
        
      </div>
    
  </div>
  
</div>
<div class="clear"></div>

<script>
  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var config = {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'My First dataset',
        animation: {
          y: {
            duration: 2000,
            delay: 100
          }
        },
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        data: [
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor()
        ],
        fill: false,
      }, {
        label: 'My Second dataset',
        fill: false,
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        data: [
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor()
        ],
      }]
    },
    options: {
      animation: {
        y: {
          easing: 'easeInOutElastic',
          from: 0
        }
      },
      responsive: true,
      title: {
        display: true,
        text: 'Chart.js Line Chart'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        x: {
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Month'
          }
        },
        y: {
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Value'
          }
        }
      }
    }
  };

  window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = new Chart(ctx, config);
  };

  document.getElementById('randomizeData').addEventListener('click', function() {
    config.data.datasets.forEach(function(dataset) {
      dataset.data = dataset.data.map(function() {

        console.log('==>'+randomScalingFactor());

        return randomScalingFactor();
      });

    });

    window.myLine.update();
  });

  var colorNames = Object.keys(window.chartColors);
  document.getElementById('addDataset').addEventListener('click', function() {
    var colorName = colorNames[config.data.datasets.length % colorNames.length];
    var newColor = window.chartColors[colorName];
    var newDataset = {
      label: 'Dataset ' + config.data.datasets.length,
      backgroundColor: newColor,
      borderColor: newColor,
      data: [],
      fill: false
    };

    for (var index = 0; index < config.data.labels.length; ++index) {
      newDataset.data.push(randomScalingFactor());
    }

    config.data.datasets.push(newDataset);
    window.myLine.update();
  });

  document.getElementById('addData').addEventListener('click', function() {
    if (config.data.datasets.length > 0) {
      var month = MONTHS[config.data.labels.length % MONTHS.length];
      config.data.labels.push(month);

      config.data.datasets.forEach(function(dataset) {
        dataset.data.push(randomScalingFactor());
      });

      window.myLine.update();
    }
  });

  document.getElementById('removeDataset').addEventListener('click', function() {
    config.data.datasets.splice(0, 1);
    window.myLine.update();
  });

  document.getElementById('removeData').addEventListener('click', function() {
    config.data.labels.splice(-1, 1); // remove the label first

    config.data.datasets.forEach(function(dataset) {
      dataset.data.pop();
    });

    window.myLine.update();
  });
</script>


<script type="text/javascript">
jQuery(document).ready(function($){
    jQuery(".if-js-closed").removeClass("if-js-closed").addClass("closed");
    postboxes.add_postbox_toggles( pagenow );
});
</script>
  <?php
}







/*
* Get Member data
*/
function get_member_count(){
  global $wpdb;
  $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_members_tb");
  return count($result);
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
/*
* Get Member data
*/





/*
* Get wp_list_table functions 
*/
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
* Get wp_list_table functions 
*/










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

          $column_name = ucwords(str_replace("_"," ",$key));

          if ($key == 'member_id') {

             $htm .='<tr>
              <th scope="row">
                <label for="UserName">'.$column_name.'</label>
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
                <label for="UserName">'.$column_name.'</label>
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


/*
* Add Balance to table
*/
function subtract_balance($amount){

    global $wpdb;
  
    $gave_amount = (float)$amount;

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_balance_tb");

    $count = count($result); 

    if ($count != 0) { 

        $balance = (float)$result[0]->balance;

        if ($balance > $gave_amount) {

          $total_balance = $balance - $gave_amount;

          $wpdb->update( 
              "{$wpdb->prefix}tmm_balance_tb", 
              array( 
                  'balance' => $total_balance
              ), 
              array( 'id' => 1 ),
              array( 
                  '%s'
              ), 
              array( '%d' ) 
          );
          
        }else{
          echo "Error: ".$balance .'>'. $gave_amount;
          die();
        }

    }
}



function add_balance($amount){

    global $wpdb;
  
    $gave_amount = (float)$amount;

    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_balance_tb");

    $count = count($result); 

    if ($count == 0) { 

        $wpdb->insert( 
            "{$wpdb->prefix}tmm_balance_tb", 
            array( 
                'balance' => $gave_amount
                ), 
            array( 
                '%s'    
            )
        ); 
        
    }else{ 

        $balance = (float)$result[0]->balance;

        $total_balance = $gave_amount + $balance;

        $wpdb->update( 
            "{$wpdb->prefix}tmm_balance_tb", 
            array( 
                'balance' => $total_balance
            ), 
            array( 'id' => 1 ),
            array( 
                '%s'
            ), 
            array( '%d' ) 
        );
    }
}


function get_total_balance(){

    global $wpdb;
  
    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_balance_tb");

    $count = count($result); 

    if ($count == 0) { 

        $balance = 0;
        
    }else{ 

        $balance = (float)$result[0]->balance;
        
    }

    return $balance;

}
/*
* Add Balance to table
*/



/*
* Register end point
*/
add_action( 'rest_api_init', 'my_register_route' );
function my_register_route() {

    register_rest_route( 'my-route', 'my-phrase', array(
                    'methods' => 'GET',
                    'callback' => 'custom_phrase',
                    'permission_callback' => function($request) {
                            return true;
                        },
                )
            );
}
function custom_phrase() {
   //http://127.0.0.1/wordpress521/wp-json/my-route/my-phrase
    global $wpdb;
    $result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_sangh_tb");
    return rest_ensure_response( $result );
}
/*
* Register end point
*/