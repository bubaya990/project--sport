<!-- Toggle Button -->
<button class="toggle-btn" id="toggleBtn">☰</button>

<!-- Overlay -->
<div class="overlay" id="overlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>My App</h2>
    </div>
    
    <div class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Navigation</div>
            <a href="{{ route('evenements.index') }}" class="{{ request()->routeIs('evenements.*') ? 'active' : '' }}">Our Events</a>
            <a href="{{ route('aboutus.index') }}" class="{{ request()->routeIs('aboutus.*') ? 'active' : '' }}">About Us</a>
        </div>
    </div>
</aside>

<style>
    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background: linear-gradient(180deg, #081825 0%, #1a2332 50%, #0a1420 100%);
        color: white;
        padding: 0;
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        z-index: 1000;
        box-shadow: 4px 0 20px rgba(0, 140, 150, 0.2);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-right: 1px solid rgba(0, 140, 150, 0.3);
    }

    .sidebar.open {
        transform: translateX(0);
    }

    .sidebar-header {
        padding: 25px 20px;
        border-bottom: 1px solid rgba(0, 140, 150, 0.3);
        background: rgba(0, 140, 150, 0.08);
    }

    .sidebar-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        color: #ffffff;
    }

    .sidebar-nav {
        flex: 1;
        padding: 20px 0;
        overflow-y: auto;
    }

    .nav-section {
        margin-bottom: 30px;
    }

    .nav-section-title {
        padding: 0 20px 10px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        color: #008c96;
        letter-spacing: 1px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        color: #d1d5db;
        text-decoration: none;
        margin: 2px 15px;
        padding: 12px 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        gap: 12px;
    }

    .sidebar a:hover {
        background: linear-gradient(135deg, rgba(0, 140, 150, 0.2), rgba(26, 100, 140, 0.15));
        color: #ffffff;
    }

    .sidebar a.active {
        background: linear-gradient(135deg, #008c96 0%, #1a648c 100%);
        color: white;
    }

    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(0, 140, 150, 0.3);
        background: rgba(26, 35, 50, 0.6);
    }

    .logout-btn {
        display: flex;
        align-items: center;
        color: #fed7d7;
        text-decoration: none;
        padding: 12px 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        gap: 12px;
        width: 100%;
        background: linear-gradient(135deg, rgba(185, 28, 28, 0.2), rgba(220, 38, 38, 0.2));
        border: 1px solid rgba(185, 28, 28, 0.3);
    }

    .logout-btn:hover {
        background: linear-gradient(135deg, rgba(185, 28, 28, 0.3), rgba(220, 38, 38, 0.3));
        color: #ffffff;
    }

    /* Toggle Button */
    .toggle-btn {
        position: fixed;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, #081825, #1a648c);
        color: white;
        border: none;
        padding: 12px 14px;
        border-radius: 12px;
        cursor: pointer;
        z-index: 1001;
        transition: all 0.3s ease;
        font-size: 18px;
        box-shadow: 0 4px 15px rgba(0, 140, 150, 0.3);
    }

    .toggle-btn:hover {
        background: linear-gradient(135deg, #1a648c, #008c96);
    }

    .toggle-btn.hidden {
        display: none;
    }

    /* Overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .overlay.active {
        opacity: 1;
        visibility: visible;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.querySelector('.main');

        // Close sidebar when clicking on overlay or main content
        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            toggleBtn.classList.remove('hidden');
        }

        // Toggle sidebar when button is clicked
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.add('open');
            overlay.classList.add('active');
            toggleBtn.classList.add('hidden');
        });

        // Close sidebar when clicking on overlay
        overlay.addEventListener('click', closeSidebar);

        // Close sidebar when clicking on main content
        mainContent.addEventListener('click', function() {
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });
    });
</script>