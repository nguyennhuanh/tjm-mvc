<?php
class CommentPageModel extends PageModelBase{
	public function pageLoad(){
		$html = '';
		
		$comments = $this->get_comments();
		if (empty($comments)){
			return '';
		}
		foreach($comments as $key =>$comment){
			if ($key%2 == 0){
				$content = '<tr style="background-color:#F2F2FF;"><td>';
			} else {
				$content = '<tr style="background-color:#F2F2DD;"><td>';
			}
			
			if (!empty($comment['full_name'])){
				$content .= 'Name: <span style="color:#106CA7;">'.$comment['full_name'].'</span><br/>';
			}
			if (!empty($comment['email'])){
				$content .= 'E-mail: '.$comment['email'].'<br/>';
			}
			if (!empty($comment['comment'])){
				$content .= 'Content: '.$comment['comment'].'<br/>';
			}
			if (!empty($comment['created'])){
				$content .= '<span style="font-size:10px">Posted at '.$comment['created'].'</span>';
			}
			$content .= '</td></tr>';
			$html .= $content;
			
			$replies = $this->get_replies($comment['id']);
			
		}
		
		$this->content['custom_html'] = '<table width="100%"><tbody>'.$html.'</tbody></table>';
    }
	
	
	
	protected function post_comment($args){
		if (empty($args['comment'])){
			return;
		}
		
		$sql = "INSERT comments(full_name, email, comment) ".
				"VALUES('".$args['full_name']."', '".$args['email']."', '".$args['comment']."')";
		$cnn = Database::getConnection();
		
		$results = mysql_query($sql, $cnn);
	}
	
	private function get_comments(){
		$sql = "SELECT * FROM comments WHERE parent_id <=0 ORDER BY created";
		$cnn = Database::getConnection();
		
		$results = mysql_query($sql, $cnn);
		while ($row = mysql_fetch_assoc($results)) {	
			$comments[$row['id']] = $row;		
		}
		mysql_free_result($results);
		
		return $comments;
	}
	
	private function get_replies($comment_id){
		$sql = "SELECT * FROM comments WHERE parent_id =".$comment_id." ORDER BY created";
		$cnn = Database::getConnection();
		
		$results = mysql_query($sql, $cnn);
		$comments = array();
		while ($row = mysql_fetch_assoc($results)) {	
			$comments[$row['id']] = $row;		
		}
		mysql_free_result($results);
		
		return $comments;
	}
	
}