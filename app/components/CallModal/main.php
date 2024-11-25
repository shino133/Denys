<div id="callModal" class="modal fade call-modal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel"
  aria-hidden="true">
  <div class="modal-dialog call-modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header align-items-center">
        <div class="call-status">
          <h1 id="callModalLabel" class="modal-title mr-3">Connected</h1>
          <span class="online-status bg-success"></span>
        </div>
        <div class="modal-options d-flex align-items-center">
          <button type="button" class="btn btn-quick-link" id="minimize-call-window">
            <i class="bx bx-minus"></i>
          </button>
        </div>
      </div>
      <div class="modal-body">
        <div class="row h-100">
          <div class="col-md-12 d-flex align-items-center justify-content-center">
            <div class="call-user text-center">
              <div class="call-user-img-anim">
                <img src="/public/img/users/user-1.jpg" class="call-user-img" alt="Call user image" />
              </div>
              <p class="call-user-name">Name Surename</p>
              <p class="text-muted call-time">05:28</p>
            </div>
          </div>
          <div class="col-md-4 offset-md-4 d-flex align-items-center justify-content-between call-btn-list">
            <a href="#" class="btn call-btn" data-toggle="tooltip" data-placement="top"
              data-title="Disable microphone"><i class="bx bxs-microphone"></i></a>
            <a href="#" class="btn call-btn" data-toggle="tooltip" data-placement="top" data-title="Enable camera"><i
                class="bx bxs-video-off"></i></a>
            <a href="#" class="btn call-btn drop-call" data-toggle="tooltip" data-placement="top" data-title="End call"
              data-dismiss="modal" aria-label="Close"><i class="bx bxs-phone"></i></a>
            <a href="#" class="btn call-btn" data-toggle="tooltip" data-placement="top" data-title="Share Screen"><i
                class="bx bx-laptop"></i></a>
            <a href="#" class="btn call-btn" data-toggle="tooltip" data-placement="top" data-title="Dark mode"><i
                class="bx bx-moon"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>