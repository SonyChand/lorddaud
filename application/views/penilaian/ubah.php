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
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header"><?= $title ?></div>
                    <div class="card-body">

                        <!-- Multi Columns Form -->
                        <form class="row g-3" method="post">
                            <div class="col-md-6 mb-2">
                                <label for="id_siswa" class="form-label">Siswa</label>
                                <select id="id_siswa" class="form-select" name="id_siswa" required>
                                    <option value="<?= $oneData->id_siswa ?>" hidden>
                                        <?= $oneData->siswa ?> - <?= $oneData->nisn ?>
                                    </option>
                                    <?php foreach ($data1 as $row): ?>
                                        <option value="<?= $row->id ?>"><?= $row->nama ?> - <?= $row->nisn ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_siswa', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="id_matpel" class="form-label">Mata Pelajaran</label>
                                <select id="id_matpel" class="form-select" name="id_matpel" required>
                                    <option value="<?= $oneData->id_matpel ?>" hidden>
                                        <?= $oneData->matpel ?> - <?= $oneData->kode ?>
                                    </option>
                                    <?php foreach ($data2 as $row): ?>
                                        <option value="<?= $row->id ?>"><?= $row->nama ?> - <?= $row->kode ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_matpel', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input type="text" class="form-control" name="nilai" id="nilai" value="<?= $oneData->nilai ?>" required>
                                <?= form_error('nilai', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="jenis_penilaian" class="form-label">Jenis Penilaian</label>
                                <input type="text" class="form-control" name="jenis_penilaian" id="jenis_penilaian" value="<?= $oneData->jenis_penilaian ?>" required>
                                <?= form_error('jenis_penilaian', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="text-end mt-5">
                                <a href="<?= base_url('penilaian/penilaian') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>