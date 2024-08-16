<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <!-- <img src="<?= base_url('assets/backend/nice/assets') ?>/img/logo.png" alt=""> -->
                                <!-- <span class="d-none d-lg-block">Ubah Text Nya ya</span> -->
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                                    <p class="text-center small">Enter your new password</p>
                                </div>
                                <?= $this->session->flashdata('reset'); ?>
                                <form class="row g-3" action="" method="POST">

                                    <div class="col-12">
                                        <label for="password" class="form-label">New Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                    </div>

                                    <div class="col-12">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Kirim</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->