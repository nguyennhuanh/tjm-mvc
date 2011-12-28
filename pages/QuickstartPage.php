<div data-role="content">
<span style="color:#006"><b>Quick start guide</b></span>

<h5 style="color:#060; border-bottom: 1px solid;"><b>1. Download & install</b></h5>
<p>This manual will explain how this framework is built, basic settings and how to create a new page.</p>
<p>Installation of TJM-MVC is very simple. First, download the source code from <a href="https://github.com/tenkana/tjm-mvc" target="_blank">Github</a> and extract it to your web server. Please note that this version assumes you are using Apache server with mod_rewrite.</p>
<p>Next, follow the instructions below to start configuring your mobile web application.</p>

<h5 style="color:#060; border-bottom: 1px solid;"><b>2. Settings</b></h5>
<p>
All the configurations of TJM-MVC are in bootstrap.php which is located at the root directory. This file is executed just after TJM-MVC core has been loaded. You can find inline configuration instructions in that file, so here I will explain just the main settings.
</p>
<li>Database settings
<pre><code style="color:blue;">Configure::write('localhost', 'db_host');
Configure::write('xxxx', 'db_user');
Configure::write('xxxx', 'db_pass');
Configure::write('xxxx', 'db_name');
</code></pre>
<li>Theme settings
<p>
Default jQuery Mobile style are probably sufficient for many cases, however, in case you want to change something, you can do it easily with TJM-MVC. Just make a copy of default directory inside /themes and give the copy your chosen theme name. Re-define the jQuery Mobile styles in styles.css. Save it all and change theme setting below to your own one.
</p>
<pre><code style="color:blue;">Configure::write('default', 'theme');
</code></pre>
<li>Cache settings
<p>Set cache_enable=true if you want TJM-MVC to automatically cache rendered pages for you.</p>
<pre><code style="color:blue;">Configure::write(
    array( 'cache_enable' => false,
        'do_not_cache' => array(),
        'cache_time' => 21600,), 
        'cache'                  );
</code></pre>
<li>SEO settings
<p>Provide information to search engines about your application.</p>
<pre><code style="color:blue;">Configure::write(
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
<li>Language settings
<p>TJM-MVC fully supports non-English languages and is easy to translate. Create a subdirectory inside lang directory and name the subdirectory with the abbreviation for your language. Inside the new subdirectory create a file named lang.php and define all of your translated labels here. Take a look at /lang/en/lang.php for sample. Load your language as below:</p>
<pre><code style="color:blue;">Lang::load('en');</code></pre>
<p>To use the translated labels, use Lang class like this Lang::get('LABEL_NAME');</p>
<p>Note: You can use substitution in your text with hat symbol(^). For example: 'WELCOME' => 'Hi ^! Have a nice day!'</p>
<li>Routing settings
<p>Pay careful attention to this section because it defines page transformation or in other words, your site structure. You must set at least one php file per page. Optionally you can set additional javascript or css files which will be loaded for each page.</p>
<p>A Page may have a PageModel to process your logic business. I will explain about Page/PageModel in more details in the next section.</p>
<pre><code style="color:blue;">Routes::add(array(
'home' => array(
    'php' => 'pages/HomePage.php',),
'login' => array(
    'php' => 'pages/LoginPage.php',),
'error' => array(
    'php' => 'pages/ErrorPage.php',),
));
</code></pre>
<li>Authentication settings
<p>TJM-MVC provides you with a basic authentication. You have 2 options:</p>
<p>Option 1: Set params with your table and fields which are used for validation</p>
<pre><code style="color:blue;">BasicAuth::setSource(
    'users', 'username', 'password'
);
</code></pre>
<p>Option 2: Set params with a fixed account</p>
<pre><code style="color:blue;">BasicAuth::setSource(
    'NO_SQL_AUTH', 
    'admin', 'admin'
);</code></pre>

<h5 style="color:#060; border-bottom: 1px solid;"><b>3. Create a new page</b></h5>
<img src="img/tjm.newpage.png">
</div>
