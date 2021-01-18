<?php

function args($parent){
	$rt=array('parent'=>$parent,'post_id'=>get_the_ID(),'status'=>'approve');
	return $rt;
}

function recursive_comment($comment,$parent=false){
	if(empty($comment)) return "";
	$out='';
	if($parent==false){
		$out.='<div class="commnets-area">';
	}
	$out.='<div class="comment">';
	if($parent){
		$out.='<h5 class="reply-for">Reply for <a href="#"><b>'.$parent->comment_author.'</b></a></h5>';
	}

	$child=get_comments(args($comment->comment_ID));

	$out.='<div class="post-info"><div class="left-area"><a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a></div>';
	$out.='<div class="middle-area"> <a class="name" href="#"><b>'.$comment->comment_author.'</b></a> <h6 class="date">on Sep 29, 2017 at </div>';
	$out.='<div class="right-area"> <h5 class="reply-btn"><a href="#"><b>REPLY</b></a></h5> </div></div><!-- post-info -->';

	$out.=$comment->comment_content.'</div>';

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