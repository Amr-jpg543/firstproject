<?php
require_once 'admin/include/connection.php';
session_start();
if (isset($_SESSION['login'])) { ?>

    <?php
    include 'include/header.php';
    ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->

        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <a href="index.php" class="btn btn-primary float-right mt-3">Add to more item</a>
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">

                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $usr_id = $_SESSION['id'];
                                $stmt = $con->prepare("SELECT * FROM cart WHERE user_id =?");
                                $stmt->execute([$usr_id]);
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categories as $row) {
                                ?>
                                    <tbody>

                                        <tr>
                                            <td><?php echo $row['product_id']; ?></td>
                                            <td>
                                                <?php
                                                $p_id = $row['product_id'];
                                                $stmt = $con->prepare("SELECT * FROM products WHERE id=?");
                                                $stmt->execute([$p_id]);
                                                $a = $stmt->fetch(PDO::FETCH_ASSOC);
                                                echo $a['p_name'];
                                                ?>

                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id'] ?>">
                                                    Update
                                                </button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id'] ?>">
                                                    Update
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- MODEL FOR Category -->

                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form action="include/process.php" method="POST">
                                                            <label for="">Category Name</label>
                                                            <input type="hidden" value="" name="cat_id">
                                                            <input type="text" value="" name="cat_name">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="update_category" class="btn btn-primary">Save changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tbody>
                                <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>



            <!-- END CONTENT AREA -->
            <?php
            include 'include/footer.php';
            ?>











        <?php } else { ?>

            <h3 class="title">Latest Products</h3>



        <?php } ?>