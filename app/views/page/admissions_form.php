<?php echo $this->Html->css(array('front/jquery-ui', 'front/admissions'));
echo $this->Javascript->link(array('front/jquery-ui', 'front/admissions'));
$year_groups = array('Preschool', 'FS1', 'FS2', 'Year 1', 'Year 2','Year 3', 'Year 4', 'Year 5', 'Year 6');
$gender_options = array('Male', 'Female');
$terms_options = array('Term1', 'Term2', 'Term3');
echo $this->Form->create('admissions', array('type' =>'file','id'=>'admissionsform', 'class'=>'admissions','url'=> $base_url.'/page/admissionsform/notajax'));?>    
<div class="input_new">
    <label for="child_name_input">Child’s Name:</label>
     <span>
         <input id="child_name_input" class="input3new admissions_input take_placeholder required_input " type="text" name="child_name" />    
     </span>
</div>
<div class="input_new">
    <label for="child_name_input">Child’s Photo:</label>
     <span>
         <input id="child_photo_input" class="input3new admissions_input " type="file" name="file" />    
     </span>
</div>
<div class="input_new">
    <label for="birth_date_input">Date of Birth:</label>
     <span>
         <input id="birth_date_input" type="text" class="input3new admissions_input take_placeholder datepicker required_input" name="birth_date" readonly="readonly">
     </span>
</div>
<div class="input_new">
    <label for="year_group_applied_for_input">Year group applied for:</label>
     <span>
         <div class="calendar_select">
             <select class="select form-control form-select required_input" id="year_group_applied_for_input" name="year_group_applied_for_input">
                <option value=""></option>            
                <?php foreach ($year_groups as $key => $year_group) {?>
                    <option value="<?php echo $year_group;?>"><?php echo $year_group;?></option>
                <?php }?>
            </select>              
        </div>
     </span>
</div>
<div class="input_new">
    <label for="requested_date_of_entry_to_the_school_input">Requested date of entry to the school:</label>
     <span>
         <?php /*<input id="requested_date_of_entry_to_the_school_input" type="text" class="input3new admissions_input take_placeholder datepicker required_input" name="requested_date_of_entry_to_the_school" readonly="readonly">*/?>
         <div class="calendar_select">
             <select id="requested_date_of_entry_to_the_school_input" class="select form-control form-select " name="requested_date_of_entry_to_the_school">
                <option value=""></option>            
                <?php foreach ($terms_options as $key => $terms_option) {?>
                    <option value="<?php echo $terms_option;?>"><?php echo $terms_option;?></option>
                <?php }?>
            </select>  
        </div>
     </span>
</div>
<div class="pupil_detailsout">
    <div class="pupil_details-title head_div orange_head">1. Pupil Information</div>
    <div class="pupil_details-table">
        <table border="1">
            <tr>
                <td class="td_center is_head">Pupil's Name</td>
                <td class="td_center is_head">Father's Name</td>
                <td class="td_center is_head">Middle Name</td>
                <td class="td_center is_head">Family Name</td>
            </tr>
            <tr>
                <td><input class="pupil_details input_in_table required_input" id="pupil_details1" type="text" name="pupil_details1" value="" placeholder=""></td>
                <td><input class="pupil_details input_in_table required_input" id="pupil_details2" type="text" name="pupil_details2" value="" placeholder=""></td>
                <td><input class="pupil_details input_in_table required_input" id="pupil_details3" type="text" name="pupil_details3" value="" placeholder=""></td>
                <td><input class="pupil_details input_in_table required_input" id="pupil_details4" type="text" name="pupil_details4" value="" placeholder=""></td>
            </tr>   
            <tr>
                <td class="td_center is_head">Date of Birth</td>
                <td class="td_center is_head">Nationality</td>
                <td class="td_center is_head">Gender</td>
                <td class="td_center is_head">Religion</td>                                    
            </tr>   
            <tr>
                <td><input class="pupil_details input_in_table datepicker required_input" readonly="readonly" id="pupil_details5" type="text" name="pupil_details5" value="" placeholder=""></td>
                <td><input class="pupil_details input_in_table required_input" id="pupil_details6" type="text" name="pupil_details6" value="" placeholder=""></td>
                <td>
                    <div class="calendar_select">
                         <select class="select form-control form-select select_in_table required_input" id="pupil_details7" name="pupil_details7">
                            <option value=""></option>            
                            <?php foreach ($gender_options as $key => $gender_option) {?>
                                <option value="<?php echo $gender_option;?>"><?php echo $gender_option;?></option>
                            <?php }?>
                        </select>              
                    </div>
                </td>
                <td><input class="pupil_details input_in_table required_input" id="pupil_details8" type="text" name="pupil_details8" value="" placeholder=""></td>
            </tr>   
            <tr>
                <td colspan="2" class="td_center is_head">Mother Tongue</td>
                <td colspan="2" class="td_center is_head">Second Language</td>
            </tr>                                   
            <tr>
                <td colspan="2"><input class="pupil_details input_in_table required_input" id="pupil_details9" type="text" name="pupil_details9" value="" placeholder=""></td>
                <td colspan="2"><input class="pupil_details input_in_table required_input" id="pupil_details10" type="text" name="pupil_details10" value="" placeholder=""></td>
            </tr>
        </table>
    </div>                          
</div>      
<div class="pupil_detailsout">
    <div class="pupil_details-title head_div head_div_left">1.1. Applicants with foreign non-Arab nationality:</div>
    <div>
        Will the pupil be exempted from the Egyptian Ministry exams?
        <input type="radio" name="egyptian_ministry_exams" value="1" />YES
        <input type="radio" name="egyptian_ministry_exams" value="0" checked="checked" />NO
    </div>
    <div class="pupil_details-title head_div head_div_left">
        1.2. Will the pupil require bus transportation?  
        <input type="radio" name="transportation" value="1" checked="checked" />YES
        <input type="radio" name="transportation" value="0" />NO        
    </div>
</div>
<div class="parent_informationsout">
    <div class="parent_informations-title head_div orange_head">2. Parent Information</div>
    <div class="parent_informations-table">
        <table border="1">
            <tr>
                <td class="td_center"></td>
                <td class="td_center">Mother</td>
                <td class="td_center">Father</td>
            </tr>
            <tr>
                <td class="td_left is_head">Name</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations1" type="text" name="parent_informations1" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations2" type="text" name="parent_informations2" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Occupation</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations3" type="text" name="parent_informations3" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations4" type="text" name="parent_informations4" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Employer</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations5" type="text" name="parent_informations5" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations6" type="text" name="parent_informations6" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Qualification</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations7" type="text" name="parent_informations7" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations8" type="text" name="parent_informations8" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Nationality</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations9" type="text" name="parent_informations9" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations10" type="text" name="parent_informations10" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">ID Number</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations11" type="text" name="parent_informations11" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations12" type="text" name="parent_informations12" value="" placeholder=""></td>
            </tr>   
            <tr>
                <td class="td_left is_head">Date of Birth</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations13" type="text" name="parent_informations13" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations14" type="text" name="parent_informations14" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Address</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations15" type="text" name="parent_informations15" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations16" type="text" name="parent_informations16" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Home Telephone</td>
                <td><input class="parent_informations input_in_table " id="parent_informations21" type="text" name="parent_informations21" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table " id="parent_informations22" type="text" name="parent_informations22" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Mobile</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations17" type="text" name="parent_informations17" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations18" type="text" name="parent_informations18" value="" placeholder=""></td>
            </tr>
            <tr>
                <td class="td_left is_head">Email</td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations19" type="text" name="parent_informations19" value="" placeholder=""></td>
                <td><input class="parent_informations input_in_table required_input" id="parent_informations20" type="text" name="parent_informations20" value="" placeholder=""></td>
            </tr>
        </table>
    </div>                          
</div>  
<div class="parent_informationsout">
    <div class="parent_informations-title head_div head_div_left">2.1. Parental marital status:  
        <input type="radio" name="marital_status" value="1" checked="checked" />Married
        <input type="radio" name="marital_status" value="0" />Divorced   
        (if so, custody is with: 
        <input class="parent_informations input_in_table marital_status_custody" id="marital_status_custody" type="text" name="marital_status_custody" value="" placeholder="________________________________________________________">
        )
    </div>
    <div class="parent_informations-title head_div head_div_left">2.2. Siblings:  
        <?php for ($i=1; $i <= 4 ; $i++) { ?>
            <div>Name: 
                <input class="parent_informations input_in_table marital_status_custody siblings" id="siblings_<?php echo $i;?>_1" type="text" name="siblings_<?php echo $i;?>_1" value="" placeholder="_______________________________________">
                Age:
                <input class="parent_informations input_in_table marital_status_custody siblings siblings_age" id="siblings_<?php echo $i;?>_2" type="text" name="siblings_<?php echo $i;?>_2" value="" placeholder="_________________________">
                Year:
                <input class="parent_informations input_in_table marital_status_custody siblings siblings_year" id="siblings_<?php echo $i;?>_3" type="text" name="siblings_<?php echo $i;?>_3" value="" placeholder="_________________________">
                Current School:
                <input class="parent_informations input_in_table marital_status_custody siblings" id="siblings_<?php echo $i;?>_4" type="text" name="siblings_<?php echo $i;?>_4" value="" placeholder="_______________________________________">
            </div>
        <?php }?> 
    </div>
</div>
<div class="additional_pupils_informationsout">
    <div class="additional_pupils_informations-title head_div orange_head">3.Additional Pupil Information</div>
    <div class="additional_pupils_informations-table">
        <table border="1">
            <tr>
                <td class="td_center">Name of Previous School <br />(Nursery to Y6)<br /> (most recent first)</td>
                <td class="td_center td_years_attended">Years Attended</td>
                <td class="td_center td_year_group_form_grade">Year Group/ Form / Grade</td>
                <td class="td_center">Curriculum Type<br />(US – UK – Egyptian – Other)</td>
                <?php /*<td class="td_center" style="width: 15%;">School Location</td>*/?>
            </tr>
            <?php for ($i=1; $i <= 5 ; $i++) { 
                $required_input_class = '';
                if($i == 1){
                    $required_input_class = 'required_input';
                }?>
                <tr>
                    <?php for ($j=1; $j <= 4 ; $j++) { ?>
                        <td><input class="additional_pupils_informations input_in_table <?php echo $required_input_class;?>" id="additional_pupils_informations_<?php echo $i.'_'.$j;?>" type="text" name="additional_pupils_informations_<?php echo $i.'_'.$j;?>" value="" placeholder=""></td>
                    <?php }?>
                </tr>
            <?php }?>
        </table>
    </div>                          
</div>  
<div class="additional_pupils_informationsout">
    <div class="additional_pupils_informations-title head_div head_div_left">3.1 Has the pupil ever skipped a year? 
        <input type="radio" name="pupil_skipped" value="1" />YES
        <input type="radio" name="pupil_skipped" value="0" checked="checked" />NO   
        If yes, which year and when? (Please give details): 
        <textarea class="additional_pupils_informations input_in_table marital_status_custody textarea_3" id="pupil_skipped_details" type="text" name="pupil_skipped_details" placeholder="_____________________________________________________________________________"></textarea>
    </div>
    <div class="additional_pupils_informations-title head_div head_div_left">3.2 Has the pupil ever been asked to repeat a year?
        <input type="radio" name="pupil_repeat" value="1" />YES
        <input type="radio" name="pupil_repeat" value="0" checked="checked" />NO   
        If yes, which year and when? (Please give details):
        <textarea class="additional_pupils_informations input_in_table marital_status_custody textarea_3" id="pupil_repeat_details" type="text" name="pupil_repeat_details" placeholder="_____________________________________________________________________________"></textarea>
    </div>
    <div class="additional_pupils_informations-title head_div head_div_left">3.3 Has the pupil ever applied to Ethos International School?                
        <input type="radio" name="pupil_applied" value="1" />YES
        <input type="radio" name="pupil_applied" value="0" checked="checked" />NO   
        If yes, which year and when? (Please give details):
        <textarea class="additional_pupils_informations input_in_table marital_status_custody textarea_3" id="pupil_applied_details" type="text" name="pupil_applied_details" placeholder="_____________________________________________________________________________"></textarea>
    </div>
    <div class="additional_pupils_informations-title head_div head_div_left">3.4 In case of emergency and the school is unable to contact the Parents, please notify:
        <?php for ($i=1; $i <= 2 ; $i++) { ?>
            <div class="additional_pupils_information_div">
                <?php echo $i;?>. Name: 
                <input class=" input_in_table marital_status_custody additional_pupils_information required_input" id="emergency_<?php echo $i;?>_1" type="text" name="emergency_<?php echo $i;?>_1" value="" placeholder="_______________________________________">
                Relation to Pupil:
                <input class="input_in_table marital_status_custody additional_pupils_information required_input" id="emergency_<?php echo $i;?>_2" type="text" name="emergency_<?php echo $i;?>_2" value="" placeholder="_______________________________________">
                Home telephone:
                <input class="input_in_table marital_status_custody additional_pupils_information_telephone required_input" id="emergency_<?php echo $i;?>_3" type="text" name="emergency_<?php echo $i;?>_3" value="" placeholder="_______________________________________">
                Mobile number:
                <input class="input_in_table marital_status_custody additional_pupils_information_mobile required_input" id="emergency_<?php echo $i;?>_4" type="text" name="emergency_<?php echo $i;?>_4" value="" placeholder="________________________________________________">                
            </div>
        <?php }?>
    </div>
</div>
<div class="developmental_historyout">
    <div class="developmental_history-title head_div orange_head">4. Developmental History</div>
    <div class="additional_pupils_informations-table">
        <table border="1">
            <tr>
                <td class="td_center td_left">Does your child have any of the following developmental issues</td>
                <td class="td_center td_years_attended">Yes</td>
                <td class="td_center td_year_group_form_grade">No</td>
            </tr>
            <?php $i = 0;?>
            <tr>
                <td class="td_center td_left">Attention Deficit Disorder / Hyperactive</td>
                <td class="td_center ">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="1" />
                </td>
                <td class="td_center">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="0" checked="checked" />
                </td>
                <?php $i++;?>
            </tr>
            <tr>
                <td class="td_center td_left">Speech and Language Disorder</td>
                <td class="td_center ">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="1" />
                </td>
                <td class="td_center">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="0" checked="checked" />
                </td>
                <?php $i++;?>
            </tr>
            <tr>
                <td class="td_center td_left">Developmental Delay</td>
                <td class="td_center ">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="1" />
                </td>
                <td class="td_center">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="0" checked="checked" />
                </td>
                <?php $i++;?>
            </tr>
            <tr>
                <td class="td_center td_left">Behavioral Issues</td>
                <td class="td_center ">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="1" />
                </td>
                <td class="td_center">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="0" checked="checked" />
                </td>
                <?php $i++;?>
            </tr>
            <tr>
                <td class="td_center td_left">Has your child been diagnosed / assessed for any learning disabilities / challenges</td>
                <td class="td_center ">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="1" />
                </td>
                <td class="td_center">
                    <input type="radio" name="developmental_history<?php echo $i;?>" value="0" checked="checked" />
                </td>
                <?php $i++;?>
            </tr>
            <tr>
                <td colspan="3" class="td_left">Other/s (please specify
                    <input style="width: 70%;" class="input_in_table" type="text" name="developmental_history<?php echo $i;?>" value="" placeholder="________________________________________________________________________________________________">)
                </td>
            </tr>
        </table>
    </div>   
</div> 
<div class="developmental_history_out">
    <ul style="list-style-type: disc;">
        <li>I hereby apply for the admission of the fore mentioned pupil to Ethos International School. All the information I have provided is true and accurate.</li>
        <li>
            I agree:<ul style="list-style-type: square;">
                <li>That my child and I will abide by and support all the rules, code of conduct and school’s regulations.</li>
                <li>To accept all decisions of the school directors.</li>
                <li>To ensure that my child wears the official school uniform</li>
                <li>To pay all the school fees promptly as requested.</li>
            </ul>
        </li>
    </ul>
    <?php /*<input type="hidden" name="date" value="<?php echo date('d-m-Y');?>" />*/?>
    <input id="i_agree" type="checkbox" name="i_agree" class="required_input" />I agree
</div>  
<div class="ajax_result_admissions">        
    <div id="admissions_ajaxLoading"></div>
    <div id="admissions_result"></div>
</div>
<div class="send_form">
    <input class="Send white_green_button" type="submit" id="send_form_admissions" value="Send" />
</div>
<?php echo $this->Form->end();?>