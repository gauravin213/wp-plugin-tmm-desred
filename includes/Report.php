<style>
table {
width:100%;
}
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}
th, td {
padding: 15px;
text-align: left;
}
table#t01 tr:nth-child(even) {
background-color: #eee;
}
table#t01 tr:nth-child(odd) {
background-color: #fff;
}
table#t01 th {
background-color: black;
color: white;
}
</style>





<?php

function get_member_report($result){

  $col = array_keys($result[0]);

  $count = count($result); 

  if ($count != 0) {

    ?>
     <table>
        <tr>
          <?php foreach ($col as $val) { ?>
           <th><?php echo ucwords(str_replace("_"," ",$val));?></th>
          <?php } ?>
        </tr>

        <?php foreach ($result as $data) { ?>
           <tr>
            <?php foreach ($data as $val) { ?>
              <th><?php echo $val;?></th>
            <?php } ?>
          </tr>
        <?php } ?>

        
      </table>
    <?php

  }

}


$lm_number = (isset($_GET['lm_number']))? $_GET['lm_number'] : '';

//echo $lm_number; echo "<br>";

if (!empty($lm_number)) {

	global $wpdb;
  
  $result1 = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_sangh_tb WHERE lm_number = '".$lm_number."'", ARRAY_A);

  $result2 = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_mahasangh_tb WHERE lm_number = '".$lm_number."'", ARRAY_A);

  $result3 = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_anshdan_tb WHERE lm_number = '".$lm_number."'", ARRAY_A);

  $result4 = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_family_welfare_scheme_tb WHERE lm_number = '".$lm_number."'", ARRAY_A);

  $result5 = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_building_fund_tb WHERE lm_number = '".$lm_number."'", ARRAY_A);

  $result6 = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_maha_adhiveshan_tb WHERE lm_number = '".$lm_number."'", ARRAY_A);

  $result7 = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}tmm_posting_tb WHERE lm_number = '".$lm_number."'", ARRAY_A);

	?>
	<div class="wrap">

        <h1 class="wp-heading-inline=" style="text-align: center;"><?php _e( 'Report', 'tmm-desred' ); ?></h1><hr class="wp-header-end">


    		<h1 class="wp-heading-inline"><?php _e( 'Sangh', 'tmm-desred' ); ?></h1><hr class="wp-header-end">
        <?php  
        $count = count($result1);
        if ($count != 0) {
          get_member_report($result1); 
        }else{
          echo "<h3>Data Not found";
        }
        ?>

        <h1 class="wp-heading-inline"><?php _e( 'Mahasangh', 'tmm-desred' ); ?></h1><hr class="wp-header-end">
        <?php  
        $count = count($result2);
        if ($count != 0) {
          get_member_report($result2); 
        }else{
          echo "<h3>Data Not found";
        }
        ?>


        <h1 class="wp-heading-inline"><?php _e( 'Anshdan', 'tmm-desred' ); ?></h1><hr class="wp-header-end">
        <?php  
        $count = count($result3);
        if ($count != 0) {
          get_member_report($result3); 
        }else{
          echo "<h3>Data Not found";
        }
        ?>

        <h1 class="wp-heading-inline"><?php _e( 'Family welfare scheme', 'tmm-desred' ); ?></h1><hr class="wp-header-end">
        <?php  
        $count = count($result4);
        if ($count != 0) {
          get_member_report($result4); 
        }else{
          echo "<h3>Data Not found";
        }
        ?>


        <h1 class="wp-heading-inline"><?php _e( 'Building fund', 'tmm-desred' ); ?></h1><hr class="wp-header-end">
        <?php  
        $count = count($result5);
        if ($count != 0) {
          get_member_report($result5); 
        }else{
          echo "<h3>Data Not found";
        }
        ?>


        <h1 class="wp-heading-inline"><?php _e( 'Maha adhiveshan', 'tmm-desred' ); ?></h1><hr class="wp-header-end">
        <?php  
        $count = count($result6);
        if ($count != 0) {
          get_member_report($result6); 
        }else{
          echo "<h3>Data Not found";
        }
        ?>


        <h1 class="wp-heading-inline"><?php _e( 'Posting', 'tmm-desred' ); ?></h1><hr class="wp-header-end">
        <?php  
        $count = count($result7);
        if ($count != 0) {
          get_member_report($result7); 
        }else{
          echo "<h3>Data Not found";
        }
        ?>

	</div>

	<?php }else{ ?>

		<!-- <h1>Not Found Data</h1> -->

    <form id="form_tmm_desred_posting==" method="get" action="">
    
    <div class="form_field">
        <label><strong><?php _e( 'Lm number', 'tmm-desred-posting-funds' ); ?></strong></label>
        <?php
        $lm_number = !empty( $lm_number ) ? $lm_number : '';
        $name = 'lm_number';
        $get_member = get_member($name, $lm_number);
        ?>
        <label for="lm_number" class="error"></label>
    </div>

    <input type="hidden" name="page" value="tmm-report">

    <button>Submit</button>
    </form>
    



<?php }