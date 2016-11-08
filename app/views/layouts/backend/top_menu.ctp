<div id="menu" style="height: 24px;">
	<?php if(($this->action != 'login') && ($this->action != 'forgot')){?>
		<div id="dropdown-holder">
			<ul id="nav" class="dropdown">
		        <li class="heading"><a href="<?php echo $base_url.'/users';?>">Users</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/widgets';?>">Widgets</a></li>
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/academics';?>">Academics</a></li>*/?>
		        <li class="heading"><a>Media</a>
                    <ul>
                        <li class=""><a href="<?php echo $base_url.'/articles';?>">News</a></li>
                        <li class=""><a href="<?php echo $base_url.'/albums';?>">Gallery</a></li>
                    </ul>
                </li>		        
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/articles';?>">Articles</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/albums';?>">Gallery</a></li>*/?>
		        <li class="heading"><a>Events</a>
                    <ul>
                        <li class=""><a href="<?php echo $base_url.'/categories';?>">Event Categories</a></li>
                        <li class=""><a href="<?php echo $base_url.'/events';?>">Events</a></li>
                    </ul>
                </li>
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/categories';?>">Event Categories</a></li>
		        <li class="heading"><a href="<?php echo $base_url.'/events';?>">Events</a></li>*/?>
		        <li class="heading"><a href="<?php echo $base_url.'/cats';?>">Categories</a></li>		        
		        <?php $contents = $this->requestAction('main/getContents');
                foreach ($contents as $content){?>
                    <li class="heading">
                        <a href="<?php echo $base_url.'/contents/edit/'.$content['Content']['id'];?>"><?php echo $content['Content']['title'];?></a>
                    </li>
                <?php }?>
                <li class="heading"><a href="<?php echo $base_url.'/testimonials';?>">Testimonials</a></li>
                <li class="heading"><a href="<?php echo $base_url.'/team_members';?>">Members</a></li>
                <li class="heading"><a>Careers</a>
                    <ul>
                        <li class=""><a href="<?php echo $base_url.'/careers';?>">Careers Vacancies</a></li>
                        <li class=""><a href="<?php echo $base_url.'/developments';?>">Continuous professional development</a></li>
                    </ul>
                </li>
                <li class="heading"><a href="<?php echo $base_url.'/values';?>">Values</a></li>
                <?php /*<li class="heading"><a href="<?php echo $base_url.'/nodes';?>">Nodes</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/faqs';?>">FAQs</a></li>*/?>		        
        		<?php /*<li class=""><a href="<?php echo $base_url.'/comments';?>">Comments</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/quotes';?>">Quotes</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/slideshows';?>">Slideshows</a></li>*/?>
		        <?php /*<li class="heading"><a href="<?php echo $base_url.'/logos';?>">Logos</a></li>*/?>
		        <?php /**/?>        		
    			<li class="heading"><a>Newsletter System</a>
    				<ul>
    				    <li class=""><a href="<?php echo $base_url.'/subscribers/subscribers_export';?>">Export Subscribers</a></li>
		    			<li class=""><a href="<?php echo $base_url.'/subscribers';?>">Subscribers</a></li>
						<li class=""><a href="<?php echo $base_url.'/newsletters';?>">Newsletters</a></li>
						<li class=""><a href="<?php echo $base_url.'/queues';?>">Sending Queue</a></li>
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