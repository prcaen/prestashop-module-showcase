<!-- Showcase -->
<style type="text/css" media="screen">
#showcase-wrap { position: relative; overflow: auto; height: 360px; width:1017px; }
#showcase { width:1000px; height: 360px; position:relative; }
#showcase img { position: static; }
#nivo-html-captions { position: absolute; top: 0; left: 0; width: 1000px; }
.nivo-html-caption, .nivo-caption { display: block; height: 360px; background: none;position: relative; }
.nivo-html-caption div, .nivo-caption div { position: absolute; top: 60px; left: 225px; color: #fff; }
.nivo-html-caption div strong, .nivo-caption div strong { font:italic bold 3.4em Georgia, "Times New Roman", Times, serif; }
.nivo-html-caption div em, .nivo-caption div em { font:normal normal 1.4em "Myriad Pro", sans-serif; }
.nivo-html-caption div a, .nivo-caption div a { margin: 35px 0 0 55px;display:block;background-color:#e15b49;border-radius:10px;color:#FFF;display:block !important;font:italic bold .95em Georgia, "Times New Roman", Times, serif;height:17px;padding:10px 15px;text-align:center;text-shadow:0 2px 2px rgba(120,28,47,0.85);width:192px; }
.nivo-caption div a { margin-top: 20px; }
.nivo-controlNav { position:absolute;top:10px;z-index:12; }
.nivo-controlNav-left { left:10px; }
.nivo-controlNav-right { right:10px; }
.nivo-controlNav a.nivo-control { cursor:pointer;display:block;margin-bottom:10px;  }

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
  background-color: {$conf.showcase_button_color};
  border-radius: {$conf.showcase_button_border_radius};
}
{if $conf.showcase_thumbs_enable}
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
    controlNavThumbs: {$conf.showcase_thumbs_enable},
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
<!-- /Showcase -->