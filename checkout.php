<?php
include 'include/header.php';
require_once 'admin/include/connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
	header('Location: login.php');
	exit();
}

$usr_id = $_SESSION['id'];

// Fetch user details
$stmt_user = $con->prepare("SELECT * FROM users WHERE id = ?");
$stmt_user->execute([$usr_id]);
$user_info = $stmt_user->fetch(PDO::FETCH_ASSOC);

// Fetch products in the user's cart
$stmt_cart = $con->prepare("
    SELECT cart.product_id, cart.p_qty, products.p_name, products.p_price 
    FROM cart 
    JOIN products ON cart.product_id = products.id 
    WHERE cart.user_id = ?
");
$stmt_cart->execute([$usr_id]);
$cart_items = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);

$cart_total = 0;
$output = '';

// Calculate cart total and prepare order summary
foreach ($cart_items as $item) {
	$total = $item['p_price'] * $item['p_qty'];
	$cart_total += $total;
	$output .= $item['product_id'] . '-' . $item['p_qty'] . ',';
}

$cart_product_ids = rtrim($output, ','); // Remove trailing comma
?>
<!-- /NAVIGATION -->

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Checkout</h3>
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Home</a></li>
					<li class="active">Checkout</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<form id="order_place" action="checkout.inc.php" method="POST">
			<div class="row">
				<!-- Billing Details -->
				<div class="col-md-7">
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">Billing Address</h3>
						</div>
						<div class="form-group">
							<input class="input" type="text" readonly name="name" value="<?= htmlspecialchars($user_info['name']); ?>" placeholder="Name">
						</div>
						<div class="form-group">
							<input class="input" type="email" readonly name="email" value="<?= htmlspecialchars($user_info['email']); ?>" placeholder="Email">
						</div>
						<div class="form-group">
							<input class="input" type="text" readonly name="address" value="<?= htmlspecialchars($user_info['address']); ?>" placeholder="Address">
						</div>
						<div class="form-group">
							<input class="input" type="text" readonly name="city" value="<?= htmlspecialchars($user_info['city']); ?>" placeholder="City">
						</div>
						<div class="form-group">
							<input class="input" type="text" readonly name="country" value="<?= htmlspecialchars($user_info['country']); ?>" placeholder="Country">
						</div>
						<div class="form-group">
							<input class="input" type="tel" readonly name="tel" value="<?= htmlspecialchars($user_info['phone']); ?>" placeholder="Telephone">
						</div>
					</div>

					<!-- Shipping Details -->
					<div class="shipping-details">
						<div class="section-title">
							<h3 class="title">Shipping Address</h3>
						</div>
						<div class="form-group">
							<textarea class="input" name="shipping_address" placeholder="Enter Your Shipping Address" required></textarea>
						</div>
					</div>
					<button type="submit" class="primary-btn btn-block order-submit" name="submit">Place Order</button>
				</div>

				<!-- Order Details -->
				<div class="col-md-5 order-details">
					<div class="section-title text-center">
						<h3 class="title">Your Order</h3>
					</div>
					<div class="order-summary">
						<div class="order-col">
							<div><strong>PRODUCT</strong></div>
							<div><strong>TOTAL</strong></div>
						</div>
						<div class="order-products">
							<?php foreach ($cart_items as $item): ?>
								<div class="order-col">
									<div><?= htmlspecialchars($item['p_name']); ?></div>
									<div><?= $item['p_qty']; ?> x Rs: <?= $item['p_price']; ?> = Rs: <?= $item['p_price'] * $item['p_qty']; ?></div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="order-col">
							<div>
								<h4>Delivery Charges</h4>
							</div>
							<div><strong>FREE</strong></div>
						</div>
						<div class="order-col">
							<div><strong>TOTAL</strong></div>
							<div><strong class="order-total">Rs: <?= $cart_total; ?></strong></div>
						</div>
					</div>

					<!-- Hidden fields for form submission -->
					<input type="hidden" name="total_price" value="<?= $cart_total; ?>">
					<!-- <input type="hidden" name="p_id" value="?>"> -->

					<!-- Terms and Conditions -->
					<div class="input-checkbox">
						<input type="checkbox" id="terms" required>
						<label for="terms">
							<span></span>
							I've read and accept the <a href="#">terms & conditions</a>
						</label>
					</div>
				</div>
			</div>
		</form>

	</div>
</div>
<!-- /SECTION -->

<!-- FOOTER -->
<?php include 'include/footer.php'; ?>

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<!-- <script>
	$('#order_place').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			method: "POST",
			url: "../admin/include/process.php",
			data: "Mode=order_place&" + $('#order_place').serialize(),
			success: function(data) {
				swal("Good Job!", data, "success");
				$('.swal-button--confirm').on('click', () => window.location.reload());
			}
		});
	});
</script> -->
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>