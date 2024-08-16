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
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_matpel" class="form-label">Mata Pelajaran</label>
                                                <select id="id_matpel" class="form-select" name="id_matpel" required>
                                                    <option value="" hidden>
                                                        Pilih Mata Pelajaran
                                                    </option>
                                                    <?php foreach ($data1 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?> (<?= $row->kode ?>)</option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_matpel', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="id_ustadz" class="form-label">Guru Pengampu</label>
                                                <select id="id_ustadz" class="form-select" name="id_ustadz" required>
                                                    <option value="" hidden>
                                                        Pilih Guru Pengampu
                                                    </option>
                                                    <?php foreach ($data2 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_ustadz', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="id_kelas" class="form-label">Kelas</label>
                                                <select id="id_kelas" class="form-select" name="id_kelas" required>
                                                    <option value="" hidden>
                                                        Pilih Kelas
                                                    </option>
                                                    <?php foreach ($data3 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('id_kelas', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="hari" class="form-label">Hari</label>
                                                <select id="hari" class="form-select" name="hari" required>
                                                    <option value="" hidden>
                                                        Pilih Hari
                                                    </option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                    <option value="Sabtu">Sabtu</option>
                                                    <option value="Minggu">Minggu</option>
                                                </select>
                                                <?= form_error('hari', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required>
                                                <?= form_error('jam_mulai', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" required>
                                                <?= form_error('jam_selesai', '<small class="text-danger">', '</small>'); ?>
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
                                <form method="POST" action="<?= base_url('output/dataJadwal') ?>" target="_blank">
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="kelas" class="form-label">Kelas</label>
                                                <select id="kelas" class="form-select" name="kelas" required>
                                                    <option value="" hidden>
                                                        Pilih Kelas
                                                    </option>
                                                    <option value="all">Semua Data</option>
                                                    <?php foreach ($data3 as $row) : ?>
                                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
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
                        <?= $this->session->flashdata('jadwal'); ?>
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Mata Pelajaran
                                        </th>
                                        <th>Guru</th>
                                        <th>Kelas</th>
                                        <th>Jadwal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Mata Pelajaran
                                        </th>
                                        <th>Guru</th>
                                        <th>Kelas</th>
                                        <th>Jadwal</th>
                                        <th></th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($dataTab as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?php $matpel = $this->db->get_where('mata_pelajaran', ['id' => $row->id_matpel])->row();
                                                if ($matpel) {
                                                    echo $matpel->nama . ' - ' . $matpel->kode;
                                                } else {
                                                    echo 'Belum ada';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php $ustadz = $this->db->get_where('ustadz', ['id' => $row->id_ustadz])->row();
                                                if ($ustadz) {
                                                    echo $ustadz->nama;
                                                } else {
                                                    echo 'Belum ada';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php $kelas = $this->db->get_where('kelas', ['id' => $row->id_kelas])->row();
                                                if ($kelas) {
                                                    echo $kelas->nama;
                                                } else {
                                                    echo 'Belum ada';
                                                }
                                                ?>
                                            </td>
                                            <td><?= $row->hari ?>, <?= date('H:i', $row->jam_mulai) ?> - <?= date('H:i', $row->jam_selesai) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('akademik/ubah') . $title . '/' . $row->id ?>">
                                                    <span class="badge bg-warning"><i class="bi bi-pencil-square me-1"></i> Ubah</span>
                                                </a>
                                                <a href="<?= base_url('akademik/hapus') . $title . '/' . $row->id ?>" onclick="return confirm('Apakah anda yakin')">
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