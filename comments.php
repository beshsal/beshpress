<div id="comments">
	<h5 class="card-header">Comments:</h5>

	<?php if (have_comments()) : ?>
	<!-- Comments List -->
	<div class="comments-list">
		<?php $args = array(
			'walker'            => null,
			'max_depth'         => '',
			'style'             => 'ul',
			'callback'          => null,
			'end-callback'      => null,
			'type'              => 'all',
			'reply_text'        => 'Reply',
			'page'              => '',
			'per_page'          => '',
			'avatar_size'       => 40,
			'reverse_top_level' => null,
			'reverse_children'  => '',
			'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
			'short_ping'        => true,   // @since 3.6
			'echo'              => true     // boolean, default is true
		); ?>
		
		<?php wp_list_comments($args, $comments); ?>
	</div>
	<?php endif; ?>
	<!-- Comments Form -->
	<div class="comments-form card my-4">
		<h5 class="card-header">Leave a Comment or Reply:</h5>
		<div class="card-body">
			<?php
			$form_args = array(
				'logged_in_as'        => '',
				'class_submit'        => 'btn btn-primary',
				'label_submit'        =>'Send',
				'title_reply'         =>'',
				'comment_notes_after' => '',
				'comment_field'       => '<div class="form-group"><textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true"></textarea></div>'
		  );
			comment_form($form_args); 
			?>
		</div>
	</div>	
</div>