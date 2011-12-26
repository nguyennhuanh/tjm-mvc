<div data-role="content">
<span style="color:#006"><b>Quick start guide</b></span>
<div>
<h5 style="color:#060; border-bottom: 1px solid;"><b>1. Download & install</b></h5>
<p>Việc cài đặt TJM-MVC rất đơn giản. Bạn chỉ cần download mã nguồn tại đây, giải nén tới thư mục web trên server của bạn và tiến hành các cài đặt cần thiết theo các hướng dẫn dưới đây.</p>
</div>

<div>
<h5 style="color:#060; border-bottom: 1px solid;"><b>2. Settings</b></h5>
<li>Database setting
<pre><code>Configure::write('localhost', 'db_host');
Configure::write('xxxx', 'db_user');
Configure::write('xxxx', 'db_pass');
Configure::write('xxxx', 'db_name');
</code></pre>
<li>Theme setting
<pre><code>Configure::write('default', 'theme');
</code></pre>
<li>Cache setting
<pre><code>Configure::write(
	array( 'cache_enable' => false,
		'do_not_cache' => array(),
		'cache_time' => 21600,), 'cache'
);
</code></pre>
<li>SEO setting
<pre><code>Configure::write(
	'meta keywords of your app', 
	'app_keywords'
);
Configure::write(
	'description about your app',
	'app_description'
);
Configure::write(
	'your canonical url', 
	'baseurl'
);
</code></pre>
<li>Routing setting
<pre><code>Routes::add(array(
	'home' => array( 'php' => 'pages/HomePage.php',),    
	'restrict' => array( 'php' => 'pages/RestrictPage.php',),
	'login' => array( 'php' => 'pages/LoginPage.php',),
	'error' => array( 'php' => 'pages/ErrorPage.php',),
));
</code></pre>
<li>Authenticate setting
<pre><code>BasicAuth::setSource(
	'NO_SQL_AUTH', 
	'admin', 'admin'
);
</code></pre>
</div>

<div>
<h5 style="color:#060; border-bottom: 1px solid;"><b>3. Create a new page</b></h5>
</div>

</div>