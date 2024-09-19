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
  <?php include 'include/sidebar.php'; ?>
  <!--  END SIDEBAR  -->

  <!--  BEGIN CONTENT AREA  -->
  <div id="content" class="main-content">
    <div class="layout-px-spacing">
      <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
          <div class="widget-content widget-content-area br-6">
            <a href="add-sub-category.php" class="btn btn-primary float-right mt-3">Add Sub-Category</a>
            <table id="zero-config" class="table dt-table-hover" style="width:100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Sub-category Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $con->prepare("SELECT * FROM sub_category");
                $stmt->execute();
                $subCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($subCategories as $subCategory) {
                  $cat_id = $subCategory['category_id'];
                  $stmt = $con->prepare("SELECT cat_name FROM category WHERE id = ?");
                  $stmt->execute([$cat_id]);
                  $category = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                  <tr>
                    <td><?php echo htmlspecialchars($subCategory['id']); ?></td>
                    <td><?php echo htmlspecialchars($category['cat_name']); ?></td>
                    <td><?php echo htmlspecialchars($subCategory['sub_cat_name']); ?></td>
                    <td>
                      <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $subCategory['id']; ?>">
                        Update
                      </button>
                      <a href="sub_cat_delete.php?id=<?php echo $subCategory['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>

                  <!-- Update Sub-category Modal -->
                  <div class="modal fade" id="updateModal<?php echo $subCategory['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="updateModalLabel">Update Sub-category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="fuck.php" method="POST">
                            <div class="form-group">
                              <label for="category<?php echo $subCategory['id']; ?>">Category</label>
                              <select name="cat_name" class="form-control" id="category<?php echo $subCategory['id']; ?>" required>
                                <option value="" disabled>Select One</option>
                                <?php
                                $stmt = $con->prepare("SELECT * FROM category");
                                $stmt->execute();
                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($categories as $category) {
                                  $selected = ($category['id'] == $subCategory['category_id']) ? 'selected' : '';
                                ?>
                                  <option value="<?php echo htmlspecialchars($category['id']); ?>" <?php echo $selected; ?>>
                                    <?php echo htmlspecialchars($category['cat_name']); ?>
                                  </option>
                                <?php
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="subCategoryName<?php echo $subCategory['id']; ?>">Sub-category Name</label>
                              <input type="text" class="form-control" id="subCategoryName<?php echo $subCategory['id']; ?>" name="update_sub_cat" value="<?php echo htmlspecialchars($subCategory['sub_cat_name']); ?>" required>
                              <input type="hidden" name="sub_cat_id" value="<?php echo htmlspecialchars($subCategory['id']); ?>">
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="update_sub_category" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- END CONTENT AREA -->
    <?php include 'include/footer.php'; ?>
  </div>
</div>