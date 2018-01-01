<?php
/**
 * @version    2.0.0
 * @package    Spedi SPGallery PLuign
 * @author     SPEDI srl http://www.spedi.it
 * @copyright  Copyright (c) 1991 - 2016 Spedi srl. Tutti i diritti riservati.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$tmpl     = JFactory::getApplication()->getTemplate();
JHtml::_('jquery.framework');
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
// masonry
$extensionPath = '/templates/'.$tmpl.'/dist/masonry/';
if(file_exists(JPATH_SITE.$extensionPath)){
	$document->addScript(JUri::base(true).'/templates/'.$tmpl.'/dist/masonry/masonry.min.js');
	$document->addScript(JUri::base(true).'/templates/'.$tmpl.'/dist/masonry/lazyload.min.js');
}
else{
	$document->addScript(JUri::base(true).'/plugins/content/'.$this->plg_name.'/dist/masonry/masonry.min.js');
	$document->addScript(JUri::base(true).'/plugins/content/'.$this->plg_name.'/dist/masonry/lazyload.min.js');
}

// template
$document->addStyleSheet(JURI::base(true).'/plugins/content/'.$this->plg_name.'/tmpl/'.$PlgTmplName.'/css/template.min.css');

$document->addScriptDeclaration("
	jQuery(document).ready(function($){
		var articleGgalleryMasonry = $('.plg-masonry-gallery-".$galleryId." .grid-".$galleryId."').masonry({
			itemSelector: '.grid-item-".$galleryId."',
			columnWidth: '.grid-sizer-".$galleryId."',
			percentPosition: true
		});

		articleGgalleryMasonry.imagesLoaded().progress( function() {
			articleGgalleryMasonry.masonry('layout');
		});

		$('.plg-masonry-gallery-".$galleryId."').magnificPopup({
	    delegate:'a.magnific-overlay-".$galleryId."',
	    type:'image',
	    gallery:{enabled:true}
	  })

		// file da 6x6 su card grandi
		if($('.plg-masonry-gallery-".$galleryId."').parent().width() > 576){
			$('.plg-masonry-gallery-".$galleryId."').addClass('largeGallery');
		}

	})
");
?>

<div class="articleGgallery masonry-gallery plg-masonry-gallery-<?php echo $galleryId; ?> container-fluid">
  <div class="row grid-<?php echo $galleryId; ?>">
		<div class="grid-gallery-image grid-sizer-<?php echo $galleryId; ?> col-12 col-sm-6 col-md-<?php echo $item['col'] ?>"></div>
    <?php foreach($item['result'] as $key => $img) : ?>
	    <div class="grid-gallery-image grid-item-<?php echo $galleryId; ?> col-12 col-sm-6 col-md-<?php echo $item['col'] ?>">
	      <figure class="plg-image">
	        <img src="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>" alt="<?php echo $img->title ?>" class="plg-no-lightbox" />
					<figcaption class="d-flex justify-content-center align-items-center">
						<i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
	          <!-- <h3><?php //echo $img->title ?></h3> -->
	        </figcaption>
	        <a class="magnific-overlay-<?php echo $galleryId; ?>" title="<?php echo $img->title ?>" href="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>"></a>
	      </figure>
	    </div>
    <?php endforeach; ?>
  </div>
</div>
