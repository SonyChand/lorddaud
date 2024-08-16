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
                                <label for="kurikulum" class="form-label">Kurikulum</label>
                                <input type="text" class="form-control" name="kurikulum" id="kurikulum" value="<?= $oneData->kurikulum ?>" required>
                                <?= form_error('kurikulum', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" class="form-select" name="status" required>
                                    <option value="<?= $oneData->status ?>" hidden>
                                        <?php if ($oneData->status == 1) {
                                            echo 'Aktif';
                                        } else {
                                            echo 'Nonaktif';
                                        }
                                        ?>
                                    </option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="text-end mt-5">
                                <a href="<?= base_url('kurikulum/kurikulum') ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>