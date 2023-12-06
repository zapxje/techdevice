<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Liên Hệ</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="contact row">
            <div class="col-lg-12">
                <div class="contact-send col-lg-7">
                    <div class="contact-infor">
                        <div class="address col-lg-4">
                            <i class="fa-solid fa-location-dot"></i>
                            <p>Công viên phần mềm Quang Trung, Q12</p>
                        </div>
                        <div class="address col-lg-4">
                            <i class="fa-solid fa-envelope"></i>
                            <p>infor@techdevice.online</p>
                        </div>
                        <div class="address col-lg-4">
                            <i class="fa-solid fa-phone"></i>
                            <p>+066-666-6666</p>
                        </div>
                    </div>
                    <?php if ((isset($notification) && !empty($notification)) || (isset($success) && !empty($success))) : ?>
                        <div class="alert <?php echo isset($success) ? 'alert-success' : 'alert-danger'; ?>" role="alert" bis_skin_checked="1">
                            <?php echo isset($success) ? $success : $notification; ?>
                        </div>
                    <?php endif; ?>
                    <form class="form-ct" action="" method="post">
                        <div class="form-group">
                            <label for="">Họ và tên</label>
                            <input type="text" name="full_name" class="form-control" id="exampleInputEmail1" placeholder="Họ và tên">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ email">
                        </div>
                        <div class="form-group">
                            <label for="message">Tin nhắn</label><br>
                            <textarea name="message" rows="5" placeholder="Nội dung liên hệ" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-main">Gửi Tin Nhắn</button>
                    </form>
                </div>
                <div class="contact-map col-lg-5">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4435924064937!2d106.62525347481906!3d10.85382635776171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bee0b0ef9e5%3A0x5b4da59e47aa97a8!2zQ8O0bmcgVmnDqm4gUGjhuqduIE3hu4FtIFF1YW5nIFRydW5n!5e0!3m2!1svi!2s!4v1700020813640!5m2!1svi!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->