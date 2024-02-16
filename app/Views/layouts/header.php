<header class="mb-3 d-flex justify-content-end">
    <div class="dropdown">
        <a href="#" role="button" id="profileDropdownTrigger" data-bs-toggle="dropdown" aria-expanded="false">
            <span id="emailUser">PT Rizquna</span> <img src="<?= base_url('./assets/compiled/png/logo.png') ?>" alt="Profile Picture" class="profile-picture">
        </a>
        <ul class="dropdown-menu" aria-labelledby="profileDropdownTrigger">
            <li><a class="dropdown-item" href="#"><i class="bi bi-shield-lock"></i> Change
                    Password</a></li>
            <li><a class="dropdown-item" id="logoutButton" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </li>
        </ul>
    </div>
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>