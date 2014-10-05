<h1><?=__t('user/login','Event widget demo')?></h1>

<hr />
<!-- Place this tag where you want the Live Helper Status to render. -->
<div id="widget_container" ></div>

<script type="text/javascript">
var eventWidget = {};
eventWidget.opt = {widget_width:'300'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = '//dev.eventizer.org/event/widget'
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>