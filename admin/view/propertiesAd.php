<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Thuộc tính sản phẩm</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li><a href="index.php?act=products">Danh sách sản phẩm</a></li>
                    <li class="active">Thuộc tính</li>
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
            <div class="float-right">
                <button type="button" class="btn btn-secondary mb-1" data-toggle="modal" data-target="#mediumModal">
                    Thêm
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Thông báo  -->
            <div>
                <?php if (isset($notification)) : ?>
                    <div class="sufee-alert alert with-close alert-<?= $notification === 'successDel' ? 'warning' : ($notification === 'notExist' || $notification === 'alreadyExist' || $notification === 'failedDel' || $notification === 'nameExist' || $notification === 'failedFormat' ? 'danger' : 'success') ?> alert-dismissible fade show">
                        <span class="badge badge-pill badge-<?= $notification === 'successDel' ? 'warning' : ($notification === 'notExist' || $notification === 'nameExist' || $notification === 'alreadyExist' || $notification === 'failedDel' || $notification === 'failedFormat' ? 'danger' : 'success') ?>">
                            <?= $notification === 'successDel' ? 'Warning' : ($notification === 'notExist' || $notification === 'nameExist' || $notification === 'alreadyExist' || $notification === 'failedDel' || $notification === 'failedFormat' ? 'Failed' : 'Success') ?>
                        </span>
                        <?= $notification === 'successAdd' ? 'Thêm thuộc tính thành công !' : ($notification === 'failedFormat' ? 'Định dạng ảnh không phù hợp !' : ($notification === 'notExist' ? 'Thuộc tính không tồn tại' : ($notification === 'alreadyExist' ? 'Logo Thuộc tính đã tồn tại !' : ($notification === 'successDel' ? 'Xóa Thuộc tính thành công !' : ($notification === 'nameExist' ? 'Tên thuộc tính đã tồn tại !' : ($notification === 'failedDel' ? 'Thuộc tính hiện chứa sản phẩm !' : 'Cập nhật thuộc tính thành công !')))))) ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Thông báo  -->
            <?php if (empty($listProperties)) : ?>
                <div class="alert alert-warning" role="alert">
                    Sản phẩm chưa có thuộc tính nào !
                </div>
            <?php else : ?>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên thuộc tính</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($listProperties as $property) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $property['name'] ?></td>
                                <td><?= $property['description'] ?></td>
                                <td class="operation">
                                    <a class="text-primary" href="index.php?act=properties&id=<?= $product['id'] ?>&idProperty=<?= $property['id'] ?>&status=3">
                                        <i class="ti-pencil-alt"></i>Sửa</a>
                                    <a class="text-danger" href="index.php?act=properties&id=<?= $product['id'] ?>&idProperty=<?= $property['id'] ?>&status=2" onclick="return confirm('Bạn có chắc chắn xóa thuộc tính này ?')">
                                        <i class="ti-trash"></i>Xóa</a>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Nội Dung -->
<!-- Modal -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Thêm mới thuộc tính</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php?act=properties&id=<?= $product['id'] ?>&status=1" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Tên thuộc tính</label>
                        <input name="name" type="text" class="form-control" required placeholder="Nhập tên thuộc tính" oninvalid="this.setCustomValidity('Nhập tên thuộc tính')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group has-success">
                        <label for="" class="control-label mb-1">Nội dung thuộc tính</label>
                        <textarea name="description" rows="5" placeholder="Mô tả thuộc tính" class="form-control"></textarea>
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