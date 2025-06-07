<?php include 'app/views/shares/header.php'; ?>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form action="/webbanhang/account/verifyCode" method="post">
                            <div class="mb-md-5 mt-md-4">
                                <h2 class="fw-bold mb-2 text-uppercase">Xác Nhận Mã</h2>
                                <p class="text-white-50 mb-5">Vui lòng kiểm tra Console (F12) để lấy mã và nhập vào ô bên dưới.</p>

                                <?php if (isset($code_for_display)) : ?>
                                    <div class="alert alert-info" role="alert">
                                        Mã xác nhận: <strong><?php echo htmlspecialchars($code_for_display); ?></strong>
                                    </div>
                                <?php endif; ?>

                                <?php if (isset($error) && !empty($error)) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo htmlspecialchars($error); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="verification_code" class="form-control form-control-lg" required maxlength="6" />
                                    <label class="form-label" for="verification_code">Mã Xác Nhận 6 Số</label>
                                </div>

                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Xác Thực</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'app/views/shares/footer.php'; ?>
