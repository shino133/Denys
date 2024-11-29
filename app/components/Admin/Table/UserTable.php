<div class="card my-4">
  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
      <h6 class="text-white text-capitalize ps-3">Danh sách quản trị viên</h6>
    </div>
  </div>
  <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed
            </th>
            <th class="text-secondary opacity-7">
              <div class="d-flex justify-content-center align-items-center">
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
          <tr>
            <td>
              <div class="d-flex px-2 py-1">
                <div>
                  <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                </div>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">John Michael</h6>
                  <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                </div>
              </div>
            </td>
            <td>
              <p class="text-xs font-weight-bold mb-0">Manager</p>
              <p class="text-xs text-secondary mb-0">Organization</p>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="badge badge-sm bg-gradient-success">Online</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
            </td>
            <td class="align-middle ">
              <div class="d-flex justify-content-center align-items-center gap-3">
                <a href="/admin/team-manager/edit"
                  class="text-success font-weight-bold text-xs d-flex justify-content-center align-items-center">
                  <i class="material-symbols-rounded opacity-5">edit</i>
                  <span>Sửa</span>
                </a>
                <a href="/admin/team-manager/"
                  class="text-danger font-weight-bold text-xs d-flex justify-content-center align-items-center">
                  <i class="material-symbols-rounded opacity-5">delete</i>
                  <span>Xoá</span>
                </a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>