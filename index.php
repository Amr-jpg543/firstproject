<?php
include 'include/header.php';
require_once 'admin/include/connection.php';

?>
<style>
	#clock {
		font-family: 'Orbitron', sans-serif;
		color: #212833;
		font-size: 34px;
		font-weight: bold;
	}
</style>



<!-- /NAVIGATION -->

<!-- //<a href="blank.php">product</a> -->
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="./img/shop01.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Laptop<br>Collection</h3>
						<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="./img/shop03.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Accessories<br>Collection</h3>
						<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="./img/shop02.png" alt="">
					</div>
					<div class="shop-body">
						<h3>Cameras<br>Collection</h3>
						<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Latest Products</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<!-- store products -->
				<div class="row mb-5">
					<!-- product -->
					<?php
					$stmt = $con->prepare("SELECT * FROM products");
					$stmt->execute();
					$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach ($categories as $row) {
					?>
						<div class="col-md-3 col-xs-6">
							<a href="product.php?p_id=<?php echo $row['id'] ?>">

								<div class="product">
									<div class="product-img">
										<img width="100px" height="280px" src="uploads/<?php echo $row['images']; ?>" alt="">
										<div class="product-label">
											<?php $percent = (($row['p_discount'] - $row['p_price']) * 100) / $row['p_discount']; ?>
											<span class="sale"><?php echo ceil($percent); ?>%</span>
										</div>
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="product.php?p_id=<?php echo $row['id'] ?>"><?php echo $row['p_name'] ?></a></h3>
										<h4 class="product-price">Rs : <?php echo $row['p_price'] ?> <del class="product-old-price">Rs : <?php echo $row['p_discount'] ?></del></h4>
										<div class="product-btns">
											<a href="product.php?p_id=<?php echo $row['id'] ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
										</div>
									</div>
									<!-- <div class="add-to-cart">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div> -->
								</div>
							</a>
						</div>

					<?php
					}
					?>

					<!-- /product -->


				</div>
				<!-- /store products -->



			</div>
			<!-- Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="hot-deal">
					<ul class="hot-deal-countdown">
						<li style="width: 300px !important;">
							<div id="clock"></div>
						</li>
					</ul>
					<h2 class="text-uppercase">hot deal this week</h2>
					<p>New Collection Up to 50% OFF</p>
					<a class="primary-btn cta-btn" href="store.php">Shop now</a>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Top Selling</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<!-- store products -->
				<div class="row mb-5">
					<!-- product -->


					<div class="col-md-3 col-xs-6">
						<a href="product.php?p_id=<?php echo $row['product_id'] ?>">
							<div class="product">
								<div class="product-img">
									<img width="100px" height="280px" src="./uploads/" alt="">
									<div class="product-label">

										<span class="sale">%</span>
									</div>
								</div>
								<div class="product-body">
									<h3 class="product-name"><a href=""></a></h3>
									<h4 class="product-price">Rs : <del class="product-old-price">Rs : </del></h4>

									<div class="product-btns">
										<a href="" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
									</div>
								</div>
								<!-- <div class="add-to-cart">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div> -->
							</div>
					</div>
					</a>

					<!-- /product -->


				</div>
				<!-- /store products -->



			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->

			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->

<!-- /SECTION -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Sign Up for the <strong>NEWSLETTER</strong></p>
					<form>
						<input class="input" type="email" placeholder="Enter Your Email">
						<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
					</form>
					<ul class="newsletter-follow">
						<li>
							<a href="#"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-instagram"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEWSLETTER -->

<!-- FOOTER -->
<?php
include 'include/footer.php';
?>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script>
	function currentTime() {
		var date = new Date(); /* creating object of Date class */
		var hour = date.getHours();
		var min = date.getMinutes();
		var sec = date.getSeconds();
		hour = updateTime(hour);
		min = updateTime(min);
		sec = updateTime(sec);
		document.getElementById("clock").innerText = hour + " : " + min + " : " + sec; /* adding time to the div */
		var t = setTimeout(function() {
			currentTime()
		}, 1000); /* setting timer */
	}

	function updateTime(k) {
		if (k < 10) {
			return "0" + k;
		} else {
			return k;
		}
	}

	currentTime(); /* calling currentTime() function to initiate the process */
</script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>