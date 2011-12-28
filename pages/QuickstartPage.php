<div data-role="content">
<span style="color:#006"><b>Quick start guide</b></span>

<h5 style="color:#060; border-bottom: 1px solid;"><b>1. Download & install</b></h5>
<p>This manual does attempt to explain how this framework built, only basic setting and how to create a new page.</p>
<p>Installation of TJM-MVC is very simple. First, download source code from <a href="https://github.com/tenkana/tjm-mvc" target="_blank">Github</a> and extract it to your web server. Please note that this version is assumed you are using Apache server with mod_rewrite.</p>
<p>Well, now you get all of things above done. Next, follow under instructions to start configuring your mobile web application.</p>

<h5 style="color:#060; border-bottom: 1px solid;"><b>2. Settings</b></h5>
<p>
All of the configuration of TJM-MVC is in bootstrap.php which located at the root directory. This file will be executed just after TJM-MVC core loading. You can find how to configure by inline instruction, here I just explain main settings.
</p>
<li>Database setting
<pre><code style="color:blue;">Configure::write('localhost', 'db_host');
Configure::write('xxxx', 'db_user');
Configure::write('xxxx', 'db_pass');
Configure::write('xxxx', 'db_name');
</code></pre>
<li>Theme setting
<p>
Jquery mobile style is good enough. However, in case you want to change some things, you can do it easily with TJM-MVC. Just make a copy of default directory inside /themes and and give the copy your chosen theme name. Re-define the standard formatting of jquery mobile style in styles.css. Save it all and change theme setting below to your own one.
</p>
<pre><code style="color:blue;">Configure::write('default', 'theme');
</code></pre>
<li>Cache setting
<p>Set cache_enable=true if you want TJM-MVC cache rendered pages for you.</p>
<pre><code style="color:blue;">Configure::write(
    array( 'cache_enable' => false,
        'do_not_cache' => array(),
        'cache_time' => 21600,), 
        'cache'                  );
</code></pre>
<li>SEO setting
<p>Provide some things to let internet folk know about your application.</p>
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
<li>Language setting
<p>TJM-MVC fully supports non-English languages and is easy to translate. Create a subdirectory inside lang directory and name the subdirectory with the abbreviation for your language. Inside the new subdirectory create a file named lang.php and define all of your translated labels here. Take a look at /lang/en lang.php for sample. Load your language as below:</p>
<pre><code style="color:blue;">Lang::load('en');</code></pre>
<p>To use translated label, use Lang class like this Lang::get('LABEL_NAME');</p>
<p>Note: You can use substitution in your text with hat symbol(^). For example: 'WELCOME' => 'Hi ^! Have a nice day!'</p>
<li>Routing setting
<p>Pay your attention to this setting section because it expresses pages transformation or your site structure. As required, you must set at least a php file per page. In addition, you can set js/css which will be loaded for each page.</p>
<p>Page may or may not have PageModel to process your logic business. I will explain more detail about Page/PageModel in the next section.</p>
<pre><code style="color:blue;">Routes::add(array(
'home' => array(
    'php' => 'pages/HomePage.php',),
'login' => array(
    'php' => 'pages/LoginPage.php',),
'error' => array(
    'php' => 'pages/ErrorPage.php',),
));
</code></pre>
<li>Authenticate setting
<p>TJM-MVC provides you with a basic authentication. You have 2 options:</p>
<p>Option 1: Set params with your table and fields which are used for validating</p>
<pre><code style="color:blue;">BasicAuth::setSource(
    'users', 'username', 'password'
);
</code></pre>
<p>Option 2: Set params with your fixed account</p>
<pre><code style="color:blue;">BasicAuth::setSource(
    'NO_SQL_AUTH', 
    'admin', 'admin'
);</code></pre>

<h5 style="color:#060; border-bottom: 1px solid;"><b>3. Create a new page</b></h5>
<img src="img/tjm.newpage.png">
</div>