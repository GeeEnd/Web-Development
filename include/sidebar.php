 <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<div class="main-profile">
					<div class="user-pic">
                            <?php
                                    if (isset($_SESSION['profile_image'])) {
                                        echo '<img src="/indapan//laboratory/' . $_SESSION['profile_image'] . '" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px;" />';
                                    } else {
                                        echo '<img src="../assets/images/users/d1.jpg" alt="Default Profile" class="rounded-circle" style="width: 40px; height: 40px;" />';
                                    }
                                    ?>
                                </div>
					<h5 class="name"><span class="font-w400"><?php echo  $_SESSION['name']; ?></span> </h5>
					<p class="email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="95f8f4e7e4e0f0efefefefd5f8f4fcf9bbf6faf8"><?php echo  $_SESSION['email']; ?></span></a></p>
				</div>
				<ul class="metismenu" id="menu">
					<li class="nav-label first">File Information</li>
                    <li><a href="index.php" aria-expanded="false">
					<img src="../images/dashboard.png" style="width: 20px; height: 20px; margin-right: 10px;" alt="photo">
							<span class="nav-text">Start</span>
						</a>
						</li>
					<li>
						<a href="resident_info.php" aria-expanded="false">
						<img src="../images/youth.png" style="width: 20px; height: 20px; margin-right: 10px;" alt="photo">
							<span class="nav-text">Residents Information</span>
						</a>
					</li>
					<li>
						<a href="announcement.php" aria-expanded="false">
						<img src="../images/loudspeaker.png" style="width: 20px; height: 20px; margin-right: 10px;" alt="photo">
							<span class="nav-text">Announcements</span>
						</a>
					</li>
					<li>
						<a href="officials.php" aria-expanded="false">
						<img src="../images/court.png" style="width: 20px; height: 20px; margin-right: 10px;" alt="photo">
							<span class="nav-text">Officials Information</span>
						</a>
					</li>		
                </ul>

				<ul class="metismenu" id="menu">
					<li class="nav-label first">Certifications</li>
                    <li><a href="clearance_history.php" aria-expanded="false">
					<img src="../images/clearance.png" style="width: 20px; height: 20px; margin-right: 10px;" alt="photo">
							<span class="nav-text">Clearance History</span>
						</a>
						</li>
						<li>
						<a href="indigency_history.php" aria-expanded="false">
							<img src="../images/stamp.png" style="width: 20px; height: 20px; margin-right: 10px;" alt="photo">
							<span class="nav-text">Indigency History</span>
						</a>
					</li>
					<li>
						<a href="incident_reports.php" aria-expanded="false">
						<img src="../images/compliance.png" style="width: 20px; height: 20px; margin-right: 10px;" alt="photo">
							<span class="nav-text">Incident Reports</span>
						</a>
					</li>
                </ul>
				<div class="copyright">
					<p><strong>Barangay Information and Management System</strong> © 2024 All Rights Reserved</p>
					
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->