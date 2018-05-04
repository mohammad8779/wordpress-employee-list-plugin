<?php
/*
 Plugin Name: Employee's List
Plugin URI:  https://softtech-it.com
Description: This is a employee's list plugin by tabs simple but flexible
Version:     1.0
Author:      Mohammad Ahammad
Author URI:  https://softtech-it.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: employee-data

*/

class Employee{

	public function __construct(){

		add_action('init', array($this,'employee_history'));
		add_action('add_meta_boxes', array($this, 'emplopyee_metabox_callback'));
		add_action('save_post', array($this, 'emplopyee_metabox_save'));
		add_action('admin_enqueue_scripts', array($this, 'default_jqueryui_tabs'));

	} 

	public function default_jqueryui_tabs(){
		wp_enqueue_script('jquery-ui-tabs');

		wp_enqueue_script('employee-tabs', PLUGINS_URL('js/custom.js',__FILE__), array('jquery') );

		wp_enqueue_style('employee-css', PLUGINS_URL('css/style.css',__FILE__) );
	}

	public function employee_history(){


		//reister custom post
		$labels = array(
		'name'               => _x( 'Employees', 'employee general name', 'employee-data' ),
		'singular_name'      => _x( 'Employee', 'employee singular name', 'employee-data' ),
		'menu_name'          => _x( 'Employees Lists', 'admin menu', 'employee-data' ),
		'name_admin_bar'     => _x( 'Employee', 'add new on admin bar', 'employee-data' ),
		'add_new'            => _x( 'Add New Employee', 'Employee', 'employee-data' ),
		'add_new_item'       => __( 'Add New Employee', 'employee-data' ),
		'new_item'           => __( 'New Employee', 'employee-data' ),
		'edit_item'          => __( 'Edit Employee', 'employee-data' ),
		'view_item'          => __( 'View Employee', 'employee-data' ),
		'all_items'          => __( 'All Employees', 'employee-data' ),
		'search_items'       => __( 'Search Employees', 'employee-data' ),
		'parent_item_colon'  => __( 'Parent Employees:', 'employee-data' ),
		'not_found'          => __( 'No Employee found.', 'employee-data' ),
		'not_found_in_trash' => __( 'No Employee found in Trash.', 'employee-data' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Employee.', 'employee-data' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'employee' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor',  'thumbnail', )
	);

	register_post_type( 'employee_list', $args );
    

      //taxonomy or catagory 
       
       $label = array(
		'name'                       => _x( 'types', 'taxonomy general name'),
		'singular_name'              => _x( 'type', 'taxonomy singular name'),
		'search_items'               => __( 'Search types'),
		'popular_items'              => __( 'Popular types'),
		'all_items'                  => __( 'All types' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit type' ),
		'update_item'                => __( 'Update type' ),
		'add_new_item'               => __( 'Add New type' ),
		'new_item_name'              => __( 'New type Name' ),
		'separate_items_with_commas' => __( 'Separate types with commas' ),
		'add_or_remove_items'        => __( 'Add or remove types'),
		'choose_from_most_used'      => __( 'Choose from the most used types' ),
		'not_found'                  => __( 'No types found.' ),
		'menu_name'                  => __( 'Employees Types'),
	);

	$argument = array(
		'hierarchical'          => true,
		'labels'                => $label,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'type' ),
	);

	register_taxonomy( 'employee_type', 'employee_list', $argument );

  }

  //metabox

  public function emplopyee_metabox_callback(){

  		add_meta_box('employee_info','<h1 class="meta-title">Employees Informations</h1>',array($this,'employee_information'),'employee_list' );
  }
  public function employee_information(){

  		$pvalue = get_post_meta(get_the_id(),'employee_info',true);
  		
  	    
  	    ?>  
  	         
  	         <div id="tabs">
				   <ul class="tabs-link">
				    
				    <li><a href="#Personal">Personal</a></li>
				    <li><a href="#Acadamic">Acadamic</a></li>
				    <li><a href="#Official">Official</a></li>

				    
				   
				  </ul>
				  <div id="Personal">
				    <h2>Personal Information:</h2>
				     <div class="info-sec">
				     	<label for="Name">Name:</label>
				     	<input id="Name" type="text" name="pdesig" value="<?php echo $pvalue;?>" placeholder="Name">

				     	<label for="Fname">Father's Name:</label>
				     	<input id="Fname" type="text" name="" value="" placeholder="Father's Name">

				     	<label for="Mname">Mother's Name:</label>
				     	<input id="Mname" type="text" name="" value="" placeholder="Mother's Name">

				     	<label for="MCname">Male</label>
				     	<input id="MCname" type="checkbox" name="" value="" >

				     	<label for="FCname">Female</label>
				     	<input id="FCname" type="checkbox" name="" value="" >
				     	

				     </div>
				    
				  </div>

				   <div id="Acadamic">
				    <h2>Acadamic Information:</h2>
				     <div class="info-sec">
				     	<label for="name">SSC Result:</label>
				     	<input id="name" type="text" name="" value="" placeholder="SSC Result">

				     	<label for="name">SSC Years:</label>
				     	<input id="name" type="text" name="" value="" placeholder="SSC Years">

				     	<label for="name">SSC Groups:</label>
				     	<input id="name" type="text" name="" value="" placeholder="SSC Groups">

				     	<label for="name">Hsc Result:</label>
				     	<input id="name" type="text" name="" value="" placeholder="Hsc Result">

				     	<label for="name">Hsc Years:</label>
				     	<input id="name" type="text" name="" value="" placeholder="Hsc Years">

				     	<label for="name">Hsc Groups:</label>
				     	<input id="name" type="text" name="" value="" placeholder="Hsc Groups">

				     	<label for="name">Bachelor Result:</label>
				     	<input id="name" type="text" name="" value="" placeholder="Bachelor Result">

				     	<label for="name">Bachelor Years:</label>
				     	<input id="name" type="text" name="" value="" placeholder="Bachelor Years">

				     	<label for="name">Bachelor Groups:</label>
				     	<input id="name" type="text" name="" value="" placeholder="Bachelor Groups">
				     </div>
				   </div>


				   <div id="Official">
				    <h2>Official Information:</h2>
				     <div class="info-sec">
				     	<label for="Dname">Designation</label>
				     	<input id="name" type="text" name="" value="" placeholder="Designation">

				     	<label for="name">Email</label>

				     	<input id="Ename" type="email" name="" value="" placeholder="employee email">

				     </div>
				    
				  </div>

				  
          </div>


  	    <?php
  	   }

  public function emplopyee_metabox_save($post_id){

  	 $name = $_POST['pdesig'];
  	 
  	 	
  	 update_post_meta($post_id,'employee_info', $name);
  	 
  }



}

$employee = new Employee();