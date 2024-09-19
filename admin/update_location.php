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
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <?php
                        if (isset($_GET['l_id'])) {
                            $user_id = $_GET['l_id'];
                            $stmt = $con->prepare("SELECT * FROM `locationw` WHERE `id` =?");
                            $stmt->execute([$user_id]);
                            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }
                        if ($users) {
                            foreach ($users as $location) { ?>
                                <form action="update_loction.inc.php?l_id=<?php echo $location['id']; ?>" method="POST" class="p-4">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="update_id" value="<?php echo $location['id']; ?>" aria-describedby="emailHelp" placeholder="Enter name">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name" value="" aria-describedby="emailHelp" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Street</label>
                                        <input type="text" class="form-control" name="street" value="<?php echo $location['street']; ?>" aria-describedby="emailHelp" placeholder="Enter street">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">City</label>
                                        <input type="text" class="form-control" name="city" value="<?php echo $location['city']; ?>" aria-describedby="emailHelp" placeholder="Enter city">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Phone</label>
                                        <input type="number" class="form-control" name="phone" value="<?php echo $location['phone']; ?>" aria-describedby="emailHelp" placeholder="Enter phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $location['email']; ?>" aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <input type="text" class="form-control" name="description" value="<?php echo $location['description']; ?>" aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                    </div>
                                </form>
                        <?php }
                        } else {
                            echo "a7aaa";
                        } ?>
                    </div>
                </div>

            </div>
        </div>





        <!-- END CONTENT AREA -->
        <?php
        include 'include/footer.php';
        ?>