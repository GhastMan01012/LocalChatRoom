
					<?php
					$category_no_safe = $_GET['category'];

					$servername = "localhost";
					$username = "root";
					$password = "root";

					// Create connection
					$conn = new mysqli($servername, $username, $password);
					$category = mysql_real_escape_string($conn,  $category_no_safe);

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					// Construct SQL query
					$filters = Array();

					foreach($_GET as $key => $value) {
						if($key != 'category' && $key != 'numRows') {
							$filters[$key] = $value;
						}
					}
					if(count($filters) == 0) {
						$sql = "SELECT ItemID, Price, ItemName, Brand FROM products.".$category.";";
					} elseif(count($filters) == 1) {
						$sql = "SELECT ItemID, Price, ItemName, Brand FROM products.".$category." WHERE ";
						foreach($filters as $key => $value) {
            	if($key == "Price" || $key == "BaseFrequency" || $key == "BoostFrequency") {
                if($key == "BaseFrequency" || $key == "BoostFrequency") {
                  $value = floatval($value) + 0.1;
                  $sql .= $key." < ".$value.";";
                } else {
                  $sql .= $key." < ".$value.";";
                }
              } elseif($key != "numRows") {
                if(strpos($value, ',')) {
                  $temp = explode(',', $value);
                  $sql .= $key." IN (";

                	$k = 0;
                	$j = count($temp);
                  foreach($temp as $value) {
                    if($k == $j - 1) {
                      $sql .= "'".$value."'";
                    } else {
                      $sql .= "'".$value."', ";
                    }
                    $k++;
                  }
                  $sql .= ");";
                } else {
                  $sql .= $key."='".$value."';";
              	}
              }
						}
					} else {
						$sql = "SELECT ItemID, Price, ItemName, Brand FROM products.".$category." WHERE ";
						$i = 0;
						$l = count($filters);
						foreach($filters as $key => $value) {
							if($i == $l - 1) {
                if($key == "Price" || $key == "BaseFrequency" || $key == "BoostFrequency") {
                  if($key == "BaseFrequency" || $key == "BoostFrequency") {
                    $value = floatval($value) + 0.1;
                    $sql .= $key." < ".$value.";";
                  } else {
                    $sql .= $key." < ".$value.";";
                  }
                } elseif($key != "numRows") {
                  if(strpos($value, ',')) {
                    $temp = explode(',', $value);
                    $sql .= $key." IN (";
                    $k = 0;
                    $j = count($temp);
                    foreach($temp as $value) {
                    	if($k == $j - 1) {
                      	$sql .= "'".$value."'";
                      } else {
                        $sql .= "'".$value."', ";
                      }
                      $k++;
                    }
                  	$sql .= ");";
                  } else {
                    $sql .= $key."='".$value."';";
        					}
                }
							} else {
                if($key == "Price" || $key == "BaseFrequency" || $key == "BoostFrequency") {
                  if($key == "BaseFrequency" || $key == "BoostFrequency") {
                    $value = floatval($value) + 0.1;
                    $sql .= $key." < ".$value." AND ";
                	} else {
                  	$sql .= $key." < ".$value." AND ";
                	}
              	} elseif($key != "numRows") {
                	if(strpos($value, ',')) {
                  	$temp = explode(',', $value);
                  	$sql .= $key." IN (";
                  	$k = 0;
                  	$j = count($temp);
                  	foreach($temp as $value) {
                  		if($k == $j - 1) {
                      	$sql .= "'".$value."'";
                    	} else {
                      	$sql .= "'".$value."', ";
                    	}
                    	$k++;
                  	}
                		$sql .= ") AND ";
                	} else {
                  	$sql .= $key."='".$value."' AND ";
                	}
              	}
              	$i++;
							}
						}
        	}
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						$i = 0;
						if(isset($_GET['numRows'])) {
							$limit = (4 * $_GET['numRows']) - 1;
							echo $limit;
						} else {
							$limit = 0;
						}
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$id = $row['ItemID'];
							$price = '$'.$row['Price'];
							$name = $row['ItemName'];
							$brand = $row['Brand'];
							if($i == 0) {
								echo "<div class='row'>
								<div class='col-sm-3 mt-2'>
								<a href='items.php?category=".$category."&ID=".$id."'>
								<img width='100%' src='/images/".$category."/".$brand."/".$id."_thumbnail.jpg' onerror='this.onerror=null;this.src=\"/images/".$category."/".$brand."/".$id."_thumbnail.png\"'>
								<h5>".$name."</h5>
								<h6>".$price."</h6>
								</a>
								</div>";
							} elseif($i != 1 && (($i + 1) % 4) == 0) {
								echo "<div class='col-sm-3 mt-2'>
								<a href='items.php?category=".$category."&ID=".$id."'>
								<img width='100%' src='/images/".$category."/".$brand."/".$id."_thumbnail.jpg' onerror='this.onerror=null;this.src=\"/images/".$category."/".$brand."/".$id."_thumbnail.png\"'>
								<h5>".$name."</h5>
								<h6>".$price."</h6>
								</a>
								</div>
								</div>";
								if($limit == $i) {
									echo "<!--";
								}
							} else {
								echo "<div class='col-sm-3 mt-2'>
								<a href='items.php?category=".$category."&ID=".$id."'>
								<img width='100%' src='/images/".$category."/".$brand."/".$id."_thumbnail.jpg' onerror='this.onerror=null;this.src=\"/images/".$category."/".$brand."/".$id."_thumbnail.png\"'>
								<h5>".$name."</h5>
								<h6>".$price."</h6>
								</a>
								</div>";
							}
							$i++;
						}
        	}
        	$conn->close();
					?>
