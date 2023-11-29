<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Danh mục sản phẩm</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li class="active">Danh mục sản phẩm</li>
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
                    <div class="sufee-alert alert with-close alert-<?= $notification === 'successDel' ? 'warning' : ($notification === 'notExist' || $notification === 'nameExist' || $notification === 'failedDel' ? 'danger' : 'success') ?> alert-dismissible fade show">
                        <span class="badge badge-pill badge-<?= $notification === 'successDel' ? 'warning' : ($notification === 'notExist' || $notification === 'nameExist' || $notification === 'failedDel' ? 'danger' : 'success') ?>"><?= $notification === 'successDel' ? 'Warning' : ($notification === 'notExist' || $notification === 'nameExist' || $notification === 'failedDel' ? 'Failed' : 'Success') ?></span>
                        <?= $notification === 'successAdd' ? 'Thêm danh mục thành công !' : ($notification === 'notExist' ? 'Danh mục không tồn tại' : ($notification === 'successDel' ? 'Xóa danh mục thành công !' : ($notification === 'failedDel' ? 'Danh mục hiện chứa sản phẩm !' : ($notification === 'nameExist' ? 'Tên danh mục đã tồn tại !' : 'Cập nhật danh mục thành công !')))) ?>
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
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Thứ tự</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($listCategories as $category) :  ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $category['name'] ?></td>
                            <td><?= $category['ordinal_number'] ?></td>
                            <td><?= $category['description'] ?></td>
                            <td class="operation">
                                <a class="text-primary border-left" href="index.php?act=updateCategory&id=<?= $category['id'] ?>"><i class="ti-pencil-alt"></i>Sửa</a>
                                <a class="text-danger" href="index.php?act=delCategory&id=<?= $category['id'] ?>" onclick="return confirm('Bạn có chắc chắn xóa danh mục này ?')"><i class="ti-trash"></i>Xóa</a>
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
            <form action="index.php?act=addCategory" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Tên danh mục</label>
                        <input name="name" type="text" class="form-control" required placeholder="Nhập tên danh mục" oninvalid="this.setCustomValidity('Nhập tên danh mục')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Thứ tự danh mục</label>
                        <input id="inputField" name="ordinal_number" type="number" class="form-control" placeholder="Nhập thứ tự danh mục">
                        <!-- onfocus="showSuggestions()" -->
                        <ul id="suggestionList" class="list-unstyled"></ul>
                    </div>
                    <div class="form-group has-success">
                        <label for="" class="control-label mb-1">Mô tả</label>
                        <textarea name="description" rows="5" placeholder="Mô tả danh mục" class="form-control"></textarea>
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