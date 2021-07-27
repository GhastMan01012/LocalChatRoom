<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset='utf-8' lang='en-AU'>
	<title>EComCo</title>
	<?php include 'globalLinks.php'; ?>
</head>
<body onload='query("<?php echo $_GET['category']; ?>")'>
<?php include 'headerbar.php'; ?>
<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-3'>
			<?php
			// Check if there is a category
			$noOfQueries = 0;
			foreach($_GET as $key=>$value) {
				if($key != 'query') {
					$noOfQueries++;
				}
			}
			if($noOfQueries != 0) {
				echo "<div class='row'>
				<div class='col mt-3 ml-3' style='background-color:#fff;'>
					<h3 class='m-0 p-0 my-2' style='width:fit-content;'>Filters</h3>
				</div>
			</div>";
			} else {
				echo "<div class='row'>
				<div class='col mt-3 ml-3' style='background-color:#fff;'>
					<h3 class='m-0 p-0 my-2' style='width:fit-content;'>Categories</h3>
				</div>
			</div>";
			}
			?>
			<div class='row'>
				<div class='col ml-3' style='background-color:#fff;'>
					<div id='accordion'>
						<form id='form'>
					<?php

					$servername = "localhost";
					$username = "root";
					$password = "root";

					// Create connection
					$conn = new mysqli($servername, $username, $password);

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					if($noOfQueries != 0) {
						$category_no_safe = $_GET['category'];
						$category = mysql_real_escape_string($conn,  $category_no_safe);
						$sql1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'products' AND TABLE_NAME = '".$category."';";
						$result1 = $conn->query($sql1);

						if ($result1->num_rows > 0) {
							// output data of each row
							while($row1 = $result1->fetch_assoc()) {
								$columnName = $row1['COLUMN_NAME'];

								if($columnName == "Price") {
									$sql2 = "SELECT DISTINCT Price FROM products.".$category.";";
									$result2 = $conn->query($sql2);

									echo "<div class='card'>
									<div class='card-header'>
									<a class='card-link'>
									".$columnName."
									</a>
									<a class='card-link' style='float:right;' data-toggle='collapse' href='#collapse".$columnName."' onclick='arrowToggle(\"".$columnName."\")'>
									<i class='fas fa-angle-down' id='".$columnName."Arrow'></i>
									</a>
									</div>";

									$priceArray = Array();

									if($result2->num_rows > 0) {
										while($row2 = $result2->fetch_assoc()) {
											$priceArray[] = $row2[$columnName];
										}
									}

									$maxPrice = max($priceArray);
									$maxPrice = floor($maxPrice + (100 - $maxPrice % 100));

									$minPrice = min($priceArray);
									$minPrice = floor($minPrice - $minPrice % 100);

									echo "<div class='form' id='collapse".$columnName."'>
									<input class='inputs' style='width:100%;' value='".$maxPrice."' type='range' max='".$maxPrice."' min='".$minPrice."' name='Price' list='numbers'>
									<datalist id='numbers'>";
									for($i = $minPrice; $i < 100 + $maxPrice; $i += 100) {
										echo "<option>".$i."</option>";
									}
									echo "</datalist>
									<label for='Price' style='float:left;'>$".$minPrice."</label>
									<label for='Price' style='float:right;'>$".$maxPrice."</label>
									</div>
									</div>";

								} elseif($columnName != "ItemID" && $columnName != "ItemDescription" && $columnName != "ItemName" && $columnName != "Quantity") {
									$sql2 = "SELECT DISTINCT `".$columnName."` FROM products.".$category.";";
									$result2 = $conn->query($sql2);

									echo "<div class='card'>
										<div class='card-header'>
										<a class='card-link'>
										".$columnName."
										</a>
										<a class='card-link' style='float:right;' data-toggle='collapse' href='#collapse".$columnName."' onclick='arrowToggle(\"".$columnName."\")'>
										<i class='fas fa-angle-down' id='".$columnName."Arrow'></i>
										</a>
										</div>
										<div id='collapse".$columnName."' class='collapse form'>";

									if($result2->num_rows > 0) {
										while($row2 = $result2->fetch_assoc()) {
											$filterItem = $row2[$columnName];
											// Check if a filter is already applied from the $_GET list
											if($_GET[$columnName] == $filterItem) {
												// Have the input already checked as a result
												echo "<input class='inputs' type='checkbox' name='".$columnName."' value ='".$filterItem."' checked>&nbsp;&nbsp;<label for='".$columnName."'>".$filterItem."</label><br>";
												// And then unset the variable to stop any issues that result from the variable being counted in $_GET
												unset($_GET[$columnName]);
											} else {
												// Or not
												echo "<input class='inputs' type='checkbox' name='".$columnName."' value='".$filterItem."'>&nbsp;&nbsp;<label for='".$columnName."'>".$filterItem."</label><br>";
											}
										}
									}
									echo "</div></div>";
								}
							}
						}
					} else {
						$sql = "SELECT ProductName, TableName, ProductSubCategories FROM products.ProductList;";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								$productName = $row['ProductName'];
								$spacelessName = str_replace("|", "", str_replace(" ", "", $productName));

								$productSubCategories = str_replace(' = ', ', ', $row['ProductSubCategories']);
								$productSubCategories = explode(', ', $productSubCategories);

								$category = $row['TableName'];
								echo "<div class='card'>
								<div class='card-header'>
								<a class='card-link' href='products.php?category=".$category."'>
								".$productName."
								</a>
								<a class='card-link' style='float:right;' data-toggle='collapse' href='#collapse".$spacelessName."' onclick='arrowToggle(\"".$spacelessName."\")'>
								<i class='fas fa-angle-down' id='".$spacelessName."Arrow'></i>
								</a>
								</div>
								<div id='collapse".$spacelessName."' class='collapse' data-parent='#accordion'>
								<div>";
								echo "<form method='get' id='".$spacelessName."' action='products.php'>
								<input id='".$spacelessName."1' type='hidden' value='ah'>
								<input id='".$spacelessName."2' type='hidden' value=''>
								</form>";
								$i = 0;
								foreach($productSubCategories as $value) {
									if($i % 2 == 0) {
										echo "<a class='sidebarLink' onclick='submitForm(\"$spacelessName\", \"$category\", \"$value\", \"";
									} else {
										echo $value."\")'>".$value."</a>";
									}
									$i++;
								}
								echo "</div>
								</div>
								</div>";
							}
							echo "</div>";
						} else {
						echo "0 results";
						}
					}
					$conn->close();
					?>
					</form>
					</div>
					<script>
						function submitForm(thingy, category, key, value) {
							var form = document.getElementById(thingy);
							var input1 = document.getElementById(thingy + '1');
							var input2 = document.getElementById(thingy + '2');
							input1.setAttribute('name', 'category');
							input1.setAttribute('value', category);
							input2.setAttribute('name', key);
							input2.setAttribute('value', value);
							form.submit();
						}
						function arrowToggle(element) {
							var arrow = document.getElementById(element + "Arrow");
							var collapsible = document.getElementById("collapse" + element);
							if(collapsible.className == 'collapse show') {
								arrow.className = 'fas fa-angle-down';
							} else {
								arrow.className = 'fas fa-angle-up';
							}
						}
						function query(category) {
							var inputs = document.getElementsByClassName('inputs');
							var filters = [];
                			var request = "request.php?category=" + category + "&";

                			for (i = 0; i < inputs.length; i++) {
                    			if(inputs[i].tagName == 'INPUT' && inputs[i].checked == true) {
									if(inputs[i].name in filters) {
										filters[inputs[i].name] += "," + inputs[i].value;
									} else{
										filters[inputs[i].name] = inputs[i].value;
									}
									console.log(filters);

                        			request += inputs[i].name + "=" + filters[inputs[i].name] + "&";
									console.log(request);
                    			}
								if(inputs[i].tagName == 'INPUT' && inputs[i].type == 'range') {
									request += inputs[i].name + "=" + inputs[i].value + "&";

									console.log(request);
								}
                			}

							var xmlhttp = new XMLHttpRequest();
                			xmlhttp.onreadystatechange = function() {
                    			if(this.readyState == 4 && this.status == 200) {
                        			document.getElementById("queryBox").innerHTML = this.responseText;
                    			}
                			};
                			xmlhttp.open("GET", request, true);
                			xmlhttp.send();
						}
						var form = document.getElementById('form');
						form.addEventListener('change', function() {
							query("<?php echo $category; ?>");
						});
					</script>
				</div>
			</div>
		</div>
		<div class='col-md-9'>
			<div class='row'>
				<div id='queryBox' class='col ml-3 mt-3' style='background-color:#fff;'>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
