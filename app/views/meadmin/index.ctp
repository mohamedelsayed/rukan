<table width="100%" border="0" cellspacing="0" cellpadding="0" class="home">
	<tr>        
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" width="93" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/settings';?>">
                    		<?php echo $this->Html->image('backend/Settings-icon.png',  array('border' => '0','width'=>'75'));?>
                		</a>
            		</td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/settings';?>">Settings</a>
                	</td>
                </tr>
            </table>
		</td> 
    	<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" width="93" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/users';?>">
                    		<?php echo $this->Html->image('backend/Users-icon.png',  array('border' => '0','height'=>'75'));?>
                		</a>
            		</td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/users';?>">Users</a>
                	</td>
                </tr>
            </table>
		</td>    
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                        <a href="<?php echo $this->Session->read('Setting.url').'/articles';?>">
                            <?php echo $this->Html->image('backend/articles_icon.gif',  array('border' => '0','height'=>'75'));?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                        <a href="<?php echo $this->Session->read('Setting.url').'/articles';?>">Articles</a>
                    </td>
                </tr>
            </table>
        </td> 
        <?php /*<td align="center"  width="20%">
            <table style="border: 2px solid #F3F3F3;"  height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/cats';?>">
                    		<?php echo $this->Html->image('backend/organization.png',  array('border' => '0','height'=>'75'));?>
                		</a>
            		</td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/cats';?>">Categories</a>
                	</td>
                </tr>
            </table>
		</td>        
        <td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/nodes';?>">
                    		<?php echo $this->Html->image('backend/node-icon.png',  array('border' => '0','height'=>'75'));?>
                		</a>
            		</td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/nodes';?>">Nodes</a>
                	</td>
                </tr>
            </table>
		</td>                
        <td align="center" width="20%">
	        <table style="border: 2px solid #F3F3F3;"  height="80" border="0" cellpadding="0" cellspacing="0">
	            <tr>
	                <td height="80" align="center">
	                	<a href="<?php echo $this->Session->read('Setting.url').'/faqs';?>">
	                		<?php echo $this->Html->image('backend/icon-faqs.gif',  array('border' => '0','height'=>'75'));?>
                		</a>
            		</td>
	            </tr>
	            <tr>
	                <td align="center" valign="top" class="icontitle">
	                	<a href="<?php echo $this->Session->read('Setting.url').'/faqs';?>">FAQs</a>
                	</td>
	            </tr>
	        </table>	
        </td>*/?>
    </tr>  
</table>
<?php /*<table width="100%" border="0" cellspacing="0" cellpadding="0" class="home">
    <tr>        
		<?php /*<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/comments';?>">
                    	    <?php echo $this->Html->image('backend/comment_icon.png',  array('border' => '0','height'=>'75'));?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/comments';?>">Comments</a>
                	</td>
                </tr>
            </table>
		</td>/?>      
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/quotes';?>">
                    	    <?php echo $this->Html->image('backend/Quotes.jpg',  array('border' => '0','height'=>'75'));?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/quotes';?>">Quotes</a>
                	</td>
                </tr>
            </table>
		</td> 
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/slideshows';?>">
                    	    <?php echo $this->Html->image('backend/Slideshows.jpg',  array('border' => '0','height'=>'75'));?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/slideshows';?>">Slideshows</a>
                	</td>
                </tr>
            </table>
		</td>      
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/team_members';?>">
                    	    <?php echo $this->Html->image('backend/TeamMembers.jpg',  array('border' => '0','height'=>'75'));?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/team_members';?>">Members</a>
                	</td>
                </tr>
            </table>
		</td>       
    </tr>  
</table>*/?>
<?php /*
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="home">
    <tr> 
    	<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/testimonials';?>">
                    	    <?php echo $this->Html->image('backend/Testimonials.jpg',  array('border' => '0','height'=>'75'));?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/testimonials';?>">Testimonials</a>
                	</td>
                </tr>
            </table>
		</td>
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/contents/edit/1';?>">
                    	    <?php echo $this->Html->image('backend/ContactUs.jpg',  array('border' => '0','height'=>'75'));?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/contents/edit/1';?>">Contact Us</a>
                	</td>
                </tr>
            </table>
		</td> 
        <td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/subscribers';?>">
                    		<?php echo $this->Html->image('backend/icon13.jpg',  array('border' => '0','height'=>'75'));?>
                		</a>
            		</td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/subscribers';?>">Subscribers</a>
                	</td>
                </tr>
            </table>
		</td>     	
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" width="93" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/newsletters';?>">
                    		<?php echo $this->Html->image('backend/mail-message-icon.png',  array('border' => '0','width'=>'75'));?>
                		</a>
            		</td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/newsletters';?>">Newsletters</a>
                	</td>
                </tr>
            </table>
		</td> 
		<td align="center" width="20%">
            <table style="border: 2px solid #F3F3F3;" width="93" height="80" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="80" align="center">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/queues';?>">
                    		<?php echo $this->Html->image('backend/queue-icon.png',  array('border' => '0','width'=>'75'));?>
                		</a>
            		</td>
                </tr>
                <tr>
                    <td align="center" valign="top" class="icontitle">
                    	<a href="<?php echo $this->Session->read('Setting.url').'/queues';?>">Sending Queue</a>
                	</td>
                </tr>
            </table>
		</td> 
	</tr>
</table>*/?>