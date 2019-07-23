<?php
include 'includes/header.php';
?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="actions/export-forms.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Exporter BDD</a>
    </div>

    <!-- Content Row -->
    

    <!-- Content Row -->


            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">TP Trafic overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                    analyse de performance par touchpoint
                </div>
            </div>


        
    <!-- Content Row -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">BDD Bornes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Localisation</th>
                            <th>Interactions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Localisation</th>
                            <th>Interactions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        include 'models/User.php';

                        $user = new User($db);

                        $result = $user->getAllUsers();

                        while ($data = $result->fetch()) {
                            echo '
                                    <tr>
                                        <td>' . $data['id'] . '</td>
                                        <td>' . $data['username'] . '</td>
                                        <td>' . $data['localisation'] . '</td>
                                        <td>' . $data['interacted'] . '</td>
                                    </tr>
                                ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End DataTables-->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include 'includes/footer.php'; ?>

