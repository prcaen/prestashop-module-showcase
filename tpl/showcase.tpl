  <!-- Showcase -->
  <style type="text/css" media="screen">
    #showcase-wrap {
      width: {$conf.showcase_img_width_access};
      height: {$conf.showcase_img_height}
    }
    #showcase {
      width: {$conf.showcase_img_width}; 
      height:{$conf.showcase_img_height}
    }
    #nivo-html-captions{
      width: {$conf.showcase_img_width}
    }
    .nivo-html-caption, .nivo-caption {
      height:{$conf.showcase_img_height}
    }
    .nivo-html-caption p a, .nivo-caption p a {
      background-color:{$conf.showcase_button_color};
      border-radius:{$conf.showcase_button_border_radius};
    }
    .nivo-controlNav a.nivo-control {
      width: {$conf.showcase_thumbs_width};
      height: {$conf.showcase_thumbs_height}
    }
    {if $conf.showcase_thumbs_fadeIn}
    .nivo-controlNav a.nivo-control img {
      opacity: 0.7;
    }
    {/if}
    .nivo-controlNav a.active {
      border: {$conf.showcase_thumbs_border_size} {$conf.showcase_thumbs_border_color} solid;
    }
    {if $conf.showcase_thumbs_fadeIn}
    .nivo-controlNav a.active img {
      opacity: 1;
    }
    {/if}
    {if $conf.showcase_img_use_title == false}
    .nivo-html-caption p strong, .nivo-html-caption p em, .nivo-caption p strong, .nivo-caption p em {
      display: none;
    }
    {/if}
   
  </style>
  <script type="text/javascript" charset="utf-8">  
    $(document).ready(function() {
      /* Disable accessibility without JS */
      $('#showcase-wrap').css({
        'overflow' : 'hidden','width' : '1000px'
      });
      $('#showcase img').css('position', 'absolute');
      $('.nivo-html-caption').hide();
      /* End Disable accessibility without JS */

      $('#showcase').nivoSlider({
        effect: "{$conf.showcase_nivo_slider_effect}",
        slices: {$conf.showcase_nivo_slider_slices},
        boxCols: {$conf.showcase_nivo_slider_box_cols},
        boxRows: {$conf.showcase_nivo_slider_box_rows},
        animSpeed: {$conf.showcase_nivo_slider_anim_speed},
        pauseTime: {$conf.showcase_nivo_slider_pause_time},
        startSlide: {$conf.showcase_nivo_slider_start_time},
        directionNav: false,
        directionNavHide: true,
        controlNav: true,
        controlNavThumbs: true,
        controlNavThumbsFromRel: true,
        keyboardNav: {$conf.showcase_nivo_slider_keyboard_nav},
        pauseOnHover: {$conf.showcase_nivo_slider_pause_on_over},
        captionOpacity: 1
      });

      /* Disable accessibility without JS */
      $('.nivo-caption').css('position', 'absolute'); // accessibility
      $('.nivo-controlNav').addClass('{$conf.showcase_thumbs_align}');
      /* End Disable accessibility without JS */
    });
  </script>
<div id="showcase-wrap">
  <div id="showcase" class="nivoSlider">
    {foreach from=$slides item=slide name=slidesLoop}
    <img src="{$conf.slides_path}{$slide.img}" alt="{$slide.title}" rel="{$conf.thumbs_path}{$slide.img}" title="#info-{$smarty.foreach.slidesLoop.index}" />
    {/foreach}
  </div>
  <div id="nivo-html-captions">
    {foreach from=$slides item=slide name=infoLoop}
    <div id="info-{$smarty.foreach.infoLoop.index}" class="nivo-html-caption">
      <div class="inner-caption">
        <strong>{$slide.title}</strong><br />
        <em>{$slide.subtitle}</em><br />
        <a href="{$slide.button_link}">{$slide.button_text}</a>
      </div>
    </div>
    {/foreach}
  </div>
</div>
  <!-- /Showcase -->
