<?php 

$universities = [];
$faculties = [];
$districts = [];

$db2= $this->load->database("db2",true);
$db2 = $db2->database;
$db3= $this->load->database("db3",true);
$db3 = $db3->database;
$db4 = $this->load->database("db4",true);
$db4 = $db4->database; 
$this->db->where('pref_userid',$this->session->userdata("myid"));
$qry = $this->db->get("$db2.user_search_preference");
if($qry->num_rows() > 0)
{
	$row = $qry->row();
	$university = json_decode($row->pref_university);
	$faculties = json_decode($row->pref_faculty);
	$districts = json_decode($row->pref_district,true);  
}
?>
<script type="text/javascript">
	function setPreference()
	{  
		$("#loading_icon").show();
		var form = document.preference;

		var dataString = $(form).serialize();


		$.ajax({
		    type:'POST',
		    url:'<?= base_url(); ?>preference/create',
		    data: dataString,
		    success: function(data){
			 	$("#loading_icon").hide();
		        $('#SuccessMsg').html(data); 
		    }
		});  
		return false;	
	}  
</script> 
<form name="preference"  action="" method="post" onsubmit="return setPreference();"> 
<div class="submitButton">
	<div class="content-box shadow bg-default">  
		<div class="row"> 
			<button type="submit" class="btn btn-info"><span class='fa fa-envelope'></span> Set</button>
			<button type="reset" class="btn btn-default"><span class='glyphicon glyphicon-remove'></span> Cancel</button>  
		</div>
		
	</div>
</div>
<div class="content-box shadow bg-default">  
	<div class="row">
		<h2>Faculty</h2>
		<?php  
			$this->db->order_by("Cfaculty_name ASC");
			$qryFaculty = $this->db->get("$db3.college_faculty");
			$getFaculty = $qryFaculty->result_array(); 
			foreach( $getFaculty as $faculty) { ?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<span class="remember-box checkbox">
					<input type="checkbox" value="<?= $faculty['Cfaculty_id'] ?>" name="faculty[]" <?php if (in_array($faculty['Cfaculty_id'], $faculties)) { echo "checked"; }?> >  <?= $faculty['Cfaculty_name'] ?>
				</span>
			</div> 

		<?php } ?> 
		
	</div>
</div>
<div class="content-box shadow bg-default">  
	<div class="row">
		<h2>University</h2>
		<?php 
			$this->db->from("$db3.college_universities cu");
			$this->db->join("$db4.university","university.Univ_id = cu.Clge_univ_university_id");
			$this->db->group_by("Clge_univ_university_id");
			$this->db->order_by("Univ_name ASC");
			$qryUniversity = $this->db->get();
			$getUniversity = $qryUniversity->result_array(); 
			foreach( $getUniversity as $university) { ?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<span class="remember-box checkbox"> 
					<input type="checkbox" name= "university[]" value="<?= $university['Univ_id'] ?>" <?php if (in_array($university['Univ_id'], $universities)) { echo "checked"; }?> > <?= $university['Univ_name'] ?>
				</span>
			</div> 

		<?php } ?> 
		
	</div>
</div>
<div class="content-box shadow bg-default">  
	<div class="row">
		<h2>District</h2>
		<?php  
			$this->db->order_by("Dist_name ASC");
			$qryDistrict = $this->db->get("$db2.district");
			$getDistrict = $qryDistrict->result_array(); 
			foreach( $getDistrict as $district) { ?>

			<div class="col-md-6 col-sm-6 col-xs-12">
				<span class="remember-box checkbox">
					<input type="checkbox" name= "district[]" value="<?= $district['Dist_id'] ?>"  <?php if (in_array($district['Dist_id'], $districts)) { echo "checked"; }?> > <?= $district['Dist_name'] ?>
				</span>
			</div> 

		<?php } ?> 
		
	</div>
</div>
</form>