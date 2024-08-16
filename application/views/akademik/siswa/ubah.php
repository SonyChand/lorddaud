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
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select id="id_kelas" class="form-select" name="id_kelas" required>
                                    <option value="<?= $oneData->id_kelas ?>" hidden>
                                        <?php
                                        $uhuy = $this->db->get_where('kelas', ['id' => $oneData->id_kelas])->row();
                                        if ($oneData->id_kelas) {
                                            echo $uhuy->nama;
                                        } else {
                                            echo "Pilih Kelas";
                                        }
                                        ?>
                                    </option>
                                    <?php foreach ($data1 as $row): ?>
                                        <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" name="nisn" id="nisn" value="<?= $oneData->nisn ?>" required>
                                <?= form_error('nisn', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $oneData->nama ?>" required>
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="tel" class="form-control" name="nik" id="nik" value="<?= $oneData->nik ?>" required>
                                <?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="no_kk" class="form-label">No KK</label>
                                <input type="tel" class="form-control" name="no_kk" id="no_kk" value="<?= $oneData->no_kk ?>" required>
                                <?= form_error('no_kk', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="jk" class="form-label">Jenis Kelamin</label>
                                <select id="jk" class="form-select" name="jk" required>
                                    <option value="<?= $oneData->jk ?>" hidden>
                                        <?php if ($oneData->jk == 'L') : ?>
                                            Laki-laki
                                        <?php else : ?>
                                            Perempuan
                                        <?php endif; ?>
                                    </option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <?= form_error('jk', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tpt_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tpt_lahir" id="tpt_lahir" value="<?= $oneData->tpt_lahir ?>" required>
                                <?= form_error('tpt_lahir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?= date('Y-m-d', $oneData->tgl_lahir) ?>" required>
                                <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="no_hp" class="form-label">No Handphone</label>
                                <input type="tel" class="form-control" name="no_hp" id="no_hp" value="<?= $oneData->no_hp ?>" required>
                                <?= form_error('no_hp', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" class="form-control" name="agama" id="agama" value="<?= $oneData->agama ?>" required>
                                <?= form_error('agama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="cita_cita" class="form-label">Cita-cita</label>
                                <input type="text" class="form-control" name="cita_cita" id="cita_cita" value="<?= $oneData->cita_cita ?>" required>
                                <?= form_error('cita_cita', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="hobi" class="form-label">Hobi</label>
                                <input type="text" class="form-control" name="hobi" id="hobi" value="<?= $oneData->hobi ?>" required>
                                <?= form_error('hobi', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" value="<?= $oneData->nama_ayah ?>" required>
                                <?= form_error('nama_ayah', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" required><?= $oneData->alamat ?></textarea>
                                <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="text-end mt-5">
                                <a href="<?= base_url('akademik/ustadz') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>