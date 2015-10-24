<div class="ad-content"></div>
<div class="ad-gallery">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php $i = 0 ?>
            <?php foreach($content['tenhinh'] as $image): ?>
                <div class="item <?php if($i==0) echo 'active'; ?>">
                    <img src="<?=uploads_url()?>post/<?=$image['tenhinh']?>">
                </div>
                <?php $i++ ?>
            <?php endforeach ?>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-circle-arrow-left size40" aria-hidden="true"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-circle-arrow-right size40" aria-hidden="true"></span>
        </a>
    </div>
</div>