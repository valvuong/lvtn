<div class="maincontain-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<!-- CONTACT_INFO START-->
				<div class="contact_info">
					<div class="contact_text">
						<h2>Contact Info</h2>
						<p>^v^v^v^v^</p>
					</div>
					<div class="contact_social_media">
						<ul>
							<li>
								<span class="contact_icon"><i class="fa fa-envelope"></i></span>
								<span class="social_text">Email: example@gmail.com</span>
							</li>
							<li>
								<span class="contact_icon"><i class="fa fa-phone"></i></span>
								<span class="social_text">Phone: (1800) 765-4321</span>
							</li>
							<li>
								<span class="contact_icon"><i class="fa fa-map-marker"></i></span>
								<span class="social_text">Address: 268 Lý Thường Kiệt, P.14, Q.10, Hồ Chí Minh, Việt Nam</span>
							</li>
						</ul>
					</div>
				</div>
				<!-- CONTACT_INFO END-->
			</div>
		</div>
		<!-- MAP_COMMENT_AREA START-->
		<div class="map_comment_area">
			<div class="row">
				<!-- MAP START-->
				<div class="col-lg-5 col-md-5">
					<div class="contact-map">
						<div id="googleMap" style="width:100%;">
							<head><?php echo $map['js'];?></head>
							<div><?php echo $map['html'];?></div>
						</div>
					</div>
				</div>
				<!-- MAP END-->
				<!-- COMMENT_FORM START-->
				<div class="col-lg-6 col-md-6">
					<h2 class="heading_comments">Leave a comments</h2>
					<div class="comment_form">
						<form method="post" action="">
							<p>
								<label>Your Name(*)</label>
								<input type="text" name="name" required>
							</p>
							<p>
								<label>Email Address(*)</label>
								<input type="email" name="email" required>
							</p>
							<p><textarea rows="3" placeholder="Message(*)" name="message" required></textarea></p>
							<div class="button_for_text">
								<input type="submit" name="contact-submit" value="Post comment">
							</div>
						</form>
					</div>
				</div>
				<!-- COMMENT_FORM END-->
			</div>
		</div>
		<!-- MAP_COMMENT_AREA END-->
	</div>
</div>