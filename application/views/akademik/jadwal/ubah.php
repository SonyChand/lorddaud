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
                            <input type="hidden" name="id" value="<?= $oneData->id ?>">
                            <div class="col-md-6 mb-2">
                                <label for="id_matpel" class="form-label">Mata Pelajaran</label>
                                <select id="id_matpel" class="form-select" name="id_matpel" required>
                                    <option value="<?= $oneData->id_matpel ?>" hidden>
                                        <?php
                                        $uhuy = $this->db->get_where('mata_pelajaran', ['id' => $oneData->id_matpel])->row();
                                        if ($oneData->id_matpel) {
                                            echo $uhuy->nama . ' - ' . $uhuy->kode;
                                        } else {
                                            echo "Pilih";
                                        }
                                        ?>
                                    </option>
                                    <?php foreach ($data1 as $row) : ?>
                                        <option value="<?= $row->id ?>"><?= $row->nama . ' - ' . $row->kode ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_matpel', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="id_ustadz" class="form-label">Guru Pengampu</label>
                                <select id="id_ustadz" class="form-select" name="id_ustadz" required>
                                    <option value="<?= $oneData->id_ustadz ?>" hidden>
                                        <?php
                                        $uhuy = $this->db->get_where('ustadz', ['id' => $oneData->id_ustadz])->row();
                                        if ($oneData->id_ustadz) {
                                            echo $uhuy->nama;
                                        } else {
                                            echo "Pilih";
                                        }
                                        ?>
                                    </option>
                                    <?php foreach ($data2 as $row) : ?>
                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_ustadz', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select id="id_kelas" class="form-select" name="id_kelas" required>
                                    <option value="<?= $oneData->id_kelas ?>" hidden>
                                        <?php
                                        $uhuy = $this->db->get_where('kelas', ['id' => $oneData->id_kelas])->row();
                                        if ($oneData->id_kelas) {
                                            echo $uhuy->nama;
                                        } else {
                                            echo "Pilih";
                                        }
                                        ?>
                                    </option>
                                    <?php foreach ($data3 as $row) : ?>
                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_kelas', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="<?= date('H:i', $oneData->jam_mulai) ?>" required>
                                <?= form_error('jam_mulai', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="<?= date('H:i', $oneData->jam_selesai) ?>" required>
                                <?= form_error('jam_selesai', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="hari" class="form-label">Hari</label>
                                <select id="hari" class="form-select" name="hari" required>
                                    <option value="<?= $oneData->hari ?>" hidden>
                                        <?= $oneData->hari ?>
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

                            <div class="text-end mt-5">
                                <a href="<?= base_url('akademik/jadwal') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>