<?php

$id ??= "newMessageModal";

?>
<div class="modal fade" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="newMessageModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header new-msg-header">
        <h5 class="modal-title" id="newMessageModalLabel">
          Start new conversation
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body new-msg-body">
        <form action="" method="" class="new-msg-form">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control search-input" rows="5" id="message-text"
              placeholder="Type a message..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer new-msg-footer">
        <button type="button" class="btn btn-primary btn-sm">
          Send message
        </button>
      </div>
    </div>
  </div>
</div>