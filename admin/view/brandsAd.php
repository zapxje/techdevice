<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Thương hiệu sản phẩm</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li class="active">Thương hiệu sản phẩm</li>
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
            <strong class="card-title"></strong>
        </div>
        <div class="card-body">
            <div class="float-right my-2">
                <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal">
                    Thêm
                </button>
            </div>
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
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên thương hiệu</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($listBrands as $brand) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i ?>
                            </th>
                            <td>
                                <?= $brand['name'] ?>
                            </td>
                            <td><img height="50px" src="../view/assets/img/brand_image/<?= $brand['image'] ?>"></img></td>
                            <td class="operation">
                                <a class="text-primary" href="index.php?act=updateBrand&id=<?= $brand['id'] ?>">
                                    <i class="ti-pencil-alt"></i>Sửa</a>
                                <a class="text-danger" href="index.php?act=delBrand&id=<?= $brand['id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa thương hiệu này ?')">
                                    <i class="ti-trash"></i>Xóa</a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
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
                <h5 class="modal-title" id="mediumModalLabel">Thêm mới danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php?act=addBrand" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Tên thương hiệu</label>
                        <input name="name" type="text" class="form-control" required oninvalid="this.setCustomValidity('Nhập tên thương hiệu')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Logo thương hiệu</label>
                        <input type="file" id="file-input" name="image" class="form-control-file" required>
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