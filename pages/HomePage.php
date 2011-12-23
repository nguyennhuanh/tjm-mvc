<!-- navbar -->
<div data-role="navbar">
    <ul>
        <li class="ui-btn-active">Home</li>
        <li><a href="restrict">Restrict</a></li>
        <li><a href="#AboutPage">About</a></li>
    </ul>
</div>
<div data-role="content" role="main">
<!-- /navbar -->
<a href="login">Login</a>
<p>
This is a dummy home-page!
</p>
<?php if (isset($custom_html))echo $custom_html; ?>
</div>