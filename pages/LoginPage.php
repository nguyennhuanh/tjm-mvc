<div data-role="content">
    <h2><?php echo Lang::get('LOGIN'); ?></h2>

    <form method="post" action="login">
        <div data-role="fieldcontain">
            <label for="username" class="ui-input-text"><?php echo Lang::get('USERNAME'); ?>:</label>
            <input type="text" name="username" class="text" id="username" value="" />
        </div>
        <div data-role="fieldcontain">
            <label for="password"><?php echo Lang::get('PASSWORD'); ?>:</label>
            <input type="password" name="password" class="text" id="password" />
        </div>
        <div data-role="fieldcontain">
            <input type="submit" data-theme="d" name="login" value="Login"></input>
        </div>
        
    </form>

    <a href="home"><?php echo Lang::get('BACK_HOME'); ?></a>
</div>