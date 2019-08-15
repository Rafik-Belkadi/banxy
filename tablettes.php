<?php
include 'includes/header.php';
?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="actions/export.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Exporter Rapport d'activités</a>
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

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Trafic overview</h6>
                        <button id="decrement" class="btn-circle btn-primary btn-sm"> < </button>
                        <p id="id"></p>
                        <button id="increment" class="btn-circle btn-primary btn-sm"> ></button>
                        
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                        <div id="loader"></div>
                            <canvas id="chartById"></canvas>
                        </div>
                        <hr>
                        analyse de performance par touchpoints
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
                            <th>Formulaires</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Localisation</th>
                            <th>Interactions</th>
                            <th>Formulaires</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        include 'models/User.php';

                        $user = new User($db);

                        $result = $user->getAllUsers();

                        while ($data = $result->fetch()) {
                            $formsNumber = $user->getFormsSubmittedByUser($data['id']);
                            echo '
                                    <tr>
                                        <td>' . $data['id'] . '</td>
                                        <td>' . $data['username'] . '</td>
                                        <td>' . $data['localisation'] . '</td>
                                        <td>' . $data['interacted'] . '</td>
                                        <td>' . $formsNumber. '</td>
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

