<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
//$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

$joonetAsset = $this->baseurl . '/components/com_joonet/assets';
$doc->addStyleSheet( $joonetAsset . '/bootstrap/css/bootstrap.min.css');
$doc->addStyleSheet( $joonetAsset . '/css/toolkit.css');
$doc->addStyleSheet( $joonetAsset . '/css/application.css');
$doc->addStyleSheet( $joonetAsset . '/css/joonet.css');

// Load optional RTL Bootstrap CSS
//JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
	<?php // Use of Google Font ?>
	<?php if ($this->params->get('googleFont')) : ?>
		<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
		<style type="text/css">
			h1,h2,h3,h4,h5,h6,.site-title{
				font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName')); ?>', sans-serif;
			}
		</style>
	<?php endif; ?>
	<?php // Template color ?>
	<?php if ($this->params->get('templateColor')) : ?>
	<style type="text/css">
		body.site
		{
			border-top: 3px solid <?php echo $this->params->get('templateColor'); ?>;
			background-color: <?php echo $this->params->get('templateBackgroundColor'); ?>
		}
		a
		{
			color: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
		.btn-primary
		{
			background: <?php echo $this->params->get('templateColor'); ?>;
		}
		.navbar-inner
		{
			-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
		}
	</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body class="<?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
?>">

  
	<?php if ($this->countModules('position-1')) : ?>
		<nav class="navbar navbar-fixed-top" role="navigation">
			<div class="container-fluid">
			    <!-- Header -->
    			<div class="navbar-header">
    			    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".nav-collapse">
                <span class="cv">Navigation</span>
                <span class="ow"></span>
                <span class="ow"></span>
                <span class="ow"></span>
              </button>
              <a class="navbar-brand" href="<?php echo $this->baseurl; ?>/"><!--.brand -->
    						<?php echo $logo; ?>
    						<?php if ($this->params->get('sitedescription')) : ?>
    							<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
    						<?php endif; ?>
    					</a>
    			</div><!--.os -->
    			<div class="collapse navbar-collapse">
						<jdoc:include type="modules" name="position-1" style="none" /> <!--/main-menu -->
  					<jdoc:include type="modules" name="position-4" style="none" /> <!--/dropdown-menu -->
  					<jdoc:include type="modules" name="position-0" style="none" /> <!--/search-menu -->
					</div>
			</div><!--.by -->
		</nav>
	<?php endif; ?>
  
	<!-- Body -->
	<div id="page-body" class="container-fluid">
		<div class="row">
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<?php if ($this->countModules('position-8')) : ?>
				<!-- Begin Sidebar -->
				<div id="sidebar" class="go"> <!-- -->
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="xhtml" />
					</div>
				</div>
				<!-- End Sidebar -->
			<?php endif; ?>
			<div id="content" role="main">
				<!-- Begin Content -->
				<jdoc:include type="modules" name="position-3" style="xhtml" />
				<jdoc:include type="message" />
				<jdoc:include type="component" />
				<!-- End Content -->
			</div>
			<?php if ($this->countModules('position-7')) : ?>
				<div id="aside" class="go">
					<!-- Begin Right Sidebar -->
					<jdoc:include type="modules" name="position-7" style="well" />
					<!-- End Right Sidebar -->
				</div>
			<?php endif; ?>
    	<jdoc:include type="modules" name="debug" style="none" />
		</div><!--.gd -->
		
		<!-- Footer -->
  	<footer class="footer" role="contentinfo">
  	  <jdoc:include type="modules" name="position-2" style="none" />
  		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
  			<hr />
  			<jdoc:include type="modules" name="footer" style="none" />
  			<p class="pull-right">
  				<a href="#top" id="back-top">
  					<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
  				</a>
  			</p>
  			<p>
  				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
  			</p>
  		</div>
  	</footer>
	</div><!--.by ams -->
</body>
</html>
