<div id="left" class="ads">
	<div class="side-bar"> 
		<h2><i class="fa fa-align-justify"></i>Loại</h2>
		<div>
			<ul>
				<?php
				$icons = array(
					1 => 'fa fa-laptop',
					'fa fa-spoon',
					'fa fa-home',
					'fa fa-motorcycle',
					'fa fa-book',
					'glyphicon glyphicon-option-horizontal'
				);
				$results = $this->mmarket_category->get_all();
				?>
                <?php foreach($results as $row): ?>
                    <li>
                    	<a href="<?php echo site_url($row['id'].'-rao-vat-1') ?>">
                    		<span><i class="<?=$icons[$row['id']]?>"></i></span><?=$row['tenloai']?> <span class="right-icon"><!-- <i class="fa fa-arrow-circle-o-right"></i> --></span>
                    	</a>
                    </li>
                <?php endforeach ?>
				
				<li><a href="category_grid.html"><span><i class="fa fa-video-camera"></i></span>Digital Camera <span class="right-icon"><i class="fa fa-arrow-circle-o-right"></i></span></a>
					<div class="category-mega-menu">
						<span class="menu-text">							
							<a href="category_grid.html">Clothing</a>
							<a href="category_grid.html">Shoes</a>
							<a href="category_grid.html">Bags</a>
							<a href="category_grid.html">Headwear</a>
							<a href="category_grid.html">Accessories</a>
							<a href="category_grid.html">News Arrivals</a>
						</span>
						<span>
							<img src="<?php echo image_url() ?>bg.png" alt="Mens" />
						</span>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>