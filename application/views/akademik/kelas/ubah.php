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
                        <form class="row g-3" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $oneData->id ?>">
                            <div class="col-md-6 mb-2">
                                <label for="id_ustadz" class="form-label">Akun Pengguna</label>
                                <select id="id_ustadz" class="form-select" name="id_ustadz" required>
                                    <option value="<?= $oneData->id_ustadz ?>" hidden>
                                        <?php
                                        $uhuy = $this->db->get_where('pengguna', ['id' => $oneData->id_ustadz])->row();
                                        if ($oneData->id_ustadz) {
                                            echo $uhuy->email . ' - ' . $uhuy->nama;
                                        } else {
                                            echo "Belum ada";
                                        }
                                        ?>
                                    </option>
                                    <?php foreach ($data1 as $row): ?>
                                        <option value="<?= $row->id ?>"><?= $row->email . ' - ' . $row->nama ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_ustadz', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $oneData->nama ?>" required>
                                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="status" class="form-label">Status Kelas</label>
                                <select id="status" class="form-select" name="status" required>
                                    <option value="<?= $oneData->status ?>" hidden>
                                        <?php if ($oneData->status == 1) : ?>
                                            Aktif
                                        <?php else : ?>
                                            Nonaktif
                                        <?php endif; ?>
                                    </option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="text-end mt-5">
                                <a href="<?= base_url('akademik/kelas') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>