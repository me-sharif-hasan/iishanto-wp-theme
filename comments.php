	<?php wp_enqueue_script( 'comment-reply' ); ?>
	<section class="comment-section">
		<div class="container">

					<h4><b>COMMENTS(<?php echo get_comments_number(get_the_ID()) ?>)</b></h4>
			<div class="row">

				<div class="col-lg-12 col-md-12">
					<div class="comment-form">
						
			<h4><b>POST COMMENT</b></h4>
					<a name="comments"></a>

<?php $comments_args = array(
        // change the title of send button 
        'submit_button'=>'<div class="col-sm-12"> <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button></div>',
        // change the title of the reply section
        'title_reply'=>'',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_form_top' => '<div class="row">',
        'comment_form_bottom' => '</div>',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
        // redefine your own textarea (the comment body)
        'comment_field' => '<div class="col-sm-12"> <textarea name="comment" rows="2" class="text-area-messge form-control" placeholder="Enter your comment" aria-required="true" aria-invalid="false" required="true"></textarea > </div><!-- col-sm-12 -->',

        'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>'<div class="col-sm-6"><input id="author" class="blog-form-input form-control" placeholder="Your Name* " name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30" required="true"/></div>',

    'email' =>'<div class="col-sm-6"><input id="email" class="blog-form-input form-control" placeholder="Your Email Address* " name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" required="true"/></div>'
  )
)
);


comment_form($comments_args);?>

</div>

					</div><!-- comment-form -->

<?php

function args($parent){
	$rt=array('parent'=>$parent,'post_id'=>get_the_ID(),'status'=>'approve');
	return $rt;
}


function turnUrlIntoHyperlink($string){
    //The Regular Expression filter
    $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

    // Check if there is a url in the text
    if(preg_match_all($reg_exUrl, $string, $url)) {

        // Loop through all matches
        foreach($url[0] as $newLinks){
            if(strstr( $newLinks, ":" ) === false){
                $link = 'http://'.$newLinks;
            }else{
                $link = $newLinks;
            }

            // Create Search and Replace strings
            $search  = $newLinks;
            $replace = '<a class="comment-links" href="'.$link.'" title="'.$newLinks.'" target="_blank" rel="nofollow">'.$link.'</a>';
            $string = str_replace($search, $replace, $string);
        }
    }

    //Return result
    return $string;
}


function recursive_comment($comment,$parent=false){
	if(empty($comment)) return "";
	$out='';
	if($parent==false){
		$out.='<div class="commnets-area">';
	}
	$out.='<div class="comment">';
	if($parent){
		$out.='<h5 class="reply-for">Reply for <a><b>'.$parent->comment_author.'</b></a></h5>';
	}

	$child=get_comments(args($comment->comment_ID));
$rpl= get_comment_reply_link(array(
    'reply_text' => __('REPLY', 'textdomain'),
    'depth'      => 1,
    'max_depth'  => 2
    )
);
	$out.='<div class="post-info"><div class="left-area"><a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a></div>';
	$out.='<div class="middle-area"> <a class="name"><b>'.$comment->comment_author.'</b></a> <h6 class="date">'.smk_get_comment_time($comment->comment_ID).'</div>';
	$out.='<div class="right-area">'.$rpl.'</div></div><!-- post-info -->';

	$comment_out=strip_tags($comment->comment_content);

	$out.=turnUrlIntoHyperlink($comment_out).'</div>';

	if(!empty($child)){
		foreach ($child as $single) {
			$out.=recursive_comment($single,$comment);
		}
	}
	if($parent==false){
		$out.='</div>';
	}
	return $out;

}

$cmnt=get_comments(args(0));

foreach ($cmnt as $comment) {
	if($comment->comment_parent!=0) continue;
	echo recursive_comment($comment);
}
//var_dump($cmnt);