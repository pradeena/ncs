<?php 
defined("BASEPATH") OR exit("No Direct Script Allowed");
if(!is_numeric($_GET["myid"]))
{
	redirect(base_url().'page_not_found');
} 
foreach($result_presonal_details as $row_presonal_details)
if($row_presonal_details["count"] < 1)
{
	redirect(base_url().'page_not_found');
}
else{
$tab=isset($_GET["tab"])?$_GET["tab"]:"personal";	
?> 
<script>
function ValidateAddUpdatemedical()
{
	var CEmedicalcondition_enquiryid=MedicalDetails.CEmedicalcondition_enquiryid.value;
	var CEmedicalcondition_bgid=MedicalDetails.CEmedicalcondition_bgid.value;
	var CEmedicalcondition_details=MedicalDetails.CEmedicalcondition_details.value;
	CEmedicalcondition_details=CEmedicalcondition_details.trim(); 
	if(MedicalDetails.CEmedicalcondition_bgid.selectedIndex==0)
	{
		document.getElementById("CEmedicalcondition_bgid").innerHTML="* Required";
		MedicalDetails.CEmedicalcondition_bgid.focus();
		return false;
	}
	if(MedicalDetails.CEmedicalcondition_bgid.selectedIndex!=0)
	{
		document.getElementById("CEmedicalcondition_bgid").innerHTML="";
	}
	if(CEmedicalcondition_details=="" || CEmedicalcondition_details==null)
	{
		document.getElementById("CEmedicalcondition_details").innerHTML="* Required";
		MedicalDetails.CEmedicalcondition_details.focus();
		return false;
	}
	if(CEmedicalcondition_details!="" || CEmedicalcondition_details!=null)
	{
		document.getElementById("CEmedicalcondition_details").innerHTML=""; 
		$("#loading_icon").show();
		$.post("<?php echo base_url(); ?>admission_form/AddUpdatemedicalAjax",{CEmedicalcondition_enquiryid:CEmedicalcondition_enquiryid,CEmedicalcondition_bgid:CEmedicalcondition_bgid,CEmedicalcondition_details:CEmedicalcondition_details},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
</script> 	
<script>
function ValidateAddUpdatepurpose()
{
	var CEpurpose_enquiryid=PurposeDetails.CEpurpose_enquiryid.value;
	var CEpurpose_details=PurposeDetails.CEpurpose_details.value;
	CEpurpose_details=CEpurpose_details.trim();
	if(CEpurpose_details=="" || CEpurpose_details==null)
	{
		document.getElementById("CEpurpose_details").innerHTML="* Required";
		PurposeDetails.CEpurpose_details.focus();
		return false;
	}	
	else
	{
		document.getElementById("CEpurpose_details").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url(); ?>admission_form/AddUpdatepurposeAjax",{CEpurpose_enquiryid:CEpurpose_enquiryid,CEpurpose_details:CEpurpose_details},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		}); 
	}		
}
</script> 
<script>
function ValidateAddUpdateActivity()
{
	var CEaward_enquiryid=ActivityDetails.CEaward_enquiryid.value;
	var CEaward_details=ActivityDetails.CEaward_details.value;
	CEaward_details=CEaward_details.trim(); 
	if(CEaward_details=="" || CEaward_details==null)
	{
		document.getElementById("CEaward_details").innerHTML="* Required";
		ActivityDetails.CEaward_details.focus();
		return false;
	}	
	else
	{
		document.getElementById("CEaward_details").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url(); ?>admission_form/AddUpdateactivityAjax",{CEaward_enquiryid:CEaward_enquiryid,CEaward_details:CEaward_details},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		}); 
	}	
}
</script>
<script>
/*----------------------------------------------------------------------------------------
Validate And Update Personal Details Of Student
-----------------------------------------------------------------------------------------*/
function Validate_personal_details()
{  
	var Cenq_fstname=Personal_details.Cenq_fstname.value;
	Cenq_fstname=Cenq_fstname.trim();
	var Cenq_lstname=Personal_details.Cenq_lstname.value;
	Cenq_lstname=Cenq_lstname.trim();
	var Cenq_dob_bs=Personal_details.Cenq_dob_bs.value;
	Cenq_dob_bs=Cenq_dob_bs.trim();
	var Cenq_dob_ad=Personal_details.Cenq_dob_ad.value;
	Cenq_dob_ad=Cenq_dob_ad.trim();
	var Cenq_gender=Personal_details.Cenq_gender.value;
	var Cenq_birth_place=Personal_details.Cenq_birth_place.value;
	Cenq_birth_place=Cenq_birth_place.trim();
	var Cenq_nationality=Personal_details.Cenq_nationality.value;
	Cenq_nationality=Cenq_nationality.trim();
	var Cenq_contactno=Personal_details.Cenq_contactno.value;
	Cenq_contactno=Cenq_contactno.trim();
	var Cenq_profilepic=Personal_details.Cenq_profilepic.value;
	Cenq_profilepic=Cenq_profilepic.trim();
	if(Cenq_fstname=="" || Cenq_fstname==null)
	{
		document.getElementById("Cenq_fstname").innerHTML="* Required";
		Personal_details.Cenq_fstname.focus();
		return false;
	}
	if(Cenq_fstname!="" || Cenq_fstname!=null)
	{
		document.getElementById("Cenq_fstname").innerHTML="";
	} 
	if(Cenq_lstname=="" || Cenq_lstname==null)
	{
		document.getElementById("Cenq_lstname").innerHTML="* Required";
		Personal_details.Cenq_lstname.focus();
		return false;
	}
	if(Cenq_lstname!="" || Cenq_lstname!=null)
	{
		document.getElementById("Cenq_lstname").innerHTML="";
	} 
	if(Cenq_dob_bs=="" || Cenq_dob_bs==null)
	{
		document.getElementById("Cenq_dob_bs").innerHTML="* Required";
		Personal_details.Cenq_dob_bs.focus();
		return false;
	}
	if(Cenq_dob_bs!="" || Cenq_dob_bs!=null)
	{
		document.getElementById("Cenq_dob_bs").innerHTML="";
	} 
	if(Cenq_dob_ad=="" || Cenq_dob_ad==null)
	{
		document.getElementById("Cenq_dob_ad").innerHTML="* Required";
		Personal_details.Cenq_dob_ad.focus();
		return false;
	}
	if(Cenq_dob_ad!="" || Cenq_dob_ad!=null)
	{
		document.getElementById("Cenq_dob_ad").innerHTML="";
	} 
	if(Cenq_birth_place=="" || Cenq_birth_place==null)
	{
		document.getElementById("Cenq_birth_place").innerHTML="* Required";
		Personal_details.Cenq_birth_place.focus();
		return false;
	}
	if(Cenq_birth_place!="" || Cenq_birth_place!=null)
	{
		document.getElementById("Cenq_birth_place").innerHTML="";
	}   
	if(Cenq_contactno=="" || Cenq_contactno==null)
	{
		document.getElementById("Cenq_contactno").innerHTML="* Required";
		Personal_details.Cenq_contactno.focus();
		return false;
	}
	if(isNaN(Cenq_contactno))
	{
		document.getElementById("Cenq_contactno").innerHTML="* Only Number Allowed";
		Personal_details.Cenq_contactno.focus();
		return false;
	}
	if(Cenq_contactno.length < 9)
	{
		document.getElementById("Cenq_contactno").innerHTML="* Contact Number Greater Than 8";
		Personal_details.Cenq_contactno.focus();
		return false;
	}
	if(Cenq_contactno!="" || Cenq_contactno!=null)
	{
		document.getElementById("Cenq_contactno").innerHTML=""; 
	} 
}
</script>
<script>
function AddReferenceAjax()
{
	var CEreferredby_enquiryid=Addreference.CEreferredby_enquiryid.value;
	var CEreferredby_name=Addreference.CEreferredby_name.value;
	CEreferredby_name=CEreferredby_name.trim();
	var CEreferredby_occupation=Addreference.CEreferredby_occupation.value;
	CEreferredby_occupation=CEreferredby_occupation.trim();
	var CEreferredby_organization=Addreference.CEreferredby_organization.value;
	CEreferredby_organization=CEreferredby_organization.trim();
	var CEreferredby_relation=Addreference.CEreferredby_relation.value;
	CEreferredby_relation=CEreferredby_relation.trim();
	var CEreferredby_address=Addreference.CEreferredby_address.value;
	CEreferredby_address=CEreferredby_address.trim();
	var CEreferredby_phoneno=Addreference.CEreferredby_phoneno.value;
	CEreferredby_phoneno=CEreferredby_phoneno.trim();
	var CEreferredby_mobileno=Addreference.CEreferredby_mobileno.value;
	CEreferredby_mobileno=CEreferredby_mobileno.trim();
	if(CEreferredby_name=="" || CEreferredby_name==null)
	{
		document.getElementById("CEreferredby_name").innerHTML="* Required";
		Addreference.CEreferredby_name.focus();
		return false;
	}
	if(CEreferredby_name!="" || CEreferredby_name!=null)
	{
		document.getElementById("CEreferredby_name").innerHTML="";
	}
	if(CEreferredby_occupation=="" || CEreferredby_occupation==null)
	{
		document.getElementById("CEreferredby_occupation").innerHTML="* Required";
		Addreference.CEreferredby_occupation.focus();
		return false;
	}
	if(CEreferredby_occupation!="" || CEreferredby_occupation!=null)
	{
		document.getElementById("CEreferredby_occupation").innerHTML="";
	}
	if(CEreferredby_organization=="" || CEreferredby_organization==null)
	{
		document.getElementById("CEreferredby_organization").innerHTML="* Required";
		Addreference.CEreferredby_organization.focus();
		return false;
	}
	if(CEreferredby_organization!="" || CEreferredby_organization!=null)
	{
		document.getElementById("CEreferredby_organization").innerHTML="";
	}
	if(CEreferredby_relation=="" || CEreferredby_relation==null)
	{
		document.getElementById("CEreferredby_relation").innerHTML="* Required";
		Addreference.CEreferredby_relation.focus();
		return false;
	}
	if(CEreferredby_relation!="" || CEreferredby_relation!=null)
	{
		document.getElementById("CEreferredby_relation").innerHTML="";
	}
	if(CEreferredby_address=="" || CEreferredby_address==null)
	{
		document.getElementById("CEreferredby_address").innerHTML="* Required";
		Addreference.CEreferredby_address.focus();
		return false;
	}
	if(CEreferredby_address!="" || CEreferredby_address!=null)
	{
		document.getElementById("CEreferredby_address").innerHTML="";
	}
	if(CEreferredby_phoneno!="")
	{
		if(isNaN(CEreferredby_phoneno))
		{
			document.getElementById("CEreferredby_phoneno").innerHTML="* Only Number Allowed";
			Addreference.CEreferredby_phoneno.focus();
			return false;
		}
		if(CEreferredby_phoneno.length < 9)
		{
			document.getElementById("CEreferredby_phoneno").innerHTML="* Contact Number Should be Greater Than 8";
			Addreference.CEreferredby_phoneno.focus();
			return false;
		}
		if(CEreferredby_phoneno.length > 8)
		{
			document.getElementById("CEreferredby_phoneno").innerHTML="";
		}
	}
	if(CEreferredby_mobileno=="" || CEreferredby_mobileno==null)
	{
		document.getElementById("CEreferredby_mobileno").innerHTML="* Required";
		Addreference.CEreferredby_mobileno.focus();
		return false;
	} 
	if(isNaN(CEreferredby_mobileno))
	{
		document.getElementById("CEreferredby_mobileno").innerHTML="* Only Number Allowed";
		Addreference.CEreferredby_mobileno.focus();
		return false;
	}
	if(CEreferredby_mobileno.length < 9)
	{
		document.getElementById("CEreferredby_mobileno").innerHTML="* Contact Number Greater Than 8";
		Addreference.CEreferredby_mobileno.focus();
		return false;
	}
	if(CEreferredby_mobileno!="" || CEreferredby_mobileno!=null)
	{ 
		document.getElementById("CEreferredby_mobileno").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/add_referenceAjax",{CEreferredby_enquiryid:CEreferredby_enquiryid,CEreferredby_name:CEreferredby_name,CEreferredby_occupation:CEreferredby_occupation,CEreferredby_relation,CEreferredby_organization:CEreferredby_organization,CEreferredby_address:CEreferredby_address,CEreferredby_phoneno:CEreferredby_phoneno,CEreferredby_mobileno:CEreferredby_mobileno},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
<?php $SrNo=1; foreach($result_list_all_refrences as $row_list_all_refrences){?>
function UpdateReferenceAjax_<?php echo $SrNo;?>()
{  
	var CEreferredby_id=Updatereference_<?php echo $SrNo;?>.CEreferredby_id.value;
	var CEreferredby_enquiryid=Updatereference_<?php echo $SrNo;?>.CEreferredby_enquiryid.value;
	var CEreferredby_name=Updatereference_<?php echo $SrNo;?>.CEreferredby_name.value;
	CEreferredby_name=CEreferredby_name.trim();
	var CEreferredby_occupation=Updatereference_<?php echo $SrNo;?>.CEreferredby_occupation.value;
	CEreferredby_occupation=CEreferredby_occupation.trim();
	var CEreferredby_organization=Updatereference_<?php echo $SrNo;?>.CEreferredby_organization.value;
	CEreferredby_organization=CEreferredby_organization.trim();
	var CEreferredby_relation=Updatereference_<?php echo $SrNo;?>.CEreferredby_relation.value;
	CEreferredby_relation=CEreferredby_relation.trim();
	var CEreferredby_address=Updatereference_<?php echo $SrNo;?>.CEreferredby_address.value;
	CEreferredby_address=CEreferredby_address.trim();
	var CEreferredby_phoneno=Updatereference_<?php echo $SrNo;?>.CEreferredby_phoneno.value;
	CEreferredby_phoneno=CEreferredby_phoneno.trim();
	var CEreferredby_mobileno=Updatereference_<?php echo $SrNo;?>.CEreferredby_mobileno.value;
	CEreferredby_mobileno=CEreferredby_mobileno.trim();
	if(CEreferredby_name=="" || CEreferredby_name==null)
	{
		document.getElementById("CEreferredby_name_<?php echo $SrNo;?>").innerHTML="* Required";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_name.focus();
		return false;
	}
	if(CEreferredby_name!="" || CEreferredby_name!=null)
	{
		document.getElementById("CEreferredby_name_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEreferredby_occupation=="" || CEreferredby_occupation==null)
	{
		document.getElementById("CEreferredby_occupation_<?php echo $SrNo;?>").innerHTML="* Required";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_occupation.focus();
		return false;
	}
	if(CEreferredby_occupation!="" || CEreferredby_occupation!=null)
	{
		document.getElementById("CEreferredby_occupation_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEreferredby_organization=="" || CEreferredby_organization==null)
	{
		document.getElementById("CEreferredby_organization_<?php echo $SrNo;?>").innerHTML="* Required";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_organization.focus();
		return false;
	}
	if(CEreferredby_organization!="" || CEreferredby_organization!=null)
	{
		document.getElementById("CEreferredby_organization_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEreferredby_relation=="" || CEreferredby_relation==null)
	{
		document.getElementById("CEreferredby_relation_<?php echo $SrNo;?>").innerHTML="* Required";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_relation.focus();
		return false;
	}
	if(CEreferredby_relation!="" || CEreferredby_relation!=null)
	{
		document.getElementById("CEreferredby_relation_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEreferredby_address=="" || CEreferredby_address==null)
	{
		document.getElementById("CEreferredby_address_<?php echo $SrNo;?>").innerHTML="* Required";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_address.focus();
		return false;
	}
	if(CEreferredby_address!="" || CEreferredby_address!=null)
	{
		document.getElementById("CEreferredby_address_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEreferredby_phoneno!="")
	{
		if(isNaN(CEreferredby_phoneno))
		{
			document.getElementById("CEreferredby_phoneno_<?php echo $SrNo;?>").innerHTML="* Only Number Allowed";
			Updatereference_<?php echo $SrNo;?>.CEreferredby_phoneno.focus();
			return false;
		}
		if(CEreferredby_phoneno.length < 9)
		{
			document.getElementById("CEreferredby_phoneno_<?php echo $SrNo;?>").innerHTML="* Contact Number Should be Greater Than 8";
			Updatereference_<?php echo $SrNo;?>.CEreferredby_phoneno.focus();
			return false;
		}
		if(CEreferredby_phoneno.length > 8)
		{
			document.getElementById("CEreferredby_phoneno_<?php echo $SrNo;?>").innerHTML="";
		}
	}
	if(CEreferredby_mobileno=="" || CEreferredby_mobileno==null)
	{
		document.getElementById("CEreferredby_mobileno_<?php echo $SrNo;?>").innerHTML="* Required";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_mobileno.focus();
		return false;
	} 
	if(isNaN(CEreferredby_mobileno))
	{
		document.getElementById("CEreferredby_mobileno_<?php echo $SrNo;?>").innerHTML="* Only Number Allowed";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_mobileno.focus();
		return false;
	}
	if(CEreferredby_mobileno.length < 9)
	{
		document.getElementById("CEreferredby_mobileno_<?php echo $SrNo;?>").innerHTML="* Contact Number Greater Than 8";
		Updatereference_<?php echo $SrNo;?>.CEreferredby_mobileno.focus();
		return false;
	}
	if(CEreferredby_mobileno!="" || CEreferredby_mobileno!=null)
	{ 
		document.getElementById("CEreferredby_mobileno_<?php echo $SrNo;?>").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/update_referenceAjax",{CEreferredby_id:CEreferredby_id,CEreferredby_enquiryid:CEreferredby_enquiryid,CEreferredby_name:CEreferredby_name,CEreferredby_occupation:CEreferredby_occupation,CEreferredby_relation,CEreferredby_organization:CEreferredby_organization,CEreferredby_address:CEreferredby_address,CEreferredby_phoneno:CEreferredby_phoneno,CEreferredby_mobileno:CEreferredby_mobileno},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
<?php $SrNo++; } ?>
</script>
<script>
function AddEmploymentAjax()
{
	var CEemployment_enquiryid=Addemployment.CEemployment_enquiryid.value;
	var CEemployment_organization=Addemployment.CEemployment_organization.value;
	CEemployment_organization=CEemployment_organization.trim();
	var CEemployment_address=Addemployment.CEemployment_address.value;
	CEemployment_address=CEemployment_address.trim();
	var CEemployment_contactno=Addemployment.CEemployment_contactno.value;
	CEemployment_contactno=CEemployment_contactno.trim();
	var CEemployment_designation=Addemployment.CEemployment_designation.value;
	CEemployment_designation=CEemployment_designation.trim();
	var CEemployment_keyrole=Addemployment.CEemployment_keyrole.value;
	CEemployment_keyrole=CEemployment_keyrole.trim();
	var CEemployment_duration=Addemployment.CEemployment_duration.value;
	CEemployment_duration=CEemployment_duration.trim();
	var CEemployment_fromyr=Addemployment.CEemployment_fromyr.value;
	CEemployment_fromyr=CEemployment_fromyr.trim();
	var CEemployment_toyr=Addemployment.CEemployment_toyr.value;
	CEemployment_toyr=CEemployment_toyr.trim();
	if(CEemployment_organization=="" || CEemployment_organization==null)
	{
		document.getElementById("CEemployment_organization").innerHTML="* Required";
		Addemployment.CEemployment_organization.focus();
		return false;
	}
	if(CEemployment_organization!="" || CEemployment_organization!=null)
	{
		document.getElementById("CEemployment_organization").innerHTML="";
	}
	if(CEemployment_address=="" || CEemployment_address==null)
	{
		document.getElementById("CEemployment_address").innerHTML="* Required";
		Addemployment.CEemployment_address.focus();
		return false;
	}
	if(CEemployment_address!="" || CEemployment_address!=null)
	{
		document.getElementById("CEemployment_address").innerHTML="";
	}
	if(CEemployment_contactno=="" || CEemployment_contactno==null)
	{
		document.getElementById("CEemployment_contactno").innerHTML="* Required";
		Addemployment.CEemployment_contactno.focus();
		return false;
	}
	if(isNaN(CEemployment_contactno))
	{
		document.getElementById("CEemployment_contactno").innerHTML="* Only Number Allowed";
		Addemployment.CEemployment_contactno.focus();
		return false;
	}
	if(CEemployment_contactno.length < 9)
	{
		document.getElementById("CEemployment_contactno").innerHTML="* Contact Number Greater Than 8";
		Addemployment.CEemployment_contactno.focus();
		return false;
	}
	if(CEemployment_contactno!="" || CEemployment_contactno!=null)
	{
		document.getElementById("CEemployment_contactno").innerHTML="";
	}
	if(CEemployment_designation=="" || CEemployment_designation==null)
	{
		document.getElementById("CEemployment_designation").innerHTML="* Required";
		Addemployment.CEemployment_designation.focus();
		return false;
	}
	if(CEemployment_designation!="" || CEemployment_designation!=null)
	{
		document.getElementById("CEemployment_designation").innerHTML="";
	}
	if(CEemployment_keyrole=="" || CEemployment_keyrole==null)
	{
		document.getElementById("CEemployment_keyrole").innerHTML="* Required";
		Addemployment.CEemployment_keyrole.focus();
		return false;
	}
	if(CEemployment_keyrole!="" || CEemployment_keyrole!=null)
	{
		document.getElementById("CEemployment_keyrole").innerHTML="";
	}
	if(CEemployment_duration=="" || CEemployment_duration==null)
	{
		document.getElementById("CEemployment_duration").innerHTML="* Required";
		Addemployment.CEemployment_duration.focus();
		return false;
	} 
	if(CEemployment_duration!="" || CEemployment_duration!=null)
	{
		document.getElementById("CEemployment_duration").innerHTML="";
	}
	if(CEemployment_fromyr=="" || CEemployment_fromyr==null)
	{
		document.getElementById("CEemployment_fromyr").innerHTML="* Required";
		Addemployment.CEemployment_fromyr.focus();
		return false;
	}
	if(CEemployment_fromyr!="" || CEemployment_fromyr!=null)
	{
		document.getElementById("CEemployment_fromyr").innerHTML="";
	}
	if(CEemployment_toyr=="" || CEemployment_toyr==null)
	{
		document.getElementById("CEemployment_toyr").innerHTML="* Required";
		Addemployment.CEemployment_toyr.focus();
		return false;
	}
	if(CEemployment_toyr!="" || CEemployment_toyr!=null)
	{
		document.getElementById("CEemployment_toyr").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/add_employmentAjax",{CEemployment_enquiryid:CEemployment_enquiryid,CEemployment_organization:CEemployment_organization,CEemployment_address:CEemployment_address,CEemployment_contactno:CEemployment_contactno,CEemployment_designation:CEemployment_designation,CEemployment_keyrole:CEemployment_keyrole,CEemployment_duration:CEemployment_duration,CEemployment_fromyr:CEemployment_fromyr,CEemployment_toyr:CEemployment_toyr},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
function AddUpdateTotalExpAjax()
{
	var CETWexperience_enquiryid=TotalExp.CETWexperience_enquiryid.value;
	var CETWexperience_total=TotalExp.CETWexperience_total.value;
	CETWexperience_total=CETWexperience_total.trim(); 
	if(CETWexperience_total=="" || CETWexperience_total==null)
	{
		document.getElementById("CETWexperience_total").innerHTML="* Required";
		TotalExp.CETWexperience_total.focus();
		return false;
	} 
	if(CETWexperience_total!="" || CETWexperience_total!=null)
	{
		document.getElementById("CETWexperience_total").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/AddUpdateTotalExpAjax",{CETWexperience_enquiryid:CETWexperience_enquiryid,CETWexperience_total:CETWexperience_total},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
<?php $SrNo=1; foreach($result_list_all_employment as $row_list_all_employment){?>
function UpdateEmploymentAjax_<?php echo $SrNo;?>()
{
	var CEemployment_enquiryid=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_enquiryid.value;
	var CEemployment_id=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_id.value;
	var CEemployment_organization=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_organization.value;
	CEemployment_organization=CEemployment_organization.trim();
	var CEemployment_address=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_address.value;
	CEemployment_address=CEemployment_address.trim();
	var CEemployment_contactno=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_contactno.value;
	CEemployment_contactno=CEemployment_contactno.trim();
	var CEemployment_designation=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_designation.value;
	CEemployment_designation=CEemployment_designation.trim();
	var CEemployment_keyrole=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_keyrole.value;
	CEemployment_keyrole=CEemployment_keyrole.trim();
	var CEemployment_duration=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_duration.value;
	CEemployment_duration=CEemployment_duration.trim();
	var CEemployment_fromyr=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_fromyr.value;
	CEemployment_fromyr=CEemployment_fromyr.trim();
	var CEemployment_toyr=UpdateEmployment_<?php echo $SrNo;?>.CEemployment_toyr.value;
	CEemployment_toyr=CEemployment_toyr.trim();
	if(CEemployment_organization=="" || CEemployment_organization==null)
	{
		document.getElementById("CEemployment_organization_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_organization.focus();
		return false;
	}
	if(CEemployment_organization!="" || CEemployment_organization!=null)
	{
		document.getElementById("CEemployment_organization_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEemployment_address=="" || CEemployment_address==null)
	{
		document.getElementById("CEemployment_address_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_address.focus();
		return false;
	}
	if(CEemployment_address!="" || CEemployment_address!=null)
	{
		document.getElementById("CEemployment_address_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEemployment_contactno=="" || CEemployment_contactno==null)
	{
		document.getElementById("CEemployment_contactno_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_contactno.focus();
		return false;
	}
	if(isNaN(CEemployment_contactno))
	{
		document.getElementById("CEemployment_contactno_<?php echo $SrNo;?>").innerHTML="* Only Number Allowed";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_contactno.focus();
		return false;
	}
	if(CEemployment_contactno.length < 9)
	{
		document.getElementById("CEemployment_contactno_<?php echo $SrNo;?>").innerHTML="* Contact Number Greater Than 8";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_contactno.focus();
		return false;
	}
	if(CEemployment_contactno!="" || CEemployment_contactno!=null)
	{
		document.getElementById("CEemployment_contactno_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEemployment_designation=="" || CEemployment_designation==null)
	{
		document.getElementById("CEemployment_designation_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_designation.focus();
		return false;
	}
	if(CEemployment_designation!="" || CEemployment_designation!=null)
	{
		document.getElementById("CEemployment_designation_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEemployment_keyrole=="" || CEemployment_keyrole==null)
	{
		document.getElementById("CEemployment_keyrole_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_keyrole.focus();
		return false;
	}
	if(CEemployment_keyrole!="" || CEemployment_keyrole!=null)
	{
		document.getElementById("CEemployment_keyrole_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEemployment_duration=="" || CEemployment_duration==null)
	{
		document.getElementById("CEemployment_duration_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_duration.focus();
		return false;
	} 
	if(CEemployment_duration!="" || CEemployment_duration!=null)
	{
		document.getElementById("CEemployment_duration_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEemployment_fromyr=="" || CEemployment_fromyr==null)
	{
		document.getElementById("CEemployment_fromyr_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_fromyr.focus();
		return false;
	}
	if(CEemployment_fromyr!="" || CEemployment_fromyr!=null)
	{
		document.getElementById("CEemployment_fromyr_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEemployment_toyr=="" || CEemployment_toyr==null)
	{
		document.getElementById("CEemployment_toyr_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateEmployment_<?php echo $SrNo;?>.CEemployment_toyr.focus();
		return false;
	}
	if(CEemployment_toyr!="" || CEemployment_toyr!=null)
	{ 
		document.getElementById("CEemployment_toyr_<?php echo $SrNo;?>").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/update_employmentAjax",{CEemployment_enquiryid:CEemployment_enquiryid,CEemployment_id:CEemployment_id,CEemployment_organization:CEemployment_organization,CEemployment_address:CEemployment_address,CEemployment_contactno:CEemployment_contactno,CEemployment_designation:CEemployment_designation,CEemployment_keyrole:CEemployment_keyrole,CEemployment_duration:CEemployment_duration,CEemployment_fromyr:CEemployment_fromyr,CEemployment_toyr:CEemployment_toyr},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
<?php $SrNo++; } ?>
</script>
<script>
function updatepreveductaion_first()
{
	var UPQ_id=UpdateEdu_first.UPQ_id.value;
	var UPQ_enquiryid=UpdateEdu_first.UPQ_enquiryid.value;
	var UPQ_prev_ctypeid=UpdateEdu_first.UPQ_prev_ctypeid.value;
	var UPQ_prev_course=UpdateEdu_first.UPQ_prev_course.value;
	UPQ_prev_course=UPQ_prev_course.trim();
	var UPQ_prev_clgename=UpdateEdu_first.UPQ_prev_clgename.value;
	UPQ_prev_clgename=UPQ_prev_clgename.trim();
	var UPQ_prev_clgeaddress=UpdateEdu_first.UPQ_prev_clgeaddress.value;
	UPQ_prev_clgeaddress=UPQ_prev_clgeaddress.trim();
	var UPQ_prev_clgeuniversity=UpdateEdu_first.UPQ_prev_clgeuniversity.value;
	UPQ_prev_clgeuniversity=UPQ_prev_clgeuniversity.trim();
	var UPQ_prev_yearofcompletion=UpdateEdu_first.UPQ_prev_yearofcompletion.value;
	var UPQ_prev_marks=UpdateEdu_first.UPQ_prev_marks.value;
	UPQ_prev_marks=UPQ_prev_marks.trim();
	if(UpdateEdu_first.UPQ_prev_ctypeid.selectedIndex==0)
	{
		document.getElementById("UPQ_prev_ctypeid1").innerHTML="*Required";
		UpdateEdu_first.UPQ_prev_ctypeid.focus();
		return false;
	}
	if(UpdateEdu_first.UPQ_prev_ctypeid.selectedIndex!=0)
	{
		document.getElementById("UPQ_prev_ctypeid1").innerHTML="";
	}
	if(UPQ_prev_course=='' || UPQ_prev_course==null)
	{
		document.getElementById("UPQ_prev_course1").innerHTML="*Required";
		UpdateEdu_first.UPQ_prev_course.focus();
		return false;
	}
	if(UPQ_prev_course!='' || UPQ_prev_course!=null)
	{
		document.getElementById("UPQ_prev_course1").innerHTML="";
	}
	if(UPQ_prev_clgename=='' || UPQ_prev_clgename==null)
	{
		document.getElementById("UPQ_prev_clgename1").innerHTML="*Required";
		UpdateEdu_first.UPQ_prev_clgename.focus();
		return false;
	}
	if(UPQ_prev_clgename!='' || UPQ_prev_clgename!=null)
	{
		document.getElementById("UPQ_prev_clgename1").innerHTML="";
	}
	if(UPQ_prev_clgeaddress=='' || UPQ_prev_clgeaddress==null)
	{
		document.getElementById("UPQ_prev_clgeaddress1").innerHTML="*Required";
		UpdateEdu_first.UPQ_prev_clgeaddress.focus();
		return false;
	}
	if(UPQ_prev_clgeaddress!='' || UPQ_prev_clgeaddress!=null)
	{
		document.getElementById("UPQ_prev_clgeaddress1").innerHTML="";
	}
	if(UPQ_prev_clgeuniversity=='' || UPQ_prev_clgeuniversity==null)
	{
		document.getElementById("UPQ_prev_clgeuniversity1").innerHTML="*Required";
		UpdateEdu_first.UPQ_prev_clgeuniversity.focus();
		return false;
	}
	if(UPQ_prev_clgeuniversity!='' || UPQ_prev_clgeuniversity!=null)
	{
		document.getElementById("UPQ_prev_clgeuniversity1").innerHTML="";
	}
	if(UpdateEdu_first.UPQ_prev_yearofcompletion.selectedIndex==0)
	{
		document.getElementById("UPQ_prev_yearofcompletion1").innerHTML="*Required";
		UpdateEdu_first.UPQ_prev_yearofcompletion.focus();
		return false;
	}
	if(UpdateEdu_first.UPQ_prev_yearofcompletion.selectedIndex!=0)
	{
		document.getElementById("UPQ_prev_yearofcompletion1").innerHTML="";
	}
	if(UPQ_prev_marks=='' || UPQ_prev_marks==null)
	{
		document.getElementById("UPQ_prev_marks1").innerHTML="*Required";
		UpdateEdu_first.UPQ_prev_marks.focus();
		return false;
	}
	if(UPQ_prev_marks!='' || UPQ_prev_marks!=null)
	{
		document.getElementById("UPQ_prev_marks1").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/updatepreveductaionAjax",{UPQ_id:UPQ_id,UPQ_enquiryid:UPQ_enquiryid,UPQ_prev_course:UPQ_prev_course,UPQ_prev_ctypeid:UPQ_prev_ctypeid,UPQ_prev_marks:UPQ_prev_marks,UPQ_prev_clgename:UPQ_prev_clgename,UPQ_prev_clgeaddress:UPQ_prev_clgeaddress,UPQ_prev_clgeuniversity:UPQ_prev_clgeuniversity,UPQ_prev_yearofcompletion:UPQ_prev_yearofcompletion},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
function Addpreveductaion()
{ 
	var UPQ_enquiryid=AddEdu.UPQ_enquiryid.value;
	var UPQ_prev_ctypeid=AddEdu.UPQ_prev_ctypeid.value;
	var UPQ_prev_course=AddEdu.UPQ_prev_course.value;
	UPQ_prev_course=UPQ_prev_course.trim();
	var UPQ_prev_clgename=AddEdu.UPQ_prev_clgename.value;
	UPQ_prev_clgename=UPQ_prev_clgename.trim();
	var UPQ_prev_clgeaddress=AddEdu.UPQ_prev_clgeaddress.value;
	UPQ_prev_clgeaddress=UPQ_prev_clgeaddress.trim();
	var UPQ_prev_clgeuniversity=AddEdu.UPQ_prev_clgeuniversity.value;
	UPQ_prev_clgeuniversity=UPQ_prev_clgeuniversity.trim();
	var UPQ_prev_yearofcompletion=AddEdu.UPQ_prev_yearofcompletion.value;
	var UPQ_prev_marks=AddEdu.UPQ_prev_marks.value;
	UPQ_prev_marks=UPQ_prev_marks.trim();
	if(AddEdu.UPQ_prev_ctypeid.selectedIndex==0)
	{
		document.getElementById("UPQ_prev_ctypeid").innerHTML="*Required";
		AddEdu.UPQ_prev_ctypeid.focus();
		return false;
	}
	if(AddEdu.UPQ_prev_ctypeid.selectedIndex!=0)
	{
		document.getElementById("UPQ_prev_ctypeid").innerHTML="";
	}
	if(UPQ_prev_course=='' || UPQ_prev_course==null)
	{
		document.getElementById("UPQ_prev_course").innerHTML="*Required";
		AddEdu.UPQ_prev_course.focus();
		return false;
	}
	if(UPQ_prev_course!='' || UPQ_prev_course!=null)
	{
		document.getElementById("UPQ_prev_course").innerHTML="";
	}
	if(UPQ_prev_clgename=='' || UPQ_prev_clgename==null)
	{
		document.getElementById("UPQ_prev_clgename").innerHTML="*Required";
		AddEdu.UPQ_prev_clgename.focus();
		return false;
	}
	if(UPQ_prev_clgename!='' || UPQ_prev_clgename!=null)
	{
		document.getElementById("UPQ_prev_clgename").innerHTML="";
	}
	if(UPQ_prev_clgeaddress=='' || UPQ_prev_clgeaddress==null)
	{
		document.getElementById("UPQ_prev_clgeaddress").innerHTML="*Required";
		AddEdu.UPQ_prev_clgeaddress.focus();
		return false;
	}
	if(UPQ_prev_clgeaddress!='' || UPQ_prev_clgeaddress!=null)
	{
		document.getElementById("UPQ_prev_clgeaddress").innerHTML="";
	}
	if(UPQ_prev_clgeuniversity=='' || UPQ_prev_clgeuniversity==null)
	{
		document.getElementById("UPQ_prev_clgeuniversity").innerHTML="*Required";
		AddEdu.UPQ_prev_clgeuniversity.focus();
		return false;
	}
	if(UPQ_prev_clgeuniversity!='' || UPQ_prev_clgeuniversity!=null)
	{
		document.getElementById("UPQ_prev_clgeuniversity").innerHTML="";
	}
	if(AddEdu.UPQ_prev_yearofcompletion.selectedIndex==0)
	{
		document.getElementById("UPQ_prev_yearofcompletion").innerHTML="*Required";
		AddEdu.UPQ_prev_yearofcompletion.focus();
		return false;
	}
	if(AddEdu.UPQ_prev_yearofcompletion.selectedIndex!=0)
	{
		document.getElementById("UPQ_prev_yearofcompletion").innerHTML="";
	}
	if(UPQ_prev_marks=='' || UPQ_prev_marks==null)
	{
		document.getElementById("UPQ_prev_marks").innerHTML="*Required";
		AddEdu.UPQ_prev_marks.focus();
		return false;
	}
	if(UPQ_prev_marks!='' || UPQ_prev_marks!=null)
	{
		document.getElementById("UPQ_prev_marks").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/AddpreveductaionAjax",{UPQ_enquiryid:UPQ_enquiryid,UPQ_prev_course:UPQ_prev_course,UPQ_prev_ctypeid:UPQ_prev_ctypeid,UPQ_prev_marks:UPQ_prev_marks,UPQ_prev_clgename:UPQ_prev_clgename,UPQ_prev_clgeaddress:UPQ_prev_clgeaddress,UPQ_prev_clgeuniversity:UPQ_prev_clgeuniversity,UPQ_prev_yearofcompletion:UPQ_prev_yearofcompletion},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}

<?php $SrNo=1; foreach($result_list_previouseducation as $row_list_previouseducation){?>
function updatepreveductaion_<?php echo $SrNo;?>()
{
	var UPQ_id=UpdateEdu_<?php echo $SrNo;?>.UPQ_id.value;
	var UPQ_enquiryid=UpdateEdu_<?php echo $SrNo;?>.UPQ_enquiryid.value;
	var UPQ_prev_ctypeid=UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_ctypeid.value;
	var UPQ_prev_course=UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_course.value;
	UPQ_prev_course=UPQ_prev_course.trim();
	var UPQ_prev_clgename=UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_clgename.value;
	UPQ_prev_clgename=UPQ_prev_clgename.trim();
	var UPQ_prev_clgeaddress=UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_clgeaddress.value;
	UPQ_prev_clgeaddress=UPQ_prev_clgeaddress.trim();
	var UPQ_prev_clgeuniversity=UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_clgeuniversity.value;
	UPQ_prev_clgeuniversity=UPQ_prev_clgeuniversity.trim();
	var UPQ_prev_yearofcompletion=UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_yearofcompletion.value;
	var UPQ_prev_marks=UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_marks.value;
	UPQ_prev_marks=UPQ_prev_marks.trim();
	if(UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_ctypeid.selectedIndex==0)
	{
		document.getElementById("UPQ_prev_ctypeid_<?php echo $SrNo;?>").innerHTML="*Required";
		UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_ctypeid.focus();
		return false;
	}
	if(UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_ctypeid.selectedIndex!=0)
	{
		document.getElementById("UPQ_prev_ctypeid_<?php echo $SrNo;?>").innerHTML="";
	}
	if(UPQ_prev_course=='' || UPQ_prev_course==null)
	{
		document.getElementById("UPQ_prev_course_<?php echo $SrNo;?>").innerHTML="*Required";
		UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_course.focus();
		return false;
	}
	if(UPQ_prev_course!='' || UPQ_prev_course!=null)
	{
		document.getElementById("UPQ_prev_course_<?php echo $SrNo;?>").innerHTML="";
	}
	if(UPQ_prev_clgename=='' || UPQ_prev_clgename==null)
	{
		document.getElementById("UPQ_prev_clgename_<?php echo $SrNo;?>").innerHTML="*Required";
		UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_clgename.focus();
		return false;
	}
	if(UPQ_prev_clgename!='' || UPQ_prev_clgename!=null)
	{
		document.getElementById("UPQ_prev_clgename_<?php echo $SrNo;?>").innerHTML="";
	}
	if(UPQ_prev_clgeaddress=='' || UPQ_prev_clgeaddress==null)
	{
		document.getElementById("UPQ_prev_clgeaddress_<?php echo $SrNo;?>").innerHTML="*Required";
		UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_clgeaddress.focus();
		return false;
	}
	if(UPQ_prev_clgeaddress!='' || UPQ_prev_clgeaddress!=null)
	{
		document.getElementById("UPQ_prev_clgeaddress_<?php echo $SrNo;?>").innerHTML="";
	}
	if(UPQ_prev_clgeuniversity=='' || UPQ_prev_clgeuniversity==null)
	{
		document.getElementById("UPQ_prev_clgeuniversity_<?php echo $SrNo;?>").innerHTML="*Required";
		UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_clgeuniversity.focus();
		return false;
	}
	if(UPQ_prev_clgeuniversity!='' || UPQ_prev_clgeuniversity!=null)
	{
		document.getElementById("UPQ_prev_clgeuniversity_<?php echo $SrNo;?>").innerHTML="";
	}
	if(UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_yearofcompletion.selectedIndex==0)
	{
		document.getElementById("UPQ_prev_yearofcompletion_<?php echo $SrNo;?>").innerHTML="*Required";
		UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_yearofcompletion.focus();
		return false;
	}
	if(UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_yearofcompletion.selectedIndex!=0)
	{
		document.getElementById("UPQ_prev_yearofcompletion_<?php echo $SrNo;?>").innerHTML="";
	}
	if(UPQ_prev_marks=='' || UPQ_prev_marks==null)
	{
		document.getElementById("UPQ_prev_marks_<?php echo $SrNo;?>").innerHTML="*Required";
		UpdateEdu_<?php echo $SrNo;?>.UPQ_prev_marks.focus();
		return false;
	}
	if(UPQ_prev_marks!='' || UPQ_prev_marks!=null)
	{
		document.getElementById("UPQ_prev_marks_<?php echo $SrNo;?>").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/updatepreveductaionAjax",{UPQ_id:UPQ_id,UPQ_enquiryid:UPQ_enquiryid,UPQ_prev_course:UPQ_prev_course,UPQ_prev_ctypeid:UPQ_prev_ctypeid,UPQ_prev_marks:UPQ_prev_marks,UPQ_prev_clgename:UPQ_prev_clgename,UPQ_prev_clgeaddress:UPQ_prev_clgeaddress,UPQ_prev_clgeuniversity:UPQ_prev_clgeuniversity,UPQ_prev_yearofcompletion:UPQ_prev_yearofcompletion},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
} 
<?php $SrNo++; } ?>
</script>
<script>
function validate_uploads_file()
{
	var UPQ_enquiryid=upload_files.UPQ_enquiryid.value;
	var UPQfiles_name=upload_files.UPQfiles_name.value;
	var UPQfiles_qualificationid=upload_files.UPQfiles_qualificationid.value;
	if(upload_files.UPQfiles_qualificationid.selectedIndex==0)
	{
		document.getElementById("UPQfiles_qualificationid").innerHTML="* Required";
		upload_files.UPQfiles_qualificationid.focus();
		return false;
	} 
	if(upload_files.UPQfiles_qualificationid.selectedIndex!=0)
	{
		document.getElementById("UPQfiles_qualificationid").innerHTML="";
	}	
	if(UPQfiles_name=='' || UPQfiles_name==null)
	{
		document.getElementById("UPQfiles_name").innerHTML="* Required";
		upload_files.UPQfiles_name.focus();
		return false;
	} 
	if(UPQfiles_name!='' || UPQfiles_name!=null)
	{
		document.getElementById("UPQfiles_name").innerHTML="";
	}
}
</script>
<script>
function AddfamilyAjax()
{
	var CEfamily_enquiryid=AddFamily.CEfamily_enquiryid.value;
	var CEfamily_familytypeid=AddFamily.CEfamily_familytypeid.value;
	var CEfamily_fstname=AddFamily.CEfamily_fstname.value;
	CEfamily_fstname=CEfamily_fstname.trim();
	var CEfamily_lstname=AddFamily.CEfamily_lstname.value;
	CEfamily_lstname=CEfamily_lstname.trim();
	var CEfamily_occupation=AddFamily.CEfamily_occupation.value;
	CEfamily_occupation=CEfamily_occupation.trim();
	var CEfamily_nationality=AddFamily.CEfamily_nationality.value;
	CEfamily_nationality=CEfamily_nationality.trim();
	var CEfamily_phoneno=AddFamily.CEfamily_phoneno.value;
	CEfamily_phoneno=CEfamily_phoneno.trim();
	var CEfamily_mobileno=AddFamily.CEfamily_mobileno.value;
	CEfamily_mobileno=CEfamily_mobileno.trim();
	if(AddFamily.CEfamily_familytypeid.selectedIndex==0)
	{
		document.getElementById("CEfamily_familytypeid").innerHTML="* Required";
		AddFamily.CEfamily_familytypeid.focus();
		return false;
	}
	if(AddFamily.CEfamily_familytypeid.selectedIndex!=0)
	{
		document.getElementById("CEfamily_familytypeid").innerHTML="";
	}
	if(CEfamily_fstname=="" || CEfamily_fstname==null)
	{
		document.getElementById("CEfamily_fstname").innerHTML="* Required";
		AddFamily.CEfamily_fstname.focus();
		return false;
	}
	if(CEfamily_fstname!="" || CEfamily_fstname!=null)
	{
		document.getElementById("CEfamily_fstname").innerHTML="";
	}
	if(CEfamily_lstname=="" || CEfamily_lstname==null)
	{
		document.getElementById("CEfamily_lstname").innerHTML="* Required";
		AddFamily.CEfamily_lstname.focus();
		return false;
	}
	if(CEfamily_lstname!="" || CEfamily_lstname!=null)
	{
		document.getElementById("CEfamily_lstname").innerHTML="";
	}
	if(CEfamily_occupation=="" || CEfamily_occupation==null)
	{
		document.getElementById("CEfamily_occupation").innerHTML="* Required";
		AddFamily.CEfamily_occupation.focus();
		return false;
	}
	if(CEfamily_occupation!="" || CEfamily_occupation!=null)
	{
		document.getElementById("CEfamily_occupation").innerHTML="";
	}
	if(CEfamily_nationality=="" || CEfamily_nationality==null)
	{
		document.getElementById("CEfamily_nationality").innerHTML="* Required";
		AddFamily.CEfamily_nationality.focus();
		return false;
	}
	if(CEfamily_nationality!="" || CEfamily_nationality!=null)
	{
		document.getElementById("CEfamily_nationality").innerHTML="";
	}
	if(CEfamily_phoneno!="")
	{
		if(isNaN(CEfamily_phoneno))
		{
			document.getElementById("CEfamily_phoneno").innerHTML="* Only Number Allowed";
			AddFamily.CEfamily_phoneno.focus();
			return false;
		}
		if(CEfamily_phoneno.length < 9)
		{
			document.getElementById("CEfamily_phoneno").innerHTML="* Contact Number Greater Than 8";
			AddFamily.CEfamily_phoneno.focus();
			return false;
		}
		if(CEfamily_phoneno!="" || CEfamily_phoneno!=null)
		{
			document.getElementById("CEfamily_phoneno").innerHTML="";
		}
	}
	if(CEfamily_mobileno=="" || CEfamily_mobileno==null)
	{
		document.getElementById("CEfamily_mobileno").innerHTML="* Required";
		AddFamily.CEfamily_mobileno.focus();
		return false;
	}
	if(isNaN(CEfamily_mobileno))
	{
		document.getElementById("CEfamily_mobileno").innerHTML="* Only Number Allowed";
		AddFamily.CEfamily_mobileno.focus();
		return false;
	}
	if(CEfamily_mobileno.length < 9)
	{
		document.getElementById("CEfamily_mobileno").innerHTML="* Contact Number Greater Than 8";
		AddFamily.CEfamily_mobileno.focus();
		return false;
	}
	if(CEfamily_mobileno!="" || CEfamily_mobileno!=null)
	{
		document.getElementById("CEfamily_mobileno").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/add_familyAjax",{CEfamily_enquiryid:CEfamily_enquiryid,CEfamily_familytypeid:CEfamily_familytypeid,CEfamily_fstname:CEfamily_fstname,CEfamily_lstname:CEfamily_lstname,CEfamily_occupation:CEfamily_occupation,CEfamily_nationality:CEfamily_nationality,CEfamily_phoneno:CEfamily_phoneno,CEfamily_mobileno:CEfamily_mobileno},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
<?php $SrNo=1; foreach($result_list_all_family as $row_list_all_family){?>
function UpdatefamilyAjax_<?php echo $SrNo;?>()
{
	var CEfamily_id=UpdateFamily_<?php echo $SrNo;?>.CEfamily_id.value;
	var CEfamily_enquiryid=UpdateFamily_<?php echo $SrNo;?>.CEfamily_enquiryid.value;
	var CEfamily_familytypeid=UpdateFamily_<?php echo $SrNo;?>.CEfamily_familytypeid.value;
	var CEfamily_fstname=UpdateFamily_<?php echo $SrNo;?>.CEfamily_fstname.value;
	CEfamily_fstname=CEfamily_fstname.trim();
	var CEfamily_lstname=UpdateFamily_<?php echo $SrNo;?>.CEfamily_lstname.value;
	CEfamily_lstname=CEfamily_lstname.trim();
	var CEfamily_occupation=UpdateFamily_<?php echo $SrNo;?>.CEfamily_occupation.value;
	CEfamily_occupation=CEfamily_occupation.trim();
	var CEfamily_nationality=UpdateFamily_<?php echo $SrNo;?>.CEfamily_nationality.value;
	CEfamily_nationality=CEfamily_nationality.trim();
	var CEfamily_phoneno=UpdateFamily_<?php echo $SrNo;?>.CEfamily_phoneno.value;
	CEfamily_phoneno=CEfamily_phoneno.trim();
	var CEfamily_mobileno=UpdateFamily_<?php echo $SrNo;?>.CEfamily_mobileno.value;
	CEfamily_mobileno=CEfamily_mobileno.trim();
	if(UpdateFamily_<?php echo $SrNo;?>.CEfamily_familytypeid.selectedIndex==0)
	{
		document.getElementById("CEfamily_familytypeid_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_familytypeid.focus();
		return false;
	}
	if(UpdateFamily_<?php echo $SrNo;?>.CEfamily_familytypeid.selectedIndex!=0)
	{
		document.getElementById("CEfamily_familytypeid_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEfamily_fstname=="" || CEfamily_fstname==null)
	{
		document.getElementById("CEfamily_fstname_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_fstname.focus();
		return false;
	}
	if(CEfamily_fstname!="" || CEfamily_fstname!=null)
	{
		document.getElementById("CEfamily_fstname_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEfamily_lstname=="" || CEfamily_lstname==null)
	{
		document.getElementById("CEfamily_lstname_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_lstname.focus();
		return false;
	}
	if(CEfamily_lstname!="" || CEfamily_lstname!=null)
	{
		document.getElementById("CEfamily_lstname_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEfamily_occupation=="" || CEfamily_occupation==null)
	{
		document.getElementById("CEfamily_occupation_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_occupation.focus();
		return false;
	}
	if(CEfamily_occupation!="" || CEfamily_occupation!=null)
	{
		document.getElementById("CEfamily_occupation_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEfamily_nationality=="" || CEfamily_nationality==null)
	{
		document.getElementById("CEfamily_nationality_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_nationality.focus();
		return false;
	}
	if(CEfamily_nationality!="" || CEfamily_nationality!=null)
	{
		document.getElementById("CEfamily_nationality_<?php echo $SrNo;?>").innerHTML="";
	}
	if(CEfamily_phoneno!="")
	{
		if(isNaN(CEfamily_phoneno))
		{
			document.getElementById("CEfamily_phoneno_<?php echo $SrNo;?>").innerHTML="* Only Number Allowed";
			UpdateFamily_<?php echo $SrNo;?>.CEfamily_phoneno.focus();
			return false;
		}
		if(CEfamily_phoneno.length < 9)
		{
			document.getElementById("CEfamily_phoneno_<?php echo $SrNo;?>").innerHTML="* Contact Number Greater Than 8";
			UpdateFamily_<?php echo $SrNo;?>.CEfamily_phoneno.focus();
			return false;
		}
		if(CEfamily_phoneno!="" || CEfamily_phoneno!=null)
		{
			document.getElementById("CEfamily_phoneno_<?php echo $SrNo;?>").innerHTML="";
		}
	}
	if(CEfamily_mobileno=="" || CEfamily_mobileno==null)
	{
		document.getElementById("CEfamily_mobileno_<?php echo $SrNo;?>").innerHTML="* Required";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_mobileno.focus();
		return false;
	}
	if(isNaN(CEfamily_mobileno))
	{
		document.getElementById("CEfamily_mobileno_<?php echo $SrNo;?>").innerHTML="* Only Number Allowed";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_mobileno.focus();
		return false;
	}
	if(CEfamily_mobileno.length < 9)
	{
		document.getElementById("CEfamily_mobileno_<?php echo $SrNo;?>").innerHTML="* Contact Number Greater Than 8";
		UpdateFamily_<?php echo $SrNo;?>.CEfamily_mobileno.focus();
		return false;
	}
	if(CEfamily_mobileno!="" || CEfamily_mobileno!=null)
	{
		document.getElementById("CEfamily_mobileno_<?php echo $SrNo;?>").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/update_familyAjax",{CEfamily_id:CEfamily_id,CEfamily_enquiryid:CEfamily_enquiryid,CEfamily_familytypeid:CEfamily_familytypeid,CEfamily_fstname:CEfamily_fstname,CEfamily_lstname:CEfamily_lstname,CEfamily_occupation:CEfamily_occupation,CEfamily_nationality:CEfamily_nationality,CEfamily_phoneno:CEfamily_phoneno,CEfamily_mobileno:CEfamily_mobileno},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
<?php $SrNo++; } ?>
</script>
<script>  
function AddUpdateCaddressAjax()
{ 
	var CEaddress_enquiryid=Cadd.CEaddress_enquiryid.value;
	var make_permanent=Cadd.make_permanent.value;
	var CEaddress_addresstypeid=Cadd.CEaddress_addresstypeid.value; 
	var CEaddress_town_village=Cadd.CEaddress_town_village.value; 
	CEaddress_town_village=CEaddress_town_village.trim(); 
	var CEaddress_country=Cadd.CEaddress_country.value; 
	CEaddress_country=CEaddress_country.trim();
	var CEaddress_zone=Cadd.CEaddress_zone.value;
	CEaddress_zone=CEaddress_zone.trim();	
	var CEaddress_district=Cadd.CEaddress_district.value;
	CEaddress_district=CEaddress_district.trim();	
	var CEaddress_wardno=Cadd.CEaddress_wardno.value; 
	CEaddress_wardno=CEaddress_wardno.trim(); 
	var CEaddress_houseno=Cadd.CEaddress_houseno.value; 
	CEaddress_houseno=CEaddress_houseno.trim();
	var CEaddress_phoneno=Cadd.CEaddress_phoneno.value; 
	CEaddress_phoneno=CEaddress_phoneno.trim();
	var CEaddress_mobileno=Cadd.CEaddress_mobileno.value; 
	CEaddress_mobileno=CEaddress_mobileno.trim();
	if(CEaddress_town_village=="" || CEaddress_town_village==null)
	{
		document.getElementById("CEaddress_town_village").innerHTML="* Required";
		Cadd.CEaddress_town_village.focus();
		return false;
	}
	if(CEaddress_town_village!="" || CEaddress_town_village!=null)
	{
		document.getElementById("CEaddress_town_village").innerHTML="";
	} 
	if(CEaddress_country=="" || CEaddress_country==null)
	{
		document.getElementById("CEaddress_country").innerHTML="* Required";
		Cadd.CEaddress_country.focus();
		return false;
	}
	if(CEaddress_country!="" || CEaddress_country!=null)
	{
		document.getElementById("CEaddress_country").innerHTML="";
	} 
	if(CEaddress_zone=="" || CEaddress_zone==null)
	{
		document.getElementById("CEaddress_zone").innerHTML="* Required";
		Cadd.CEaddress_zone.focus();
		return false;
	}
	if(CEaddress_zone!="" || CEaddress_zone!=null)
	{
		document.getElementById("CEaddress_zone").innerHTML="";
	} 
	if(CEaddress_district=="" || CEaddress_district==null)
	{
		document.getElementById("CEaddress_district").innerHTML="* Required";
		Cadd.CEaddress_district.focus();
		return false;
	}
	if(CEaddress_district!="" || CEaddress_district!=null)
	{
		document.getElementById("CEaddress_district").innerHTML="";
	} 
	if(CEaddress_wardno=="" || CEaddress_wardno==null)
	{
		document.getElementById("CEaddress_wardno").innerHTML="* Required";
		Cadd.CEaddress_wardno.focus();
		return false;
	}
	if(CEaddress_wardno!="" || CEaddress_wardno!=null)
	{
		document.getElementById("CEaddress_wardno").innerHTML="";
	}  
	if(CEaddress_phoneno!="")
	{
		if(isNaN(CEaddress_phoneno))
		{
			document.getElementById("CEaddress_phoneno").innerHTML="* Only Number Allowed";
			Cadd.CEaddress_phoneno.focus();
			return false;
		}
		if(CEaddress_phoneno.length < 9)
		{
			document.getElementById("CEaddress_phoneno").innerHTML="* Contact Number Greater Than 8";
			Cadd.CEaddress_phoneno.focus();
			return false;
		}
		if(CEaddress_phoneno!="" || CEaddress_phoneno!=null)
		{
			document.getElementById("CEaddress_phoneno").innerHTML="";
		}
	}
	if(CEaddress_mobileno=="" || CEaddress_mobileno==null)
	{
		document.getElementById("CEaddress_mobileno").innerHTML="* Required";
		Cadd.CEaddress_mobileno.focus();
		return false;
	}
	if(isNaN(CEaddress_mobileno))
	{
		document.getElementById("CEaddress_mobileno").innerHTML="* Only Number Allowed";
		Cadd.CEaddress_mobileno.focus();
		return false;
	}
	if(CEaddress_mobileno.length < 9)
	{
		document.getElementById("CEaddress_mobileno").innerHTML="* Contact Number Greater Than 8";
		Cadd.CEaddress_mobileno.focus();
		return false;
	}
	if(CEaddress_mobileno!="" || CEaddress_mobileno!=null)
	{
		document.getElementById("CEaddress_mobileno").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/addupdate_currentAddressAjax",{CEaddress_enquiryid:CEaddress_enquiryid,CEaddress_addresstypeid:CEaddress_addresstypeid,CEaddress_phoneno:CEaddress_phoneno,CEaddress_mobileno:CEaddress_mobileno,CEaddress_houseno:CEaddress_houseno,CEaddress_wardno:CEaddress_wardno,CEaddress_town_village:CEaddress_town_village,CEaddress_district:CEaddress_district,CEaddress_zone:CEaddress_zone,CEaddress_country:CEaddress_country,make_permanent:make_permanent},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
function AddUpdatePaddressAjax()
{
	var CEaddress_enquiryid=Padd.CEaddress_enquiryid.value; 
	var CEaddress_addresstypeid=Padd.CEaddress_addresstypeid.value; 
	var CEaddress_town_village=Padd.CEaddress_town_village.value; 
	CEaddress_town_village=CEaddress_town_village.trim(); 
	var CEaddress_country=Padd.CEaddress_country.value; 
	CEaddress_country=CEaddress_country.trim();
	var CEaddress_zone=Padd.CEaddress_zone.value;
	CEaddress_zone=CEaddress_zone.trim();	
	var CEaddress_district=Padd.CEaddress_district.value;
	CEaddress_district=CEaddress_district.trim();	
	var CEaddress_wardno=Padd.CEaddress_wardno.value; 
	CEaddress_wardno=CEaddress_wardno.trim(); 
	var CEaddress_houseno=Padd.CEaddress_houseno.value; 
	CEaddress_houseno=CEaddress_houseno.trim();
	var CEaddress_phoneno=Padd.CEaddress_phoneno.value; 
	CEaddress_phoneno=CEaddress_phoneno.trim();
	var CEaddress_mobileno=Padd.CEaddress_mobileno.value; 
	CEaddress_mobileno=CEaddress_mobileno.trim();
	if(CEaddress_town_village=="" || CEaddress_town_village==null)
	{
		document.getElementById("PCEaddress_town_village").innerHTML="* Required";
		Padd.CEaddress_town_village.focus();
		return false;
	}
	if(CEaddress_town_village!="" || CEaddress_town_village!=null)
	{
		document.getElementById("PCEaddress_town_village").innerHTML="";
	} 
	if(CEaddress_country=="" || CEaddress_country==null)
	{
		document.getElementById("PCEaddress_country").innerHTML="* Required";
		Padd.CEaddress_country.focus();
		return false;
	}
	if(CEaddress_country!="" || CEaddress_country!=null)
	{
		document.getElementById("PCEaddress_country").innerHTML="";
	} 
	if(CEaddress_zone=="" || CEaddress_zone==null)
	{
		document.getElementById("PCEaddress_zone").innerHTML="* Required";
		Padd.CEaddress_zone.focus();
		return false;
	}
	if(CEaddress_zone!="" || CEaddress_zone!=null)
	{
		document.getElementById("PCEaddress_zone").innerHTML="";
	} 
	if(CEaddress_district=="" || CEaddress_district==null)
	{
		document.getElementById("PCEaddress_district").innerHTML="* Required";
		Padd.CEaddress_district.focus();
		return false;
	}
	if(CEaddress_district!="" || CEaddress_district!=null)
	{
		document.getElementById("PCEaddress_district").innerHTML="";
	} 
	if(CEaddress_wardno=="" || CEaddress_wardno==null)
	{
		document.getElementById("PCEaddress_wardno").innerHTML="* Required";
		Padd.CEaddress_wardno.focus();
		return false;
	}
	if(CEaddress_wardno!="" || CEaddress_wardno!=null)
	{
		document.getElementById("PCEaddress_wardno").innerHTML="";
	}  
	if(CEaddress_phoneno!="")
	{
		if(isNaN(CEaddress_phoneno))
		{
			document.getElementById("PCEaddress_phoneno").innerHTML="* Only Number Allowed";
			Padd.CEaddress_phoneno.focus();
			return false;
		}
		if(CEaddress_phoneno.length < 9)
		{
			document.getElementById("PCEaddress_phoneno").innerHTML="* Contact Number Greater Than 8";
			Padd.CEaddress_phoneno.focus();
			return false;
		}
		if(CEaddress_phoneno!="" || CEaddress_phoneno!=null)
		{
			document.getElementById("PCEaddress_phoneno").innerHTML="";
		}
	}
	if(CEaddress_mobileno=="" || CEaddress_mobileno==null)
	{
		document.getElementById("PCEaddress_mobileno").innerHTML="* Required";
		Padd.CEaddress_mobileno.focus();
		return false;
	}
	if(isNaN(CEaddress_mobileno))
	{
		document.getElementById("PCEaddress_mobileno").innerHTML="* Only Number Allowed";
		Padd.CEaddress_mobileno.focus();
		return false;
	}
	if(CEaddress_mobileno.length < 9)
	{
		document.getElementById("PCEaddress_mobileno").innerHTML="* Contact Number Greater Than 8";
		Padd.CEaddress_mobileno.focus();
		return false;
	}
	if(CEaddress_mobileno!="" || CEaddress_mobileno!=null)
	{
		document.getElementById("PCEaddress_mobileno").innerHTML="";
		$("#loading_icon").show();
		$.post("<?php echo base_url();?>admission_form/addupdate_permanentAddressAjax",{CEaddress_enquiryid:CEaddress_enquiryid,CEaddress_addresstypeid:CEaddress_addresstypeid,CEaddress_phoneno:CEaddress_phoneno,CEaddress_mobileno:CEaddress_mobileno,CEaddress_houseno:CEaddress_houseno,CEaddress_wardno:CEaddress_wardno,CEaddress_town_village:CEaddress_town_village,CEaddress_district:CEaddress_district,CEaddress_zone:CEaddress_zone,CEaddress_country:CEaddress_country},function(data){
			$("#loading_icon").hide();
			$("#SuccessMsg").html(data);
		});
	}
}
</script>
<div class="content-wrapper"> 
		<section class="content-header"> 
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>enquiry">My Enquiry</a></li> 
				<li class="active">Fill Admission Form</li>
			</ol>
		</section>  <br/>
		<center>	
			<span id="loading_icon" style="display:none;font-size:25px">
				<div class="overlay">
					<i style="color:#DC143C" class="fa fa-refresh fa-spin"></i>
				</div>
			</span>
			<b><span id="SuccessMsg"></span><b/>
			<b><?php if(isset($msg)) echo $msg;?></b>
		</center>	
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs pull-right">
							<li <?php if($tab=="myform"){ ?>class="active" <?php }?>>
								<a href="#myform" data-toggle="tab"><b> My Form</b></a>
							</li> 
							<li <?php if($tab=="medical"){ ?>class="active" <?php }?>>
								<a href="#medical" data-toggle="tab"><b> Medical Details</b></a>
							</li> 
							<li <?php if($tab=="purpose"){ ?>class="active" <?php }?>>
								<a href="#purpose" data-toggle="tab"><b> Purpose</b></a>
							</li> 
							<li <?php if($tab=="activities"){ ?>class="active" <?php }?>>
								<a href="#activities" data-toggle="tab"><b> Award & Activities</b></a>
							</li> 
							<li <?php if($tab=="references"){ ?>class="active" <?php }?>>
								<a href="#references" data-toggle="tab"><b> References</b></a>
							</li> 
							<li <?php if($tab=="employment"){ ?>class="active" <?php }?>>
								<a href="#employment" data-toggle="tab"><b> Employment</b></a>
							</li> 
							<li <?php if($tab=="education"){ ?>class="active" <?php }?>>
								<a href="#education" data-toggle="tab"><b> Education</b></a>
							</li> 
							<li <?php if($tab=="family"){ ?>class="active" <?php }?>>
								<a href="#family" data-toggle="tab"><b> Family Details</b></a>
							</li> 
							<li <?php if($tab=="contact"){ ?>class="active" <?php }?>>
								<a href="#contact" data-toggle="tab"><b> Contact Details</b></a>
							</li> 
							<li <?php if($tab=="personal"){ ?>class="active" <?php }?>>
								<a href="#personal" data-toggle="tab"><b> Personal Details</b></a>
							</li>  
						</ul>
						<div class="tab-content">
							<div class="tab-pane  <?php if($tab=="myform"){ ?>active<?php }?>" id="myform">  
								<div class="box"> 
									<div class="box-body">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<?php foreach($result_presonal_details as $row_presonal_details) ?>
													<th style="background:lightgray;width:300px">Personal Details</th>
													<th>Name-<?php echo $row_presonal_details["Cenq_fstname"] ." ". $row_presonal_details["Cenq_lstname"].',Email-'.$row_presonal_details["Cenq_email"].',<br/>Contact-'.$row_presonal_details["Cenq_contactno"].',Gender-'.$row_presonal_details["Cenq_gender"].',Nationality-'.$row_presonal_details["Cenq_nationality"].',<br/> Place Of Birth-'.$row_presonal_details["Cenq_birth_place"].',DOB-'.$row_presonal_details["Cenq_dob_ad"].'/'.$row_presonal_details["Cenq_dob_bs"] ; ?></th>
												</tr>
												<tr>
													<?php 	foreach($result_list_all_currentAddress as $row_list_all_currentAddress) 
															foreach($result_list_all_permanentAddress as $row_list_all_permanentAddress) 
													?>
													<th style="background:lightgray;width:300px">Contect Details</th>
													<th>Current Address:-<br/>House No-<?php echo $row_list_all_currentAddress["CEaddress_houseno"].',Town/village-'.$row_list_all_currentAddress["CEaddress_town_village"] ." ,Dist-". $row_list_all_currentAddress["CEaddress_wardno"] ." ,Ward No-". $row_list_all_currentAddress["CEaddress_district"]." ,<br/>zone-". $row_list_all_currentAddress["CEaddress_zone"]." ,Country-". $row_list_all_currentAddress["CEaddress_country"]; ?><br/>
													<hr/>
													Permanent Address:-<br/>House No-<?php echo $row_list_all_permanentAddress["CEaddress_houseno"].',Town/village-'.$row_list_all_permanentAddress["CEaddress_town_village"] ." ,Dist-". $row_list_all_permanentAddress["CEaddress_wardno"] ." ,Ward No-". $row_list_all_permanentAddress["CEaddress_district"]." ,<br/>zone-". $row_list_all_permanentAddress["CEaddress_zone"]." ,Country-". $row_list_all_permanentAddress["CEaddress_country"]; ?></th>
												</tr>
												<tr>
													<?php 
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;  
														$this->db->select("*");
														$this->db->from("$db8.college_enquiry_family");
														$this->db->join("$db8.college_enquiry_familytype",'college_enquiry_familytype.CEFtype_id=college_enquiry_family.CEfamily_familytypeid','left');
														$this->db->where("CEfamily_enquiryid",$this->input->get("myid"));
														$result_family=$this->db->get();
														$result_family_details=$result_family->result_array();
													?>
													<th style="background:lightgray;width:300px;">Family Details</th>
													<th><?php
													foreach($result_family_details as $row_family_details) 
													{
														if($row_family_details["CEfamily_familytypeid"])
														{
														?>
															<?php echo $row_family_details["CEFtype_name"].''. " " ; ?>Details:-<br/><?php echo $row_family_details["CEFtype_name"].' '."Name-" ; ?><?php echo $row_family_details["CEfamily_fstname"] ." ". $row_family_details["CEfamily_lstname"].",Ocupation- ". $row_family_details["CEfamily_occupation"].",<br/>Nationality- ". $row_family_details["CEfamily_nationality"].",Phone NO- ". $row_family_details["CEfamily_phoneno"].",<br/>Phone NO- ". $row_family_details["CEfamily_mobileno"]; ?><hr/>
												<?php	}	
													} 
												?>
													</th>
												</tr>
												<tr>
													<?php 
														$db4=$this->load->database("db4",true);
														$db4=$db4->database;  
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;  
														$this->db->select("*");
														$this->db->from("$db8.users_previous_qualification");
														$this->db->join("$db4.courses_type",'courses_type.Course_type_id=users_previous_qualification.UPQ_prev_ctypeid','left');
														$this->db->where("UPQ_enquiryid",$this->input->get("myid"));
														$result_eduction=$this->db->get();
														$result_education_details=$result_eduction->result_array();
													?>
													<th style="background:lightgray;width:300px;">Education Details</th>
													<th><?php
													foreach($result_education_details as $row_education_details) 
													{
														if($row_education_details["UPQ_prev_ctypeid"])
														{
														?>
															<?php echo $row_education_details["Course_type_name"] .''. " " ; ?>Details:-<br/><?php echo "Program".'-'.$row_education_details["UPQ_prev_course"] .",College Name- ". $row_education_details["UPQ_prev_clgename"].",<br/>Address- ". $row_education_details["UPQ_prev_clgeaddress"].",<br/>University- ". $row_education_details["UPQ_prev_clgeuniversity"].",Marks- ". $row_education_details["UPQ_prev_marks"].",<br/>Year Of Completion- ". $row_education_details["UPQ_prev_yearofcompletion"]; ?><hr/>
												<?php	}	
													} 
												?>
													</th>
												</tr>
												<tr>
													<?php  
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;  
														$this->db->select("*");
														$this->db->from("$db8. college_enquiry_employment");
														$this->db->where("CEemployment_enquiryid",$this->input->get("myid"));
														$result_employment=$this->db->get();
														$result_employment_details=$result_employment->result_array();
													?>
													<th style="background:lightgray;width:300px;">Employment Details</th>
													<th><?php
													foreach($result_employment_details as $row_employment_details) 
													{
														?>
															<?php echo "Organization ".'-'.$row_employment_details["CEemployment_organization"] .",Address- ". $row_employment_details["CEemployment_address"].",<br/>Contact- ". $row_employment_details["CEemployment_contactno"].",<br/>Designation- ". $row_employment_details["CEemployment_designation"].",Key Role- ". $row_employment_details["CEemployment_keyrole"].",<br/>Employment Duration- ". $row_employment_details["CEemployment_duration"].",<br/>Duration- (". $row_employment_details["CEemployment_fromyr"].') To ('.$row_employment_details["CEemployment_toyr"].''. ")"; ?><hr/>
												<?php	
													} 
												?>
													</th>
												</tr>
												<tr>
													<?php  
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;  
														$this->db->select("*");
														$this->db->from("$db8. college_enquiry_referredby");
														$this->db->where("CEreferredby_enquiryid",$this->input->get("myid"));
														$result_references=$this->db->get();
														$result_reference_details=$result_references->result_array();
													?>
													<th style="background:lightgray;width:300px;">References Detail</th>
													<th><?php
													foreach($result_reference_details as $row_reference_details) 
													{
														?>
															<?php echo $row_reference_details["CEreferredby_name"].",Organization- ".$row_reference_details["CEreferredby_organization"] .",Occupation- ". $row_reference_details["CEreferredby_occupation"].",<br/>Relation- ". $row_reference_details["CEreferredby_relation"].",Address- ". $row_reference_details["CEreferredby_address"].",<br/>Phone No- ". $row_reference_details["CEreferredby_phoneno"].",Mobile- ". $row_reference_details["CEreferredby_mobileno"]; ?><hr/>
												<?php	
													} 
												?>
													</th>
												</tr>
												<tr>
													<?php  
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;  
														$this->db->select("*");
														$this->db->from("$db8. college_enquiry_award&achievement");
														$this->db->where("CEaward_enquiryid",$this->input->get("myid"));
														$result_awards=$this->db->get();
														$result_awards_details=$result_awards->result_array();
													?>
													<th style="background:lightgray;width:300px;">Awards And Activities 	</th>
													<th><?php
													foreach($result_awards_details as $row_awards_details) 
													{
														?>
															<?php echo $row_awards_details["CEaward_details"]; ?>
												<?php	
													} 
												?>
													</th>
												</tr>
												<tr>
													<?php  
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;  
														$this->db->select("*");
														$this->db->from("$db8.college_enquiry_purpose");
														$this->db->where("CEpurpose_enquiryid",$this->input->get("myid"));
														$result_purpose=$this->db->get();
														$result_purpose_details=$result_purpose->result_array();
													?>
													<th style="background:lightgray;width:300px;">Purpose	</th>
													<th><?php
													foreach($result_purpose_details as $row_purpose_details) 
													{
														?>
															<?php echo $row_purpose_details["CEpurpose_details"]; ?>
												<?php	
													} 
												?>
													</th>
												</tr>
												<tr>
													<?php  
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;  
														$this->db->select("*");
														$this->db->from("$db8.college_enquiry_medicalcondition");
														$this->db->join("$db8.college_enquiry_bloodgroup",'college_enquiry_bloodgroup.CEbloodgroup_id=college_enquiry_medicalcondition.CEmedicalcondition_bgid','left');
														$this->db->where("CEmedicalcondition_enquiryid",$this->input->get("myid"));
														$result_medical_condition=$this->db->get();
														$result_medical_condition_details=$result_medical_condition->result_array();
													?>
													<th style="background:lightgray;width:300px;">Medical Condition</th>
													<th><?php
													foreach($result_medical_condition_details as $row_medical_condition_details) 
													{
														?>
															<?php echo "Blood Group".'-'.$row_medical_condition_details["CEbloodgroup_bloodgroup"].'<br/>Medical Status-'.$row_medical_condition_details["CEmedicalcondition_details"]; ?>
												<?php	
													} 
												?>
													</th>
												</tr>
											</thead> 
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>
							<div class="tab-pane  <?php if($tab=="medical"){ ?>active<?php }?>" id="medical">  
								<div class="box"> 
									<?php 
										foreach($result_medical_details as $row_medical_details)
										if($row_medical_details["count"] > 0)
										{
											$CEmedicalcondition_bgid=$row_medical_details["CEmedicalcondition_bgid"]; 
											$CEmedicalcondition_details=$row_medical_details["CEmedicalcondition_details"]; 
										}
										else
										{
											$CEmedicalcondition_bgid=$this->input->post("CEmedicalcondition_bgid"); 
											$CEmedicalcondition_details=$this->input->post("CEmedicalcondition_details"); 
										}
									?>
									<div class="box-body"> 
										<table class="table table-bordered table-striped">	
											<form  name="MedicalDetails" method="post" action="" enctype="multipart/form-data"> 
												<input type="hidden" name="CEmedicalcondition_enquiryid" value="<?php echo $this->input->get("myid");?>">
												<div class="col-xs-6">	
													<label><h3>Medical Details</h3></label>
															<div class="box-body"> 
																<div class="form-group">
																	<label>Blood Group*</label>
																	<select  name="CEmedicalcondition_bgid" class="form-control select1">
																		<option selected="selected">Select </option>
																	<?php 
																		$db8=$this->load->database("db8",true);
																		$db8=$db8->database;
																		$query_bloodgroup=$this->db->get("$db8.college_enquiry_bloodgroup");
																		$result_bloodgroup=$query_bloodgroup->result_array();
																		foreach($result_bloodgroup as $row_blood_group)
																	{?>
																		<option value="<?php echo $row_blood_group["CEbloodgroup_id"]; ?>" <?php if($row_blood_group["CEbloodgroup_id"]==$CEmedicalcondition_bgid) echo "selected"; ?>>
																	<?php echo $row_blood_group["CEbloodgroup_bloodgroup"]; ?>
																		</option>
																	<?php } ?> 
																	</select>
																	<b><span style="color:red" id="CEmedicalcondition_bgid"></span></b>
																</div>
																<div class="form-group">
																	<label>Madical Condition Details*</label>
																	<textarea  rows="15" cols="50" class="form-control"  name="CEmedicalcondition_details" value="<?php echo $CEmedicalcondition_details; ?>"><?php echo $CEmedicalcondition_details; ?></textarea>
																	<b><span style="color:red" id="CEmedicalcondition_details"></span></b>
																</div> 
																<div class="box-footer">
																	<button type="button" class="btn btn-primary" onclick="return ValidateAddUpdatemedical()" ><i class="fa fa-save"> save</i></button>
																	<button type="reset" class="btn btn-success"> Reset</button>
																</div><!-- /.box-body -->
															</div><!--/.box body --> 
												</div>
											</form>
										</table>  
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>
							<div class="tab-pane  <?php if($tab=="purpose"){ ?>active<?php }?>" id="purpose">  
								<div class="box"> <!-- /.box-header -->  
									<?php 
										foreach($result_purpose_details as $row_purpose_details)
										if($row_medical_details["count"] > 0)
										{
											$CEpurpose_details=$row_purpose_details["CEpurpose_details"];   
										}
										else
										{
											$CEpurpose_details=$this->input->post("CEpurpose_details");   
										}
									?>
									<div class="box-body">
										<table class="table table-bordered table-striped">		
											<form  name="PurposeDetails" method="post" action="" enctype="multipart/form-data" onsubmit="return paymentValidate()"> 
											<input type="hidden" name="CEpurpose_enquiryid" value="<?php echo $this->input->get("myid");?>">
												<div class="col-xs-6">	
													<label><h3>Statement of Purpose</h3></label>
													<div class="box-body"> 
														<div class="form-group">
															<label>Statement of Purpose*</label>
															<textarea  rows="15" cols="30" class="form-control" name="CEpurpose_details" placeholder="Put Your Total Certificate Name" value="<?php echo $CEpurpose_details; ?>"><?php echo $CEpurpose_details; ?></textarea>
															<b><span style="color:red" id="CEpurpose_details"></span></b>
														</div> 
														<div class="box-footer">
														<button type="button"  name="submit" class="btn btn-primary" onclick="return ValidateAddUpdatepurpose()" ><i class="fa fa-save"> save</i></button>
														<button type="reset" class="btn btn-info">Cancel</button>
														</div><!-- /.box-body -->
													</div><!--/.box body --> 
												</div> 
											</form>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
							<div class="tab-pane  <?php if($tab=="activities"){ ?>active<?php }?>" id="activities">  
								<div class="box"> <!-- /.box-header -->
									<?php 
										foreach($result_activities_details as $row_activities_details)
										if($row_activities_details["count"] > 0)
										{
											$CEaward_details=$row_activities_details["CEaward_details"];   
										}
										else
										{
											$CEaward_details=$this->input->post("CEaward_details");   
										}
									?>
									<div class="box-body">
										<table class="table table-bordered table-striped">		
											<form  name="ActivityDetails" method="post" action="" enctype="multipart/form-data">
												<input type="hidden" name="CEaward_enquiryid" value="<?php echo $this->input->get("myid");?>"> 
												<div class="col-xs-6">		
													<label><h3>EXTRA/CO-CURRICULAR ACTIVITIES & AWARDS</h3></label>
													<div class="box-body"> 
														<div class="form-group">
															<label>Activities & Awards</label>
															<textarea  rows="15" cols="50" class="form-control" name="CEaward_details" placeholder="Put Your All Details About Activities" value="<?php echo $CEaward_details;?>"><?php echo $CEaward_details;?></textarea>
															<b><span style="color:red" id="CEaward_details"></span></b>
														</div> 
														<div class="box-footer">
														<button type="button"  class="btn btn-primary" onclick="return ValidateAddUpdateActivity();"><i class="fa fa-save"> Save</i></button>
														<button type="reset" class="btn btn-info">Cancel</button>
														</div><!-- /.box-body -->
													</div><!--/.box body --> 
												</div>
											</form>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
							<div class="tab-pane  <?php if($tab=="references"){ ?>active<?php }?>" id="references">  
								<div class="box"> <!-- /.box-header -->
									<div class="box-body">
										<table class="table table-bordered table-striped">
												<div class="col-xs-6">			
													<form  name="Addreference" method="post" action="" enctype="multipart/form-data">
													<input type="hidden" name="CEreferredby_enquiryid" value="<?php echo $this->input->get("myid");?>">  
													<label><h3>References</h3></label>
													<div class="box-body">	
														<div class="form-group">
															<label>Referee Name*</label>
															<input type="text" class="form-control" name="CEreferredby_name" placeholder="Enter Refree Name" value="<?php echo $this->input->post("CEreferredby_name"); ?>">
															<b><span style="color:red" id="CEreferredby_name"></span></b>
														</div> 
														<div class="form-group">
															<label>Occupation*</label>
															<input type="text" class="form-control" name="CEreferredby_occupation" placeholder="Refree Occupation" value="<?php echo $this->input->post("CEreferredby_occupation"); ?>">
															<b><span style="color:red" id="CEreferredby_occupation"></span></b>
														</div> 
														<div class="form-group">
															<label>Organization*</label>
															<input type="text" class="form-control" placeholder="Refree Occupation" name="CEreferredby_organization"  value="<?php echo $this->input->post("CEreferredby_organization");?>">
															<b><span style="color:red" id="CEreferredby_organization"></span></b>
														</div>
														<div class="form-group">
															<label>Relation*</label>
															<input type="text" class="form-control" placeholder="Refree Relation" name="CEreferredby_relation"  value="<?php echo $this->input->post("CEreferredby_relation");?>">
															<b><span style="color:red" id="CEreferredby_relation"></span></b>
														</div>
														<div class="form-group">
															<label>Address*</label>
															<textarea type="text" class="form-control" placeholder="Refree Address" name="CEreferredby_address"  value="<?php echo $this->input->post("CEreferredby_address");?>"><?php echo $this->input->post("CEreferredby_address");?></textarea>
															<b><span style="color:red" id="CEreferredby_address"></span></b>
														</div>
														<div class="form-group">
															<label>Phone No</label>
															<input type="text" class="form-control" placeholder="Refree Phone Number" name="CEreferredby_phoneno"  value="<?php echo $this->input->post("CEreferredby_phoneno");?>"> 
															<b><span style="color:red" id="CEreferredby_phoneno"></span></b>
														</div> 
														<div class="form-group">
															<label>Mobile*</label>
															<input type="text" class="form-control" placeholder="Refree Mobile Number" name="CEreferredby_mobileno"  value="<?php echo $this->input->post("CEreferredby_mobileno");?>">
															<b><span style="color:red" id="CEreferredby_mobileno"></span></b>
														</div> 
														<div class="box-footer">
														<button type="button"  name="submit" class="btn btn-primary" onclick="return AddReferenceAjax();"><i class="fa fa-save"> Save</i></button>
														<button type="reset" class="btn btn-info">Cancel</button>
														</div><!-- /.box-body -->
													</div><!--/.box body --> 
													</form>
												</div>
												<div  class="col-xs-6">
													<label><h3>List All References</h3></label> 
												<?php $SrNo=1; foreach($result_list_all_refrences as $row_list_all_refrences){?>	
													<div class="box box-default collapsed-box">
														<div class="box-header with-border" data-widget="collapse">
															<h3 class="box-title">References<?php echo $SrNo;?></h3>
															<div class="box-tools pull-right">
																<button class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
															</div><!-- /.box-tools -->
														</div><!-- /.box-header -->
														<div class="box-body">
															<form  name="Updatereference_<?php echo $SrNo;?>" method="post" action="" enctype="multipart/form-data">
																<input type="hidden" name="CEreferredby_id" value="<?php echo $row_list_all_refrences["CEreferredby_id"]; ?>"> 
																<input type="hidden" name="CEreferredby_enquiryid" value="<?php echo $this->input->get("myid");?>">   
																<div class="box-body">	
																	<div class="form-group">
																		<label>Referee Name*</label>
																		<input type="text" class="form-control" name="CEreferredby_name" placeholder="Enter Refree Name" value="<?php echo $row_list_all_refrences["CEreferredby_name"]; ?>">
																		<b><span style="color:red" id="CEreferredby_name_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="form-group">
																		<label>Occupation*</label>
																		<input type="text" class="form-control" name="CEreferredby_occupation" placeholder="Refree Occupation" value="<?php echo $row_list_all_refrences["CEreferredby_occupation"]; ?>">
																		<b><span style="color:red" id="CEreferredby_occupation_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="form-group">
																		<label>Organization*</label>
																		<input type="text" class="form-control" placeholder="Refree Occupation" name="CEreferredby_organization"  value="<?php echo $row_list_all_refrences["CEreferredby_organization"];?>">
																		<b><span style="color:red" id="CEreferredby_organization_<?php echo $SrNo;?>"></span></b>
																	</div>
																	<div class="form-group">
																		<label>Relation*</label>
																		<input type="text" class="form-control" placeholder="Refree Relation" name="CEreferredby_relation"  value="<?php echo $row_list_all_refrences["CEreferredby_relation"];?>">
																		<b><span style="color:red" id="CEreferredby_relation_<?php echo $SrNo;?>"></span></b>
																	</div>
																	<div class="form-group">
																		<label>Address*</label>
																		<textarea type="text" class="form-control" placeholder="Refree Address" name="CEreferredby_address"  value="<?php echo $row_list_all_refrences["CEreferredby_address"];?>"><?php echo $row_list_all_refrences["CEreferredby_address"];?></textarea>
																		<b><span style="color:red" id="CEreferredby_address_<?php echo $SrNo;?>"></span></b>
																	</div>
																	<div class="form-group">
																		<label>Phone No</label>
																		<input type="text" class="form-control" placeholder="Refree Phone Number" name="CEreferredby_phoneno"  value="<?php echo $row_list_all_refrences["CEreferredby_phoneno"];?>"> 
																		<b><span style="color:red" id="CEreferredby_phoneno_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="form-group">
																		<label>Mobile*</label>
																		<input type="text" class="form-control" placeholder="Refree Mobile Number" name="CEreferredby_mobileno"  value="<?php echo $row_list_all_refrences["CEreferredby_mobileno"];?>">
																		<b><span style="color:red" id="CEreferredby_mobileno_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="box-footer">
																		<button type="button"  name="submit" class="btn btn-primary" onclick="return UpdateReferenceAjax_<?php echo $SrNo;?>();"><i class="fa fa-save"> Update</i></button>
																		<button type="reset" class="btn btn-info">Cancel</button>
																	</div><!-- /.box-body -->
																</div><!--/.box body --> 
															</form>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												<?php  $SrNo++; }?>	
												</div>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>  
							<div class="tab-pane  <?php if($tab=="employment"){ ?>active<?php }?>" id="employment">  
								<div class="box"> <!-- /.box-header --> 
									<div class="box-body">
										<table class="table table-bordered table-striped">	
												<div class="col-xs-6">		
													<form  name="Addemployment" method="post" action="" enctype="multipart/form-data"> 
														<input type="hidden" name="CEemployment_enquiryid" value="<?php echo $this->input->get("myid");?>">
													<label><h3>Work Experience </h3></label>
													<div class="box-body">	
														<div class="form-group">
															<label>Organization*</label>
															<input type="text" class="form-control" name="CEemployment_organization" placeholder="Enter Organization" value="<?php echo $this->input->post("CEemployment_organization"); ?>">
															<b><span style="color:red" id="CEemployment_organization"></span></b>
														</div> 
														<div class="form-group">
															<label>Address*</label>
															<textarea  rows="4" cols="50" class="form-control" name="CEemployment_address" placeholder="Enter Address" value="<?php echo $this->input->post("CEemployment_address");?>"><?php echo $this->input->post("CEemployment_address");?></textarea>
															<b><span style="color:red" id="CEemployment_address"></span></b>
														</div> 
														<div class="form-group">
															<label>Telephone/Mobile*</label>
															<input type="text" class="form-control" placeholder="Enter Contact Number" name="CEemployment_contactno"  value="<?php echo $this->input->post("CEemployment_contactno");?>">
															<b><span style="color:red" id="CEemployment_contactno"></span></b>
														</div>
														<div class="form-group">
															<label>Designation*</label>
															<input type="text" class="form-control" placeholder="Enter Designation" name="CEemployment_designation"  value="<?php echo $this->input->post("CEemployment_designation");?>">
															<b><span style="color:red" id="CEemployment_designation"></span></b>
														</div> 
														<div class="form-group">
															<label>Key Roles and Responsibilitiess*</label>
															<textarea  rows="4" cols="50" class="form-control" name="CEemployment_keyrole" placeholder="Your Responsibilitiess in Organization" value="<?php echo $this->input->post("CEemployment_keyrole");?>"><?php echo $this->input->post("CEemployment_keyrole");?></textarea>
															<b><span style="color:red" id="CEemployment_keyrole"></span></b>
														</div> 
														<div class="form-group">
															<label>Duration*</label>
															<input type="text" class="form-control" placeholder="Total Duration Year" name="CEemployment_duration"  value="<?php echo $this->input->post("CEemployment_duration");?>">
															<b><span style="color:red" id="CEemployment_duration"></span></b>
														</div>
														<div class="form-group">
															<label>Duration From*</label>
															<input type="date" class="form-control" name="CEemployment_fromyr"  value="<?php echo $this->input->post("CEemployment_fromyr");?>">
															<b><span style="color:red" id="CEemployment_fromyr"></span></b>
														</div>
														<div class="form-group">
															<label>Duration To*</label>
															<input type="date" class="form-control" name="CEemployment_toyr"  value="<?php echo $this->input->post("CEemployment_toyr");?>">
															<b><span style="color:red" id="CEemployment_toyr"></span></b>
														</div> 
														<div class="box-footer">
														<button type="button" class="btn btn-primary" onclick="return AddEmploymentAjax()"><i class="fa fa-save"> Save</i></button>
														<button type="reset" class="btn btn-info">Cancel</button>
														</div><!-- /.box-body -->
													</div><!--/.box body --> 
													</form>
												</div>
												<div class="col-xs-6">	
													<label><h3>List All Work Experience</h3></label>
														<?php
														foreach($result_list_totalworkexperience as $row_list_totalworkexperience)
														if($row_list_totalworkexperience["count"] > 0)
														{
															$CETWexperience_total=$row_list_totalworkexperience["CETWexperience_total"];
														}
														else
														{
															$CETWexperience_total=$this->input->post("CETWexperience_total");
														}
														?>
														<div class="box-body">
															<form  name="TotalExp" method="post" action="" enctype="multipart/form-data"> 
																<input type="hidden" name="CETWexperience_enquiryid" value="<?php echo $this->input->get("myid");?>">  
																<div class="box-body">	
																	<div class="form-group">
																		<label>Total Work Experience *</label>
																		<input type="text" class="form-control" name="CETWexperience_total" placeholder="Eg: 1 year , 6 months , 15 days etc" value="<?php echo $CETWexperience_total; ?>">
																		<b><span style="color:red" id="CETWexperience_total"></span></b>
																	</div>  
																	<div class="box-footer">
																		<button type="button" class="btn btn-primary" onclick="return AddUpdateTotalExpAjax()"><i class="fa fa-save"> Save</i></button>
																		<button type="reset" class="btn btn-info">Cancel</button>
																	</div><!-- /.box-body -->
																</div><!--/.box body --> 
															</form>
														</div><!-- /.box-body -->
												<?php $SrNo=1; foreach($result_list_all_employment as $row_list_all_employment){?>	
													<div class="box box-default collapsed-box">
														<div class="box-header with-border" data-widget="collapse">
															<h3 class="box-title">Work Experience<?php echo $SrNo;?></h3>
															<div class="box-tools pull-right">
																<button class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
															</div><!-- /.box-tools -->
														</div><!-- /.box-header -->
														<div class="box-body">
															<form  name="UpdateEmployment_<?php echo $SrNo;?>" method="post" action="" enctype="multipart/form-data"> 
																<input type="hidden" name="CEemployment_enquiryid" value="<?php echo $this->input->get("myid");?>">
																<input type="hidden" name="CEemployment_id" value="<?php echo $row_list_all_employment["CEemployment_id"]; ?>">
																<label><h3>Work Experience </h3></label>
																<div class="box-body">	
																	<div class="form-group">
																		<label>Organization*</label>
																		<input type="text" class="form-control" name="CEemployment_organization" placeholder="Enter Organization" value="<?php echo $row_list_all_employment["CEemployment_organization"]; ?>">
																		<b><span style="color:red" id="CEemployment_organization_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="form-group">
																		<label>Address*</label>
																		<textarea  rows="4" cols="50" class="form-control" name="CEemployment_address" placeholder="Enter Address" value="<?php echo $row_list_all_employment["CEemployment_address"];?>"><?php echo $row_list_all_employment["CEemployment_address"];?></textarea>
																		<b><span style="color:red" id="CEemployment_address_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="form-group">
																		<label>Telephone/Mobile*</label>
																		<input type="text" class="form-control" placeholder="Enter Contact Number" name="CEemployment_contactno"  value="<?php echo $row_list_all_employment["CEemployment_contactno"];?>">
																		<b><span style="color:red" id="CEemployment_contactno_<?php echo $SrNo;?>"></span></b>
																	</div>
																	<div class="form-group">
																		<label>Designation*</label>
																		<input type="text" class="form-control" placeholder="Enter Designation" name="CEemployment_designation"  value="<?php echo $row_list_all_employment["CEemployment_designation"];?>">
																		<b><span style="color:red" id="CEemployment_designation_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="form-group">
																		<label>Key Roles and Responsibilitiess*</label>
																		<textarea  rows="4" cols="50" class="form-control" name="CEemployment_keyrole" placeholder="Your Responsibilitiess in Organization" value="<?php echo $row_list_all_employment["CEemployment_keyrole"];?>"><?php echo $row_list_all_employment["CEemployment_keyrole"];?></textarea>
																		<b><span style="color:red" id="CEemployment_keyrole_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="form-group">
																		<label>Duration*</label>
																		<input type="text" class="form-control" placeholder="Total Duration Year" name="CEemployment_duration"  value="<?php echo $row_list_all_employment["CEemployment_duration"];?>">
																		<b><span style="color:red" id="CEemployment_duration_<?php echo $SrNo;?>"></span></b>
																	</div>
																	<div class="form-group">
																		<label>Duration From*</label>
																		<input type="date" class="form-control" name="CEemployment_fromyr"  value="<?php echo $row_list_all_employment["CEemployment_fromyr"];?>">
																		<b><span style="color:red" id="CEemployment_fromyr_<?php echo $SrNo;?>"></span></b>
																	</div>
																	<div class="form-group">
																		<label>Duration To*</label>
																		<input type="date" class="form-control" name="CEemployment_toyr"  value="<?php echo $row_list_all_employment["CEemployment_toyr"];?>">
																		<b><span style="color:red" id="CEemployment_toyr_<?php echo $SrNo;?>"></span></b>
																	</div> 
																	<div class="box-footer">
																		<button type="button" class="btn btn-primary" onclick="return UpdateEmploymentAjax_<?php echo $SrNo;?>()"><i class="fa fa-save"> Update</i></button>
																		<button type="reset" class="btn btn-info">Cancel</button>
																	</div><!-- /.box-body -->
																</div><!--/.box body --> 
															</form>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												<?php  $SrNo++; }?>	
												</div>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
							<div class="tab-pane  <?php if($tab=="education"){ ?>active<?php }?>" id="education">  
								<div class="box">  
									<div class="box-body">
										<table class="table table-bordered table-striped">
										<?php 
										foreach($result_list_checkpreviouseducation as $row_list_checkpreviouseducation)
										if($row_list_checkpreviouseducation["count"]==1)
										{
										?>
											<div class="col-xs-6">
												<label><h3>Education Details </h3></label>		
												<form  name="UpdateEdu_first" method="post" action="" enctype="multipart/form-data" > 
												<input type="hidden" name="UPQ_enquiryid" value="<?php echo $this->input->get("myid");?>">	
												<input type="hidden" name="UPQ_id" value="<?php echo $row_list_checkpreviouseducation["UPQ_id"];?>">	
														<div class="box-body">		 	
															<div class="form-group">
																<label>Select Level(Or Course Type)*</label>  
																<select  name="UPQ_prev_ctypeid" class="form-control select1">
																	<option selected="selected">Select </option>
																	<?php 
																	$db4=$this->load->database("db4",true);
																	$db4=$db4->database;
																	$this->db->select('*');
																	$query_coursetype=$this->db->get("$db4.courses_type");
																	$result_coursetype=$query_coursetype->result_array();	
																	foreach($result_coursetype as $row_coursetype) {
																	?>
																	<option value="<?php echo $row_coursetype["Course_type_id"]; ?>" <?php if($row_coursetype["Course_type_id"]==$row_list_checkpreviouseducation["UPQ_prev_ctypeid"]) echo "selected"; ?>>	
																	<?php echo $row_coursetype["Course_type_name"]; ?>
																	</option>
																	<?php }?>
																</select>
																<b><span style="color:red" id="UPQ_prev_ctypeid1"></span></b>
															</div>
															<div class="form-group">
																<label>Program*</label>
																<input type="text" class="form-control" name="UPQ_prev_course" placeholder="Enter Previous Program (Or Course) Name" value="<?php echo $row_list_checkpreviouseducation["UPQ_prev_course"]; ?>">
																<b><span style="color:red" id="UPQ_prev_course1"></span></b>
															</div> 
															<div class="form-group">
																<label>College Name*</label>
																<input type="text" class="form-control" name="UPQ_prev_clgename" placeholder="Enter Previous College Name" value="<?php echo $row_list_checkpreviouseducation["UPQ_prev_clgename"]; ?>">
																<b><span style="color:red" id="UPQ_prev_clgename1"></span></b>
															</div> 
															<div class="form-group">
																<label>Address*</label>
																<textarea  rows="4" cols="50" class="form-control" name="UPQ_prev_clgeaddress" placeholder="Enter Previous Address" value="<?php echo $row_list_checkpreviouseducation["UPQ_prev_clgeaddress"]; ?>"><?php echo $row_list_checkpreviouseducation["UPQ_prev_clgeaddress"]; ?></textarea>
																<b><span style="color:red" id="UPQ_prev_clgeaddress1"></span></b>
															</div> 
															<div class="form-group">
																<label>Board / university*</label>
																<input type="text" class="form-control" placeholder="Enter Previous Address" name="UPQ_prev_clgeuniversity"  value="<?php echo $row_list_checkpreviouseducation["UPQ_prev_clgeuniversity"]; ?>">
																<b><span style="color:red" id="UPQ_prev_clgeuniversity1"></span></b>
															</div>
															<div class="form-group">
																<label>Year of Completion*</label>
																<select class="form-control select3" name="UPQ_prev_yearofcompletion" >
																	<option selected="selected">Select College Established Year</option> 
																	<?php
																	$currentYear = date('Y');
																	foreach (range(1950, $currentYear) as $value) {
																	?>		
																		<option value="<?php echo $value; ?>" <?php if($value==$row_list_checkpreviouseducation["UPQ_prev_yearofcompletion"]) echo "selected"; ?>>
																		<?php echo $value; ?>
																		</option>
																	<?php } ?>
																</select>
																<b><span style="color:red" id="UPQ_prev_yearofcompletion1"></span></b>
															</div>
															<div class="form-group">
																<label> Aggregate % / CGPA *</label>
																<input type="text" class="form-control" placeholder="Enter Previous Aggregate Marks" name="UPQ_prev_marks"  value="<?php echo $row_list_checkpreviouseducation["UPQ_prev_marks"]; ?>">
																<b><span style="color:red" id="UPQ_prev_marks1"></span></b>
															</div>
															<div class="box-footer">
																<button type="button"  class="btn btn-primary" onclick="return updatepreveductaion_first()"><i class="fa fa-save"> Update</i></button>
																<button type="reset"  class="btn btn-info"> Cancel</button>
															</div><!-- /.box-body -->
														</div><!--/.box body -->   
												</form>
											</div>
										<?php } else{?>
											<div class="col-xs-6">
												<label><h3>Education Details </h3></label>		
												<form  name="AddEdu" method="post" action="" enctype="multipart/form-data" > <input type="text" class="form-control" name="Cenq_fstname" placeholder="Enter Frist Name" value="<?php echo $row_presonal_details["Cenq_fstname"];?>">
														<div class="box-body">		 	
															<div class="form-group">
																<label>Select Level(Or Course Type)*</label>  
																<select  name="UPQ_prev_ctypeid" class="form-control select1">
																	<option selected="selected">Select </option>
																	<?php 
																	$db4=$this->load->database("db4",true);
																	$db4=$db4->database;
																	$this->db->select('*');
																	$query_coursetype=$this->db->get("$db4.courses_type");
																	$result_coursetype=$query_coursetype->result_array();	
																	foreach($result_coursetype as $row_coursetype) {
																	?>
																	<option value="<?php echo $row_coursetype["Course_type_id"]; ?>" <?php if($row_coursetype["Course_type_id"]==$this->input->post("UPQ_prev_ctypeid")) echo "selected"; ?>>	
																	<?php echo $row_coursetype["Course_type_name"]; ?>
																	</option>
																	<?php }?>
																</select>
																<b><span style="color:red" id="UPQ_prev_ctypeid"></span></b>
															</div>
															<div class="form-group">
																<label>Program*</label>
																<input type="text" class="form-control" name="UPQ_prev_course" placeholder="Enter Previous Program (Or Course) Name" value="<?php echo $this->input->post("UPQ_prev_course"); ?>">
																<b><span style="color:red" id="UPQ_prev_course"></span></b>
															</div> 
															<div class="form-group">
																<label>College Name*</label>
																<input type="text" class="form-control" name="UPQ_prev_clgename" placeholder="Enter Previous College Name" value="<?php echo $this->input->post("UPQ_prev_clgename"); ?>">
																<b><span style="color:red" id="UPQ_prev_clgename"></span></b>
															</div> 
															<div class="form-group">
																<label>Address*</label>
																<textarea  rows="4" cols="50" class="form-control" name="UPQ_prev_clgeaddress" placeholder="Enter Previous Address" value="<?php echo $this->input->post("UPQ_prev_clgeaddress"); ?>"><?php echo $this->input->post("UPQ_prev_clgeaddress"); ?></textarea>
																<b><span style="color:red" id="UPQ_prev_clgeaddress"></span></b>
															</div> 
															<div class="form-group">
																<label>Board / university*</label>
																<input type="text" class="form-control" placeholder="Enter Previous Address" name="UPQ_prev_clgeuniversity"  value="<?php echo $this->input->post("UPQ_prev_clgeuniversity"); ?>">
																<b><span style="color:red" id="UPQ_prev_clgeuniversity"></span></b>
															</div>
															<div class="form-group">
																<label>Year of Completion*</label>
																<select class="form-control select3" name="UPQ_prev_yearofcompletion">
																	<option selected="selected">Select College Established Year</option> 
																	<?php
																	$currentYear = date('Y');
																	foreach (range(1950, $currentYear) as $value) {
																	?>		
																		<option value="<?php echo $value; ?>" <?php if($value==$this->input->post("UPQ_prev_yearofcompletion")) echo "selected"; ?>>
																		<?php echo $value; ?>
																		</option>
																	<?php } ?>
																</select>
																<b><span style="color:red" id="UPQ_prev_yearofcompletion"></span></b>
															</div>
															<div class="form-group">
																<label> Aggregate % / CGPA *</label>
																<input type="text" class="form-control" placeholder="Enter Previous Aggregate Marks" name="UPQ_prev_marks"  value="<?php echo $this->input->post("UPQ_prev_marks"); ?>">
																<b><span style="color:red" id="UPQ_prev_marks"></span></b>
															</div>
															<div class="box-footer">
																<button type="button"  class="btn btn-primary" onclick="return Addpreveductaion()"><i class="fa fa-save"> Save</i></button>
																<button type="reset"  class="btn btn-info"> Cancel</button>
															</div><!-- /.box-body -->
														</div><!--/.box body -->   
												</form>
											</div>
											<div  class="col-xs-6">
												<form name="upload_files" method="post" action="" enctype="multipart/form-data">
												<input type="hidden" name="Cenq_fstname" value="<?php echo $row_presonal_details["Cenq_fstname"]; ?>">
												
												<label><h3>Add Your Documents</h3></label> 		 	
													<div class="form-group">
														<label>Select Level(Or Course Type)*</label>  
														<select  name="UPQfiles_qualificationid" class="form-control select1">
														<option selected="selected">Select </option>
														<?php 
														$db4=$this->load->database("db4",true);
														$db4=$db4->database;
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;
														$this->db->select('*');
														$this->db->from("$db8.users_previous_qualification");
														$this->db->join("$db4.courses_type",'courses_type.Course_type_id=users_previous_qualification.UPQ_prev_ctypeid');
														$this->db->where("UPQ_enquiryid",$this->input->get("myid"));
														$query_coursetype=$this->db->get();
														$result_coursetype=$query_coursetype->result_array();	
														foreach($result_coursetype as $row_coursetype) {
														?>
														<option value="<?php echo $row_coursetype["UPQ_id"]; ?>" <?php if($row_coursetype["UPQ_id"]==$this->input->post("UPQfiles_qualificationid")) echo "selected"; ?>>	
														<?php echo $row_coursetype["Course_type_name"]; ?>
														<?php echo "(".' '.$row_coursetype["UPQ_prev_clgename"].' '.")"; ?>
														</option>
														<?php }?>
														</select>
													<b><span style="color:red" id="UPQfiles_qualificationid"></span></b>
												</div>
												<div class="form-group">
													<label>Upload Files*</label>
													<input type="file" class="form-control" name="UPQfiles_name" placeholder="Enter Previous College Name" value="<?php echo $this->input->post("UPQfiles_name"); ?>">
													<b><span style="color:red" id="UPQfiles_name"></span></b>
												</div>
												<div class="box-footer">
													<button type="submit" name="upload_marksheet" class="btn btn-primary" onclick="return validate_uploads_file();"><i class="fa fa-save"> Upload</i></button>
													<button type="reset"  class="btn btn-info"> Cancel</button>
												</div><!-- /.box-body -->
												</form>
												<label><h3>List Uploaded Documets</h3></label><br/>
												<?php foreach($result_list_previouseducation as $row_list_previouseducation){?>
												<h3 class="box-title">
													<?php echo $row_list_previouseducation["Course_type_name"]; ?> (<?php echo $row_list_previouseducation["UPQ_prev_course"]; ?>) -<?php echo $row_list_previouseducation["UPQ_prev_clgename"]; ?>
												</h3>
													<?php
														$db8=$this->load->database("db8",true);
														$db8=$db8->database;
														$this->db->select("*");
														$this->db->from("$db8.users_previous_qualification_files");
														$this->db->join("$db8.users_previous_qualification",'users_previous_qualification.UPQ_id=users_previous_qualification_files.UPQfiles_qualificationid');
														$this->db->where("UPQfiles_qualificationid",$row_list_previouseducation["UPQ_id"]);
														$query=$this->db->get();
														$result_files=$query->result_array();
														foreach($result_files as $row_files)
														{
													?>
														<h4><?php echo $row_files["UPQfiles_name"];?><a href="<?php echo base_url();?>./admin/uploads/marksheets/<?php echo $row_files["UPQfiles_name"];?>" download> Download <i class="fa fa-download"></i></a></h4>
												<?php 	} }?>
												<hr/>
												<label><h3>List All Previous Education Details</h3></label> 
												<?php $SrNo=1; foreach($result_list_previouseducation as $row_list_previouseducation){?>	
												<div class="box box-default collapsed-box">
													<div class="box-header with-border" data-widget="collapse">
														<h3 class="box-title">Previous Education <?php echo $SrNo;?></h3>
														<div class="box-tools pull-right">
															<button class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
														</div><!-- /.box-tools -->
													</div><!-- /.box-header -->
													<div class="box-body">
														<form  name="UpdateEdu_<?php echo $SrNo;?>" method="post" action="" enctype="multipart/form-data" > 
															<input type="hidden" name="UPQ_enquiryid" value="<?php echo $this->input->get("myid");?>">	
															<input type="hidden" name="UPQ_id" value="<?php echo $row_list_previouseducation["UPQ_id"];?>">	
															<div class="box-body">		 	
																<div class="form-group">
																	<label>Select Level(Or Course Type)*</label>  
																	<select  name="UPQ_prev_ctypeid" class="form-control select1">
																		<option selected="selected">Select </option>
																		<?php 
																		$db4=$this->load->database("db4",true);
																		$db4=$db4->database;
																		$this->db->select('*');
																		$query_coursetype=$this->db->get("$db4.courses_type");
																		$result_coursetype=$query_coursetype->result_array();	
																		foreach($result_coursetype as $row_coursetype) {
																		?>
																		<option value="<?php echo $row_coursetype["Course_type_id"]; ?>" <?php if($row_coursetype["Course_type_id"]==$row_list_previouseducation["UPQ_prev_ctypeid"]) echo "selected"; ?>>	
																		<?php echo $row_coursetype["Course_type_name"]; ?>
																		</option>
																		<?php }?>
																	</select>
																	<b><span style="color:red" id="UPQ_prev_ctypeid_<?php echo $SrNo;?>"></span></b>
																</div>
																<div class="form-group">
																	<label>Program*</label>
																	<input type="text" class="form-control" name="UPQ_prev_course" placeholder="Enter Previous Program (Or Course) Name" value="<?php echo $row_list_previouseducation["UPQ_prev_course"]; ?>">
																	<b><span style="color:red" id="UPQ_prev_course_<?php echo $SrNo;?>"></span></b>
																</div> 
																<div class="form-group">
																	<label>College Name*</label>
																	<input type="text" class="form-control" name="UPQ_prev_clgename" placeholder="Enter Previous College Name" value="<?php echo $row_list_previouseducation["UPQ_prev_clgename"]; ?>">
																	<b><span style="color:red" id="UPQ_prev_clgename_<?php echo $SrNo;?>"></span></b>
																</div> 
																<div class="form-group">
																	<label>Address*</label>
																	<textarea  rows="4" cols="50" class="form-control" name="UPQ_prev_clgeaddress" placeholder="Enter Previous Address" value="<?php echo $row_list_previouseducation["UPQ_prev_clgeaddress"]; ?>"><?php echo $row_list_previouseducation["UPQ_prev_clgeaddress"]; ?></textarea>
																	<b><span style="color:red" id="UPQ_prev_clgeaddress_<?php echo $SrNo;?>"></span></b>
																</div> 
																<div class="form-group">
																	<label>Board / university*</label>
																	<input type="text" class="form-control" placeholder="Enter Previous Address" name="UPQ_prev_clgeuniversity"  value="<?php echo $row_list_previouseducation["UPQ_prev_clgeuniversity"]; ?>">
																	<b><span style="color:red" id="UPQ_prev_clgeuniversity_<?php echo $SrNo;?>"></span></b>
																</div>
																<div class="form-group">
																	<label>Year of Completion*</label>
																	<select class="form-control select3" name="UPQ_prev_yearofcompletion" >
																	<option selected="selected">Select College Established Year</option> 
																	<?php
																	$currentYear = date('Y');
																	foreach (range(1950, $currentYear) as $value) {
																	?>		
																	<option value="<?php echo $value; ?>" <?php if($value==$row_list_previouseducation["UPQ_prev_yearofcompletion"]) echo "selected"; ?>>
																	<?php echo $value; ?>
																	</option>
																	<?php } ?>
																	</select>
																	<b><span style="color:red" id="UPQ_prev_yearofcompletion_<?php echo $SrNo;?>"></span></b>
																</div>
																<div class="form-group">
																	<label> Aggregate % / CGPA *</label>
																	<input type="text" class="form-control" placeholder="Enter Previous Aggregate Marks" name="UPQ_prev_marks"  value="<?php echo $row_list_previouseducation["UPQ_prev_marks"]; ?>">
																	<b><span style="color:red" id="UPQ_prev_marks_<?php echo $SrNo;?>"></span></b>
																</div>
																<div class="box-footer">
																	<button type="button"  class="btn btn-primary" onclick="return updatepreveductaion_<?php echo $SrNo;?>()"><i class="fa fa-save"> Update</i></button>
																	<button type="reset"  class="btn btn-info"> Cancel</button>
																</div><!-- /.box-body -->
															</div><!--/.box body -->   
														</form>
													</div><!-- /.box-body -->
												</div><!-- /.box -->
												<?php  $SrNo++; }?>	
											</div>
										<?php }?>	
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
							<div class="tab-pane <?php if($tab=="family"){ ?>active<?php }?>" id="family">  
								<div class="box"> 
									<div class="box-body">
										<table class="table table-bordered table-striped">
												<div class="col-xs-6">		
													<form  name="AddFamily" method="post" action="" enctype="multipart/form-data" > 
													<input type="hidden" name="CEfamily_enquiryid" value="<?php echo $this->input->get("myid");?>">
													<label><h3>Family Details</h3></label>
													<div class="box-body">
														<div class="form-group">
														<label>Relations*</label>
														<select  name="CEfamily_familytypeid" class="form-control select2">
															<option selected="selected">Select </option>
															<?php 
															$db8=$this->load->database("db8",true);
															$db8=$db8->database;
															$this->db->where("CEfamily_familytypeid!=",4);
															$this->db->where("CEfamily_enquiryid",$this->input->get("myid"));
															$query_ftypeid=$this->db->get("$db8.college_enquiry_family");
															$result_ftypeid=$query_ftypeid->result_array();
															foreach($result_ftypeid as $row_ftypeid)
															{
																$this->db->where("CEFtype_id!=",$row_ftypeid["CEfamily_familytypeid"]);
															}
															$query_familytype=$this->db->get("$db8.college_enquiry_familytype");
															$result_familytype=$query_familytype->result_array();
															foreach($result_familytype as $row_familytype)
															{
															?>
															<option value="<?php echo $row_familytype["CEFtype_id"]; ?>" <?php if($row_familytype["CEFtype_id"]==$this->input->post("CEfamily_familytypeid"))echo 'selected'; ?>><?php echo $row_familytype["CEFtype_name"]; ?></option>
															<?php } ?>	
														</select>
															<b><span style="color:red" id="CEfamily_familytypeid"></span></b>
														</div>
														<div class="form-group">
															<label>Frist Name*</label>
															<input type="text" class="form-control" name="CEfamily_fstname" placeholder="Enter Frist Name" value="<?php echo $this->input->post("CEfamily_fstname"); ?>">
															<b><span style="color:red" id="CEfamily_fstname"></span></b>
														</div> 
														<div class="form-group">
															<label>Last Name*</label>
															<input type="text" class="form-control" name="CEfamily_lstname" placeholder="Enter Last Name" value="<?php echo $this->input->post("CEfamily_lstname"); ?>">
															<b><span style="color:red" id="CEfamily_lstname"></span></b>
														</div> 
														<div class="form-group">
															<label>Ocupation*</label>
															<input type="text" class="form-control" name="CEfamily_occupation" placeholder="Enter Ocupation" value="<?php echo $this->input->post("CEfamily_occupation");?>">
															<b><span style="color:red" id="CEfamily_occupation"></span></b>
														</div>
														<div class="form-group">
															<label>Nationality*</label>
															<input type="text" class="form-control" name="CEfamily_nationality" placeholder="Enter Nationality" value="<?php echo $this->input->post("CEfamily_nationality");?>">
															<b><span style="color:red" id="CEfamily_nationality"></span></b>
														</div>
														<div class="form-group">
															<label>Telephone</label>
															<input type="text" placeholder="Enter Phone no" class="form-control" name="CEfamily_phoneno"  value="<?php echo $this->input->post("CEfamily_phoneno");?>">
															<b><span style="color:red" id="CEfamily_phoneno"></span></b>
														</div>
														<div class="form-group">
															<label>Mobile*</label>
															<input type="text" class="form-control" placeholder="Enter Mobile No" name="CEfamily_mobileno"  value="<?php echo $this->input->post("CEfamily_mobileno");?>">
															<b><span style="color:red" id="CEfamily_mobileno"></span></b>
														</div>
													</div><!--/.box body -->
													<div class="box-footer">
														<button type="button"  class="btn btn-primary" onclick="return AddfamilyAjax()"><i class="fa fa-save"> Save</i></button>
														<button type="reset"  class="btn btn-info"> Cancel</button>
													</div><!-- /.box-body -->
													</form>
												</div> 
												<div  class="col-xs-6">
													<label><h3>List All Families</h3></label> 
												<?php $SrNo=1; foreach($result_list_all_family as $row_list_all_family){?>	
													<div class="box box-default collapsed-box">
														<div class="box-header with-border" data-widget="collapse">
															<h3 class="box-title">Family Member <?php echo $SrNo;?></h3>
															<div class="box-tools pull-right">
																<button class="btn btn-box-tool" ><i class="fa fa-plus"></i></button>
															</div><!-- /.box-tools -->
														</div><!-- /.box-header -->
														<div class="box-body">
															<form  name="UpdateFamily_<?php echo $SrNo;?>" method="post" action="" enctype="multipart/form-data" > 
															<input type="hidden" name="CEfamily_id" value="<?php echo $row_list_all_family["CEfamily_id"];?>">
															<input type="hidden" name="CEfamily_enquiryid" value="<?php echo $this->input->get("myid");?>">
																<label><h3>Family Details</h3></label>
																	<div class="box-body">
																		<div class="form-group">
																			<label>Relations*</label>
																			<select  name="CEfamily_familytypeid" class="form-control select1">
																				<option selected="selected">Select </option>
																				<?php 
																				$db8=$this->load->database("db8",true);
																				$db8=$db8->database; 
																				$this->db->where("CEFtype_id",4);
																				if($row_list_all_family["CEfamily_familytypeid"]!=4)
																				{
																					$this->db->or_where("CEFtype_id",$row_list_all_family["CEfamily_familytypeid"]); 
																				} 
																				$query_familytype=$this->db->get("$db8.college_enquiry_familytype");
																				$result_familytype=$query_familytype->result_array();
																				foreach($result_familytype as $row_familytype)
																				{
																				?>
																				<option value="<?php echo $row_familytype["CEFtype_id"]; ?>" <?php if($row_familytype["CEFtype_id"]==$row_list_all_family["CEfamily_familytypeid"]) echo 'selected';?>><?php echo $row_familytype["CEFtype_name"]; ?></option>
																				<?php } ?>	
																			</select>
																			<b><span style="color:red" id="CEfamily_familytypeid_<?php echo $SrNo;?>"></span></b>
																		</div>
																		<div class="form-group">
																			<label>Frist Name*</label>
																			<input type="text" class="form-control" name="CEfamily_fstname" placeholder="Enter Frist Name" value="<?php echo $row_list_all_family["CEfamily_fstname"]; ?>">
																			<b><span style="color:red" id="CEfamily_fstname_<?php echo $SrNo;?>"></span></b>
																		</div> 
																		<div class="form-group">
																			<label>Last Name*</label>
																			<input type="text" class="form-control" name="CEfamily_lstname" placeholder="Enter Last Name" value="<?php echo $row_list_all_family["CEfamily_lstname"]; ?>">
																			<b><span style="color:red" id="CEfamily_lstname_<?php echo $SrNo;?>"></span></b>
																		</div> 
																		<div class="form-group">
																			<label>Ocupation*</label>
																			<input type="text" class="form-control" name="CEfamily_occupation" placeholder="Enter Ocupation" value="<?php echo $row_list_all_family["CEfamily_occupation"];?>">
																			<b><span style="color:red" id="CEfamily_occupation_<?php echo $SrNo;?>"></span></b>
																		</div>
																		<div class="form-group">
																			<label>Nationality*</label>
																			<input type="text" class="form-control" name="CEfamily_nationality" placeholder="Enter Nationality" value="<?php echo $row_list_all_family["CEfamily_nationality"];?>">
																			<b><span style="color:red" id="CEfamily_nationality_<?php echo $SrNo;?>"></span></b>
																		</div>
																		<div class="form-group">
																			<label>Telephone</label>
																			<input type="text" placeholder="Enter Phone no" class="form-control" name="CEfamily_phoneno"  value="<?php echo $row_list_all_family["CEfamily_phoneno"];?>">
																			<b><span style="color:red" id="CEfamily_phoneno_<?php echo $SrNo;?>"></span></b>
																		</div>
																		<div class="form-group">
																			<label>Mobile*</label>
																			<input type="text" class="form-control" placeholder="Enter Mobile No" name="CEfamily_mobileno"  value="<?php echo $row_list_all_family["CEfamily_mobileno"];?>">
																			<b><span style="color:red" id="CEfamily_mobileno_<?php echo $SrNo;?>"></span></b>
																		</div>
																	</div><!--/.box body -->
																	<div class="box-footer">
																		<button type="button"  class="btn btn-primary" onclick="return UpdatefamilyAjax_<?php echo $SrNo;?>()"><i class="fa fa-save"> Save</i></button>
																		<button type="reset"  class="btn btn-info"> Cancel</button>
																	</div><!-- /.box-body -->
															</form>
														</div><!-- /.box-body -->
													</div><!-- /.box -->
												<?php  $SrNo++; }?>	
												</div>
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>  				
							<div class="tab-pane  <?php if($tab=="contact"){ ?>active<?php }?>" id="contact">  
								<div class="box"> <!-- /.box-header -->
									<?php
									foreach($result_list_all_currentAddress as $row_list_all_currentAddress)
									if($row_list_all_currentAddress["count"] > 0)
									{
										$CEaddress_phoneno=$row_list_all_currentAddress["CEaddress_phoneno"];
										$CEaddress_mobileno=$row_list_all_currentAddress["CEaddress_mobileno"];
										$CEaddress_houseno=$row_list_all_currentAddress["CEaddress_houseno"];
										$CEaddress_wardno=$row_list_all_currentAddress["CEaddress_wardno"];
										$CEaddress_town_village=$row_list_all_currentAddress["CEaddress_town_village"];
										$CEaddress_district=$row_list_all_currentAddress["CEaddress_district"];
										$CEaddress_zone=$row_list_all_currentAddress["CEaddress_zone"];
										$CEaddress_country=$row_list_all_currentAddress["CEaddress_country"];
									}
									else
									{
										$CEaddress_phoneno=$this->input->post("CEaddress_phoneno");
										$CEaddress_mobileno=$this->input->post("CEaddress_mobileno");
										$CEaddress_houseno=$this->input->post("CEaddress_houseno");
										$CEaddress_wardno=$this->input->post("CEaddress_wardno");
										$CEaddress_town_village=$this->input->post("CEaddress_town_village");
										$CEaddress_district=$this->input->post("CEaddress_district");
										$CEaddress_zone=$this->input->post("CEaddress_zone");
										$CEaddress_country=$this->input->post("CEaddress_country");
									}
									?>
									<div class="box-body">
										<table class="table table-bordered table-striped">
												<div class="col-xs-6">		
													<form id="Cadd" name="Cadd" method="post" action="" enctype="multipart/form-data"> 
													<input type="hidden" name="CEaddress_enquiryid" value="<?php echo $this->input->get("myid");?>">
													<input type="hidden" name="CEaddress_addresstypeid" value="1">
													<label><h3>Current Address</h3></label>
													<div class="box-body"> 
														<div class="form-group">
															<label>Town/Village*</label>
															<input type="text" class="form-control" name="CEaddress_town_village" placeholder="Enter Town or Village" value="<?php echo $CEaddress_town_village;?>">
															<b><span style="color:red" id="CEaddress_town_village"></span></b>
														</div> 
														<div class="form-group">
															<label>Country*</label>
															<input type="text" class="form-control" name="CEaddress_country" placeholder="Enter Country" value="<?php echo $CEaddress_country;?>">
															<b><span style="color:red" id="CEaddress_country"></span></b>
														</div> 
														<div class="form-group">
															<label>Zone*</label>
															<input type="text" class="form-control" name="CEaddress_zone" placeholder="Enter Zone" value="<?php echo $CEaddress_zone;?>">
															<b><span style="color:red" id="CEaddress_zone"></span></b>
														</div> 
														<div class="form-group">
															<label>District*</label>
															<input type="text" class="form-control" name="CEaddress_district" placeholder="Enter District" value="<?php echo $CEaddress_district;?>">
															<b><span style="color:red" id="CEaddress_district"></span></b>
														</div>   
														<div class="form-group">
															<label>Ward No*</label>
															<input type="text"  placeholder="Enter Ward No" class="form-control" name="CEaddress_wardno"  value="<?php echo $CEaddress_wardno;?>">
															<b><span style="color:red" id="CEaddress_wardno"></span></b>
														</div>
														<div class="form-group">
															<label>House Number</label>
															<input type="text" placeholder="Enter House No" class="form-control" name="CEaddress_houseno"  value="<?php echo $CEaddress_houseno;?>"> 
														</div>
														<div class="form-group">
															<label>Telephone </label>
															<input type="text" placeholder="Enter Phone No" class="form-control" name="CEaddress_phoneno"  value="<?php echo $CEaddress_phoneno;?>">
															<b><span style="color:red" id="CEaddress_phoneno"></span></b>
														</div>
														<div class="form-group">
															<label>Mobile*</label>
															<input type="text" placeholder="Enter Mobile No" class="form-control" name="CEaddress_mobileno"  value="<?php echo $CEaddress_mobileno;?>">
															<b><span style="color:red" id="CEaddress_mobileno"></span></b>
														</div> 
														<div class="form-group">
															<label>Make Current Address As Permanent Address? </label>  
															<input type="radio" value="no" name="make_permanent" checked> No  
															<input id="copy" type="radio" value="yes" name="make_permanent"> Yes    
														</div> 
													</div><!--/.box body -->
													<div class="box-footer">
														<button type="button"  class="btn btn-primary" onclick="return AddUpdateCaddressAjax()" ><i class="fa fa-save"> Save</i></button>
														<button type="reset"  class="btn btn-info"> Cancel</button>
													</div><!-- /.box-body -->
													</form> 
												</div> 		
									<?php
									foreach($result_list_all_permanentAddress as $row_list_all_permanentAddress)
									if($row_list_all_permanentAddress["count"] > 0)
									{
										$CEaddress_phoneno=$row_list_all_permanentAddress["CEaddress_phoneno"];
										$CEaddress_mobileno=$row_list_all_permanentAddress["CEaddress_mobileno"];
										$CEaddress_houseno=$row_list_all_permanentAddress["CEaddress_houseno"];
										$CEaddress_wardno=$row_list_all_permanentAddress["CEaddress_wardno"];
										$CEaddress_town_village=$row_list_all_permanentAddress["CEaddress_town_village"];
										$CEaddress_district=$row_list_all_permanentAddress["CEaddress_district"];
										$CEaddress_zone=$row_list_all_permanentAddress["CEaddress_zone"];
										$CEaddress_country=$row_list_all_permanentAddress["CEaddress_country"];
									}
									else
									{
										$CEaddress_phoneno=$this->input->post("CEaddress_phoneno");
										$CEaddress_mobileno=$this->input->post("CEaddress_mobileno");
										$CEaddress_houseno=$this->input->post("CEaddress_houseno");
										$CEaddress_wardno=$this->input->post("CEaddress_wardno");
										$CEaddress_town_village=$this->input->post("CEaddress_town_village");
										$CEaddress_district=$this->input->post("CEaddress_district");
										$CEaddress_zone=$this->input->post("CEaddress_zone");
										$CEaddress_country=$this->input->post("CEaddress_country");
									}
									?>			
												<div class="col-xs-6">		
													<form id="Padd" name="Padd" method="post" action="" enctype="multipart/form-data"> 
													<input type="hidden" name="CEaddress_enquiryid" value="<?php echo $this->input->get("myid");?>">
													<input type="hidden" name="CEaddress_addresstypeid" value="2">
													<label><h3>Permanent Address</h3></label>
													<div class="box-body"> 
														<div class="form-group">
															<label>Town/Village*</label>
															<input type="text" class="form-control" name="CEaddress_town_village" placeholder="Enter Town or Village" value="<?php echo $CEaddress_town_village;?>">
															<b><span style="color:red" id="PCEaddress_town_village"></span></b>
														</div> 
														<div class="form-group">
															<label>Country*</label>
															<input type="text" class="form-control" name="CEaddress_country" placeholder="Enter Country" value="<?php echo $CEaddress_country;?>">
															<b><span style="color:red" id="PCEaddress_country"></span></b>
														</div> 
														<div class="form-group">
															<label>Zone*</label>
															<input type="text" class="form-control" name="CEaddress_zone" placeholder="Enter Zone" value="<?php echo $CEaddress_zone;?>">
															<b><span style="color:red" id="PCEaddress_zone"></span></b>
														</div> 
														<div class="form-group">
															<label>District*</label>
															<input type="text" class="form-control" name="CEaddress_district" placeholder="Enter District" value="<?php echo $CEaddress_district;?>">
															<b><span style="color:red" id="PCEaddress_district"></span></b>
														</div>   
														<div class="form-group">
															<label>Ward No*</label>
															<input type="text"  placeholder="Enter Ward No" class="form-control" name="CEaddress_wardno"  value="<?php echo $CEaddress_wardno;?>">
															<b><span style="color:red" id="PCEaddress_wardno"></span></b>
														</div>
														<div class="form-group">
															<label>House Number</label>
															<input type="text" placeholder="Enter House No" class="form-control" name="CEaddress_houseno"  value="<?php echo $CEaddress_houseno;?>"> 
														</div>
														<div class="form-group">
															<label>Telephone </label>
															<input type="text" placeholder="Enter Phone No" class="form-control" name="CEaddress_phoneno"  value="<?php echo $CEaddress_phoneno;?>">
															<b><span style="color:red" id="PCEaddress_phoneno"></span></b>
														</div>
														<div class="form-group">
															<label>Mobile*</label>
															<input type="text" placeholder="Enter Mobile No" class="form-control" name="CEaddress_mobileno"  value="<?php echo $CEaddress_mobileno;?>">
															<b><span style="color:red" id="PCEaddress_mobileno"></span></b>
														</div> 
													</div><!--/.box body -->
													<div class="box-footer">
														<button type="button"  class="btn btn-primary" onclick="return AddUpdatePaddressAjax()" ><i class="fa fa-save"> Save</i></button>
														<button type="reset"  class="btn btn-info"> Cancel</button>
													</div><!-- /.box-body -->
													</form> 
												</div> 
										</table>	
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div> 
							<div class="tab-pane <?php if($tab=="personal"){ ?>active<?php }?>" id="personal">  
								<div class="box"> <!-- /.box-header --> 
									<div class="box-body">
										<table class="table table-bordered table-striped">	
											<form  name="Personal_details" method="post" action="" enctype="multipart/form-data" onsubmit="return Validate_personal_details()"> 
											<input type="hidden" name="do_update_personal_details" value="true">
											<input type="hidden" name="User_id" value="<?php echo $row_presonal_details["Cenq_userid"];?>">
												<div class="col-xs-6">	 
													<div class="box-body">
														<div class="form-group">
															<label>Profile</label>
															<input type="hidden" class="form-control" name="Cenq_profilepic_hidden"  value="<?php echo $row_presonal_details["Cenq_profilepic"];?>"> 
															<?php 
																if($row_presonal_details["Cenq_profilepic"]==''){ $image="no-image.jpg";} else {$image=$row_presonal_details["Cenq_profilepic"]; } 
															?>
															<img src="./admin/uploads/users/thumbs/<?php  	echo $image; ?>" class="img-square" width="70" alt="image<?php echo $row_presonal_details["Cenq_fstname"];?>" />
														</div> 
														<div class="form-group">
															<label>First Name*</label>
															<input type="text" class="form-control" name="Cenq_fstname" placeholder="Enter Frist Name" value="<?php echo $row_presonal_details["Cenq_fstname"];?>">
															<b><span style="color:red" id="Cenq_fstname"></span></b>
														</div> 
														<div class="form-group">
															<label>Last Name*</label>
															<input type="text" class="form-control" name="Cenq_lstname" placeholder="Enter Last Name" value="<?php echo $row_presonal_details["Cenq_lstname"];?>">
															<b><span style="color:red" id="Cenq_lstname"></span></b>
														</div> 
														<div class="form-group">
															<label>Date of Birth (Nepali)*</label>
															<input type="date" class="form-control" name="Cenq_dob_bs"  value="<?php echo $row_presonal_details["Cenq_dob_bs"]; ?>">
															<b><span style="color:red" id="Cenq_dob_bs"></span></b>
														</div>
														<div class="form-group">
															<label>Date of Birth (Universal)*</label>
															<input type="date" class="form-control" name="Cenq_dob_ad"  value="<?php echo $row_presonal_details["Cenq_dob_ad"]; ?>">
															<b><span style="color:red" id="Cenq_dob_ad"></span></b>
														</div>
														<div class="form-group">
															<label>Gender*</label></br>
															<label style="color:green"> 
															<input type="radio" name="Cenq_gender" value="Male" <?php if($row_presonal_details["Cenq_gender"]=="Male") echo "checked";?> checked>Male
															<input type="radio" name="Cenq_gender" value="Female" <?php if($row_presonal_details["Cenq_gender"]=="Female") echo "checked";?>>Female
															<input type="radio" name="Cenq_gender" value="Others" <?php if($row_presonal_details["Cenq_gender"]=="Others") echo "checked";?>>Others 
															</label>
														</div>
													</div><!--/.box body -->
												</div>	
												<div class="col-xs-6">		 
													<div class="box-body">
														<div class="form-group">
															<label>Place of Birth*</label>
															<input type="text" class="form-control" name="Cenq_birth_place" placeholder="Place Of Birth" value="<?php echo $row_presonal_details["Cenq_birth_place"]; ?>">
															<b><span style="color:red" id="Cenq_birth_place"></span></b>
														</div> 
														<div class="form-group">
															<label>Nationality*</label>
															<input type="text" class="form-control" name="Cenq_nationality" placeholder="Place Of Birth" value="<?php echo $row_presonal_details["Cenq_nationality"]; ?>">
															<b><span style="color:red" id="Cenq_nationality"></span></b>
														</div> 
														<div class="form-group">
															<label>Mobile No*</label>
															<input type="text" class="form-control" name="Cenq_contactno" placeholder="Enter Mobile Number" value="<?php echo $row_presonal_details["Cenq_contactno"];?>">
															<b><span style="color:red" id="Cenq_contactno"></span></b>
														</div> 
														<div class="form-group">
															<label>Email*</label>
															<input type="email" class="form-control" name="Cenq_email" placeholder="Enter Email"  value="<?php echo $row_presonal_details["Cenq_email"];?>" disabled>
															<b><span style="color:red" id="Cenq_email"></span></b>
														</div> 	
														<div class="form-group">
															<label>Add Profile Picture</label>
															<input type="file" class="form-control" name="Cenq_profilepic"  value="<?php echo $row_presonal_details["Cenq_profilepic"]; ?>"> 
														</div> 
													</div><!--/.box body --> 
													<div class="box-footer">
														<button type="submit" name="update_personal_details" class="btn btn-primary"><i class="fa fa-save"> Save</i></button>
														<button type="reset"  class="btn btn-info"> Cancel</button>
													</div><!-- /.box-body --> 
												</div>
											</form>	
										</table>
									</div><!-- /.box-body -->
								</div><!-- /.box -->
							</div>
						</div> 
					</div> 
				</div><!-- /.col -->
			</div><!-- /.row -->
        </section><!-- /.content -->  
</div>
<?php	
}
?>
