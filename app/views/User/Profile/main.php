<?php

$profileData['profile_bannerUrl'] = isset($profileData['profile_bannerUrl'])
	? "/assets/img/users/" . $profileData['profile_bannerUrl']
	: "/public/img/users/cover/cover.webp";
$postData ??= [];
$isCurrentUser = $profileData['user_id'] == Auth::getUser('id');

// dumpVar([
// 	"data" => $extractDataDetails,
// 	'profileData' => $profileData,
// 	'postData' => $postData
// ])

?>
<div class="row profile-right-side-content">
	<div class="user-profile">
		<!-- Banner  -->
		<div class="profile-header-background overflow-hidden">
			<img src="<?= $profileData['profile_bannerUrl'] ?>" alt="Profile Header Background" id="profileBanner"
				class="w-100 object-fit-cover" />
			<?php if ($isCurrentUser) : ?>
				<form action="/user/profile/banner/upload/request" method="post" enctype="multipart/form-data"
					class="profile-cover">
					<div class="cover-overlay">
						<label for="banner" class="btn btn-update-cover">
							<i class="bx bxs-camera"></i>
							Đăng ảnh bìa mới
						</label>
						<input type="file" name="banner" id="banner" accept="image/jpeg, image/png, image/gif, image/webp, image/jpg"
							hidden>
					</div>
				</form>
			<?php endif ?>
		</div>

		<div class="row profile-rows px-5">
			<div class="col-md-3">
				<?php AppLoader::component("Profile/LeftSide", [
					'profileData' => $profileData
				]); ?>
			</div>

			<div class="col-md-9 p-0">
				<div class="profile-info-right">
					<!-- Posts section -->
					<div class="row">
						<div class="col-md-9 profile-center">
							<!-- Navbar -->
							<?php AppLoader::component("Profile/Navbar", [
								"baseUrl" => $profile_baseUrl ?? null
							]); ?>

							<?php if (Auth::checkUser()) : ?>
								<!-- New Post -->
								<div class="p-3">
									<?php AppLoader::component("NewPost"); ?>
								</div>
							<?php endif; ?>


							<div class="posts-section mb-5">
								<?php if (! empty($postData)) : ?>
									<div id="post-container">
										<div id="post-wrapper-0">
											<?php foreach ($postData as $post) : ?>
											<div class="p-3">
												<div class="post border-card border-bottom p-3 bg-white shadow-lg" id="post-card-<?= $post_id ?>">
													<?php AppLoader::component("Post/Card", $post); ?>
												</div>
											</div>
										<?php endforeach; ?>
										</div>
									</div>
									<?php AppLoader::component("LoadPostBtn") ?>
								<?php else : ?>
									<div class="pt-3">
										<div class="alert text-center rounded">
											Không có bài viết nào
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<div class="col-md-3 profile-quick-media">
							<?php AppLoader::component("Profile/RightSide", [
								'postData' => $postData
							]); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php AppLoader::component("NewMessageModal") ?>