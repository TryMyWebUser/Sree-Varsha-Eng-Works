                <!-- < ?php include "../libs/load.php"; Session::start(); $userAccount = Operations::getUserAccount(); ?> -->
                <script>
                    var isFluid = JSON.parse(localStorage.getItem("isFluid"));
                    if (isFluid) {
                        var container = document.querySelector("[data-layout]");
                        container.classList.remove("container");
                        container.classList.add("container-fluid");
                    }
                </script>
                <nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
                    <script>
                        var navbarStyle = localStorage.getItem("navbarStyle");
                        if (navbarStyle && navbarStyle !== "transparent") {
                            document.querySelector(".navbar-vertical").classList.add(`navbar-${navbarStyle}`);
                        }
                    </script>
                    <div class="d-flex align-items-center">
                        <div class="toggle-icon-wrapper">
                            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation">
                                <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="index.php">
                            <div class="d-flex align-items-center py-3">
                                <img src="../images/header/logo.png" alt="" width="150" />
                            </div>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                        <div class="navbar-vertical-content scrollbar">
                            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                                <li class="nav-item">
                                    <!-- parent pages-->
                                    <a class="nav-link" href="index.php">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text ps-1">Dashboard</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <!-- parent pages-->
                                    <a class="nav-link dropdown-indicator" href="#offer" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="offer">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon"><span class="fas fa-rocket"></span></span><span class="nav-link-text ps-1">Offer</span>
                                        </div>
                                    </a>
                                    <ul class="nav collapse" id="offer">
                                        <li class="nav-item">
                                            <a class="nav-link" href="add-offer.php">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add Offer</span></div>
                                            </a>
                                            <a class="nav-link" href="list-offer.php">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">List Offer</span></div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <!-- label-->
                                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                        <div class="col-auto navbar-vertical-label">Store</div>
                                        <div class="col ps-0">
                                            <hr class="mb-0 navbar-vertical-divider" />
                                        </div>
                                    </div>
                                    <!-- parent pages-->
                                    <a class="nav-link dropdown-indicator" href="#e-commerce" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="e-commerce">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon"><span class="fas fa-shopping-cart"></span></span><span class="nav-link-text ps-1">E commerce</span>
                                        </div>
                                    </a>
                                    <ul class="nav collapse" id="e-commerce">
                                        <li class="nav-item">
                                            <a class="nav-link" href="add-product.php">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Add Product</span></div>
                                            </a>
                                            <a class="nav-link" href="product-list.php">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product list</span></div>
                                            </a>
                                            <a class="nav-link" href="product-details.php">
                                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Product details</span></div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
                    <button
                        class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarStandard"
                        aria-controls="navbarStandard"
                        aria-expanded="false"
                        aria-label="Toggle Navigation"
                    >
                        <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                    </button>
                    <a class="navbar-brand me-1 me-sm-3" href="index.php">
                        <div class="d-flex align-items-center">
                            <img src="../images/header/logo.png" alt="" width="150" />
                        </div>
                    </a>
                </nav>
                <div class="content">
                    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
                        <button
                            class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarVerticalCollapse"
                            aria-controls="navbarVerticalCollapse"
                            aria-expanded="false"
                            aria-label="Toggle Navigation"
                        >
                            <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                        </button>
                        <a class="navbar-brand me-1 me-sm-3" href="index.php">
                            <div class="d-flex align-items-center">
                                <img src="../images/header/logo.png" alt="" width="150" />
                            </div>
                        </a>
                        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                            <li class="nav-item ps-2 pe-0">
                                <div class="dropdown theme-control-dropdown">
                                    <a
                                        class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0"
                                        href="#"
                                        role="button"
                                        id="themeSwitchDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <span class="fas fa-sun fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light"></span>
                                        <span class="fas fa-moon fs-7" data-fa-transform="shrink-3" data-theme-dropdown-toggle-icon="dark"></span>
                                        <span class="fas fa-adjust fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3" aria-labelledby="themeSwitchDropdown">
                                        <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                            <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="light" data-theme-control="theme">
                                                <span class="fas fa-sun"></span>Light<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                            <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="dark" data-theme-control="theme">
                                                <span class="fas fa-moon" data-fa-transform=""></span>Dark<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                            <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="auto" data-theme-control="theme">
                                                <span class="fas fa-adjust" data-fa-transform=""></span>Auto<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="<?= $userAccount['avatar']; ?>" alt="" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                        <a class="dropdown-item" href="settings.php">Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../logout.php">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;" data-move-target="#navbarVerticalNav" data-navbar-top="combo">
                        <button
                            class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarVerticalCollapse"
                            aria-controls="navbarVerticalCollapse"
                            aria-expanded="false"
                            aria-label="Toggle Navigation"
                        >
                            <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                        </button>
                        <a class="navbar-brand me-1 me-sm-3" href="index.php">
                            <div class="d-flex align-items-center">
                                <img src="../images/header/logo.png" alt="" width="150" />
                            </div>
                        </a>
                        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                            <li class="nav-item ps-2 pe-0">
                                <div class="dropdown theme-control-dropdown">
                                    <a
                                        class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0"
                                        href="#"
                                        role="button"
                                        id="themeSwitchDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <span class="fas fa-sun fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="light"></span>
                                        <span class="fas fa-moon fs-7" data-fa-transform="shrink-3" data-theme-dropdown-toggle-icon="dark"></span>
                                        <span class="fas fa-adjust fs-7" data-fa-transform="shrink-2" data-theme-dropdown-toggle-icon="auto"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3" aria-labelledby="themeSwitchDropdown">
                                        <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                            <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="light" data-theme-control="theme">
                                                <span class="fas fa-sun"></span>Light<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                            <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="dark" data-theme-control="theme">
                                                <span class="fas fa-moon" data-fa-transform=""></span>Dark<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                            <button class="dropdown-item d-flex align-items-center gap-2" type="button" value="auto" data-theme-control="theme">
                                                <span class="fas fa-adjust" data-fa-transform=""></span>Auto<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="<?= $userAccount['avatar']; ?>" alt="" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                        <a class="dropdown-item" href="settings.php">Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../logout.php">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <script>
                        var navbarPosition = localStorage.getItem("navbarPosition");
                        var navbarVertical = document.querySelector(".navbar-vertical");
                        var navbarTopVertical = document.querySelector(".content .navbar-top");
                        var navbarTop = document.querySelector("[data-layout] .navbar-top:not([data-double-top-nav");
                        var navbarDoubleTop = document.querySelector("[data-double-top-nav]");
                        var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

                        if (localStorage.getItem("navbarPosition") === "double-top") {
                            document.documentElement.classList.toggle("double-top-nav-layout");
                        }

                        if (navbarPosition === "top") {
                            navbarTop.removeAttribute("style");
                            navbarTopVertical.remove(navbarTopVertical);
                            navbarVertical.remove(navbarVertical);
                            navbarTopCombo.remove(navbarTopCombo);
                            navbarDoubleTop.remove(navbarDoubleTop);
                        } else if (navbarPosition === "combo") {
                            navbarVertical.removeAttribute("style");
                            navbarTopCombo.removeAttribute("style");
                            navbarTop.remove(navbarTop);
                            navbarTopVertical.remove(navbarTopVertical);
                            navbarDoubleTop.remove(navbarDoubleTop);
                        } else if (navbarPosition === "double-top") {
                            navbarDoubleTop.removeAttribute("style");
                            navbarTopVertical.remove(navbarTopVertical);
                            navbarVertical.remove(navbarVertical);
                            navbarTop.remove(navbarTop);
                            navbarTopCombo.remove(navbarTopCombo);
                        } else {
                            navbarVertical.removeAttribute("style");
                            navbarTopVertical.removeAttribute("style");
                            navbarTop.remove(navbarTop);
                            navbarDoubleTop.remove(navbarDoubleTop);
                            navbarTopCombo.remove(navbarTopCombo);
                        }
                    </script>