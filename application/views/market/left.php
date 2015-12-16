<div id="left" class="ads">
	<div class="side-bar"> 
		<h2><i class="fa fa-align-justify"></i>Loại</h2>
		<div>
			<ul>
				<?php
				$icons = array(
					1 => 'fa fa-laptop',
					'fa fa-pencil',
					'fa fa-motorcycle',
					'fa fa-book',
					'glyphicon glyphicon-option-horizontal'
				);
				$results = $this->mmarket_category->get_all();
				?>
                <?php foreach($results as $row): ?>
                    <li>
                    	<a href="<?php echo site_url($row['id'].'-rao-vat-1') ?>">
                    		<?php
                    		$qr = $this->mmarket_category->get_sub_category($row['id']);
                    		?>
                    		<span><i class="<?=$icons[$row['id']]?>"></i></span><?=$row['tenloai']?> 
                    		<?php if($qr != null): ?>
	                    		<span class="right-icon"><i class="fa fa-arrow-circle-o-right"></i></span>
	                    	<?php endif ?>
                    	</a>
                    	<?php if($qr != null): ?>
                    		<div class="category-mega-menu">
								<span class="menu-text">
									<?php foreach($qr as $r): ?>
										<a href="<?php echo site_url('market/get_by_subcategory/'.$r['id']) ?>"><?=$r['tenloai']?></a>
									<?php endforeach ?>
								</span>
							</div>
                		<?php endif ?>
                    </li>
                <?php endforeach ?>
			</ul>
		</div>
	</div>
</div>