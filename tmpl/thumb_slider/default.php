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
// phocagalleryimport('phocagallery.text.text');
// phocagalleryimport('phocagallery.access.access');
// phocagalleryimport('phocagallery.file.file');
// phocagalleryimport('phocagallery.file.filethumbnail');
// phocagalleryimport('phocagallery.image.image');
// phocagalleryimport('phocagallery.image.imagefront');
// phocagalleryimport('phocagallery.render.renderfront');
// phocagalleryimport('phocagallery.render.renderdetailwindow');
// phocagalleryimport('phocagallery.ordering.ordering');
// phocagalleryimport('phocagallery.picasa.picasa');

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
// swiper slider
$extensionPath = '/templates/'.$tmpl.'/dist/swiper/';
if(file_exists(JPATH_SITE.$extensionPath)){
	$document->addStyleSheet(JUri::base(true).'/templates/'.$tmpl.'/dist/swiper/swiper.min.css');
	$document->addScript(JUri::base(true).'/templates/'.$tmpl.'/dist/swiper/swiper.min.js');
}
else{
	$document->addStyleSheet(JUri::base(true).'/plugins/content/'.$this->plg_name.'/dist/swiper/swiper.min.css');
	$document->addScript(JUri::base(true).'/plugins/content/'.$this->plg_name.'/dist/swiper/swiper.min.js');
}

// template
$document->addStyleSheet(JURI::base(true).'/plugins/content/'.$this->plg_name.'/tmpl/'.$PlgTmplName.'/css/template.min.css');
$document->addScriptDeclaration("
	jQuery(document).ready(function($){

    var galleryTop = new Swiper('.plg-thumbSlide-".$galleryId." .gallery-top-".$galleryId."', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    var galleryThumbs = new Swiper('.plg-thumbSlide-".$galleryId." .gallery-thumbs-".$galleryId."', {
      spaceBetween: 10,
      centeredSlides: true,
      slidesPerView: 'auto',
      touchRatio: 0.2,
      slideToClickedSlide: true,
    });
    galleryTop.controller.control = galleryThumbs;
    galleryThumbs.controller.control = galleryTop;


    $('.plg-thumbSlide-".$galleryId." .gallery-top-".$galleryId."').magnificPopup({
	    delegate:'a.magnific-overlay',
	    type:'image',
	    gallery:{enabled:true}
	  })

	});
");

?>


<!-- Swiper -->
<div class="articleGgallery thumbSlide-gallery plg-thumbSlide-<?php echo $galleryId; ?> container-fluid px-0">
  <div class="swiper-container top gallery-top-<?php echo $galleryId; ?>">
    <div class="swiper-wrapper">
      <?php foreach($item['result'] as $img) : ?>
        <div class="swiper-slide" style="background-image:url(<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>); height: <?php echo $item['hSlider'] ?>">
          <a class="magnific-overlay" title="<?php echo $img->title ?>" href="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>"></a>
        </div>
      <?php endforeach; ?>
			<?php if(isset($catResult)) : ?>
				<div class="swiper-slide d-flex align-items-center justify-content-center bg-light" style="height: <?php echo $item['hSlider'] ?>">
					<a href="<?php echo JRoute::_(PhocaGalleryRoute::getCategoryRoute($catResult[0]->id, $catResult[0]->alias)); ?>" class="text-center">
						<i class="far fa-plus fa-2x text-primary d-block"></i>
						<p class="b-block text-primary font-weight-light mb-0">Vedi di più</p>
					</a>
				</div>
			<?php endif; ?>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
  </div>
  <div class="swiper-container thumbs gallery-thumbs-<?php echo $galleryId; ?>">
    <div class="swiper-wrapper">
      <?php foreach($item['result'] as $img) : ?>
        <div class="swiper-slide" style="background-image:url(<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>)"></div>
      <?php endforeach; ?>
			<?php if(isset($catResult)) : ?>
				<div class="swiper-slide bg-white"></div>
			<?php endif; ?>
    </div>
  </div>
</div>
