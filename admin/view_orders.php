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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Shipping Address</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- <?php
                                        // $txt = "";
                                        // if($row['status'] == 1){
                                        //     $txt = "Completed";
                                        // }
                                    ?> -->
                                    <!-- <div class="badge badge-primary"></div> -->
                                        <!-- <a href=""></a> -->
                                    </td>       
                                    <td><a href="" class="btn btn-success btn-sm">View Order</a> 
                                        | <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                 </tr>
                               
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