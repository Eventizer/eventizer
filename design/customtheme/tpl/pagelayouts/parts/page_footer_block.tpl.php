<section id="footer">
<div class="inner-column">
    <div class="container">
        <div class="row">
        	<?php foreach (erLhcoreClassModelArticleCategory::getList(array('limit'=>3, 'filter'=>array('type'=>2,'parent_id'=>0))) as $category):?>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                <h5 class="uppercase"><?=$category->name?></h5>
                <ul class="list-unstyled">
                	<?php foreach (erLhcoreClassModelArticleCategory::getList(array('limit'=>3, 'filter'=>array('parent_id'=>$category->id))) as $cat):?>
                    <li><a href="<?=$cat->url_path?>"><?=$cat->name?></a></li>
                    <?php endforeach;?>
                 </ul>
              </div>
              <?php endforeach;?>
          
             <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
              	<?php /*  <h5 class="uppercase">Subscribe to our Newsletter</h5>*/?>
             </div>
          </div>
       </div>
   </div>
</section>

<section id="footer-bottom">
    <div class="inner-column">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <p class="text-center"> © 2014 
                    </p>
                    <p class="text-center"><small>Powered by: <a href="http://eventizer.org" target="_blank">Eventizer.</a></small>
                    </p>
                 </div>
            </div>
        </div>
    </div>
</section>