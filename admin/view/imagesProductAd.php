<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Ảnh sản phẩm</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li><a href="index.php?act=products">Danh sách sản phẩm</a></li>
                    <li class="active">Ảnh sản phẩm</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Tiêu Đề -->

<!-- Nội Dung -->
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"><?= $product['name'] ?></strong>
        </div>
        <div class="card-body">
            <!-- Thông báo  -->
            <div>
                <?php if (isset($notification)) : ?>
                    <div class="sufee-alert alert with-close alert-<?= $notification === 'successDel' ? 'warning' : ($notification === 'notExist' || $notification === 'alreadyExist' || $notification === 'failedDel' || $notification === 'failedFormat' ? 'danger' : 'success') ?> alert-dismissible fade show">
                        <span class="badge badge-pill badge-<?= $notification === 'successDel' ? 'warning' : ($notification === 'notExist' || $notification === 'alreadyExist' || $notification === 'failedDel' || $notification === 'failedFormat' ? 'danger' : 'success') ?>">
                            <?= $notification === 'successDel' ? 'Warning' : ($notification === 'notExist' || $notification === 'alreadyExist' || $notification === 'failedDel' || $notification === 'failedFormat' ? 'Failed' : 'Success') ?>
                        </span>
                        <?= $notification === 'successAdd' ? 'Thêm thương hiệu thành công !' : ($notification === 'failedFormat' ? 'Định dạng ảnh không phù hợp !' : ($notification === 'notExist' ? 'Thương hiệu không tồn tại' : ($notification === 'alreadyExist' ? 'Logo thương hiệu đã tồn tại !' : ($notification === 'successDel' ? 'Xóa thương hiệu thành công !' : ($notification === 'failedDel' ? 'Thương hiệu hiện chứa sản phẩm !' : 'Cập nhật thương hiệu thành công !'))))) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Thông báo  -->
            <table class="table">
                <div class="box-images-product">
                    <div class="images-product">
                        <img src="../view/assets/img/product/<?= $product['image'] ?>" alt="">
                    </div>
                    <?php foreach ($listImagesProduct as $image) : ?>
                        <div class="images-product">
                            <img src="../view/assets/img/product/<?= $image['name'] ?>" alt="">
                            <a href="index.php?act=imagesProduct&id=<?= $product['id'] ?>&idImage=<?= $image['id'] ?>&del" onclick="return confirm('Bạn có chắn chắn xóa ?')"><i class="fa-regular fa-circle-xmark"></i></a>
                        </div>
                    <?php endforeach; ?>
                    <div class="images-product-add">
                        <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
            </table>
        </div>
    </div>
</div>
<!-- Nội Dung -->
<!-- Modal -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Thêm mới ảnh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php?act=imagesProduct&id=<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Ảnh sản phẩm</label>
                        <input type="file" name="new_image" class="form-control-file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal -->