<?php

$activeTextColor = function ($status) {
    return match ($status) {
        'active' => 'bg-gradient-success',
        'deleted' => 'bg-gradient-danger',
        'pending' => 'bg-gradient-warning',
    };
};
// dumpVar(var: $groupData)
?>
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Danh sách Nhóm</h6>
        </div>
    </div>
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên nhóm</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">chủ sở hữu</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo
                        </th>
                        <th class="text-secondary opacity-7">
                            <div class="d-flex justify-content-center align-items-center ">
                                <button type="button" onClick="window.location.reload();"
                                    class="btn m-0 text-warning font-weight-bold text-xs d-flex justify-content-center align-items-center">
                                    <i class="material-symbols-rounded opacity-5">refresh</i>
                                    <span>Refresh</span>
                                </button>
                                <a href="/admin/team-manager/add"
                                    class="text-info font-weight-bold text-xs d-flex justify-content-center align-items-center">
                                    <i class="material-symbols-rounded opacity-5">add</i>
                                    <span>Thêm</span>
                                </a>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupData as $data): ?>
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="/admin/manager/group/get/<?= $data['group_id'] ?>">
                                            <h6 class="mb-0 text-sm"><?= $data['group_name'] ?></h6>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="/@<?= $data['user_userName'] ?>" class="text-sm text-secondary mb-0" target="_blank">
                                    @<?= $data['user_userName'] ?>
                                </a>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm <?= $activeTextColor($data['group_status']) ?>">
                                    <?= $data['group_status'] ?>
                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-xs font-weight-bold"><?= $data['group_createdAt'] ?></span>
                            </td>
                            <td class="align-middle ">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <a href="/admin/manager/group/edit/<?= $data['group_id'] ?>"
                                        class="text-success font-weight-bold text-xs d-flex justify-content-center align-items-center">
                                        <i class="material-symbols-rounded opacity-5">edit</i>
                                        <span>Sửa</span>
                                    </a>
                                    <a href="/admin/manager/group/destroy/<?= $data['group_id'] ?>"
                                        class="text-danger font-weight-bold text-xs d-flex justify-content-center align-items-center">
                                        <i class="material-symbols-rounded opacity-5">delete</i>
                                        <span>Xoá</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>