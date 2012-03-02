<!-- Showcase -->
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
