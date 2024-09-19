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
                        <table id="zero-config" class="table dt-table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $con->prepare("SELECT * FROM orders");
                                $stmt->execute();
                                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($orders as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php
                                            $id = $row['user_id'];
                                            $stmt = $con->prepare("SELECT * FROM users WHERE id=?");
                                            $stmt->execute([$id]);
                                            $orders1 = $stmt->fetch(PDO::FETCH_ASSOC);
                                            if (isset($orders1)) {
                                                echo $orders1['name'];
                                            } else {
                                                echo "No user";
                                            }
                                            ?></td>
                                        <td><?php
                                            // $p_id = $row['product_id'];
                                            // $stmt = $con->prepare("SELECT * FROM products WHERE id=?");
                                            // $stmt->execute([$p_id]);
                                            // $a = $stmt->fetch(PDO::FETCH_ASSOC);
                                            // echo $a['p_name'];
                                            ?></td>
                                        <td>
                                            <?php
                                            $txt = "";
                                            if ($row['status'] == 0) {
                                                $txt = "Pending";
                                                $txt2 = "Cancel";
                                            }
                                            ?>
                                            <a href="include/process.php?pending_change=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm"><?php echo $txt; ?></a>
                                            <a href="include/process.php?cancel_Id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm"><?php echo $txt2; ?></a>
                                        </td>
                                        <td>
                                            <a href="include/process.php?co_id=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>





        <!-- END CONTENT AREA -->
        <?php
        include 'include/footer.php';
        ?>