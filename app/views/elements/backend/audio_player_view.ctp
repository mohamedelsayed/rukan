<?php
	if(!empty($audio)){?>
    	<script type="text/javascript">
        	$(document).ready(function(){
				updateAudioHits('<?php echo $audio['id'];?>', '<?php echo BASE_URL;?>');
			});
			function updateAudioHits(audioId, siteUrl){
				$.ajax({	
					url: siteUrl+'/main/updateAudioHits/'+audioId,
					beforeSend: function(){
					},
					success:function(result){
					}
				});
			}
        </script>
		<?php    
		if($this->action == 'edit')$delete = true; else $delete = false;
		//$imagePath = ($audio['image']!='')?BASE_URL.'/app/webroot/img/upload/'.$audio['image']:BASE_URL.'/app/webroot/img/backend/no_image.jpeg';
		//$imagePath = BASE_URL.'/app/webroot/img/upload/'.$audio['image'];
		$audioPath = BASE_URL.'/app/webroot/files/upload/'.$audio['file'];
		$src = BASE_URL.'/app/webroot/files/mp3_player/player.swf';
		echo '<div>'.$audio['title'].'</div>';
		echo '<object 
			type="application/x-shockwave-flash" 
			data="'.$src.'" 
			width="'.$width.'" 
			height="'.$height.'">
     		<param name="movie" value="'.$src.'" />
     		<param name="FlashVars" value="mp3='.$audioPath.'&showvolume=1&showstop=1" />
		</object>';	
		if($delete){			
			echo '<div class = "delete">';	
				if(isset($controller))	
					echo $this->Html->link(__('Delete audio', true), array('controller' => $controller.'/deleteAudio/'.$audio['id']), null, __('Are you sure you want to delete this audio?', true));
				else 
					echo __("Can't Del", true);
			echo '</div>';
		}		
	}
	else{
		echo __('No Audio', true);
	} 	 
?>