<?php
// Only allow request to an address ending with '/'
if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) != '/'){
	header('HTTP/1.1 404 Not Found');
	exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<span class="navbar-brand">Inco</span>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?= isset($_GET['invoice']) ? '<li class="nav-item active">' : '<li class="nav-item">' ?>
				<a class="nav-link" href="?invoice">Invoice</a>
			</li>
				<?= isset($_GET['customer']) ? '<li class="nav-item active">' : '<li class="nav-item">' ?>
				<a class="nav-link" href="?customer">Customer</a>
			</li>
				<?= isset($_GET['payment']) ? '<li class="nav-item active">' : '<li class="nav-item">' ?>
				<a class="nav-link" href="?payment">Payment</a>
			</li>
		</ul>
		<!--<form class="form-inline my-2 my-lg-0" method="get">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
			<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
		</form>-->
	</div>
</nav>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<?php
			if(!isset($_GET['invoice'])&&!isset($_GET['customer'])&&!isset($_GET['payment'])&&!isset($_GET['query'])){
				echo '<li class="breadcrumb-item active">Home</li>';
			}else{
				echo '<li class="breadcrumb-item"><a href=".">Home</a></li>';

				foreach(['invoice', 'customer', 'payment'] as $department){
					if(isset($_GET[$department])){
						if($_GET[$department] == ''){
							echo '<li class="breadcrumb-item active">'.ucfirst($department).'</li>';
						}else{
							echo '<li class="breadcrumb-item"><a href="?'.$department.'">'.ucfirst($department).'</a></li>';

							if($department == 'customer'){
								echo '<li class="breadcrumb-item active">'.getCustomerName($_GET[$department], true).'</li>';
							}else{
								echo '<li class="breadcrumb-item active">'.$_GET[$department].'</li>';
							}
						}

						break;
					}
				}
			}
		?>
	</ol>
</nav>
