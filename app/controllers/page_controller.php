<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class PageController  extends AppController {
	var $name = 'Page';
	var $uses = null;
	var $components = array('Email', 'Upload');	
	function index(){
		$this->redirect(array('controller'=>'/'));
	}
	function view($cat_id){
	    $this->redirect(array('controller'=>'/'));					
	}
	function show($cat_id, $childid = 0){
	    $base_url = BASE_URL;
	    $tree = array();
        $image = '';
        $this->loadModel('Cat');
        $parent_cat = $this->Cat->find(
            'first', array(
                'conditions' => array('Cat.approved' => 1, 'Cat.id' => $cat_id),
                'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
            )           
        );        
        if(isset($parent_cat['ChildCat']) && $childid == 0){
            if(!empty($parent_cat['ChildCat'])){
               
                if(isset($parent_cat['ChildCat'][0]['id'])){
                    $childCat_0_id = $parent_cat['ChildCat'][0]['id'];
                    $in_url = $base_url.'/page/show/'.$cat_id.'/'.$childCat_0_id;
                    if($parent_cat['ChildCat'][0]['has_url'] == 1){
                        if (strpos($parent_cat['ChildCat'][0]['url'], 'http') !== FALSE) {
                            $in_url = $parent_cat['ChildCat'][0]['url'];
                        }else{
                            $in_url = $base_url.$parent_cat['ChildCat'][0]['url'];
                        }
                    }  
                    $this->redirect($in_url);                  
                }                
            }            
        }	    
		//$this->set('parent_cat' , $parent_cat);
        $parent_title = $title = $parent_cat['Cat']['title'];
        $meta_keywords = $parent_cat['Cat']['meta_keywords'];
        $meta_description = $parent_cat['Cat']['meta_description'];
        if(isset($parent_cat['Cat']['image'])){
            if(trim($parent_cat['Cat']['image']) != ''){
                $this->mainSmartResizeImage($parent_cat['Cat']['image']);
                $image = $base_url.'/img/upload/'.$parent_cat['Cat']['image'];
            }
        }
        if($childid != 0 && is_numeric($childid)){
            $child_cat = $this->Cat->find(
                'first', array(
                    'conditions' => array('Cat.approved' => 1, 'Cat.id' => $childid),
                    'order' => array('Cat.weight' => 'ASC', 'Cat.id'=>'DESC')
                )           
            );      
            //$this->set('child_cat' , $child_cat);
            $title = $child_cat['Cat']['title'];
            $meta_keywords = $child_cat['Cat']['meta_keywords'];
            $meta_description = $child_cat['Cat']['meta_description'];
            if(isset($child_cat['Cat']['image'])){
                if(trim($child_cat['Cat']['image']) != ''){
                    $this->mainSmartResizeImage($child_cat['Cat']['image']);
                    $image = $base_url.'/img/upload/'.$child_cat['Cat']['image'];
                }
            }
            if($childid == 14){
                $this->set('mission_vision_values' , 1);  
                $this->loadModel('Value');
                $values = $this->Value->find(
                    'all', array(
                        'conditions' => array('Value.approved' => 1),
                        'order' => array('Value.weight' => 'ASC', 'Value.id'=>'DESC'),
                        //'limit' => 4
                    )           
                );
                $this->set('values_data' , $values);               
            }
            if($childid == 16){
                $this->set('testimonials' , 1); 
                $this->loadModel('Testimonial');
                $testimonials = $this->Testimonial->find(
                    'all', array(
                        'conditions' => array('Testimonial.approved' => 1),
                        'order' => array('Testimonial.weight' => 'ASC', 'Testimonial.id'=>'DESC'),
                        //'limit' => 4
                    )           
                );
                $this->set('testimonials_data' , $testimonials);               
            }
            if($childid == 19){
                $this->set('whoiswho' , 1); 
                $this->loadModel('TeamMember');
                $members = $this->TeamMember->find(
                    'all', array(
                        'conditions' => array('TeamMember.approved' => 1),
                        'order' => array('TeamMember.weight' => 'ASC', 'TeamMember.id'=>'DESC'),
                        //'limit' => 4
                    )           
                );
                $this->set('members' , $members);
            }
            if($childid == 23){
                $this->set('admissions' , 1);
            } 
        }
		$this->set('title_for_layout' , strip_tags($title));		
		$this->set(
			array(
				'metaKeywords'     => $meta_keywords,
				'metaDescription'  => $meta_description,
			)
		);	
        $this->set('selected', strtolower(str_replace(' ', '', $parent_title)));   
        if(isset($parent_cat) && !empty($parent_cat)){
            $url = '';
            if(isset($child_cat) && !empty($child_cat)){
                $url = '';
            }
            $tree[] = array('url' => '/page/show/'.$parent_cat['Cat']['id'], 'str' => $parent_cat['Cat']['title']);    
        }
        if(isset($child_cat) && !empty($child_cat)){
            $tree[] = array('url' => '', 'str' => $child_cat['Cat']['title']);    
        }   
        $this->set('tree' , $tree);
        $this->set('title' , $parent_title);
        $body = '';
        if(isset($child_cat) && !empty($child_cat)){
            $body = $child_cat['Cat']['body'];            
        }elseif(isset($parent_cat) && !empty($parent_cat)){
            $body = $parent_cat['Cat']['body'];
        }     
        $pdf_file = '';
        $pdf_name = '';
        if(isset($child_cat['Cat']['pdf_file'])){
            if(trim($child_cat['Cat']['pdf_file']) != ''){
                $pdf_file = BASE_URL."/app/webroot/files/upload/".$child_cat['Cat']['pdf_file'];
                $pdf_name = str_replace('.pdf', '', $child_cat['Cat']['pdf_file']);
                $pdf_name = substr($pdf_name,0,strrpos($pdf_name,"_"));
                $pdf_name = 'Click here for '.str_replace('_', ' ', $pdf_name);
            }            
        }
        $body = $this->linkify_mail($body);
        $this->set('body' , $body);     
        $this->set('image' , $image);
        $this->set('pdf_file' , $pdf_file);
        $this->set('pdf_name' , $pdf_name);                
        //if($cat_id == 4){
            $cats = $this->Cat->find(
                'all', array(
                    'conditions' => array('Cat.approved' => 1, 'Cat.parent_id' => $cat_id),
                    'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
                )           
            );   
            $this->set('cats' , $cats);    
            $this->set('childid' , $childid);                 
        //}
	}	
    function academic($id = 0){
        $tree = array();
        $this->loadModel('Academic');
        $academic = $this->Academic->find(
            'first', array(
                'conditions' => array('Academic.approved' => 1, 'Academic.id' => $id),
                'order' => array('Academic.id'=>'DESC')
            )           
        );  
        $title = $academic['Academic']['title'];
        $body = $academic['Academic']['body'];
        $this->set('title' , $title);
        $this->set('body' , $body);
        $this->set('title_for_layout', strip_tags($title));            
        $this->set('selected', 'academics');                 
        $tree[] = array('url' => '', 'str' => $academic['Academic']['title']);    
        $this->set('tree' , $tree);
        $this->render('show');   
    }
    function search(){
        $keyword = '';
        if(isset($_GET['k'])){
            $keyword = $_GET['k'];
        }
        $original_keyword = $keyword;
        $all_data = array();
        if(trim($keyword) != ''){
            ini_set("max_execution_time",9999);
            set_time_limit(9999);
            $this->loadModel('Cat');
            $allTables = array();
            $allTablesFields = array();           
            /*$temp = $this->Cat->query("SHOW TABLES");
            if(!empty($temp)){
                foreach ($temp as $key => $value) {
                    $allTables[] = $value['TABLE_NAMES']['Tables_in_ethos'];
                }
            }*/
            $allTables = array('testimonials', 'cats', 'careers', 'events', 'developments',
                                              'articles', 'academics', 'albums', 'team_members', 'values');
            foreach ($allTables as $key => $tableName) {
                $temp = $this->Cat->query("SHOW COLUMNS FROM `".$tableName."`");
                if(!empty($temp)){
                    $fieldArray=array();
                    foreach ($temp as $key => $value) {
                        $type = $value['COLUMNS']['Type'];
                        $pos = strpos($type,"(");
                        if($pos !== false){
                            $type=substr($type, 0, $pos);
                        }
                        $fieldArray[]=array($value['COLUMNS']['Field'], $type); 
                    }
                    $allTablesFields[$tableName] = $fieldArray;     
                }
            }
            $data = array();            
            $excepted_fields = array('to_email', 'tab_title', 'position');
            foreach($allTablesFields as $tableName=>$fieldArray){                
                $tmp=array();
                foreach($fieldArray as $fields){
                    $field=$fields[0];
                    if(!in_array($field, $excepted_fields)){
                        $type=$fields[1];
                        $typeO=$type;
                        if(is_int($keyword)){
                            $typeOfKeyword="int";                       
                        }
                        elseif(is_array($keyword)){
                            $typeOfKeyword="array";                     
                        }
                        elseif(is_bool($keyword)){
                            $typeOfKeyword="boolean";                       
                        }
                        elseif(is_string($keyword)){
                            $typeOfKeyword="string";                        
                        }
                        elseif(is_float($keyword)){
                            $typeOfKeyword="float";                     
                        }
                        if($type=="int" || $type=="smallint" || $type=="largeint" || $type=="tinyint" || $type=="mediumint"|| $type=="boolean"){
                            $type="int";
                        }
                        if($type=="varchar" || $type=="char" || $type=="datetime" || $type=="text" || $type=="longtext"){
                            $type="string";
                        }
                        $type=strtolower($type);
                        $typeO=strtolower($typeO);
                        $typeOfKeyword=strtolower($typeOfKeyword);                  
                        $type=trim($type);
                        $typeOfKeyword=trim($typeOfKeyword);
                        $typeO=trim($typeO);                                        
                        if($type==$typeOfKeyword){
                            if($type != 'int'){
                                $keyword=strtolower($keyword);
                                $sql="SELECT * FROM `$tableName` WHERE lower(`$field`) like '%$keyword%' OR lower(`$field`) like '$keyword%' OR lower(`$field`) like '%$keyword'";                          
                                $temp = $this->Cat->query($sql);
                                if(!empty($temp)){
                                    if(count($temp) > 0){
                                        $all_data = array_merge($temp, $all_data);                                
                                        //$tmp[]=array('FieldName'=>$field,"Query"=>$sql);                                
                                    }
                                }
                            }
                        }
                    }                   
                }
                /*if(count($tmp)>0){
                    $data[$tableName]=$tmp;
                }*/
            }
        }
        $title = 'Search';
        $title_for_layout = 'Search for "'.$original_keyword.'"';
        $this->set('all_data', $all_data);
        $this->set('title_for_layout', $title_for_layout);            
        $this->set('selected', 'search');                 
        $tree[] = array('url' => '', 'str' => $title);    
        $this->set('tree' , $tree);
        $this->set('all_tables' , $allTables);        
    }
    function admissionsform($type = 'notajax'){
        if(!empty($_POST)){
            $upload_dir = ROOT.DS.APP_DIR.DS.'tmp'.DS.'tmpcv'.DS;
            if (!file_exists($upload_dir)) {
                 mkdir($upload_dir, 0777);
            } 
            $current_year = date('Y');
            $current_month = date('m');
            $dir_name_with_year = $upload_dir.'/'.$current_year;
            if (!file_exists($dir_name_with_year)) {
                mkdir($dir_name_with_year, 0777);
            }
            $dir_name_with_month = $upload_dir.'/'.$current_year.'/'.$current_month;
            if (!file_exists($dir_name_with_month)) {
                mkdir($dir_name_with_month, 0777);
            }
            $final_upload_dir = $upload_dir.'/'.$current_year.'/'.$current_month.'/';
            $file_path = '';   
            if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){ 
                $file_name = str_replace("#", "_", basename($_FILES['file']['name']));
                $file_name = str_replace("?", "_", $file_name);
                $file_name = str_replace(" ", "_", $file_name);
                $file = $final_upload_dir.$file_name; 
                if (file_exists($file)) {
                    $file_name = time().$file_name;
                }
                $file = $final_upload_dir.$file_name;                 
                if(isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != ''){
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $file)){
                        $file_path = $file;
                    }
                }
            }
            $this->loadModel('Setting');            
            $settings = $this->Setting->read(null, 1);
            $this->loadModel('Cat');            
            $cat = $this->Cat->read(null, 23);         
            $to = $cat['Cat']['to_email'];
            $from = $to;      
            $subject = $cat['Cat']['title'];
            $this->Email->to = $to;
            $this->Email->subject = $subject;           
            $this->Email->replyTo = $from;
            $this->Email->from = $subject.'<'.$from.'>';                
            $this->Email->sendAs = 'html';
            $this->Email->template = 'admissions';
            if($file_path != ''){
                $this->Email->attachments = array($file_path);  
            }
            $html = '';
            $tr_html = '<tr>
                    <td class="td_left">
                        <font class="element">{{key}}:</font>
                    </td>
                    <td>
                        <font class="element">{{value}}</font>
                    </td>
                </tr>';
            $inputs = array('child_name' => 'Child’s Name', 'birth_date' => 'Date of Birth',
                            'year_group_applied_for_input' => 'Year group applied for', 
                            'requested_date_of_entry_to_the_school' => 'Requested date of entry to the school',
                            'date' => 'Date');
            foreach ($inputs as $k => $v) {
                if($k == 'date'){
                    $key = $v;
                    $value = date('d-m-Y');
                    $html .= str_replace(array('{{key}}', '{{value}}'), array($key, $value), $tr_html);                    
                }elseif(isset($_POST[$k])){
                    $key = $v;
                    $value = $_POST[$k];
                    $html .= str_replace(array('{{key}}', '{{value}}'), array($key, $value), $tr_html);            
                }
            }
            $space_html = '<tr><td colspan="2" align="center" height="30"></td></tr>';
            $head_html = '<tr class="head">
                <td height="30" colspan="2" class="title_td">
                    <font class="title">
                        <strong>{{head}}</strong>
                    </font>
                </td>
            </tr>';
            $head_html = $space_html.$head_html.$space_html;
            $html .= str_replace(array('{{head}}'), array('1. Pupil Details'), $head_html);
            for ($i=1; $i <= 10; $i++) {
                $pupil_details[$i] = '';
                if(isset($_POST['pupil_details'.$i])){
                    $pupil_details[$i] = $_POST['pupil_details'.$i];
                }
            }
            $html .= '<tr><td colspan="2"><table border="1" class="admissions">
                <tr>
                    <td class="td_center is_head">Pupil\'s Name</td>
                    <td class="td_center is_head">Father\'s Name</td>
                    <td class="td_center is_head">Middle Name</td>
                    <td class="td_center is_head">Family Name</td>
                    
                </tr>
                <tr>
                    <td>'.$pupil_details[1].'</td>
                    <td>'.$pupil_details[2].'</td>
                    <td>'.$pupil_details[3].'</td>
                    <td>'.$pupil_details[4].'</td>
                </tr>   
                <tr>
                    <td class="td_center is_head">Date of Birth</td>
                    <td class="td_center is_head">Nationality</td>
                    <td class="td_center is_head">Gender</td>
                    <td class="td_center is_head">Religion</td>                                    
                </tr>   
                <tr>
                    <td>'.$pupil_details[5].'</td>
                    <td>'.$pupil_details[6].'</td>
                    <td>'.$pupil_details[7].'</td>
                    <td>'.$pupil_details[8].'</td>
                </tr>   
                <tr>
                    <td colspan="2" class="td_center is_head">Mother Tongue</td>
                    <td colspan="2" class="td_center is_head">Second Language</td>
                </tr>                                   
                <tr>
                    <td colspan="2">'.$pupil_details[9].'</td>
                    <td colspan="2">'.$pupil_details[10].'</td>
                </tr>
            </table></td></tr>';
            if(isset($_POST['egyptian_ministry_exams']) || isset($_POST['transportation'])){
                $html .= '<tr><td colspan="2">';
                if(isset($_POST['egyptian_ministry_exams'])){
                    $html .= '<div class="pupil_details-title head_div head_div_left">1.1. Applicants with foreign non-Arab nationality:</div>
                    <div>
                        Will the pupil be exempted from the Egyptian Ministry exams? ';
                        if($_POST['egyptian_ministry_exams'] == 1){
                            $html .= 'YES';
                        }else{
                            $html .= 'NO';
                        }
                    $html .= '</div>';
                }
                if(isset($_POST['transportation'])){
                    $html .= '<div class="pupil_details-title head_div head_div_left">
                        1.2. Will the pupil require bus transportation? ';
                    if($_POST['transportation'] == 1){
                        $html .= 'YES';
                    }else{
                        $html .= 'NO';
                    }  
                    $html .= '</div>';
                }
                $html .= '</td></tr>';
            }
            $html .= str_replace(array('{{head}}'), array('2. Parent Information'), $head_html);
            for ($i=1; $i <= 22; $i++) {
                $parent_informations[$i] = '';
                if(isset($_POST['parent_informations'.$i])){
                    $parent_informations[$i] = $_POST['parent_informations'.$i];
                }
            }
            $html .= '<tr><td colspan="2">
                <table border="1" class="odd_even_table">
                    <tr>
                        <td class="td_center is_head"></td>
                        <td class="td_center is_head">Mother</td>
                        <td class="td_center is_head">Father</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Name</td>
                        <td class="td_center">'.$parent_informations[1].'</td>
                        <td class="td_center">'.$parent_informations[2].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Occupation</td>
                        <td class="td_center">'.$parent_informations[3].'</td>
                        <td class="td_center">'.$parent_informations[4].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Employer</td>
                        <td class="td_center">'.$parent_informations[5].'</td>
                        <td class="td_center">'.$parent_informations[6].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Qualification</td>
                        <td class="td_center">'.$parent_informations[7].'</td>
                        <td class="td_center">'.$parent_informations[8].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Nationality</td>
                        <td class="td_center">'.$parent_informations[9].'</td>
                        <td class="td_center">'.$parent_informations[10].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">ID Number</td>
                        <td class="td_center">'.$parent_informations[11].'</td>
                        <td class="td_center">'.$parent_informations[12].'</td>
                    </tr>   
                    <tr>
                        <td class="td_left is_head">Date of Birth</td>
                        <td class="td_center">'.$parent_informations[13].'</td>
                        <td class="td_center">'.$parent_informations[14].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Address</td>
                        <td class="td_center">'.$parent_informations[15].'</td>
                        <td class="td_center">'.$parent_informations[16].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Home Telephone</td>
                        <td class="td_center">'.$parent_informations[21].'</td>
                        <td class="td_center">'.$parent_informations[22].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Mobile</td>
                        <td class="td_center">'.$parent_informations[17].'</td>
                        <td class="td_center">'.$parent_informations[18].'</td>
                    </tr>
                    <tr>
                        <td class="td_left is_head">Email</td>
                        <td class="td_center">'.$parent_informations[19].'</td>
                        <td class="td_center">'.$parent_informations[20].'</td>
                    </tr>
                </table>
            </td></tr>';
            if(isset($_POST['marital_status']) || isset($_POST['marital_status_custody'])){
                $html .= '<tr><td colspan="2">';
                if(isset($_POST['marital_status'])){
                    $html .= '<div class="parent_informations-title head_div head_div_left">2.1. Parental marital status:';
                        if($_POST['marital_status'] == 1){
                            $html .= 'Married';
                        }else{
                            $html .= 'Divorced';
                        }
                        if(isset($_POST['marital_status_custody']) && trim($_POST['marital_status_custody']) != ''){
                            $html .= ' (if so, custody is with: '.$_POST['marital_status_custody'].')';
                        }
                    $html .= '</div>';
                }                
                $html .= '</td></tr>';
            }
            $html .= '<tr><td colspan="2"><div class="parent_informations-title head_div head_div_left">2.2. Siblings:</div></td></tr>';
            for ($i=1; $i <= 4; $i++) {
                for ($j=1; $j <= 4; $j++) {
                    $siblings[$i][$j] = '';
                    if(isset($_POST['parent_informations'.$i])){
                        $siblings[$i][$j] = $_POST['siblings_'.$i.'_'.$j];
                    }
                }
            }
            $html .= '<tr><td colspan="2">
                <table border="1" class="odd_even_table">
                    <tr>
                        <td class="td_center is_head">Name</td>
                        <td class="td_center is_head">Age</td>
                        <td class="td_center is_head">Year</td>
                        <td class="td_center is_head">Current School</td>
                    </tr>';
            for ($i=1; $i <= 4; $i++) {
                $html .= '<tr>';
                for ($j=1; $j <= 4; $j++) {
                    $html .= '<td class="td_center">'.$siblings[$i][$j].'</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table>
            </td></tr>';
            $html .= str_replace(array('{{head}}'), array('3.Additional Pupils Information'), $head_html);
            for ($i=1; $i <= 20; $i++) {
                for ($j=1; $j <= 5; $j++) {
                    $additional_pupils_informations[$i.'_'.$j] = '';
                    if(isset($_POST['additional_pupils_informations_'.$i.'_'.$j])){
                        $additional_pupils_informations[$i.'_'.$j] = $_POST['additional_pupils_informations_'.$i.'_'.$j];
                    }
                }
            }
            $html .= '<tr><td colspan="2">
            <table border="1" class="odd_even_table">
            <tr>
                <td class="td_center is_head">Name of Previous School <br />(Nursery to Y6)<br /> (most recent first)</td>
                <td class="td_center td_years_attended is_head">Years Attended</td>
                <td class="td_center td_year_group_form_grade is_head">Year Group/ Form / Grade</td>
                <td class="td_center is_head">Curriculum Type<br />(US – UK – Egyptian – Other)</td>';
                //<td class="td_center is_head" style="width: 15%;">School Location</td>
            $html .= '</tr>';
            for ($i=1; $i <= 5 ; $i++) {
                $html .= '<tr>';
                for ($j=1; $j <= 4 ; $j++) {
                    $html .= '<td class="td_center">'.$additional_pupils_informations[$i.'_'.$j].'</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table>
            </td></tr>';
            $html .= '<tr><td colspan="2">';
            $html .= '<div class="additional_pupils_informations-title head_div head_div_left">3.1 Has the pupil ever skipped a year? ';
            if($_POST['pupil_skipped'] == 1){
                $html .= 'YES';
            }else{
                $html .= 'NO';
            }
            if(trim($_POST['pupil_skipped_details']) != ''){
                $html .= ' If yes, which year and when? (Please give details): '.$_POST['pupil_skipped_details'];
            }
            $html .= '</div>';
            $html .= '</td></tr>';
            $html .= '<tr><td colspan="2">';
            $html .= '<div class="additional_pupils_informations-title head_div head_div_left">3.2 Has the pupil ever been asked to repeat a year? ';
            if($_POST['pupil_repeat'] == 1){
                $html .= 'YES';
            }else{
                $html .= 'NO';
            }
            if(trim($_POST['pupil_repeat_details']) != ''){
                $html .= ' If yes, which year and when? (Please give details): '.$_POST['pupil_repeat_details'];
            }
            $html .= '</div>';
            $html .= '</td></tr>';
            $html .= '<tr><td colspan="2">';
            $html .= '<div class="additional_pupils_informations-title head_div head_div_left">3.3 Has the pupil ever applied to Ethos International School? ';
            if($_POST['pupil_applied'] == 1){
                $html .= 'YES';
            }else{
                $html .= 'NO';
            }
            if(trim($_POST['pupil_applied_details']) != ''){
                $html .= ' If yes, which year and when? (Please give details): '.$_POST['pupil_applied_details'];
            }
            $html .= '</div>';
            $html .= '</td></tr>';
            $html .= '<tr><td colspan="2">';
            $html .= '<div class="additional_pupils_informations-title head_div head_div_left">3.4 In case of emergency and the school is unable to contact the Parents, please notify: ';
            $html .= '</div>';
            $html .= '</td></tr>';
            $html .= '<tr><td colspan="2">
                <table border="1" class="odd_even_table">
                    <tr>
                        <td class="td_center is_head">Name</td>
                        <td class="td_center is_head">Relation to Pupil</td>
                        <td class="td_center is_head">Home telephone</td>
                        <td class="td_center is_head">Mobile number</td>
                    </tr>';
            for ($i=1; $i <= 2; $i++) {
                $html .= '<tr>';
                for ($j=1; $j <= 4; $j++) {
                    $html .= '<td class="td_center">';
                    if(isset($_POST['emergency_'.$i.'_'.$j])){
                        $html .= $_POST['emergency_'.$i.'_'.$j].' ';
                    }
                    $html .= '</td>';
                }
                $html .= '</tr>';
            }
            $html .= '</table>
            </td></tr>';
            $html .= str_replace(array('{{head}}'), array('4. Developmental History'), $head_html);            
            $html .= '<tr><td colspan="2">';
            $html .= '<table border="1" class="odd_even_table">
            <tr>
                <td class="td_center td_left is_head">Does your child have any of the following developmental issues</td>
                <td class="td_center td_years_attended is_head">Yes</td>
                <td class="td_center td_year_group_form_grade is_head">No</td>
            </tr>';
            $i = 0;
            $right_mark = '&#10004;';
            $html .= '<tr>
            <td class="td_center td_left">Attention Deficit Disorder / Hyperactive</td>
            <td class="td_center ">';
            if($_POST['developmental_history'.$i] == 1){
                $html .= $right_mark;
            }
            $html .= '</td>
            <td class="td_center">';
            if($_POST['developmental_history'.$i] == 0){
                $html .= $right_mark;
            }
            $html .= '</td>';
            $i++;
            $html .= '</tr>
            <tr>
                <td class="td_center td_left">Speech and Language Disorder</td>
                <td class="td_center ">';
            if($_POST['developmental_history'.$i] == 1){
                $html .= $right_mark;
            }
            $html .= '</td>
            <td class="td_center">';
            if($_POST['developmental_history'.$i] == 0){
                $html .= $right_mark;
            }
            $html .= '</td>';
            $i++;
            $html .= '</tr>
            <tr>
                <td class="td_center td_left">Developmental Delay</td>
                <td class="td_center ">';
            if($_POST['developmental_history'.$i] == 1){
                $html .= $right_mark;
            }
            $html .= '</td>
            <td class="td_center">';
            if($_POST['developmental_history'.$i] == 0){
                $html .= $right_mark;
            }
            $html .= '</td>';
            $i++;
            $html .= '</tr>';
            $html .= '<tr>
                <td class="td_center td_left">Behavioral Issues</td>
                <td class="td_center ">';
            if($_POST['developmental_history'.$i] == 1){
                $html .= $right_mark;
            }
            $html .= '</td>
            <td class="td_center">';
            if($_POST['developmental_history'.$i] == 0){
                $html .= $right_mark;
            }
            $html .= '</td>';
            $i++;
            $html .= '</tr>';
            $html .= '<tr>
                <td class="td_center td_left">Has your child been diagnosed / assessed for any learning disabilities / challenges</td>
                <td class="td_center ">';
            if($_POST['developmental_history'.$i] == 1){
                $html .= $right_mark;
            }
            $html .= '</td>
            <td class="td_center">';
            if($_POST['developmental_history'.$i] == 0){
                $html .= $right_mark;
            }
            $html .= '</td>';
            $i++;
            $html .= '</tr>';
            $html .= '<tr>
                <td colspan="3" class="td_left">Other/s (please specify ';
            if($_POST['developmental_history'.$i] == 0){
                $html .= $_POST['developmental_history'.$i];
            }
            $html .= ')
                </td>
            </tr>
            </table>';
            $html .= '</td></tr>';
            $this->set('html', $html);            
            $this->set('subject', $subject);
            //$this->set('url', BASE_URL);                     
            if ($this->Email->send()){
                echo __('<span style="color:#00FF00;">Thank you for your message. He will get back to you the soonest.</span>', true);
                //echo __('Thank you for your message. He will get back to you the soonest.', true);           
            }
            else{
                echo __('There was a problem sending the Email. Please try again.', true);
            }               
        }
        if($type == 'notajax'){
            $this->redirect(BASE_URL.'/');
        }elseif($type == 'ajax'){
            $this->autoRender = false;
        }   
    }  
}