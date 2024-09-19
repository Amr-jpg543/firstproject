<?php
include 'include/header.php';

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
                                    <!-- <th>ID</th> -->
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <th>Sub-Total</th>
                                </tr>
                            </thead>
                            <tbody>


                                <td class="text-center">
                                    <img width="100" height="100" src="" alt="img" class="profile-img">
                                </td>
                                <td></td>

                                <td></td>
                                <td> </td>
                                <td></td>


                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                    <td>
                                        <h5 class="text-danger">Total Price =</h5>
                                    </td>
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