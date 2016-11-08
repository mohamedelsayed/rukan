<div class="header_big">
	<div class="header">
		<div class="logo">
			<a href="<?php echo BASE_URL.'/forum';?>">
				<img src="<?php echo BASE_URL.'/img/front/logo.png';?>" />
			</a>
		</div>
		<?php if(!empty($quote)){
			$quote_name = $quote['Quote']['name'];
			$quote_body = strip_tags(trim($quote['Quote']['body']));?>
			<div class="men_etop">
				<div class="men_e">"<?php echo $quote_body;?>"</div>
				<div class="men_a">- <?php echo $quote_name;?></div>
			</div>
		<?php }?>
	</div>
</div>
<div class="menu_big">
	<div class="menu">
		<ul id="jMenu">
			<li>
				<a href="<?php echo BASE_URL.'/forum';?>" class="fNiv" id="home" ><?php echo $this->Session->read('Setting.home_string');?></a>           
            </li>
            <?php if($userInfoFront){?>
            	<?php if($isAdmin == 1){?>
            		<li>
		            	<a title="Admin" id="adminlink" class="fNiv">Admin</a> 	            
	            		<ul>
	            			<li class="submenu">
	            				<a style="width: 200px;" title="Users" id="userslink" href="<?php echo BASE_URL.'/members';?>">Members</a>
			        		</li>
			        		<li class="submenu">
	            				<a style="width: 200px;" title="Categories" id="categorieslink" href="<?php echo BASE_URL.'/categories';?>">Categories</a>
			        		</li>
			        		<li class="submenu">
	            				<a style="width: 200px;" title="Posts" id="postslink" href="<?php echo BASE_URL.'/posts';?>">Posts</a>
			        		</li>	
			        		<li class="submenu">
	            				<a style="width: 200px;" title="Comments" id="commentslink" href="<?php echo BASE_URL.'/forum_comments';?>">Comments</a>
			        		</li>	
			        		<li class="submenu">
	            				<a style="width: 200px;" title="Announcements" id="announcementslink" href="<?php echo BASE_URL.'/announcements';?>">Announcements</a>
			        		</li>	
			        		<li class="submenu">
	            				<a style="width: 200px;" title="Events" id="eventslink" href="<?php echo BASE_URL.'/events';?>">Events</a>
			        		</li>		        		
		        		</ul>
	        		</li> 	            
	            <?php }?>
	            <li>
	            	<a title="Announcements" id="announcementsall" href="<?php echo BASE_URL.'/announcements/all';?>" class="fNiv">Announcements</a>           
	            </li>
	            <li>
	            	<a title="Calendar" id="Calendar" href="<?php echo BASE_URL.'/calendar';?>" class="fNiv">Calendar</a>           
	            </li>
	            <li>
	            	<a title="Contacts" id="Contacts" href="<?php echo BASE_URL.'/members/all';?>" class="fNiv">Contacts</a>           
	            </li>
	            <li>
	            	<a title="Edit Profile" id="editProfile" href="<?php echo BASE_URL.'/members/edit';?>" class="fNiv">Edit Profile</a>           
	            </li>            
	            <li>
	            	<a title="Logout" id="logout" href="<?php echo BASE_URL.'/forum/logout';?>" class="fNiv">Logout</a>           
	            </li> 
            <?php }?>           
        </ul>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#jMenu").jMenu({
    	ulWidth : '300',
    	absoluteTop: 40,}
	);
});
</script>
<?php if(isset($selected)){?>
	<script type="text/javascript">
	$(document).ready(function(){
	 	$(".fNiv").removeClass('selected');
	 	$("#<?php echo $selected;?>").addClass('selected');	 
	});
	</script>
<?php }?>