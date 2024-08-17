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
                            <?php if (getAddCrudAccess() != 0): ?>
                                <div class="p-1">
                                    <a href="" class="badge btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="fa fa-plus"></i>
                                        Add
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php if (getDownloadCrudAccess() != 0): ?>
                                <div class="p-1">
                                    <a class="badge btn-warning" target="_blank" href="<?= base_url('output/data') . $title ?>"><i class="fa fa-download"></i> Download</a>
                                </div>
                            <?php endif; ?>
                        </div>


                        <!-- Table with stripped rows -->
                    </div>
                    <form id="addUserForm">
                        <div class="modal fade" id="addModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add <?= $title ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" name="name" id="name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" id="email" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="role_id" class="form-label">Role Access</label>
                                                <select id="role_id" class="form-select" name="role_id" required>
                                                    <option value="" hidden>
                                                        Select
                                                    </option>
                                                    <?php foreach ($dataSelectRole as $row) : ?>
                                                        <option value="<?= $row->id_role ?>"><?= $row->role ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="is_active" class="form-label">Active Status</label>
                                                <select id="is_active" class="form-select" name="is_active" required>
                                                    <option value="" hidden>
                                                        Select
                                                    </option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-success">Add</button>
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
                                <form id="editUserForm">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_user" id="editId">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control" name="name" id="editName" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" name="email" id="editEmail" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="role_id" class="form-label">Role Access</label>
                                                <select id="editRole" class="form-select" name="role_id" required>
                                                    <option value="" hidden>
                                                        Select
                                                    </option>
                                                    <?php foreach ($dataSelectRole as $row) : ?>
                                                        <option value="<?= $row->id_role ?>"><?= $row->role ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="is_active" class="form-label">Active Status</label>
                                                <select id="editActive" class="form-select" name="is_active" required>
                                                    <option value="" hidden>
                                                        Select
                                                    </option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
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
                        <?= $this->session->flashdata('user'); ?>
                        <div class="table-responsive">
                            <table id="basic-something" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Email
                                        </th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Active</th>
                                        <?php
                                        if (getEditCrudAccess() != 0 || getDeleteCrudAccess() != 0) {
                                            echo '<th></th>';
                                        }
                                        ?>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Email
                                        </th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Active</th>
                                        <?php
                                        if (getEditCrudAccess() != 0 || getDeleteCrudAccess() != 0) {
                                            echo '<th></th>';
                                        }
                                        ?>

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
        $("#basic-something").DataTable({
            ajax: '<?= base_url('admin/listUser'); ?>',
            order: [],
            pageLength: 10,
            language: {
                zeroRecords: "No data..."
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

    function editUser(id_user) {
        $.ajax({
            url: '<?= base_url('admin/getUser') ?>',
            data: {
                id_user: id_user
            },
            method: 'post',
            dataType: 'json',
            success: function(response) {
                $("#editId").val(response.id_user);
                $("#editName").val(response.name);
                $("#editEmail").val(response.email);
                $("#editRole").val(response.role_id);
                $("#editActive").val(response.is_active);
                $("#editModal").modal('show');
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    }

    function deleteUser(id_user) {
        $.ajax({
            url: '<?= base_url('admin/deleteUser') ?>',
            data: {
                id_user: id_user
            },
            method: 'post',
            dataType: 'json',
            success: function(response) {
                if (response.success == 1) {
                    if (response.count == 0) {
                        location.reload();
                    }
                    $("#basic-something").DataTable().ajax.reload();
                }
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    }
</script>

<script>
    $("#addUserForm").submit(function() {
        event.preventDefault();
        $.ajax({
            url: '<?= base_url('admin/addUser') ?>',
            data: $("#addUserForm").serialize(),
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#addModal").modal('hide');
                $("#addUserForm")[0].reset();
                $("#basic-something").DataTable().ajax.reload();
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    });

    $("#editUserForm").submit(function() {
        event.preventDefault();
        $.ajax({
            url: '<?= base_url('admin/editUser') ?>',
            data: $("#editUserForm").serialize(),
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#editModal").modal('hide');
                $("#editUserForm")[0].reset();
                $("#basic-something").DataTable().ajax.reload();
            },
            error: function() {
                alert('Error occurred during AJAX request');
            }
        })
    });
</script>