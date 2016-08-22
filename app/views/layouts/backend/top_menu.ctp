<div id="menu" style="height: 24px;">
	<?php if(($this->action != 'login') && ($this->action != 'forgot')){?>
		<div id="dropdown-holder">
			<ul id="nav" class="dropdown">
		        <li class="heading"><a href="<?php echo BASE_URL.'/users';?>">Users</a></li>
		        <li class="heading"><a href="<?php echo BASE_URL.'/widgets';?>">Widgets</a></li>
		        <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/academics';?>">Academics</a></li>*/?>
		        <li class="heading"><a>Media</a>
                    <ul>
                        <li class=""><a href="<?php echo BASE_URL.'/articles';?>">News</a></li>
                        <li class=""><a href="<?php echo BASE_URL.'/albums';?>">Gallery</a></li>
                    </ul>
                </li>		        
		        <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/articles';?>">Articles</a></li>
		        <li class="heading"><a href="<?php echo BASE_URL.'/albums';?>">Gallery</a></li>*/?>
		        <li class="heading"><a>Events</a>
                    <ul>
                        <li class=""><a href="<?php echo BASE_URL.'/categories';?>">Event Categories</a></li>
                        <li class=""><a href="<?php echo BASE_URL.'/events';?>">Events</a></li>
                    </ul>
                </li>
		        <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/categories';?>">Event Categories</a></li>
		        <li class="heading"><a href="<?php echo BASE_URL.'/events';?>">Events</a></li>*/?>
		        <li class="heading"><a href="<?php echo BASE_URL.'/cats';?>">Categories</a></li>		        
		        <?php $contents = $this->requestAction('main/getContents');
                foreach ($contents as $content){?>
                    <li class="heading">
                        <a href="<?php echo BASE_URL.'/contents/edit/'.$content['Content']['id'];?>"><?php echo $content['Content']['title'];?></a>
                    </li>
                <?php }?>
                <li class="heading"><a href="<?php echo BASE_URL.'/testimonials';?>">Testimonials</a></li>
                <li class="heading"><a href="<?php echo BASE_URL.'/team_members';?>">Members</a></li>
                <li class="heading"><a>Careers</a>
                    <ul>
                        <li class=""><a href="<?php echo BASE_URL.'/careers';?>">Careers Vacancies</a></li>
                        <li class=""><a href="<?php echo BASE_URL.'/developments';?>">Continuous professional development</a></li>
                    </ul>
                </li>
                <li class="heading"><a href="<?php echo BASE_URL.'/values';?>">Values</a></li>
                <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/nodes';?>">Nodes</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/faqs';?>">FAQs</a></li>*/?>		        
        		<?php /*<li class=""><a href="<?php echo BASE_URL.'/comments';?>">Comments</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/quotes';?>">Quotes</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/slideshows';?>">Slideshows</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo BASE_URL.'/logos';?>">Logos</a></li>*/?>
		        <?php /**/?>        		
    			<li class="heading"><a>Newsletter System</a>
    				<ul>
    				    <li class=""><a href="<?php echo BASE_URL.'/subscribers/subscribers_export';?>">Export Subscribers</a></li>
		    			<li class=""><a href="<?php echo BASE_URL.'/subscribers';?>">Subscribers</a></li>
						<li class=""><a href="<?php echo BASE_URL.'/newsletters';?>">Newsletters</a></li>
						<li class=""><a href="<?php echo BASE_URL.'/queues';?>">Sending Queue</a></li>
					</ul>
				</li>
		    </ul>
	    </div>
	<?php }?>
</div>
<style type="text/css">
.dropdown li{
	border-bottom:1px solid #C3C3C3;
}
</style>