<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logox d-flex align-items-center">
            <img src="/assets/img/new.png" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Our logo represents our mission: the globe reflects our commitment to providing global service, while the broken lines around the globe symbolize connectivity through signals and data. The wheat embodies sustenance and strength, representing our dedication to meeting clients' needs and supporting our families through our virtual assistant services. We support and sustain our clients, who in turn, reinforce and sustain our growth. This mutual sustenance underscores our belief that by supporting our clients, we create a cycle of shared growth and success. The 'i' stands for the internet and the individuals who drive it, emphasizing our role in empowering people to assist one another through technology. Overall, we create an environment of mutual support and success, fostering innovation, and a thriving community where everyone can achieve their goals."
                style="height: 80px !important;" alt="">
            <span class="text-dark mx-3 fs-italic"
                style="font-size: 40px; font-family:  'Permanent Marker', cursive; font-style: italic; color: #0F394C !important">IOS</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <style>
            /* Tooltip Container */
            .tooltip {
                background-color: #333;
                /* Dark gray background */
                border-radius: 20px;
                /* Rounded corners */
                color: #fff;
                /* White text */
                font-size: 14px;
                /* Slightly larger text */
                padding: 8px 11px;
                /* Inner spacing */
                text-align: center;
                /* Center-align text */
                font-family: 'Arial', sans-serif;
                /* Change font style */
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                /* Add shadow */
            }

            /* Tooltip Arrow */
            .tooltip .tooltip-arrow {
                border-top-color: #333;
                /* Match the background color */
            }

            /* Tooltip Fade Animation */
            .tooltip.fade.show {
                opacity: 1;
                /* Ensure it's fully visible */
            }

            /* Custom Placement (Optional, Example for Bottom) */
            .bs-tooltip-bottom .tooltip-arrow {
                border-bottom-color: #333;
                /* Match the tooltip background */
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>
    </div>
</header>
