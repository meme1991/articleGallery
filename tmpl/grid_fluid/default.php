<?php
/**
 * @version    3.0.0
 * @package    SPEDI Article Gallery
 * @author     SPEDI srl - http://www.spedi.it
 * @copyright  Copyright (c) Spedi srl.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

//asset
//$document = JFactory::getDocument();
if(count($item['result']) < 5) return;
$tmpl     = JFactory::getApplication()->getTemplate();
JHtml::_('jquery.framework');
if(isset($catResult)){
	if (!JComponentHelper::isEnabled('com_phocagallery', true)) {
		return JError::raiseError(JText::_('Phoca Gallery Error'), JText::_('Phoca Gallery is not installed on your system'));
	}
	if (! class_exists('PhocaGalleryLoader')) {
	    require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'libraries'.DS.'loader.php');
	}
	phocagalleryimport('phocagallery.path.path');
	phocagalleryimport('phocagallery.path.route');
	phocagalleryimport('phocagallery.library.library');
}
// magnificPopup
$extensionPath = '/templates/'.$tmpl.'/dist/magnific/';
if(file_exists(JPATH_SITE.$extensionPath)){
	$document->addStyleSheet(JUri::base(true).'/templates/'.$tmpl.'/dist/magnific/magnific-popup.min.css');
	$document->addScript(JUri::base(true).'/templates/'.$tmpl.'/dist/magnific/jquery.magnific-popup.min.js');
}
else{
	$document->addStyleSheet(JUri::base(true).'/plugins/content/'.$this->plg_name.'/dist/magnific/magnific-popup.min.css');
	$document->addScript(JUri::base(true).'/plugins/content/'.$this->plg_name.'/dist/magnific/jquery.magnific-popup.min.js');
}
// modernizr
$extensionPath = '/templates/'.$tmpl.'/dist/modernizr/';
if(file_exists(JPATH_SITE.$extensionPath)){
	$document->addScript(JUri::base(true).'/templates/'.$tmpl.'/dist/modernizr/modernizr-objectfit.js');
}
else{
	$document->addScript(JUri::base(true).'/plugins/content/'.$this->plg_name.'/dist/modernizr/modernizr-objectfit.js');
}

// template
$document->addStyleSheet(JURI::base(true).'/plugins/content/'.$this->plg_name.'/tmpl/'.$PlgTmplName.'/css/template.min.css');
$document->addScriptDeclaration("
	jQuery(document).ready(function($){
		// magnific popup
	  $('.plg-articleGgallery-".$galleryId."').magnificPopup({
	    delegate:'a.magnific-overlay',
	    type:'image',
	    gallery:{enabled:true}
	  })

		// modernizr
		if ( ! Modernizr.objectfit ) {
	    if($('.plg-articleGgallery-".$galleryId." figure').length){
	      $('.plg-articleGgallery-".$galleryId." figure').each(function () {
	        var container = $(this), imgUrl = container.find('img').prop('src');
	        if (imgUrl) {
	          container
	            .css('backgroundImage', 'url(' + imgUrl + ')')
	            .addClass('compat-object-fit')
	            .children('img').hide();
	        }
	      });
	    }
		}

	});
");
?>

<div class="articleGgallery fluid-gallery plg-articleGgallery-<?php echo $galleryId; ?> container-fluid p-0">
	<?php foreach($item['result'] as $k => $img) : ?>
		<?php if($k == 5) break; ?>
		<?php
			switch ($k) {
				case 0: $class = 'big'; break;
				case 1: $class = 'wide'; break;
				case 2: $class = 'small'; break;
				case 3: $class = 'tall'; break;
				case 4: $class = 'big-wide'; break;
			}
		?>
		<div class="grid-gallery-image <?= $class ?>">
			<figure class="plg-image">
        <img src="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>" alt="<?php echo $img->title ?>" class="plg-no-lightbox" />
        <figcaption class="d-flex justify-content-center align-items-center">
					<i class="fas fa-image fa-2x"></i>
        </figcaption>
        <a class="magnific-overlay" title="<?php echo $img->title ?>" href="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>"></a>
      </figure>
		</div>
	<?php endforeach; ?>
</div>
