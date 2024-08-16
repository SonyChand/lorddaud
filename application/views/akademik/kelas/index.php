<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3"><?= $title ?></h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="<?= base_url() ?>">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= ucwords($this->uri->segment(1)) ?></a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#"><?= $title ?></a>
                </li>
            </ul>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="p-1 flex-grow-1">
                                <h4 class="card-title"><?= $title ?></h4>
                            </div>
                            <div class="p-1">
                                <a href="" class="badge btn-primary" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </a>
                            </div>
                            <div class="p-1">
                                <a class="badge btn-warning" target="_blank" href="<?= base_url('output/data') . $title ?>"><i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>


                        <!-- Table with stripped rows -->
                    </div>
                    <form id="tbKelas">
                        <div class="modal fade" id="addRowModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah <?= $title ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_ustadz" class="form-label">Walikelas</label>
                                                <select id="id_ustadz" class="form-select" name="id_ustadz" required>
                                                    <option value="" hidden>
                                                        Pilih Walikelas
                                                    </option>
                                                    <?php foreach ($data1 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->email ?> (<?= $row->nama ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_ustadz', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nama" class="form-label">Nama Kelas</label>
                                                <input type="text" class="form-control" name="nama" id="nama" required>
                                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="status" class="form-label">Status Kelas</label>
                                                <select id="status" class="form-select" name="status" required>
                                                    <option value="" hidden>
                                                        Pilih Status Kelas
                                                    </option>
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Nonaktif</option>
                                                </select>
                                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-success">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Basic Modal-->
                    </form>

                    <div class="modal" id="editModal" tabindex="-1">
                        <div class="modal-dialog modal-lg static">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit <?= $title ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="editKelas">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="editId">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_ustadz" class="form-label">Walikelas</label>
                                                <select id="editIdUstadz" class="form-select" name="id_ustadz" required>
                                                    <option value="" hidden>
                                                        Pilih Walikelas
                                                    </option>
                                                    <?php foreach ($data1 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->email ?> (<?= $row->nama ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_ustadz', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nama" class="form-label">Nama Kelas</label>
                                                <input type="text" class="form-control" name="nama" id="editNama" required>
                                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="status" class="form-label">Status Kelas</label>
                                                <select id="editStatus" class="form-select" name="status" required>
                                                    <option value="" hidden>
                                                        Pilih Status Kelas
                                                    </option>
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Nonaktif</option>
                                                </select>
                                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->

                    <div class="card-body">
                        <?= $this->session->flashdata('kelas'); ?>
                        <div class="table-responsive">
                            <table id="kuntul" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Walikelas
                                        </th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Walikelas
                                        </th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#kuntul").DataTable({
            ajax: '<?= base_url('akademik/kelass') ?>',
            order: [],
            pageLength: 10,
            language: {
                zeroRecords: "No Data"
            },
            initComplete: function() {
                this.api()
                    .columns()
                    .every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column
                                    .search(val ? "^" + val + "$" : "", true, false)
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                select.append(
                                    '<option value="' + d + '">' + d + "</option>"
                                );
                            });
                    });
            },
        });
    });

    function editKelas(id) {
        $.ajax({
            url: '<?= base_url('akademik/getKelas') ?>',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(response) {
                $("#editId").val(response.id);
                $("#editIdUstadz").val(response.id_ustadz);
                $("#editNama").val(response.nama);
                $("#editStatus").val(response.status);
                $("#editModal").modal('show');
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    }

    function deleteKelas(id) {
        $.ajax({
            url: '<?= base_url('akademik/deleteKelas') ?>',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(response) {
                if (response.success == 1) {
                    if (response.count == 0) {
                        location.reload();
                    }
                    $("#kuntul").DataTable().ajax.reload();
                }
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    }
</script>

<script>
    $("#tbKelas").submit(function() {
        event.preventDefault();
        $.ajax({
            url: '<?= base_url('akademik/tbKelas') ?>',
            data: $("#tbKelas").serialize(),
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#addRowModal").modal('hide');
                $("#tbKelas")[0].reset();
                alert('Uhuy');
                $("#kuntul").DataTable().ajax.reload();
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    });

    $("#editKelas").submit(function() {
        event.preventDefault();
        $.ajax({
            url: '<?= base_url('akademik/editKelas') ?>',
            data: $("#editKelas").serialize(),
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#editModal").modal('hide');
                $("#editKelas")[0].reset();
                if (response == 1) {
                    alert('Uhsuy');
                } else {
                    alert('Kuntul');
                }
                $("#kuntul").DataTable().ajax.reload();
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    });
</script>