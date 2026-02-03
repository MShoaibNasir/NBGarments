

<nav class="top-navbar d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <button class="sidebar-toggler me-3" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo-section">
    
            {{--<img src="{{asset('dashboard\img\logo.png')}}" alt="HRU Logo"
                style="background: white;"> --}}
            <div>
                {{--
                <h1 class="logo-text" style="color: white;">Invoice Management System</h1>
                <small style="opacity: 0.8; color: white;">Management Portal</small>
                --}}
            </div>
        </div>
    </div>

    <div class="user-section">
        <div class="position-relative">
            @if(Auth::user()->profile)
            <img class="rounded-circle user-avatar"
            src="{{ asset('profile_images/' . Auth::user()->profile) }}" alt="User Avatar">
            @else
            <img class="rounded-circle user-avatar"
                src="{{asset('dashboard\img\logo.png')}}" alt="User Avatar">
            @endif    
            <div
                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
            </div>
        </div>
        <div class="user-info-navbar">
            <h6 style="color: var(--hru-light);">{{ Auth::user()->name }}</h6>
        </div>
        <div class="dropdown navbar-user">
            <button class="btn btn-link text-white" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-chevron-down"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('editProfile',[Auth::user()->id])}}"><i
                            class="fas fa-user me-2"></i>Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ route('user.logout') }}"                     document.getElementById('logout-form').submit();"><i
                            class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
        // Preloader
        window.addEventListener('load', function () {
            const preloader = document.getElementById('hrupreloader');
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });

        // Sidebar Toggle Function
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementsByClassName("content");

            if (window.innerWidth >= 360 || window.innerWidth <= 992) {
                sidebar.classList.toggle("collapsed");

                // Loop through all elements with class 'content'
                for (let i = 0; i < content.length; i++) {
                    content[i].classList.toggle("expanded");
                }
            
            } else {
                sidebar.classList.toggle("show");
            }
        }

        // Initialize sidebar functionality
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById("sidebarToggle");
            const mobileToggleBtn = document.getElementById("mobileSidebarToggle");
            
            // Desktop toggle button
            toggleBtn.addEventListener("click", function (e) {
                e.preventDefault();
                toggleSidebar();
            });

            mobileToggleBtn2.addEventListener("click", function (e) {
                e.preventDefault();
                toggleSidebar();
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function (e) {
                if (window.innerWidth <= 992) {
                    const sidebar = document.getElementById("sidebar");
                    if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function () {
                const sidebar = document.getElementById("sidebar");
                const content = document.getElementsByClassName("content");
                
                if (window.innerWidth > 992) {
                    sidebar.classList.remove('show');
                } else {
                    sidebar.classList.remove('collapsed');

                    // Loop through all elements with class 'content'
                    for (let i = 0; i < content.length; i++) {
                        content[i].classList.remove('expanded');
                    }
                }
            });

            // Active link highlighting for both main and submenu links
            const currentUrl = window.location.href;
                    
            // Highlight top-level nav link
            document.querySelectorAll(".nav-link").forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add("active");
                }
            });
            
            // Highlight submenu dropdown items and expand parent menu
            document.querySelectorAll(".dropdown-item").forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add("active");
                
                    // Open parent dropdown
                    const parentDropdown = link.closest(".custom-dropdown");
                    if (parentDropdown) {
                        parentDropdown.classList.add("open");
                    }
                
                    // Open any nested submenu
                    const submenu = link.closest(".dropdown-submenu");
                    if (submenu) {
                        submenu.classList.add("open");
                    }
                }
            });
        });

        // Custom Dropdown Functionality
        document.addEventListener("DOMContentLoaded", function () {
            // Handle main dropdown toggles
            const dropdowns = document.querySelectorAll('.custom-dropdown > a');
            dropdowns.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    const currentDropdown = this.closest('.custom-dropdown');
                    const isOpen = currentDropdown.classList.contains('open');

                    // Close all other main dropdowns
                    document.querySelectorAll('.custom-dropdown.open').forEach(drop => {
                        if (drop !== currentDropdown) {
                            drop.classList.remove('open');
                        }
                    });

                    // Toggle current dropdown
                    currentDropdown.classList.toggle('open', !isOpen);
                });
            });

            // Handle submenu toggles
            const submenuToggles = document.querySelectorAll('.dropdown-submenu > a');
            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    const currentSubmenu = this.closest('.dropdown-submenu');
                    const isOpen = currentSubmenu.classList.contains('open');

                    // Close all other submenus in the same parent
                    const parentDropdown = currentSubmenu.closest('.dropdown-menu-custom');
                    parentDropdown.querySelectorAll('.dropdown-submenu.open').forEach(submenu => {
                        if (submenu !== currentSubmenu) {
                            submenu.classList.remove('open');
                        }
                    });

                    // Toggle current submenu
                    currentSubmenu.classList.toggle('open', !isOpen);
                });
            });

            // Close dropdowns on outside click
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.custom-dropdown')) {
                    document.querySelectorAll('.custom-dropdown.open').forEach(drop => {
                        drop.classList.remove('open');
                    });
                }
            });
        });

        // Smooth animations for cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    </script>