<div class="post border-card border-bottom p-3 bg-white w-shadow">
    <div class="media text-muted pt-3">
        <?php if ($user_avatarUrl): ?>
            <img src="<?= "/assets/img/users/$user_avatarUrl" ?>" alt="Online user" class="mr-3 post-user-image" style="height: 40px; width: 40px;" />
        <?php else: ?>
            <div class="mr-2 d-flex justify-content-center align-items-center bg-orange text-white post-user-image" style="height: 40px; width: 40px;"><span
                    class=""><?= strtoupper($user_fullName)[0] ?></span></div>
        <?php endif; ?>

        <div class="media-body pb-3 mb-0 small lh-125">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a href="<?= BASE_URL . "@$user_fullName" ?>" class="text-gray-dark post-user-name">@<?= $user_fullName ?></a>
                <div class="dropdown">
                    <a href="#" class="post-more-settings" role="button" data-toggle="dropdown" id="postOptions"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-horizontal-rounded"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left post-dropdown-menu">
                        <a href="#" class="dropdown-item" aria-describedby="savePost">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="bx bx-bookmark-plus post-option-icon"></i>
                                </div>
                                <div class="col-md-10">
                                    <span class="fs-9">Save post</span>
                                    <small id="savePost" class="form-text text-muted">Add this to your saved items</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item" aria-describedby="hidePost">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="bx bx-hide post-option-icon"></i>
                                </div>
                                <div class="col-md-10">
                                    <span class="fs-9">Hide post</span>
                                    <small id="hidePost" class="form-text text-muted">See fewer posts like this</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item" aria-describedby="snoozePost">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="bx bx-time post-option-icon"></i>
                                </div>
                                <div class="col-md-10">
                                    <span class="fs-9">Snooze Arthur for 30 days</span>
                                    <small id="snoozePost" class="form-text text-muted">Temporarily stop seeing
                                        posts</small>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item" aria-describedby="reportPost">
                            <div class="row">
                                <div class="col-md-2">
                                    <i class="bx bx-block post-option-icon"></i>
                                </div>
                                <div class="col-md-10">
                                    <span class="fs-9">Report</span>
                                    <small id="reportPost" class="form-text text-muted">I'm concerned about this
                                        post</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <span class="d-block"><?= $timeAgo ?><i class="bx bx-globe ml-3"></i></span>
        </div>
    </div>
    <div class="mx-1">
        <p>
            <?= $content ?>
        </p>
    </div>
    <div class="d-block mt-3">
        <?php if ($mediaUrl): ?>
            <img src="<?= "/assets/img/posts/$mediaUrl" ?>" class="post-content border-content" alt="post image" />
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <!-- Reactions -->
        <div class="argon-reaction">
            <span class="like-btn">
                <a href="#" class="post-card-buttons" id="reactions"><i class="bx bxs-like mr-2"></i> 67</a>
            </span>
        </div>
        <a href="javascript:void(0)" class="post-card-buttons" id="show-comments"><i class="bx bx-message-rounded mr-2"></i>
            5</a>
        <div class="dropdown dropup share-dropup">
            <a href="#" class="post-card-buttons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-share-alt mr-2"></i> Share
            </a>
            <div class="dropdown-menu post-dropdown-menu">
                <a href="#" class="dropdown-item">
                    <div class="row">
                        <div class="col-md-2">
                            <i class="bx bx-share-alt"></i>
                        </div>
                        <div class="col-md-10">
                            <span>Share Now (Public)</span>
                        </div>
                    </div>
                </a>
                <a href="#" class="dropdown-item">
                    <div class="row">
                        <div class="col-md-2">
                            <i class="bx bx-share-alt"></i>
                        </div>
                        <div class="col-md-10">
                            <span>Share...</span>
                        </div>
                    </div>
                </a>
                <a href="#" class="dropdown-item">
                    <div class="row">
                        <div class="col-md-2">
                            <i class="bx bx-message"></i>
                        </div>
                        <div class="col-md-10">
                            <span>Send as Message</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="border-top pt-3 hide-comments" style="display: none">
        <div class="row bootstrap snippets">
            <div class="col-md-12">
                <div class="comment-wrapper">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <ul class="media-list comments-list">
                                <li class="media comment-form">
                                    <a href="#" class="pull-left">
                                        <img src="/public/img/users/user-4.jpg" alt="" class="img-circle" />
                                    </a>
                                    <div class="media-body">
                                        <form action="" method="" role="form">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control comment-input" placeholder="Write a comment..." />

                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn comment-form-btn" data-toggle="tooltip"
                                                                data-placement="top" title="Tooltip on top">
                                                                <i class="bx bxs-smiley-happy"></i>
                                                            </button>
                                                            <button type="button" class="btn comment-form-btn comment-form-btn" data-toggle="tooltip"
                                                                data-placement="top" title="Tooltip on top">
                                                                <i class="bx bx-camera"></i>
                                                            </button>
                                                            <button type="button" class="btn comment-form-btn comment-form-btn" data-toggle="tooltip"
                                                                data-placement="top" title="Tooltip on top">
                                                                <i class="bx bx-microphone"></i>
                                                            </button>
                                                            <button type="button" class="btn comment-form-btn" data-toggle="tooltip"
                                                                data-placement="top" title="Tooltip on top">
                                                                <i class="bx bx-file-blank"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="/public/img/users/user-2.jpg" alt="" class="img-circle" />
                                    </a>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <strong class="text-gray-dark"><a href="#" class="fs-8">Karen Minas</a></strong>
                                            <a href="#"><i class="bx bx-dots-horizontal-rounded"></i></a>
                                        </div>
                                        <span class="d-block comment-created-time">30 min ago</span>
                                        <p class="fs-8 pt-2">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Lorem ipsum dolor sit
                                            amet,
                                            <a href="#">#consecteturadipiscing </a>.
                                        </p>
                                        <div class="commentLR">
                                            <button type="button" class="btn btn-link fs-8">
                                                Like
                                            </button>
                                            <button type="button" class="btn btn-link fs-8">
                                                Reply
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="https://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle" />
                                    </a>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <strong class="text-gray-dark"><a href="#" class="fs-8">Lia Earnest</a></strong>
                                            <a href="#"><i class="bx bx-dots-horizontal-rounded"></i></a>
                                        </div>
                                        <span class="d-block comment-created-time">2 hours ago</span>
                                        <p class="fs-8 pt-2">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Lorem ipsum dolor sit
                                            amet,
                                            <a href="#">#consecteturadipiscing </a>.
                                        </p>
                                        <div class="commentLR">
                                            <button type="button" class="btn btn-link fs-8">
                                                Like
                                            </button>
                                            <button type="button" class="btn btn-link fs-8">
                                                Reply
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle" />
                                    </a>
                                    <div class="media-body">
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <strong class="text-gray-dark"><a href="#" class="fs-8">Rusty Mickelsen</a></strong>
                                            <a href="#"><i class="bx bx-dots-horizontal-rounded"></i></a>
                                        </div>
                                        <span class="d-block comment-created-time">17 hours ago</span>
                                        <p class="fs-8 pt-2">
                                            Lorem ipsum dolor sit amet, consectetur
                                            adipiscing elit. Lorem ipsum dolor sit
                                            amet,
                                            <a href="#">#consecteturadipiscing </a>.
                                        </p>
                                        <div class="commentLR">
                                            <button type="button" class="btn btn-link fs-8">
                                                Like
                                            </button>
                                            <button type="button" class="btn btn-link fs-8">
                                                Reply
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="comment-see-more text-center">
                                            <button type="button" class="btn btn-link fs-8">
                                                See More
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>