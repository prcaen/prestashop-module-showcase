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
*  @copyright 2011-2012 Pierrick CAEN
*  @version   0.2
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/

require_once _PS_MODULE_DIR_ . 'showcase/phpthumb/ThumbLib.inc.php';

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
    $this->version = 0.2;
    $this->author  = 'Pierrick CAEN';
    
    $this->_localhost = true;

    parent::__construct();

    $this->displayName      = $this->l('Showcase with Nivo Slider');
    $this->description      = $this->l('A slideshow which use the jQuery framework and Nivo Slider jQuery plugin');
    
    if($this->_localhost)
      $this->_showcase_img_path     = 'http://localhost/prestashop-module-showcase/modules/' . $this->name . '/img/';
    else
      $this->_showcase_img_path     = _PS_MODULE_DIR_ . $this->name . '/img/';

    $this->_showcase_slides_path  = $this->_showcase_img_path . 'slides/';
    $this->_showcase_thumbs_path  = $this->_showcase_img_path . 'thumbs/';
    $this->_showcase_sources_path = $this->_showcase_img_path . 'sources/';
    
    $this->_config = array(
      'defaultsValues' => array(
        'Images' => array(
          array(
            'name'  => 'SHOWCASE_IMG_NUMBER',
            'id'    => 'showcase_image_number',
            'title' => 'Image number',
            'type'  => 'text',
            'value' => 3,
            'help'  => ''
          ),
          array(
            'name'  => 'SHOWCASE_IMG_WIDTH',
            'id'    => 'showcase_image_width',
            'title' => 'Image width',
            'type'  => 'text',
            'value' => 1000,
            'help'  => 'Provide a value in pixel. Ex: 960'
          ),
          array(
            'name'  => 'SHOWCASE_IMG_HEIGHT',
            'id'    => 'showcase_image_height',
            'title' => 'Image height',
            'type'  => 'text',
            'value' => 360,
            'help'  => 'Provide a value in pixel. Ex: 360'
          )
        ),
        'Thumbs' => array(
          array(
            'name'  => 'SHOWCASE_THBS_DIFFERENT',
            'id'    => 'showcase_thumbs_different',
            'title' => 'Upload a different thumb ?',
            'type'  => 'radio',
            'value' => 1,
            'help'  => 'Check it if you want to display a title and a subtitle'
          ),
          array(
            'name'  => 'SHOWCASE_THBS_WIDTH',
            'id'    => 'showcase_thumbs_width',
            'title' => 'Thumbs width',
            'type'  => 'text',
            'value' => 133,
            'help'  => 'Provide a value in pixel. Ex: 260'
          ),
          array(
            'name'  => 'SHOWCASE_THBS_HEIGHT',
            'id'    => 'showcase_thumbs_height',
            'title' => 'Thumbs height',
            'type'  => 'text',
            'value' => 115,
            'help'  => 'Provide a value in pixel. Ex: 60'
          ),
          array(
            'name'  => 'SHOWCASE_THBS_ALIGN',
            'id'    => 'showcase_thumbs_align',
            'title' => 'Thumbs align',
            'type'  => 'radio2',
            'options' => array(
              'left',
              'right'
            ),
            'value' => 'left'
          ),
          array(
            'name'  => 'SHOWCASE_THBS_BORDER_COLOR',
            'type'  => 'colorpicker',
            'id'    => 'showcase_thumbs_border_color',
            'title' => 'Choose the active thumb border color',
            'value' => '#95d4dc',
            'help'  => 'Provide a value in hexa. Ex: #FFF'
          ),
          array(
            'name'  => 'SHOWCASE_THBS_FADEIN',
            'type'  => 'radio',
            'id'    => 'showcase_thumbs_fadein',
            'title' => 'FadeIn on active thumb ?',
            'value' => 1
          )
        ),
        'Text'    => array(
          array(
            'name'  => 'SHOWCASE_USE_IMG_TITLE',
            'id'    => 'showcase_image_use_title',
            'title' => 'Use image title',
            'type'  => 'checkbox',
            'value' => 1,
            'help'  => 'Check it if you want to display a title'
          ),
          array(
            'name'  => 'SHOWCASE_USE_IMG_SUBTITLE',
            'id'    => 'showcase_image_use_subtitle',
            'title' => 'Use image subtitle',
            'type'  => 'checkbox',
            'value' => 1,
            'help'  => 'Check it if you want to display a subtitle'
          ),
          array(
            'name'  => 'SHOWCASE_USE_IMG_DESCRIPTION',
            'id'    => 'showcase_image_use_description',
            'title' => 'Use image description',
            'type'  => 'checkbox',
            'value' => 0,
            'help'  => 'Check it if you want to display a description'
          )
        ),
        'Buttons' => array(
          array(
            'name'  => 'SHOWCASE_BTN_COLOR_DIFFERENT',
            'type'  => 'radio',
            'id'    => 'showcase_button_color_different',
            'title' => 'Use a different button color',
            'value' => 1
          ),
          array(
            'name'  => 'SHOWCASE_BTN_COLOR',
            'type'  => 'colorpicker',
            'id'    => 'showcase_button_color',
            'title' => 'Button color',
            'value' => '#e15b49',
            'help'  => 'Provide a value in hexa. Ex: #000'
          ),
          array(
            'name'  => 'SHOWCASE_BTN_TEXT_DIFFERENT',
            'type'  => 'radio',
            'id'    => 'showcase_button_text_different',
            'title' => 'Use a different button text',
            'value' => 1
          )
        ),
        'Nivo Slider' => array(
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_EFFECT',
            'type'  => 'select',
            'id'    => 'showcase_nivo_slider_effect',
            'title' => 'Effect',
            'value' => 'fade',
            'options' => array(
              'sliceDown',
              'sliceDownLeft',
              'sliceUp',
              'sliceUpLeft',
              'sliceUpDown',
              'sliceUpDownLeft',
              'fold',
              'fade',
              'random',
              'slideInRight',
              'slideInLeft',
              'boxRandom',
              'boxRain',
              'boxRainReverse',
              'boxRainGrow',
              'boxRainGrowReverse'
            ),
            'help' => ''
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_SLICES',
            'id'    => 'showcase_nivo_slider_slices',
            'title' => 'Slices',
            'type'  => 'text',
            'value' => 15,
            'help' => ''
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_BOX_COLS',
            'id'    => 'showcase_nivo_slider_box_cols',
            'title' => 'Box cols',
            'type'  => 'text',
            'value' => 8,
            'help' => 'For box animations'
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_BOX_ROWS',
            'id'    => 'showcase_nivo_slider_box_rows',
            'title' => 'Box rows',
            'type'  => 'text',
            'value' => 4,
            'help' => 'For box animations'
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_ANIM_SPEED',
            'id'    => 'showcase_nivo_slider_anim_speed',
            'title' => 'Animation speed',
            'type'  => 'text',
            'value' => 500,
            'help'  => 'Slide transition speed'
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_PAUSE_TIME',
            'id'    => 'showcase_nivo_slider_pause_time',
            'title' => 'Animation time pause',
            'type'  => 'text',
            'value' => 0,
            'help'  => 'How long each slide will show'
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_START_SLIDE',
            'id'    => 'showcase_nivo_slider_start_slide',
            'title' => 'Start slide',
            'type'  => 'text',
            'value' => 0,
            'help'  => 'Set starting Slide (0 index)'
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_PAUSE_OVER',
            'id'    => 'showcase_nivo_slider_keyboard_pause_on_over',
            'title' => 'Pause on over',
            'type'  => 'radio',
            'value' => 1,
            'help'  => 'Stop animation while hovering'
          ),
          array(
            'name'  => 'SHOWCASE_NIVO_SLIDER_KEYBD_NAV',
            'id'    => 'showcase_nivo_slider_keyboard_nav',
            'title' => 'Keyboard navigation',
            'type'  => 'radio',
            'value' => 1,
            'help' => 'Use left & right keyboard arrows'
          )
        )
      ),
      'defaultsMedia' => array(
        'SHOWCASE_IMG_TITLE_' => 'Lookbook',
        'SHOWCASE_IMG_SUBTITLE_' => 'PRINTEMPS-ÉTÉ 2011',
        'SHOWCASE_IMG_SLIDE_' => 'showcase_img_',
        'SHOWCASE_IMG_BUTTON_TXT_' => 'Accédez au lookbook',
        'SHOWCASE_IMG_BUTTON_LINK_' => 'http://www.google.fr'
      )
    );
  }
  
  public function install()
  {
    if(!parent::install())
      return false;
    
    // Register hooks
    if(!$this->registerHook('home') || !$this->registerHook('header'))
      return false;
    
    foreach ($this->_config['defaultsValues'] as $key => $type)
    {
      foreach ($type as $value)
      {
        if(!Configuration::updateValue($value['name'], $value['value']))
          return false;
      }
    }
    
	  for($i = 1; $i <= $this->_config['defaultsValues']['Images'][0]['value']; $i++)
	  {
      foreach ($this->_config['defaultsMedia'] as $media => $value)
      {
        if($media == 'SHOWCASE_IMG_SLIDE_')
        {
          if(!Configuration::updateValue($media . $i, $value . $i . '.jpg'))
            return false;
        }
        else
        {
          if(!Configuration::updateValue($media . $i, $value))
            return false;
        }
      }
    }

  	return true;
  }
  
  public function uninstall()
  {
    if(!parent::uninstall())
      return false;
    
    foreach ($this->_config['defaultsValues'] as $key => $type)
    {
      foreach ($type as $value)
      {
        if(!Configuration::deleteByName($value['name']))
          return false;
      }
    }
    
    for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
    {
      foreach ($this->_config['defaultsMedia'] as $media => $value)
      {
        if(!Configuration::deleteByName($media . $i))
          return false;
      }
    }

    return true;
  }
  
  /**
	 * getContent used to display admin module form
	 * 
	 * @return void
	 */
  public function getContent()
  {
    $output = '<script type="text/javascript">
    $(document).ready(function() {
      if($("input[name=showcase_button_color_different]").val() == 0)
         $("#color_showcase_button_color").parent().show();
      else
         $("#color_showcase_button_color").parent().hide();

       $("input[name=\'showcase_button_color_different\']").change(function()
       {
         if($(this).val() == 0)
           $("#color_showcase_button_color").parent().show();
         else
           $("#color_showcase_button_color").parent().hide();
       }); 
    });
    </script>';
    
    $output .= '<script type="text/javascript" src="/prestashop-module-showcase/js/jquery/jquery-colorpicker.js"></script>';
    $this->postProcess();

    $output .= '<form action="' . Tools::safeOutput($_SERVER['REQUEST_URI']) . '" method="post" enctype="multipart/form-data">';
    $output .= '  <fieldset style="margin-bottom: 1em">';
    $output .= '    <legend>' . $this->l('Showcase images') . '</legend>';
    for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
    {
      $output .= '    <fieldset style="font-size: 1em; margin-bottom: 1em">';
      $output .= '    <legend>' . $this->l('Image') . ' ' . $i . '</legend>';
      $output .= '    <p style="float:right; text-align:center">';
      $output .= '    <strong>' . $this->l('Slide') . '</strong><br />';
      $output .= '      <img src="' . $this->_showcase_slides_path . Configuration::get('SHOWCASE_IMG_SLIDE_' . $i) .'" alt="" width="400" /><br />';
      $output .= '    <strong>' . $this->l('Thumb') . '</strong><br />';
      $output .= '      <img src="' . $this->_showcase_thumbs_path . Configuration::get('SHOWCASE_IMG_SLIDE_' . $i) .'" alt="" />';
      $output .= '    </p>';
      $output .= '    <p>';
      $output .= '      <label for="showcase_img_' . $i . '">' . $this->l('Image') .'</label>';
      $output .= '      <input type="file" name="showcase_img_' . $i . '" id="showcase_img_' . $i . '" />';
      $output .= '    </p>';

      if(Configuration::get('SHOWCASE_THBS_DIFFERENT'))
      {
        $output .= '    <p>';
        $output .= '      <label for="showcase_thumbs_' . $i . '">' . $this->l('Thumb') . '</label>';
        $output .= '      <input type="file" name="showcase_thumbs_' . $i . '" id="showcase_thumbs_' . $i . '" />';
        $output .= '    </p>';
      }

      if(Configuration::get('SHOWCASE_USE_IMG_TITLE'))
      {
        $output .= '    <p>';
        $output .= '      <label for="showcase_img_title_' . $i . '">' . $this->l('Title') . '</label>';
        $output .= '      <input type="text" name="showcase_img_title_' . $i . '" id="showcase_img_title_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_TITLE_' . $i). '" />';
        $output .= '    </p>';
      }

      if(Configuration::get('SHOWCASE_USE_IMG_SUBTITLE'))
      {
        $output .= '    <p>';
        $output .= '      <label for="showcase_img_subtitle_' . $i . '">' . $this->l('Subtitle') . '</label>';
        $output .= '      <input type="text" name="showcase_img_subtitle_' . $i . '" id="showcase_img_subtitle_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_SUBTITLE_' . $i). '" />';
        $output .= '    </p>';
      }

      if(Configuration::get('SHOWCASE_USE_IMG_DESCRIPTION'))
      {
        $output .= '    <p>';
        $output .= '      <label for="showcase_img_description_' . $i . '">' . $this->l('Description') . '</label>';
        $output .= '      <textarea rows="5" cols="45" name="showcase_img_description_' . $i . '" id="showcase_img_description_' . $i . '">' . Configuration::get('SHOWCASE_IMG_DESCRIPTION_' . $i). '</textarea>';
        $output .= '    </p>';
      }
      
      if(Configuration::get('SHOWCASE_BTN_COLOR_DIFFERENT'))
      {
        $output .= '    <p>';
        $output .= '      <label for="color_' . $i . '">' . $this->l('Button color') . '</label>';
        $output .= '      <input type="text" data-hex="true" class="color mColorPickerInput mColorPicker" name="showcase_button_color_' . $i . '" id="color_' . $i . '" value="' . Configuration::get('SHOWCASE_BTN_COLOR_' . $i). '" />';
        $output .= '      <span style="cursor:pointer;" id="icp_color_' . $i . '" class="mColorPickerTrigger" data-mcolorpicker="true"><img src="../img/admin/color.png" style="border:0;margin:0 0 0 3px" align="absmiddle"></span>';
        $output .= '    </p>';
      }

      if(Configuration::get('SHOWCASE_BTN_TEXT_DIFFERENT'))
      {
        $output .= '    <p>';
        $output .= '      <label for="showcase_img_button_txt_' . $i . '">' . $this->l('Text button') . '</label>';
        $output .= '      <input type="text" name="showcase_img_button_txt_' . $i . '" id="showcase_img_button_txt_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_BUTTON_TXT_' . $i). '" />';
        $output .= '    </p>';
      }
      $output .= '    <p>';
      $output .= '      <label for="showcase_img_button_link_' . $i . '">' . $this->l('Link button') . '</label>';
      $output .= '      <input type="text" name="showcase_img_button_link_' . $i . '" id="showcase_img_button_link_' . $i . '" value="' . Configuration::get('SHOWCASE_IMG_BUTTON_LINK_' . $i). '" />';
      $output .= '    </p>';
      
      $output .= '  </fieldset>';
    }

    $output .= '    <p style="text-align: center">';
    $output .= '      <input type="submit" class="button" name="submit_showcase_img" value="'.$this->l('Validate').'"/>';
    $output .= '    </p>';
    $output .= '  </fieldset>';
    $output .= '  <fieldset>';
    $output .= '    <legend>' . $this->l('Showcase configuration') . '</legend>';
    
    foreach ($this->_config['defaultsValues'] as $key => $type)
    {
      $output .= '    <fieldset style="font-size: 1em; margin-bottom: 1em">';
      $output .= '      <legend>' . $this->l($key) . '</legend>';

      foreach ($type as $value)
      {
        $output .= '      <p style="margin-top:10px     ">';
      
        switch($value['type'])
        {
          case 'text':
            $output .= '        <label for="' . $value['id'] . '">' . $this->l($value['title']) . '</label>';
            $output .= '        <input type="text" name="' . $value['id'] . '" id="' . $value['id'] . '" value="' . Configuration::get($value['name']) . '" />';
            break;
      
          case 'select':
            $output .= '        <label for="' . $value['id'] . '">' . $this->l($value['title']) . '</label>';
            $output .= '        <select name="' . $value['id'] . '" id="' . $value['id'] . '">';
            foreach ($value['options'] as $option)
              $output .= '          <option value="' . $option . '" ' . (Configuration::get($value['name']) == $option ? 'selected="selected"' : '') . '>' . $option . '</option>';
            $output .= '        </select>';
            break;
      
          case 'radio':
            $output .= '        <label>' . $this->l($value['title']) . '</label>';
            $output .= '        <input type="radio" name="' . $value['id'] . '" id="' . $value['id'] . '_yes" value="1"' . (Configuration::get($value['name']) == 1 ? 'checked="checked"' : '' ) . ' />';
            $output .= '        <label for="' . $value['id'] . '_yes" class="t"><img src="../img/admin/enabled.gif" alt="' . $this->l('Enabled') . '" title="' . $this->l('Enabled') . '"></label>';
            $output .= '        <input type="radio" name="' . $value['id'] . '" id="' . $value['id'] . '_no" value="0"' . (Configuration::get($value['name']) == 0 ? 'checked="checked"' : '' ) . ' />';
            $output .= '        <label for="' . $value['id'] . '_no" class="t"><img src="../img/admin/disabled.gif" alt="' . $this->l('Disabled') . '" title="' . $this->l('Disabled') . '"></label>';
            break;
            
          case 'radio2':
            $output .= '        <label>' . $this->l($value['title']) . '</label>';
            foreach ($value['options'] as $option)
            {
              $output .= '        <input type="radio" name="' . $value['id'] . '" id="' . $value['id'] . '_' . $option .'" value="' . $option . '"' . (Configuration::get($value['name']) == $option ? 'checked="checked"' : '' ) . ' />';
              $output .= '        <label for="' . $value['id'] . '_' . $option .'" class="t">'. $this->l($option) .'</label>';
            }
            break;
          
          case 'checkbox':
            $output .= '        <label for="' . $value['id'] . '">' . $this->l($value['title']) . '</label>';
            $output .= '        <input type="checkbox" name="' . $value['id'] . '" id="' . $value['id'] . '" value="1"' . (Configuration::get($value['name']) == 1 ? 'checked="checked"' : '' ) . ' />';
            break;
            
          case 'colorpicker':
            $output .= '      <label for="color_' . $value['id'] . '">' . $this->l($value['title']) . '</label>';
            $output .= '      <input type="text" data-hex="true" class="color mColorPickerInput mColorPicker" name="' . $value['id'] . '" id="color_' . $value['id'] . '" value="' . Configuration::get($value['name'] ). '" />';
            $output .= '      <span style="cursor:pointer;" id="icp_color_' . $value['id'] . '" class="mColorPickerTrigger" data-mcolorpicker="true"><img src="../img/admin/color.png" style="border:0;margin:0 0 0 3px" align="absmiddle"></span>';
            $output .= '    </p>';
        }
      
        if(isset($value['help']))
          $output .= '        <em style="color: #7F7F7F; font-size: 0.85em">' . $this->l($value['help']) . '</em>';
      
        $output .= '      </p>';
      }
      
      $output .= '    </fieldset>';
    }
    
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
          Configuration::updateValue('SHOWCASE_IMG_TITLE_' . $i, Tools::getValue('showcase_img_title_' . $i));
      }

      if(Configuration::get('SHOWCASE_USE_IMG_SUBTITLE'))
      {
        for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
          Configuration::updateValue('SHOWCASE_IMG_SUBTITLE_' . $i, Tools::getValue('showcase_img_subtitle_' . $i));
      }
      
      if(Configuration::get('SHOWCASE_USE_IMG_DESCRIPTION'))
      {
        for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
          Configuration::updateValue('SHOWCASE_IMG_DESCRIPTION_' . $i, Tools::getValue('showcase_img_description_' . $i));
      }
      
      if(Configuration::get('SHOWCASE_BTN_COLOR_DIFFERENT'))
      {
        for($i = 1; $i <= Configuration::get('SHOWCASE_IMG_NUMBER'); $i++)
          Configuration::updateValue('SHOWCASE_BTN_COLOR_' . $i, Tools::getValue('showcase_button_color_' . $i));
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

      foreach ($this->_config['defaultsValues'] as $type)
      {
        foreach ($type as $value)
          Configuration::updateValue($value['name'], Tools::getValue($value['id']));
      }
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
	  Tools::addJS(($this->_path) . 'nivoslider/jquery.nivo.slider.pack.js');

	  Tools::addCSS(($this->_path) . 'nivoslider/nivo-slider.css', 'all');
	  Tools::addCSS(($this->_path) . 'showcase.css', 'all');
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
      'slides_path'                        => '/modules/showcase/images/slides/',
      'thumbs_path'                        => '/modules/showcase/images/thumbs/',
      'showcase_img_width'                 => Configuration::get('SHOWCASE_IMG_WIDTH') . 'px',
      'showcase_img_width_access'          => Configuration::get('SHOWCASE_IMG_WIDTH') + 17 . 'px',
      'showcase_img_height'                => Configuration::get('SHOWCASE_IMG_HEIGHT') . 'px',
      'showcase_thumbs_width'              => Configuration::get('SHOWCASE_THBS_WIDTH') . 'px',
      'showcase_thumbs_height'             => Configuration::get('SHOWCASE_THBS_HEIGHT') . 'px',
      'showcase_thumbs_border_color'       => Configuration::get('SHOWCASE_THBS_BORDER_COLOR'),
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
      
		return $this->display(__FILE__, 'showcase.tpl');
	}
}