<?php include 'app/views/shares/header.php'; ?>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        
                        <form action="/webbanhang/account/updatePassword" method="post">
                            <div class="mb-md-5 mt-md-4">
                                <h2 class="fw-bold mb-2 text-uppercase">Reset Password</h2>
                                <p class="text-white-50 mb-5">Please enter your new password.</p>
                                
                                <?php if (isset($errors) && !empty($errors)) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php foreach ($errors as $error) : ?>
                                            <p><?php echo htmlspecialchars($error); ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label" for="password">New Password</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="confirm_password" class="form-control form-control-lg" required />
                                    <label class="form-label" for="confirm_password">Confirm New Password</label>
                                </div>
                                
                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Reset Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'app/views/shares/footer.php'; ?>