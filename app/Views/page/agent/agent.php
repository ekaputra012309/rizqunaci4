<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Agent</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('p/dash') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Agent</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0"> </h5>
                    <div>
                        <a href="<?= base_url('p/agent_tambah') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-square"></i> Add Agent</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Agent</th>
                                <th>Kontak Person</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

</div>
<?= include('page/agent/scripts/scripts_agent.php') ?>

<?= $this->endSection() ?>