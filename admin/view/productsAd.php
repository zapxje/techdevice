<!-- Tiêu Đề -->
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Danh sách sản phẩm</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="index.php">Bảng điều khiển</a></li>
                    <li class="active">Danh sách sản phẩm</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Tiêu Đề -->

<!-- Nội Dung -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <!-- Thông báo  -->
            <div>
                <?php
                if (isset($notification) && $notification == "successAdd") : ?>
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        Thêm sản phẩm thành công !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php elseif (isset($notification) && $notification == "failedFormat") : ?>
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-danger">Failed</span>
                        Định dạng ảnh không đúng !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php elseif (isset($notification) && $notification == "alreadyExist") : ?>
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-danger">Failed</span>
                        Ảnh sản phẩm đã tồn tại !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php elseif (isset($notification) && $notification == "notExist") : ?>
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-danger">Failed</span>
                        Sản phẩm không tồn tại !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php elseif (isset($notification) && $notification == "successDel") : ?>
                    <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                        <span class="badge badge-pill badge-warning">Success</span>
                        Xóa danh mục thành công !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php elseif (isset($notification) && $notification == "successUpdate") : ?>
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        Cập nhật sản phẩm thành công !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Thông báo  -->
            <!-- Lọc sản phẩm  -->
            <div class="row">
                <div class="col-lg-8">
                    <form action="index.php?act=filterProducts" method="POST">
                        <div class="col-lg-8">
                            <div class="col-lg-12">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Danh mục</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="idFilterCategory" id="SelectLm" class="form-control-sm form-control">
                                            <option value="0">Không</option>
                                            <?php foreach ($listCategories as $category) : ?>
                                                <option value="<?= $category['id'] ?>" <?= isset($_REQUEST['idFilterCategory']) && $_REQUEST['idFilterCategory'] == $category['id'] ? "selected" : '' ?>>
                                                    <?= $category['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="selectSm" class=" form-control-label">Thương hiệu</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="idFilterBrand" id="SelectLm" class="form-control-sm form-control">
                                            <option value="0">Không</option>
                                            <?php foreach ($listBrands as $brand) : ?>
                                                <option value="<?= $brand['id'] ?>" <?= isset($_REQUEST['idFilterBrand']) && $_REQUEST['idFilterBrand'] == $brand['id'] ? "selected" : '' ?>><?= $brand['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex flex-column ">
                            <button type="submit" class="btn btn-primary mb-1 w-50">
                                Lọc <i class="fa fa-search"></i>
                            </button>
                            <button type="button" class="btn btn-secondary mb-1 w-50" data-toggle="modal" data-target="#mediumModal">
                                Thêm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Lọc sản phẩm  -->
            <div id="bootstrap-data-table-export_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="bootstrap-data-table-export_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 246.2px;">Tên SP</th>
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 145px;">Giá gốc</th>
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 145px;">Giảm giá</th>
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 145px;">Số lượng</th>
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 405.2px;">Mô tả</th>
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 182.2px;">Doanh số</th>
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 182.2px;">Hình ảnh</th>
                                    <th class="sorting" tabindex="0" aria-controls="bootstrap-data-table-export" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 182.2px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listProducts as $product) : ?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?= mb_strimwidth($product['name'], 0, 50, "...") ?></td>
                                        <td><?= number_format($product['price'], 0, ',', '.')  ?></td>
                                        <td><?= number_format($product['price_sale'], 0, ',', '.') ?></td>
                                        <td><?= $product['quantity'] ?></td>
                                        <td><?= mb_strimwidth($product['description'], 0, 60, "...") ?></td>
                                        <td><?= $product['number_of_purchases'] ?></td>
                                        <td class="images-product-admin">
                                            <img width="50px" height="50px" src="../view/assets/img/product/<?= $product['image'] ?>" alt="">
                                            <div class="count-images-product">
                                                <a href="javascript:void(0)"><?= count(getImageByProduct($product['id'])) > 0 ? "+" . count(getImageByProduct($product['id'])) : '' ?></a>
                                            </div>
                                        </td>
                                        <td class="operation">
                                            <a class="text-primary" href=""><i class="ti-pencil-alt"></i>Sửa</a>
                                            <a class="text-danger" href=""><i class="ti-trash"></i>Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Nội Dung -->
<!-- Modal -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Thêm mới sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php?act=addProduct" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="" class="control-label mb-1">Danh mục</label>
                            <select name="idCategory" id="select" class="form-control" required oninvalid="this.setCustomValidity('Chọn danh mục sản phẩm !')" oninput="setCustomValidity('')">
                                <option value="">Chọn danh mục</option>
                                <?php foreach ($listCategories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="" class="control-label mb-1">Thương hiệu</label>
                            <select name="idBrand" id="select" class="form-control" required oninvalid="this.setCustomValidity('Chọn thương hiệu sản phẩm !')" oninput="setCustomValidity('')">
                                <option value="">Chọn thương hiệu</option>
                                <?php foreach ($listBrands as $brand) : ?>
                                    <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Tên sản phẩm</label>
                        <input name="name" type="text" class="form-control" oninvalid="this.setCustomValidity('Nhập tên sản phẩm !')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="" class="control-label mb-1">Giá gốc</label>
                            <input name="price" type="number" class="form-control" oninvalid="this.setCustomValidity('Nhập giá sản phẩm !')" oninput="setCustomValidity('')" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="control-label mb-1">Giá giảm (nếu có)</label>
                            <input name="price_sale" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Số lượng</label>
                        <input name="quantity" type="number" class="form-control" value="1">
                    </div>
                    <div class="form-group has-success">
                        <label for="" class="control-label mb-1">Mô tả</label>
                        <textarea name="description" rows="5" placeholder="Mô tả sản phẩm" class="form-control"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label for="" class="control-label mb-1">Ảnh đại diện</label>
                            <input type="file" id="file-input" name="image" class="form-control-file" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="control-label mb-1">Ảnh con (nếu có)</label>
                            <input type="file" id="file-input" class="form-control-file" name="images" multiple accept="image/*">
                        </div>
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