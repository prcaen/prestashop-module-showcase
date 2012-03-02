<?php
/**
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
*  @author    Pierrick CAEN <prcaen@gmail.com>
*  @copyright 2011-2012 PrestaShop SA
*  @version   0.1
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

require_once _PS_MODULE_DIR_ . 'showcase/classes/phpthumb/ThumbLib.inc.php';

class Showcase extends Module
{
  public  $showcase_img_name = 'showcase_img_';
  private $_showcase_img_path;
  private $_showcase_slides_path;
  private $_showcase_thumbs_path;
  private $_showcase_sources_path;

  function __construct()
  {
    $this->name    = 'showcase';
    $this->tab     = 'advertising_marketing';
    $this->version = 0.1;
    $this->author  = 'Pierrick CAEN';

    parent::__construct();

    $this->displayName      = $this->l('Showcase with Nivo Slider');
    $this->description      = $this->l('A slideshow which use the jQuery framework and Nivo Slider jQuery plugin');

    $this->_showcase_img_path     = _PS_IMG_DIR_ . $this->name . '/';
    $this->_showcase_slides_path  = $this->_showcase_img_path . 'slides/';
    $this->_showcase_thumbs_path  = $this->_showcase_img_path . 'thumbs/';
    $this->_showcase_sources_path = $this->_showcase_img_path . 'sources/';
  }

  public function install()
  {
  	if (   !parent::install()
  	    || !$this->registerHook('home')
  	    || !$this->registerHook('header')
  	    || !Configuration::updateValue('SHOWCASE_IMG_NUMBER', 3)
  		  || !Configuration::updateValue('SHOWCASE_IMG_WIDTH', 1000)
  		  || !Configuration::updateValue('SHOWCASE_IMG_HEIGHT', 360)
  		  || !Configuration::updateValue('SHOWCASE_USE_IMG_TITLE', 1)
        || !Configuration::updateValue('SHOWCASE_THBS_ENABLE', 1)
  		  || !Configuration::updateValue('SHOWCASE_THBS_DIFFERENT', 1)
  		  || !Configuration::updateValue('SHOWCASE_THBS_WIDTH', 133)
  		  || !Configuration::updateValue('SHOWCASE_THBS_HEIGHT', 115)
  		  || !Configuration::updateValue('SHOWCASE_THBS_ALIGN', 'left')
  		  || !Configuration::updateValue('SHOWCASE_THBS_BORDER_COLOR', '#95d4dc')
  		  || !Configuration::updateValue('SHOWCASE_THBS_BORDER_SIZE', 1)
  		  || !Configuration::updateValue('SHOWCASE_THBS_FADEIN', 1)
  		  || !Configuration::updateValue('SHOWCASE_BTN_BORDER_RADIUS', 3)
  		  || !Configuration::updateValue('SHOWCASE_BTN_COLOR', '#e15b49')
  		  || !Configuration::updateValue('SHOWCASE_IMG_TITLE_1', 'Lookbook')
  		  || !Configuration::updateValue('SHOWCASE_IMG_TITLE_2', 'Lookbook')
  		  || !Configuration::updateValue('SHOWCASE_IMG_TITLE_3', 'Lookbook')
  		  || !Configuration::updateValue('SHOWCASE_IMG_SUBTITLE_1', 'PRINTEMPS-ÉTÉ 2011')
  		  || !Configuration::updateValue('SHOWCASE_IMG_SUBTITLE_2', 'PRINTEMPS-ÉTÉ 2011')
  		  || !Configuration::updateValue('SHOWCASE_IMG_SUBTITLE_3', 'PRINTEMPS-ÉTÉ 2011')
  		  || !Configuration::updateValue('SHOWCASE_IMG_SLIDE_1', 'showcase_img_1.jpg')
  		  || !Configuration::updateValue('SHOWCASE_IMG_SLIDE_2', 'showcase_img_2.jpg')
  		  || !Configuration::updateValue('SHOWCASE_IMG_SLIDE_3', 'showcase_img_3.jpg')
  		  || !Configuration::updateValue('SHOWCASE_IMG_BUTTON_TXT_1', 'Accédez au lookbook')
  		  || !Configuration::updateValue('SHOWCASE_IMG_BUTTON_TXT_2', 'Accédez au lookbook')
  		  || !Configuration::updateValue('SHOWCASE_IMG_BUTTON_TXT_3', 'Accédez au lookbook')
  		  || !Configuration::updateValue('SHOWCASE_IMG_BUTTON_LINK_1', 'http://www.google.fr')
  		  || !Configuration::updateValue('SHOWCASE_IMG_BUTTON_LINK_2', 'http://www.prestashop.com')
  		  || !Configuration::updateValue('SHOWCASE_IMG_BUTTON_LINK_3', 'http://www.jquery.com')
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_EFFECT', 'fade')
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_SLICES', 15)
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_BOX_COLS', 8)
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_BOX_ROWS', 4)
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_ANIM_SPEED', 500)
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_PAUSE_TIME', 3000)
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_START_SLIDE', 0)
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_PAUSE_OVER', 0)
  		  || !Configuration::updateValue('SHOWCASE_NIVO_SLIDER_KEYBD_NAV', 0))
  		return false;
  	return true;
  }

  public function uninstall()
  {
    if (   !parent::uninstall()
        || !Configuration::deleteByName('SHOWCASE_IMG_NUMBER')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_WIDTH')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_HEIGHT')
  		  || !Configuration::deleteByName('SHOWCASE_USE_IMG_TITLE')
        || !Configuration::deleteByName('SHOWCASE_THBS_ENABLE')
  		  || !Configuration::deleteByName('SHOWCASE_THBS_DIFFERENT')
  		  || !Configuration::deleteByName('SHOWCASE_THBS_WIDTH')
  		  || !Configuration::deleteByName('SHOWCASE_THBS_HEIGHT')
  		  || !Configuration::deleteByName('SHOWCASE_THBS_ALIGN')
  		  || !Configuration::deleteByName('SHOWCASE_THBS_BORDER_COLOR')
  		  || !Configuration::deleteByName('SHOWCASE_THBS_BORDER_SIZE')
  		  || !Configuration::deleteByName('SHOWCASE_THBS_FADEIN')
  		  || !Configuration::deleteByName('SHOWCASE_BTN_BORDER_RADIUS')
  		  || !Configuration::deleteByName('SHOWCASE_BTN_COLOR')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_TITLE_1')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_TITLE_2')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_TITLE_3')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_SUBTITLE_1')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_SUBTITLE_2')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_SUBTITLE_3')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_SLIDE_1')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_SLIDE_2')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_SLIDE_3')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_BUTTON_TXT_1')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_BUTTON_TXT_2')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_BUTTON_TXT_3')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_BUTTON_LINK_1')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_BUTTON_LINK_2')
  		  || !Configuration::deleteByName('SHOWCASE_IMG_BUTTON_LINK_3')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_EFFECT')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_SLICES')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_BOX_COLS')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_BOX_ROWS')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_ANIM_SPEED')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_PAUSE_TIME')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_START_SLIDE')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_PAUSE_OVER')
  		  || !Configuration::deleteByName('SHOWCASE_NIVO_SLIDER_KEYBD_NAV'))
  		return false;
  }

  /**
	 * getContent used to display admin module form
	 *
	 * @return void
	 */
  public function getContent()
  {
    $output = '';
    $this->postProcess();

    $output .= '<form action="' . Tools::safeOutput($_SERVER['REQUEST_URI']) . '" method="post" enctype="multipart/form-data">';
    $output .= '  <fieldset style="margin-bottom: 1em">';
    $output .= '    <legend>' . $this->l('Showcase images') . '</legend>';
    for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
    {
      $output .= '    <p>';
      $output .= '      <label for="showcase_img_' . $i . '">' . $this->l('Image') . ' ' . $i . '</label>';
      $output .= '      <input type="file" name="showcase_img_' . $i . '" id="showcase_img_' . $i . '" />';
      $output .= '    </p>';

      if(Configuration::get('SHOWCASE_THBS_DIFFERENT') && Configuration::get('SHOWCASE_THBS_ENABLE'))
      {
        $output .= '    <p>';
        $output .= '      <label for="showcase_thumbs_' . $i . '">' . $this->l('Thumb') . ' ' . $i . '</label>';
        $output .= '      <input type="file" name="showcase_thumbs_' . $i . '" id="showcase_thumbs_' . $i . '" />';
        $output .= '    </p>';
      }

      if(Configuration::get('SHOWCASE_USE_IMG_TITLE'))
      {
        $output .= '    <p>';
        $output .= '      <label for="showcase_img_title_' . $i . '">' . $this->l('Title') . ' ' . $i . '</label>';
        $output .= '      <input type="text" name="showcase_img_title_' . $i . '" id="showcase_img_title_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_TITLE_' . $i). '" />';
        $output .= '    </p>';
        $output .= '    <p>';
        $output .= '      <label for="showcase_img_subtitle_' . $i . '">' . $this->l('Subtitle') . ' ' . $i . '</label>';
        $output .= '      <input type="text" name="showcase_img_subtitle_' . $i . '" id="showcase_img_subtitle_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_SUBTITLE_' . $i). '" />';
        $output .= '    </p>';
      }

      $output .= '    <p>';
      $output .= '      <label for="showcase_img_button_txt_' . $i . '">' . $this->l('Text button') . ' ' . $i . '</label>';
      $output .= '      <input type="text" name="showcase_img_button_txt_' . $i . '" id="showcase_img_button_txt_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_BUTTON_TXT_' . $i). '" />';
      $output .= '    </p>';
      $output .= '    <p>';
      $output .= '      <label for="showcase_img_button_link_' . $i . '">' . $this->l('Link button') . ' ' . $i . '</label>';
      $output .= '      <input type="text" name="showcase_img_button_link_' . $i . '" id="showcase_img_button_link_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_BUTTON_LINK_' . $i). '" />';
      $output .= '    </p>';
    }
    $output .= '    <p style="text-align: center">';
    $output .= '      <input type="submit" class="button" name="submit_showcase_img" value="'.$this->l('Validate').'"/>';
    $output .= '    </p>';
    $output .= '  </fieldset>';
    $output .= '  <fieldset>';
    $output .= '    <legend>' . $this->l('Showcase configuration') . '</legend>';
    $output .= '    <fieldset style="font-size: 1em; margin-bottom: 1em">';
    $output .= '      <legend>' . $this->l('Images') . '</legend>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_image_number">' . $this->l('Image number') . '</label>';
    $output .= '        <input type="text" name="showcase_image_number" id="showcase_image_number" value="' . Configuration::get('SHOWCASE_IMG_NUMBER') . '" />';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_image_width">' . $this->l('Image width') . '</label>';
    $output .= '        <input type="text" name="showcase_image_width" id="showcase_image_width" value="' . Configuration::get('SHOWCASE_IMG_WIDTH') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in pixel. Ex: 960') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_image_height">' . $this->l('Image height') . '</label>';
    $output .= '        <input type="text" name="showcase_image_height" id="showcase_image_height" value="' . Configuration::get('SHOWCASE_IMG_HEIGHT') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in pixel. Ex: 360') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label>' . $this->l('Image title and subtitle') . '</label>';
    $output .= '        <input type="radio" name="showcase_image_use_title" id="showcase_image_use_title_yes" value="1"' . (Configuration::get('SHOWCASE_USE_IMG_TITLE') == 1 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_image_use_title_yes" class="t"><img src="../img/admin/enabled.gif" alt="' . $this->l('Enabled') . '" title="' . $this->l('Enabled') . '"></label>';
    $output .= '        <input type="radio" name="showcase_image_use_title" id="showcase_image_use_title_no" value="0"' . (Configuration::get('SHOWCASE_USE_IMG_TITLE') == 0 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_image_use_title_no" class="t"><img src="../img/admin/disabled.gif" alt="' . $this->l('Disabled') . '" title="' . $this->l('Disabled') . '"></label>';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Check it if you want to display a title and a subtitle') . '</em>';
    $output .= '      </p>';
    $output .= '    </fieldset>';
    $output .= '    <fieldset style="font-size: 1em; margin-bottom: 1em">';
    $output .= '      <legend>' . $this->l('Thumbs') . '</legend>';
    $output .= '      <p>';
    $output .= '        <label style="width: 201px">' . $this->l('Use thumbs ?') . '</label>';
    $output .= '        <input type="radio" name="showcase_thumbs_enable" id="showcase_thumbs_enable_yes" value="1"' . (Configuration::get('SHOWCASE_THBS_ENABLE') == 1 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_enable_yes" class="t"><img src="../img/admin/enabled.gif" alt="' . $this->l('Enabled') . '" title="' . $this->l('Enabled') . '"></label>';
    $output .= '        <input type="radio" name="showcase_thumbs_enable" id="showcase_thumbs_enable_no" value="0"' . (Configuration::get('SHOWCASE_THBS_ENABLE') == 0 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_enable_no" class="t"><img src="../img/admin/disabled.gif" alt="' . $this->l('Disabled') . '" title="' . $this->l('Disabled') . '"></label>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label style="width: 201px">' . $this->l('Upload a different thumb ?') . '</label>';
    $output .= '        <input type="radio" name="showcase_thumbs_different" id="showcase_thumbs_different_yes" value="1"' . (Configuration::get('SHOWCASE_THBS_DIFFERENT') == 1 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_different_yes" class="t"><img src="../img/admin/enabled.gif" alt="' . $this->l('Enabled') . '" title="' . $this->l('Enabled') . '"></label>';
    $output .= '        <input type="radio" name="showcase_thumbs_different" id="showcase_thumbs_different_no" value="0"' . (Configuration::get('SHOWCASE_THBS_DIFFERENT') == 0 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_different_no" class="t"><img src="../img/admin/disabled.gif" alt="' . $this->l('Disabled') . '" title="' . $this->l('Disabled') . '"></label>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_thumbs_width">' . $this->l('Thumbs width') . '</label>';
    $output .= '        <input type="text" name="showcase_thumbs_width" id="showcase_thumbs_width" value="' . Configuration::get('SHOWCASE_THBS_WIDTH') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in pixel. Ex: 260') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_thumbs_height">' . $this->l('Thumbs height') . '</label>';
    $output .= '        <input type="text" name="showcase_thumbs_height" id="showcase_thumbs_height" value="' . Configuration::get('SHOWCASE_THBS_HEIGHT') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in pixel. Ex: 60') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label>' . $this->l('Thumbs align') . '</label>';
    $output .= '        <input type="radio" name="showcase_thumbs_align" id="showcase_thumbs_align_left" value="left"' . (Configuration::get('SHOWCASE_THBS_ALIGN') == 'left' ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_align_left" class="t">' . $this->l('left') . '</label>';
    $output .= '        <input type="radio" name="showcase_thumbs_align" id="showcase_thumbs_align_right" value="right"' . (Configuration::get('SHOWCASE_THBS_ALIGN') == 'right' ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_align_right" class="t">' . $this->l('right') . '</label>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_thumbs_border_color">' . $this->l('Choose the active thumb border color') . '</label>';
    $output .= '        <input type="text" name="showcase_thumbs_border_color" id="showcase_thumbs_border_color" value="' . Configuration::get('SHOWCASE_THBS_BORDER_COLOR') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in hexa. Ex: #FFF') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_thumbs_border_size">' . $this->l('Choose the active thumb border size') . '</label>';
    $output .= '        <input type="text" name="showcase_thumbs_border_size" id="showcase_thumbs_border_size" value="' . Configuration::get('SHOWCASE_THBS_BORDER_SIZE') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in pixel. Ex: 1') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label>' . $this->l('FadeIn on active thumb ?') . '</label>';
    $output .= '        <input type="radio" name="showcase_thumbs_fadein" id="showcase_thumbs_fadein_yes" value="1"' . (Configuration::get('SHOWCASE_THBS_FADEIN') == 1 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_fadein_yes" class="t"><img src="../img/admin/enabled.gif" alt="' . $this->l('Enabled') . '" title="' . $this->l('Enabled') . '"></label>';
    $output .= '        <input type="radio" name="showcase_thumbs_fadein" id="showcase_thumbs_fadein_no" value="0"' . (Configuration::get('SHOWCASE_THBS_FADEIN') == 0 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_fadein_no" class="t"><img src="../img/admin/disabled.gif" alt="' . $this->l('Disabled') . '" title="' . $this->l('Disabled') . '"></label>';
    $output .= '      </p>';
    $output .= '    </fieldset>';
    $output .= '    <fieldset style="font-size: 1em; margin-bottom: 1em">';
    $output .= '      <legend>' . $this->l('Buttons') . '</legend>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_button_color">' . $this->l('Button color') . '</label>';
    $output .= '        <input type="text" name="showcase_button_color" id="showcase_button_color" value="' . Configuration::get('SHOWCASE_BTN_COLOR') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in hexa. Ex: #000') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_button_border_radius">' . $this->l('Button border radius') . '</label>';
    $output .= '        <input type="text" name="showcase_button_border_radius" id="showcase_button_border_radius" value="' . Configuration::get('SHOWCASE_BTN_BORDER_RADIUS') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Provide a value in pixel. Ex: 3') . '</em>';
    $output .= '      </p>';
    $output .= '    </fieldset>';
    $output .= '    <fieldset style="font-size: 1em; margin-bottom: 1em">';
    $output .= '      <legend>' . $this->l('Nivo Slider') . '</legend>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_effect">' . $this->l('Effect') . '</label>';
    $output .= '        <select name="showcase_nivo_slider_effect" id="showcase_nivo_slider_effect">';
    $output .= '          <option value="sliceDown" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'sliceDown' ? 'selected="selected"' : '') . '>sliceDown</option>';
    $output .= '          <option value="sliceDownLeft" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'sliceDownLeft' ? 'selected="selected"' : '') . '>sliceDownLeft</option>';
    $output .= '          <option value="sliceUp" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'sliceUp' ? 'selected="selected"' : '' ). '>sliceUp</option>';
    $output .= '          <option value="sliceUpLeft" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'sliceUpLeft' ? 'selected="selected"' : '' ). '>sliceUp</option>';
    $output .= '          <option value="sliceUpDown" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'sliceUpDown' ? 'selected="selected"' : '' ). '>sliceUpDown</option>';
    $output .= '          <option value="sliceUpDownLeft" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'sliceUpDownLeft' ? 'selected="selected"' : '' ). '>sliceUpDownLeft</option>';
    $output .= '          <option value="fold" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'fold' ? 'selected="selected"' : '' ). '>fold</option>';
    $output .= '          <option value="fade" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'fade' ? 'selected="selected"' : '' ). '>fade</option>';
    $output .= '          <option value="random" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'random' ? 'selected="selected"' : '' ). '>random</option>';
    $output .= '          <option value="slideInRight" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'slideInRight' ? 'selected="selected"' : '' ). '>slideInRight</option>';
    $output .= '          <option value="slideInLeft" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'slideInLeft' ? 'selected="selected"' : '' ). '>slideInLeft</option>';
    $output .= '          <option value="boxRandom" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'boxRandom' ? 'selected="selected"' : '' ). '>boxRandom</option>';
    $output .= '          <option value="boxRain" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'boxRain' ? 'selected="selected"' : '' ). '>boxRain</option>';
    $output .= '          <option value="boxRainReverse" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'boxRainReverse' ? 'selected="selected"' : '' ). '>boxRainReverse</option>';
    $output .= '          <option value="boxRainGrow" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'boxRainGrow' ? 'selected="selected"' : '' ). '>boxRainGrow</option>';
    $output .= '          <option value="boxRainGrowReverse" ' . (Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT') == 'boxRainGrowReverse' ? 'selected="selected"' : '' ). '>boxRainGrowReverse</option>';
    $output .= '        </select>';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Specify your effect') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_slices">' . $this->l('Slices') . '</label>';
    $output .= '        <input type="text" name="showcase_nivo_slider_slices" id="showcase_nivo_slider_slices" value="' . Configuration::get('SHOWCASE_NIVO_SLIDER_SLICES') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('For slice animations') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_box_rows">' . $this->l('Box rows') . '</label>';
    $output .= '        <input type="text" name="showcase_nivo_slider_box_rows" id="showcase_nivo_slider_box_rows" value="' . Configuration::get('SHOWCASE_NIVO_SLIDER_BOX_ROWS') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('For box animations') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_box_cols">' . $this->l('Box cols') . '</label>';
    $output .= '        <input type="text" name="showcase_nivo_slider_box_cols" id="showcase_nivo_slider_box_cols" value="' . Configuration::get('SHOWCASE_NIVO_SLIDER_BOX_COLS') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('For box animations') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_anim_speed">' . $this->l('Animation speed') . '</label>';
    $output .= '        <input type="text" name="showcase_nivo_slider_anim_speed" id="showcase_nivo_slider_anim_speed" value="' . Configuration::get('SHOWCASE_NIVO_SLIDER_ANIM_SPEED') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Slide transition speed') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_pause_time">' . $this->l('Animation time pause') . '</label>';
    $output .= '        <input type="text" name="showcase_nivo_slider_pause_time" id="showcase_nivo_slider_pause_time" value="' . Configuration::get('SHOWCASE_NIVO_SLIDER_PAUSE_TIME') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('How long each slide will show') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_start_slide">' . $this->l('Start slide') . '</label>';
    $output .= '        <input type="text" name="showcase_nivo_slider_start_slide" id="showcase_nivo_slider_start_slide" value="' . Configuration::get('SHOWCASE_NIVO_SLIDER_START_SLIDE') . '" />';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Set starting Slide (0 index)') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_keyboard_nav">' . $this->l('Keyboard navigation') . '</label>';
    $output .= '        <input type="radio" name="showcase_nivo_slider_keyboard_nav" id="showcase_nivo_slider_keyboard_nav" value="1"' . (Configuration::get('SHOWCASE_NIVO_SLIDER_KEYBD_NAV') == 1 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_fadein_yes" class="t"><img src="../img/admin/enabled.gif" alt="' . $this->l('Enabled') . '" title="' . $this->l('Enabled') . '"></label>';
    $output .= '        <input type="radio" name="showcase_nivo_slider_keyboard_nav" id="showcase_nivo_slider_keyboard_nav" value="0"' . (Configuration::get('SHOWCASE_NIVO_SLIDER_KEYBD_NAV') == 0 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_fadein_no" class="t"><img src="../img/admin/disabled.gif" alt="' . $this->l('Disabled') . '" title="' . $this->l('Disabled') . '"></label>';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Use left & right keyboard arrows') . '</em>';
    $output .= '      </p>';
    $output .= '      <p>';
    $output .= '        <label for="showcase_nivo_slider_keyboard_pause_on_over">' . $this->l('Pause on over') . '</label>';
    $output .= '        <input type="radio" name="showcase_nivo_slider_keyboard_pause_on_over" id="showcase_nivo_slider_keyboard_pause_on_over" value="1"' . (Configuration::get('SHOWCASE_NIVO_SLIDER_PAUSE_OVER') == 1 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_fadein_yes" class="t"><img src="../img/admin/enabled.gif" alt="' . $this->l('Enabled') . '" title="' . $this->l('Enabled') . '"></label>';
    $output .= '        <input type="radio" name="showcase_nivo_slider_keyboard_pause_on_over" id="showcase_nivo_slider_keyboard_pause_on_over" value="0"' . (Configuration::get('SHOWCASE_NIVO_SLIDER_PAUSE_OVER') == 0 ? 'checked="checked"' : '' ) . ' />';
    $output .= '        <label for="showcase_thumbs_fadein_no" class="t"><img src="../img/admin/disabled.gif" alt="' . $this->l('Disabled') . '" title="' . $this->l('Disabled') . '"></label>';
    $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l('Stop animation while hovering') . '</em>';
    $output .= '      </p>';
    $output .= '    </fieldset>';
    $output .= '    <p style="text-align: center">';
    $output .= '      <input type="submit" class="button" name="submit_showcase_conf" value="'.$this->l('Validate').'"/>';
    $output .= '    </p>';
    $output .= '  </fieldset>';
    $output .= '</form>';

    return $output;
  }

  /**
	 * postProcess update configuration
	 * @return void
	 */
	 public function postProcess()
 	{
 	  if (Tools::isSubmit('submit_showcase_img'))
		{
		  echo '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="ok">' . $this->l('Update successful') . '</div>';
		  $errors = '';
		  for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
      {
        $imgName = $this->showcase_img_name . $i;

        if (isset($_FILES['showcase_img_' . $i]) AND isset($_FILES['showcase_img_' . $i]['tmp_name']) AND !empty($_FILES['showcase_img_' . $i]['tmp_name']))
  			{
  			  if ($error = checkImage($_FILES['showcase_img_' . $i], Tools::convertBytes(ini_get('upload_max_filesize'))))
  					$errors .= $error;
  				else
  				{
            // Create thumb
  					if(!Configuration::get('SHOWCASE_THBS_DIFFERENT') OR (empty($_FILES['showcase_thumbs_' . $i]['tmp_name'])))
  					  $this->_createThumb($_FILES['showcase_img_' . $i], $imgName, true);

  					// Create slide
  					$this->_createSlide($_FILES['showcase_img_' . $i], $imgName, $i, true);

  					// Copy the source file
  				  $this->_createSource($_FILES['showcase_img_' . $i], $imgName);
				  }
			  }

			  if (isset($_FILES['showcase_thumbs_' . $i]) AND isset($_FILES['showcase_thumbs_' . $i]['tmp_name']) AND !empty($_FILES['showcase_thumbs_' . $i]['tmp_name']))
  			{
  			  if ($error = checkImage($_FILES['showcase_thumbs_' . $i], Tools::convertBytes(ini_get('upload_max_filesize'))))
  					$errors .= $error;
  				else
  				{
  					// Create thumb
  					$this->_createThumb($_FILES['showcase_thumbs_' . $i], $imgName, true);

  					// Copy the source file
  					$imgNameThumb = $imgName . '_thumbs';
  				  $this->_createSource($_FILES['showcase_thumbs_' . $i], $imgNameThumb);
				  }
			  }

			  if ($errors)
    			echo $this->displayError($errors);
      }

      if(Configuration::get('SHOWCASE_USE_IMG_TITLE'))
      {
        for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
        {
          Configuration::updateValue('SHOWCASE_IMG_TITLE_' . $i, Tools::getValue('showcase_img_title_' . $i));
          Configuration::updateValue('SHOWCASE_IMG_SUBTITLE_' . $i, Tools::getValue('showcase_img_subtitle_' . $i));
        }
      }

      for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
      {
        Configuration::updateValue('SHOWCASE_IMG_BUTTON_TXT_' . $i, Tools::getValue('showcase_img_button_txt_' . $i));
        Configuration::updateValue('SHOWCASE_IMG_BUTTON_LINK_' . $i, Tools::getValue('showcase_img_button_link_' . $i));
      }
	  }

 	  if (Tools::isSubmit('submit_showcase_conf'))
		{
		  echo '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="ok">' . $this->l('Update successful') . '</div>';

		  Configuration::updateValue('SHOWCASE_IMG_NUMBER', Tools::getValue('showcase_image_number'));
		  Configuration::updateValue('SHOWCASE_IMG_WIDTH', Tools::getValue('showcase_image_width'));
		  Configuration::updateValue('SHOWCASE_IMG_HEIGHT', Tools::getValue('showcase_image_height'));
		  Configuration::updateValue('SHOWCASE_USE_IMG_TITLE', Tools::getValue('showcase_image_use_title'));
      Configuration::updateValue('SHOWCASE_THBS_ENABLE', Tools::getValue('showcase_thumbs_enable'));
		  Configuration::updateValue('SHOWCASE_THBS_DIFFERENT', Tools::getValue('showcase_thumbs_different'));
		  Configuration::updateValue('SHOWCASE_THBS_WIDTH', Tools::getValue('showcase_thumbs_width'));
		  Configuration::updateValue('SHOWCASE_THBS_HEIGHT', Tools::getValue('showcase_thumbs_height'));
		  Configuration::updateValue('SHOWCASE_THBS_ALIGN', Tools::getValue('showcase_thumbs_align'));
		  Configuration::updateValue('SHOWCASE_THBS_BORDER_COLOR', Tools::getValue('showcase_thumbs_border_color'));
		  Configuration::updateValue('SHOWCASE_THBS_BORDER_SIZE', Tools::getValue('showcase_thumbs_border_size'));
		  Configuration::updateValue('SHOWCASE_THBS_FADEIN', Tools::getValue('showcase_thumbs_fadein'));
		  Configuration::updateValue('SHOWCASE_BTN_BORDER_RADIUS', Tools::getValue('showcase_button_border_radius'));
		  Configuration::updateValue('SHOWCASE_BTN_COLOR', Tools::getValue('showcase_button_color'));

		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_EFFECT', Tools::getValue('showcase_nivo_slider_effect'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_SLICES', Tools::getValue('showcase_nivo_slider_slices'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_BOX_ROWS', Tools::getValue('showcase_nivo_slider_box_rows'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_BOX_COLS', Tools::getValue('showcase_nivo_slider_box_cols'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_ANIM_SPEED', Tools::getValue('showcase_nivo_slider_anim_speed'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_PAUSE_TIME', Tools::getValue('showcase_nivo_slider_pause_time'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_START_TIME', Tools::getValue('showcase_nivo_slider_start_slide'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_KEYBD_NAV', Tools::getValue('showcase_nivo_slider_keyboard_nav'));
		  Configuration::updateValue('SHOWCASE_NIVO_SLIDER_PAUSE_OVER', Tools::getValue('showcase_nivo_slider_keyboard_pause_on_over'));
	  }
  }

	private function _deleteOldImage($fileName)
	{
	  if(file_exists($fileName))
	    unlink($fileName);
	}

	private function _createThumb($file, $name, $crop = false)
	{
	  $ext    = $this->_getExtension($file);
	  $file   = $file['tmp_name'];
	  $width  = Configuration::get('SHOWCASE_THBS_WIDTH');
	  $height = Configuration::get('SHOWCASE_THBS_HEIGHT');
    $thumb  = PhpThumbFactory::create($file);

    $fileName = $this->_showcase_thumbs_path . $name . $ext;

    $this->_deleteOldImage($fileName);

    if($crop)
      $thumb->cropFromCenter($width, $height);
    else
      $thumb->resize($width, $height);

    $thumb->save($fileName);
	}

	private function _createSlide($file, $name, $number, $crop = false)
	{
	  $ext    = $this->_getExtension($file);
	  $file   = $file['tmp_name'];
	  $width  = Configuration::get('SHOWCASE_IMG_WIDTH');
	  $height = Configuration::get('SHOWCASE_IMG_HEIGHT');
    $thumb  = PhpThumbFactory::create($file);

    $fileName = $this->_showcase_slides_path . $name . $ext;

    $this->_deleteOldImage($fileName);

    if($crop)
      $thumb->cropFromCenter($width, $height);
    else
      $thumb->resize($width, $height);

    $thumb->save($fileName);

    Configuration::updateValue('SHOWCASE_IMG_SLIDE_' . $number , $name . $ext);
	}

	private function _createSource($file, $name)
	{
	  $ext    = $this->_getExtension($file);
	  $file   = $file['tmp_name'];
	  $thumb  = PhpThumbFactory::create($file);

	  $fileName = $this->_showcase_sources_path . $name . $ext;

	  $thumb->save($fileName);
	}

	private function _getExtension($file)
	{
	  return strrchr($file['name'], '.');
	}

	function hookHeader($params)
	{
    global $smarty;

	  Tools::addJS(($this->_path) . 'js/jquery.nivo.slider.pack.js');

	  Tools::addCSS(($this->_path) . 'css/nivo-slider.css', 'all');

    $conf = array(
      'slides_path'                        => _PS_IMG_ . 'showcase/slides/',
      'thumbs_path'                        => _PS_IMG_ . 'showcase/thumbs/',
      'showcase_img_width'                 => Configuration::get('SHOWCASE_IMG_WIDTH') . 'px',
      'showcase_img_width_access'          => Configuration::get('SHOWCASE_IMG_WIDTH') + 17 . 'px',
      'showcase_img_height'                => Configuration::get('SHOWCASE_IMG_HEIGHT') . 'px',
      'showcase_thumbs_enable'             => Configuration::get('SHOWCASE_THBS_ENABLE'),
      'showcase_thumbs_width'              => Configuration::get('SHOWCASE_THBS_WIDTH') . 'px',
      'showcase_thumbs_height'             => Configuration::get('SHOWCASE_THBS_HEIGHT') . 'px',
      'showcase_thumbs_border_color'       => Configuration::get('SHOWCASE_THBS_BORDER_COLOR'),
      'showcase_thumbs_border_size'        => Configuration::get('SHOWCASE_THBS_BORDER_SIZE') . 'px',
      'showcase_button_border_radius'      => Configuration::get('SHOWCASE_BTN_BORDER_RADIUS') . 'px',
      'showcase_button_color'              => Configuration::get('SHOWCASE_BTN_COLOR'),
      'showcase_nivo_slider_effect'        => Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT'),
      'showcase_nivo_slider_slices'        => Configuration::get('SHOWCASE_NIVO_SLIDER_SLICES'),
      'showcase_nivo_slider_box_rows'      => Configuration::get('SHOWCASE_NIVO_SLIDER_BOX_ROWS'),
      'showcase_nivo_slider_box_cols'      => Configuration::get('SHOWCASE_NIVO_SLIDER_BOX_COLS'),
      'showcase_nivo_slider_anim_speed'    => Configuration::get('SHOWCASE_NIVO_SLIDER_ANIM_SPEED'),
      'showcase_nivo_slider_pause_time'    => Configuration::get('SHOWCASE_NIVO_SLIDER_PAUSE_TIME'),
      'showcase_nivo_slider_start_time'    => Configuration::get('SHOWCASE_NIVO_SLIDER_START_TIME'),
      'showcase_nivo_slider_keyboard_nav'  => Configuration::get('SHOWCASE_NIVO_SLIDER_KEYBD_NAV'),
      'showcase_nivo_slider_pause_on_over' => Configuration::get('SHOWCASE_NIVO_SLIDER_PAUSE_OVER')
    );
    if(Configuration::get('SHOWCASE_USE_IMG_TITLE'))
      $conf['showcase_img_use_title'] = true;
    else
      $conf['showcase_img_use_title'] = false;

    if(Configuration::get('SHOWCASE_THBS_ALIGN') == 'left')
      $conf['showcase_thumbs_align'] = 'nivo-controlNav-left';
    else
      $conf['showcase_thumbs_align'] = 'nivo-controlNav-right';

    if(Configuration::get('SHOWCASE_THBS_FADEIN'))
      $conf['showcase_thumbs_fadeIn'] = true;
    else
      $conf['showcase_thumbs_fadeIn'] = false;

    $smarty->assign('conf', $conf);

    return $this->display(__FILE__, '/tpl/showcase_header.tpl');
	}

	function hookHome($params)
	{
	  global $smarty;

	  $slides = array();
	  for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
    {
      $slides[$i] = array();
      $slides[$i]['title']         = Configuration::get('SHOWCASE_IMG_TITLE_' . $i);
      $slides[$i]['subtitle']      = Configuration::get('SHOWCASE_IMG_SUBTITLE_' . $i);
      $slides[$i]['img']           = Configuration::get('SHOWCASE_IMG_SLIDE_' . $i);
      $slides[$i]['button_text']   = Configuration::get('SHOWCASE_IMG_BUTTON_TXT_' . $i);
      $slides[$i]['button_link']   = Configuration::get('SHOWCASE_IMG_BUTTON_LINK_' . $i);
    }
    $conf = array(
      'slides_path'                        => _PS_IMG_ . 'showcase/slides/',
      'thumbs_path'                        => _PS_IMG_ . 'showcase/thumbs/',
      'showcase_img_width'                 => Configuration::get('SHOWCASE_IMG_WIDTH') . 'px',
      'showcase_img_width_access'          => Configuration::get('SHOWCASE_IMG_WIDTH') + 17 . 'px',
      'showcase_img_height'                => Configuration::get('SHOWCASE_IMG_HEIGHT') . 'px',
      'showcase_thumbs_enable'             => Configuration::get('SHOWCASE_THBS_ENABLE'),
      'showcase_thumbs_width'              => Configuration::get('SHOWCASE_THBS_WIDTH') . 'px',
      'showcase_thumbs_height'             => Configuration::get('SHOWCASE_THBS_HEIGHT') . 'px',
      'showcase_thumbs_border_color'       => Configuration::get('SHOWCASE_THBS_BORDER_COLOR'),
      'showcase_thumbs_border_size'        => Configuration::get('SHOWCASE_THBS_BORDER_SIZE') . 'px',
      'showcase_button_border_radius'      => Configuration::get('SHOWCASE_BTN_BORDER_RADIUS') . 'px',
      'showcase_button_color'              => Configuration::get('SHOWCASE_BTN_COLOR'),
      'showcase_nivo_slider_effect'        => Configuration::get('SHOWCASE_NIVO_SLIDER_EFFECT'),
      'showcase_nivo_slider_slices'        => Configuration::get('SHOWCASE_NIVO_SLIDER_SLICES'),
      'showcase_nivo_slider_box_rows'      => Configuration::get('SHOWCASE_NIVO_SLIDER_BOX_ROWS'),
      'showcase_nivo_slider_box_cols'      => Configuration::get('SHOWCASE_NIVO_SLIDER_BOX_COLS'),
      'showcase_nivo_slider_anim_speed'    => Configuration::get('SHOWCASE_NIVO_SLIDER_ANIM_SPEED'),
      'showcase_nivo_slider_pause_time'    => Configuration::get('SHOWCASE_NIVO_SLIDER_PAUSE_TIME'),
      'showcase_nivo_slider_start_time'    => Configuration::get('SHOWCASE_NIVO_SLIDER_START_TIME'),
      'showcase_nivo_slider_keyboard_nav'  => Configuration::get('SHOWCASE_NIVO_SLIDER_KEYBD_NAV'),
      'showcase_nivo_slider_pause_on_over' => Configuration::get('SHOWCASE_NIVO_SLIDER_PAUSE_OVER')
    );
    if(Configuration::get('SHOWCASE_USE_IMG_TITLE'))
      $conf['showcase_img_use_title'] = true;
    else
      $conf['showcase_img_use_title'] = false;

    if(Configuration::get('SHOWCASE_THBS_ALIGN') == 'left')
      $conf['showcase_thumbs_align'] = 'nivo-controlNav-left';
    else
      $conf['showcase_thumbs_align'] = 'nivo-controlNav-right';

    if(Configuration::get('SHOWCASE_THBS_FADEIN'))
      $conf['showcase_thumbs_fadeIn'] = true;
    else
      $conf['showcase_thumbs_fadeIn'] = false;

    $smarty->assign('conf', $conf);
    $smarty->assign('slides', $slides);

		return $this->display(__FILE__, '/tpl/showcase.tpl');
	}
}