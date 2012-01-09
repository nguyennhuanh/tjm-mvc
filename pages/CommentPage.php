<div data-role="content">
	<span style="color:#006"><b>Comments</b></span>
	<p>I'm looking forward to you comments that will help me to improve this stuff in the future. Or you can email me at <a href="mailto:tenkana@gmail.com">tenkana@gmail.com</a>. Thank you very much!</p>
	<?php echo $custom_html; ?>
    <form method="post" action="comment">
        <div data-role="fieldcontain">
            <label for="full_name" class="ui-input-text">Name:</label>
            <input type="text" name="full_name" class="text" id="full_name" value="" />
			<label for="email">Email:</label>
            <input type="text" name="email" class="text" id="email" value=""/>
			<label for="comment">Content:</label>
			<textarea name="comment" class="text" id="comment" rows="2" cols="20"></textarea>
			<input type="submit" data-theme="d" name="post_comment" value="Submit"></input>
        </div>
    </form>
    <a href="home"><?php echo Lang::get('BACK_HOME'); ?></a>
</div>