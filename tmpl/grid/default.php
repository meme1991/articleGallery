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

		// file da 6x6 se le card sono molto grandi
		if($('.plg-articleGgallery-".$galleryId."').parent().width() > 576){
			$('.plg-articleGgallery-".$galleryId."').addClass('largeGallery');
		}

	});
");
?>

<div class="articleGgallery grid-gallery plg-articleGgallery-<?php echo $galleryId; ?> container-fluid">
  <div class="row">
    <?php foreach($item['result'] as $img) : ?>
    <div class="grid-gallery-image col-12 col-sm-6 col-md-<?php echo $item['col'] ?>">
      <figure class="plg-image">
        <img src="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>" alt="<?php echo $img->title ?>" class="plg-no-lightbox" />
        <figcaption class="d-flex justify-content-center align-items-center">
					<i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
          <!-- <h3><?php //echo $img->title ?></h3> -->
        </figcaption>
        <a class="magnific-overlay" title="<?php echo $img->title ?>" href="<?php echo JUri::base(true)."/images/phocagallery/".$img->filename; ?>"></a>
      </figure>
    </div>
    <?php endforeach; ?>
  </div>
</div>
