<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 mt-2"><img src="<?php echo base_url() ?>assets/img/logo_luhur.jpg" width="400px"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot your password ?</h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form class="user" method="POST" action="<?= base_url('auth/forgotpassword'); ?>">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger" pl-3>', '</small>'); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                                <hr>

                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth'); ?>">Back to login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>