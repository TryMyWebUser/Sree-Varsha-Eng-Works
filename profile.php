<?php

	include "libs/load.php";

	Session::start();
	$user = Operations::getUser();
	$userAccount = Operations::getUserAccount();

    // Check if the user is logged in
    $isLoggedIn = Session::get('Loggedin');

	$error = "";

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// If the avatar is uploaded
		if (isset($_FILES['avatar']) && isset($_POST['submit'])) {
			$avatar = $_FILES['avatar']; // Pass the entire file array to the function
			$fileSize = $_FILES['avatar']['size'];
			$error = User::setAvatar($avatar, $fileSize);
		}

		if (isset($_POST['old']) && isset($_POST['new']) && isset($_POST['conf']) && isset($_POST['submit'])) {
			$old = $_POST['old'];
			$new = $_POST['new'];
			$conf = $_POST['conf'];

			// Call the register method
			$error = User::setNewPass($old, $new, $conf);
		}

		if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['submit'])) {
			$user = $_POST['username'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$locat = $_POST['locate'];

			// Call the register method
			$error = User::setUser($user, $email, $phone, $locat);
		}    
	}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta
            name="description"
            content=""
        />
        <title>Sree Varsha Engineering Works</title>
        
        <?php include "temp/head.php" ?>

    </head>

    <body class="custom-cursor">
        <div class="custom-cursor__cursor"></div>
        <div class="custom-cursor__cursor-two"></div>

        <div class="preloader">
            <div class="preloader__image" style="background-image: url(assets/images/loader.png);"></div>
        </div>
        <!-- /.preloader -->
        <div class="page-wrapper">
            <?php include "temp/header.php" ?>

			<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
			<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
			<div class="container my-5 py-5">
				<div class="row flex-lg-nowrap">

					<div class="col my-3">
						<div class="card">
							<div class="card-body">
								<div class="e-profile">
									<div class="row">
										<form method="post" enctype="multipart/form-data">
											<div class="row">
												<!-- Profile Picture Section -->
												<div class="col-12 col-sm-auto mb-3">
													<div class="mx-auto" style="width: 140px;">
														<div class="d-flex justify-content-center align-items-center rounded">
															<!-- Image Preview -->
															<img id="avatar-preview" src="dashboard/<?= $userAccount['avatar']; ?>" alt="Image Not Found" style="max-width: 100%; max-height: 100%; border-radius: 50%;">
														</div>
													</div>
												</div>

												<!-- User Info and Buttons Section -->
												<div class="col d-flex flex-column justify-content-between mb-3">
													<!-- User Info -->
													<div class="text-center text-sm-left mb-2 mb-sm-0">
														<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $user['username']; ?></h4>
														<div class="mt-2">
															<!-- File Input with Custom Styled Button -->
															<label for="avatar-upload" class="btn btn-primary">
																<i class="fa fa-fw fa-camera"></i>
																<span>Change Photo</span>
															</label>
															<input type="file" id="avatar-upload" name="avatar" accept="image/*" style="display: none;" required>
														</div>
													</div>
													<br>
													<!-- Save Button and Uploaded Time -->
													<div class="text-center text-sm-right">
														<div class="col d-flex justify-content-end p-0">
															<button class="btn btn-primary" name="submit" type="submit">Save</button>
														</div>
														<div class="text-muted"><small><?= $userAccount['uploaded_time']; ?></small></div>
													</div>
												</div>
											</div>
										</form>

										<!-- JavaScript for Image Preview -->
										<script>
											document.getElementById('avatar-upload').addEventListener('change', function (event) {
												const file = event.target.files[0]; // Get the selected file
												if (file) {
													const reader = new FileReader(); // Create a FileReader to read the file
													reader.onload = function (e) {
														// Set the preview image source to the file's data URL
														document.getElementById('avatar-preview').src = e.target.result;
													};
													reader.readAsDataURL(file); // Read the file as a data URL
												}
											});
										</script>
									</div>
									<!-- Tab Navigation -->
									<ul class="nav nav-tabs">
										<li class="nav-item">
											<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile">Profile</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings">Settings</a>
										</li>
									</ul>

									<!-- Tab Content -->
									<div class="tab-content">
										<!-- Profile Tab -->
										<div class="tab-pane active" id="profile">
											<div class="tab-content pt-3">
												<div class="row">
													<!-- Username Field -->
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label>Username: </label><p><?= $user['username']; ?></p>
														</div>
													</div>
													<!-- Email Field -->
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label>Email: </label><p><?= $user['email']; ?></p>
														</div>
													</div>
												</div>
												<div class="row">
													<!-- Phone Field -->
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label>Phone: </label><p><?= $user['phone']; ?></p>
														</div>
													</div>
													<!-- Location Field -->
													<div class="col-12 col-md-6">
														<div class="form-group">
															<label>Address: </label><p><?= $userAccount['location']; ?></p>
														</div>
													</div>
												</div>
											</div>
										</div>

										<!-- Settings Tab -->
										<div class="tab-pane fade" id="settings">
											<div class="tab-content pt-3">
												<form method="POST">
													<div class="row">
														<!-- Username Field -->
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label>Username</label>
																<input class="form-control" type="text" name="username" value="<?= $user['username']; ?>" required>
															</div>
														</div>
														<!-- Email Field -->
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label>Email</label>
																<input class="form-control" type="email" name="email" value="<?= $user['email']; ?>" required>
															</div>
														</div>
													</div>
													<div class="row">
														<!-- Phone Field -->
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label>Phone</label>
																<input class="form-control" type="phone" name="phone" value="<?= $user['phone']; ?>" required>
															</div>
														</div>
														<!-- Location Field -->
														<div class="col-12 col-md-6">
															<div class="form-group">
																<label>Address</label>
																<input class="form-control" type="text" name="locate" value="<?= $userAccount['location']; ?>">
															</div>
														</div>
													</div>
													<div class="row">
														<!-- Save Button -->
														<div class="col-12 d-flex justify-content-end">
															<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
														</div>
													</div>
												</form>
											</div>

											<!-- Change Password Section -->
											<div class="tab-content pt-3">
												<form method="POST">
													<div class="col-12 col-sm-6 mb-3">
														<div class="mb-2"><b>Change Password</b></div>
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<input class="form-control" type="password" name="old" placeholder="Current Password" required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<input class="form-control" type="password" name="new" placeholder="New Password" required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col">
																<div class="form-group">
																	<input class="form-control" type="password" name="conf" placeholder="Confirm Password">
																</div>
															</div>
														</div>
														<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
													</div>
												</form>
											</div>
										</div>
									</div>

									<!-- Required Bootstrap JS -->
									<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
									<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
									<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

	        <?php include "temp/footer.php"; ?>
        
        <script>
            $(window).on("load", function () {
                var wow = new WOW({
                    boxClass: "wow",
                    animateClass: "animated",
                    offset: 0,
                    mobile: true,
                    live: true,
                });
                wow.init();
            });

            // CountDown Js
            var deadline = "December 31 2022 23:59:59 GMT+0530";
            function time_remaining(endtime) {
                var t = Date.parse(endtime) - Date.parse(new Date());
                var seconds = Math.floor((t / 1000) % 60);
                var minutes = Math.floor((t / 1000 / 60) % 60);
                var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
                var days = Math.floor(t / (1000 * 60 * 60 * 24));
                return { total: t, days: days, hours: hours, minutes: minutes, seconds: seconds };
            }
            function run_clock(id, endtime) {
                var clock = document.getElementById(id);

                // get spans where our clock numbers are held
                var days_span = clock.querySelector(".days");
                var hours_span = clock.querySelector(".hours");
                var minutes_span = clock.querySelector(".minutes");
                var seconds_span = clock.querySelector(".seconds");

                function update_clock() {
                    var t = time_remaining(endtime);

                    // update the numbers in each part of the clock
                    days_span.innerHTML = t.days;
                    hours_span.innerHTML = ("0" + t.hours).slice(-2);
                    minutes_span.innerHTML = ("0" + t.minutes).slice(-2);
                    seconds_span.innerHTML = ("0" + t.seconds).slice(-2);

                    if (t.total <= 0) {
                        clearInterval(timeinterval);
                    }
                }
                update_clock();
                var timeinterval = setInterval(update_clock, 1000);
            }
            run_clock("clockdiv", deadline);
        </script>
        <!--main js file end-->
    </body>
</html>