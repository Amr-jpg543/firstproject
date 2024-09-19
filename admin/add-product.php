<?php
include 'include/header.php';
require_once 'include/connection.php';
?>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    <!--  BEGIN SIDEBAR  -->
    <?php
    include 'include/sidebar.php';
    ?>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row mt-4">
                <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h3>Add Product</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="add-product.inc.php" method="POST" enctype="multipart/form-data">

                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="category">Category</label>
                                        <select class="form-control" name="category" id="category">
                                            <option value="0" selected>Select Category</option>


                                            <?php
                                            $stmt = $con->prepare("SELECT * FROM category");
                                            $stmt->execute();
                                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($categories as $row) {
                                            ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subcategory">Sub-Category</label>
                                        <select class="form-control" name="sub_category" id="sub_category">
                                            <option value="">--SELECT--</option>
                                            <?php
                                            $stmt = $con->prepare("SELECT * FROM sub_category");
                                            $stmt->execute();
                                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($categories as $row) {
                                            ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['sub_cat_name'] ?></option>

                                            <?php } ?>
                                        </select>


                                    </div>
                                </div>


                                <div class="form-group mb-4">
                                    <label for="inputAddress">Product Name</label>
                                    <input type="text" name="p_name" require class="form-control" id="tittle" placeholder="Enter Your Product Name">
                                </div>
                                <!-- <div class="form-group mb-4">
                                    <label for="inputAddress2">Specification Of Product </label>
                                    <textarea name="editor1" class="form-control" id="" cols="30" rows="4" placeholder="ENter YOur Product Description"></textarea>
                                </div> -->
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Discount Price</label>
                                        <input type="number" name="p_discount" placeholder="Example : 50000" class="form-control" id="inputCity" require>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Product Price</label>
                                        <input type="number" name="p_price" class="form-control" placeholder="Example : 20000" id="inputCity" require>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Quantity</label>
                                        <input type="number" name="p_quantity" class="form-control" placeholder="Example : 100" id="inputCity" max="200" min="0" require>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputZip">Choose Color</label>
                                        <select class="form-control" name="p_color" id="">
                                            <option value="Multicolor">Multicolor</option>
                                            <option value="Black">Black</option>
                                            <option value="Blue">Blue</option>
                                            <option value="Pink">Pink</option>
                                            <option value="Grey">Grey</option>
                                            <option value="white">white</option>
                                            <option value="White">White</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="inputZip">Product Image</label>
                                        <input type="file" multiple name="image" class="form-control" id="inputZip">
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary float-right mt-1" name="submit" value="Publish Product">
                            </form
                                </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- END CONTENT AREA -->
            <?php
            include 'include/footer.php';
            ?>
            <script>
                $("#category").on('change', function() {
                    let id = $("#category").val();

                    $.ajax({
                        type: "POST",
                        url: "./include/add-product.php",
                        data: "call_id=" + id, // serializes the form's elements.
                        success: function(data) {
                            $("#sub_category").html(data); // show response from the php script.
                        }
                    });
                });

                CKEDITOR.replace('editor1');
            </script>








            <!-- require_once 'include/connection.php'; // Ensure this file sets up a PDO connection and assigns it to $con

            session_start();

            // Check if the request is a POST request
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Check if the required POST parameter 'call_id' is set
                if (isset($_POST['call_id'])) {
                    // Sanitize the input to prevent SQL injection and XSS
                    $call_id = filter_var($_POST['call_id'], FILTER_SANITIZE_NUMBER_INT);

                    try {
                        // Prepare the SQL statement to prevent SQL injection
                        $stmt = $con->prepare("SELECT * FROM subcategories WHERE category_id = ?");
                        $stmt->execute([$call_id]);

                        // Fetch all results as an associative array
                        $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Check if any rows were returned
                        if ($subcategories) {
                            // Loop through the subcategories and output each as an HTML option element
                            foreach ($subcategories as $subcategory) {
                                echo "<option value='" . htmlspecialchars($subcategory['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($subcategory['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                            }
                        } else {
                            // No subcategories found, output an empty option
                            echo "<option value=''>No subcategories available</option>";
                        }
                    } catch (PDOException $e) {
                        // Log the error message to a file or display an error message to the user
                        error_log("Database error: " . $e->getMessage());
                        echo "There was an error processing your request.";
                    }
                } else {
                    // If 'call_id' is not set, output an error message
                    echo "Invalid request: Missing 'call_id'.";
                }
            } else {
                // If the request method is not POST, output a 405 Method Not Allowed response
                http_response_code(405);
                echo "Method Not Allowed";
            } -->