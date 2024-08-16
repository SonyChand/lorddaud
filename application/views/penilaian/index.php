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
                                <a class="badge btn-warning" target="_blank" href="" data-bs-toggle="modal" data-bs-target="#downloadModal"><i class="fa fa-download"></i> Download</a>
                            </div>
                        </div>


                        <!-- Table with stripped rows -->
                    </div>
                    <div class="modal fade" id="addRowModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah <?= $title ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_siswa" class="form-label">Siswa</label>
                                                <select id="id_siswa" class="form-select" name="id_siswa" required>
                                                    <option value="" hidden>
                                                        Pilih Siswa
                                                    </option>
                                                    <?php foreach ($data1 as $row): ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?> - <?= $row->nisn ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_siswa', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_matpel" class="form-label">Mata Pelajaran</label>
                                                <select id="id_matpel" class="form-select" name="id_matpel" required>
                                                    <option value="" hidden>
                                                        Pilih Mata Pelajaran
                                                    </option>
                                                    <?php foreach ($data2 as $row): ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?> - <?= $row->kode ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_matpel', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="nilai" class="form-label">Nilai</label>
                                                <input type="number" class="form-control" name="nilai" id="nilai" required>
                                                <?= form_error('nilai', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="jenis_penilaian" class="form-label">Jenis Penilaian</label>
                                                <input type="text" class="form-control" name="jenis_penilaian" id="jenis_penilaian" required>
                                                <?= form_error('jenis_penilaian', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="submit" name="submit<?= $title ?>" class="btn btn-outline-success" value="Tambah">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- End Basic Modal-->

                    <div class="modal fade" id="downloadModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Download <?= $title ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="<?= base_url('output/dataNilai') ?>" target="_blank">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_siswa" class="form-label">Siswa</label>
                                                <select id="id_siswa" class="form-select" name="id_siswa" required>
                                                    <option value="" hidden>
                                                        Pilih Siswa
                                                    </option>
                                                    <option value="all">Semua Data</option>
                                                    <?php foreach ($data1 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nisn ?> - <?= $row->nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_matpel" class="form-label">Mata Pelajaran</label>
                                                <select id="id_matpel" class="form-select" name="id_matpel" required>
                                                    <option value="" hidden>
                                                        Pilih Mata Pelajaran
                                                    </option>
                                                    <option value="all">Semua Data</option>
                                                    <?php foreach ($data2 as $row): ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?> - <?= $row->kode ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-success">Download</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('penilaian'); ?>
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Siswa
                                        </th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nilai</th>
                                        <th>Jenis Penilaian</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Siswa
                                        </th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nilai</th>
                                        <th>Jenis Penilaian</th>
                                        <th></th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?php
                                                $siswa = $this->db->get_where('siswa', ['id' => $row->id_siswa])->row();
                                                if ($siswa) {
                                                    echo $siswa->nama . ' - ' . $siswa->nisn;
                                                } else {
                                                    echo 'Tidak ada';
                                                }  ?>
                                            </td>
                                            <td>
                                                <?php
                                                $matpel = $this->db->get_where('mata_pelajaran', ['id' => $row->id_matpel])->row();
                                                if ($matpel) {
                                                    echo $matpel->nama . ' - ' . $matpel->kode;
                                                } else {
                                                    echo 'Tidak ada';
                                                }  ?>
                                            </td>
                                            <td><?= $row->nilai ?></td>
                                            <td><?= $row->jenis_penilaian ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('penilaian/ubahPenilaian/') . $row->id ?>">
                                                    <span class="badge bg-warning"><i class="bi bi-pencil-square me-1"></i> Ubah</span>
                                                </a>
                                                <a href="<?= base_url('penilaian/hapusPenilaian/') . $row->id ?>" onclick="return confirm('Apakah anda yakin')">
                                                    <span class="badge bg-danger"><i class="bi bi-trash me-1"></i> Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>