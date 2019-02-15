<?php
/**
 * @version    3.0.0
 * @package    SPEDI Article Gallery
 * @author     SPEDI srl - http://www.spedi.it
 * @copyright  Copyright (c) Spedi srl.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

//asset
$tmpl = JFactory::getApplication()->getTemplate();
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
// template
$document->addStyleSheet(JURI::base(true).'/plugins/content/'.$this->plg_name.'/tmpl/'.$PlgTmplName.'/css/template.min.css');
$document->addScriptDeclaration("
	jQuery(document).ready(function($){

    $('.articleGalleryId-".$galleryId." ').magnificPopup({
	    delegate:'a.magnific-overlay',
	    type:'image',
	    gallery:{enabled:true}
	  })

	});
");

?>
<?php echo $galleryId; ?>
<div class="articleGgallery table-layout table-orizzontal articleGalleryId-<?= $galleryId ?> container-fluid p-0">
	<div class="row">
		<?php foreach($item['result'] as $img) : ?>
		<div class="col-12 col-md-4 col-lg-<?= $item['col'] ?> mb-3">
			<div class="image-caption" style="height: <?= $item['hSlider'] ?>">
				<a href="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>" class="magnific-overlay" title="<?= $img->title ?>">
					<div class="image" style="background-image: url(<?php echo JUri::base(true).'/images/phocagallery/'.$img->filename; ?>);"></div>
				</a>
			</div>
			<div class="desc-caption">
				<?= $img->title ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
