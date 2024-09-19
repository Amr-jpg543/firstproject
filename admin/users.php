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
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                try {
                                    $stmt = $con->prepare("SELECT * FROM users");
                                    $stmt->execute();
                                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if ($users) {
                                        foreach ($users as $user) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                <td><?php echo htmlspecialchars($user['address']); ?></td>
                                                <td><?php echo htmlspecialchars($user['city']); ?></td>
                                                <td><?php echo htmlspecialchars($user['country']); ?></td>
                                                <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                                <td>
                                                    <?php
                                                    // Assuming 'role' is a column in your database
                                                    // You can customize this based on your application's roles
                                                    echo '<div class="badge badge-primary">' . htmlspecialchars($user['role']) . '</div>';
                                                    ?>
                                                </td>

                                                <!-- Update the delete link with actual functionality -->
                                                <!-- The delete should use POST request, handled by another PHP file -->
                                                <td>
                                                    <a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>

                                            </tr>
                                <?php }
                                    } else {
                                        echo '<tr><td colspan="9">No users found.</td></tr>';
                                    }
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
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