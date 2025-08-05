@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')
    <!-- Header Section with Search -->
    <div class="header-section">
        <div class="search-container">
            <div class="search-icon">🔍</div>
            <input type="text" class="search-bar" placeholder="Search events, plans, or anything...">
        </div>
        <div class="user-info">
            <div class="user-avatar">JD</div>
            <div class="user-details">
                <h3>John Doe</h3>
                <p id="currentRole">Participant</p>
            </div>
        </div>
    </div>

    <!-- Role Toggle -->
    <div class="role-toggle">
        <button class="role-btn active" onclick="switchRole('participant')">Participant View</button>
        <button class="role-btn" onclick="switchRole('admin')">Admin View</button>
    </div>

    <!-- Dashboard Content -->
    <div id="dashboardContent">
        <!-- Content will be injected here by JavaScript -->
    </div>

    <style>
        /* Header Section */
        .header-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            background: rgba(0, 140, 150, 0.08);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(0, 140, 150, 0.2);
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 140, 150, 0.1), transparent);
            animation: headerGlow 3s ease-in-out infinite;
        }

        @keyframes headerGlow {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .search-container {
            flex: 1;
            position: relative;
        }

        .search-bar {
            width: 90%;
            padding: 15px 20px 15px 50px;
            background: rgba(45, 55, 72, 0.8);
            border: 2px solid rgba(0, 140, 150, 0.3);
            border-radius: 25px;
            color: #e2e8f0;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-bar:focus {
            border-color: #008c96;
            box-shadow: 0 0 20px rgba(0, 140, 150, 0.3);
            background: rgba(45, 55, 72, 0.9);
        }

        .search-bar::placeholder {
            color: #a0aec0;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #008c96;
            font-size: 18px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(45, 55, 72, 0.6);
            padding: 12px 20px;
            border-radius: 20px;
            border: 1px solid rgba(0, 140, 150, 0.2);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #008c96, #1a648c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .user-details h3 {
            margin: 0;
            font-size: 14px;
            color: #ffffff;
        }

        .user-details p {
            margin: 0;
            font-size: 12px;
            color: #a0aec0;
        }

        /* Role Toggle */
        .role-toggle {
            background: rgba(0, 140, 150, 0.1);
            padding: 10px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }

        .role-btn {
            padding: 8px 20px;
            background: transparent;
            color: #a0aec0;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .role-btn.active {
            background: linear-gradient(135deg, #008c96, #1a648c);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 140, 150, 0.3);
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        /* Section Cards */
        .section-card {
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.8), rgba(26, 35, 50, 0.9));
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(0, 140, 150, 0.2);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .section-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #008c96, #1a648c);
            opacity: 0.8;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 140, 150, 0.2);
            border-color: rgba(0, 140, 150, 0.4);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            background: linear-gradient(135deg, #008c96, #1a648c);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #ffffff;
            margin: 0;
        }

        /* Plan Section */
        .plan-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #008c96, #1a648c);
            border-radius: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .plan-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="25" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #008c96, #1a648c);
            color: white;
            margin-bottom: 10px;
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 140, 150, 0.4);
        }

        .btn-secondary {
            background: rgba(0, 140, 150, 0.2);
            color: #008c96;
            border: 1px solid rgba(0, 140, 150, 0.3);
            width: 100%;
        }

        .btn-secondary:hover {
            background: rgba(0, 140, 150, 0.3);
            color: white;
        }

        /* Events Section */
        .event-item {
            background: rgba(0, 140, 150, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-left: 4px solid #008c96;
            transition: all 0.3s ease;
        }

        .event-item:hover {
            background: rgba(0, 140, 150, 0.2);
            transform: translateX(5px);
        }

        .event-date {
            font-size: 12px;
            color: #008c96;
            font-weight: 600;
        }

        .event-title {
            font-size: 16px;
            color: #ffffff;
            margin: 5px 0;
        }

        .event-desc {
            font-size: 14px;
            color: #a0aec0;
        }

        /* Contact Section */
        .social-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .social-link {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .social-link:hover::before {
            transform: translateX(100%);
        }

        .social-link.facebook { background: linear-gradient(135deg, #1877f2, #42a5f5); color: white; }
        .social-link.twitter { background: linear-gradient(135deg, #1da1f2, #42a5f5); color: white; }
        .social-link.instagram { background: linear-gradient(135deg, #e4405f, #fd1d1d, #fcb045); color: white; }
        .social-link.linkedin { background: linear-gradient(135deg, #0077b5, #00a0dc); color: white; }

        .social-link:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 140, 150, 0.3);
        }

        /* Admin Sections */
        .admin-controls {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 8px 16px;
            font-size: 14px;
            flex: 1;
            min-width: 80px;
        }

        .btn-success { background: linear-gradient(135deg, #10b981, #059669); color: white; }
        .btn-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
        .btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }

        .btn-success:hover, .btn-warning:hover, .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Inscriptions Section */
        .inscription-item {
            background: rgba(0, 140, 150, 0.1);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .inscription-info h4 {
            margin: 0 0 5px 0;
            color: #ffffff;
        }

        .inscription-info p {
            margin: 0;
            color: #a0aec0;
            font-size: 14px;
        }

        .inscription-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
        .status-approved { background: rgba(16, 185, 129, 0.2); color: #10b981; }
        .status-rejected { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
    </style>

    <script>
        let currentRole = 'participant';

        function switchRole(role) {
            currentRole = role;
            
            // Update role buttons
            document.querySelectorAll('.role-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Update user role display
            document.getElementById('currentRole').textContent = role.charAt(0).toUpperCase() + role.slice(1);
            
            // Update dashboard content
            updateDashboardContent(role);
        }

        function updateDashboardContent(role) {
            const dashboardContent = document.getElementById('dashboardContent');
            
            if (role === 'participant') {
                dashboardContent.innerHTML = `
                    <div class="dashboard-grid">
                        <!-- Plans Section -->
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-icon">📋</div>
                                <h2 class="section-title">Our Plans</h2>
                            </div>
                            <div class="plan-image">
                                <span>Premium Fitness Plan</span>
                            </div>
                            <p style="color: #a0aec0; margin-bottom: 20px;">
                                Transform your fitness journey with our comprehensive training program designed for all levels.
                            </p>
                            <a href="#" class="btn btn-primary">Learn About Us</a>
                            <a href="#" class="btn btn-secondary">Sign Up Now</a>
                        </div>

                        <!-- Discover Events -->
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-icon">🎯</div>
                                <h2 class="section-title">Discover Events</h2>
                            </div>
                            <div class="event-item">
                                <div class="event-date">Dec 15, 2024</div>
                                <div class="event-title">Winter Fitness Challenge</div>
                                <div class="event-desc">Join our community challenge and win amazing prizes!</div>
                            </div>
                            <div class="event-item">
                                <div class="event-date">Dec 20, 2024</div>
                                <div class="event-title">Yoga & Meditation Workshop</div>
                                <div class="event-desc">Find your inner peace with our expert instructors.</div>
                            </div>
                            <div class="event-item">
                                <div class="event-date">Dec 25, 2024</div>
                                <div class="event-title">Holiday Bootcamp</div>
                                <div class="event-desc">Stay fit during the holidays with our special program.</div>
                            </div>
                            <a href="#" class="btn btn-secondary" style="margin-top: 15px;">See All Events</a>
                        </div>

                        <!-- Contact Section -->
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-icon">📞</div>
                                <h2 class="section-title">Contact Us</h2>
                            </div>
                            <p style="color: #a0aec0; margin-bottom: 20px;">
                                Stay connected with us on social media for updates, tips, and community support.
                            </p>
                            <div class="social-links">
                                <a href="#" class="social-link facebook">📘</a>
                                <a href="#" class="social-link twitter">🐦</a>
                                <a href="#" class="social-link instagram">📷</a>
                                <a href="#" class="social-link linkedin">💼</a>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                dashboardContent.innerHTML = `
                    <div class="dashboard-grid">
                        <!-- Inscriptions Management -->
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-icon">👥</div>
                                <h2 class="section-title">Inscriptions</h2>
                            </div>
                            <div class="inscription-item">
                                <div class="inscription-info">
                                    <h4>Sarah Johnson</h4>
                                    <p>Premium Plan • Registered 2 days ago</p>
                                </div>
                                <span class="inscription-status status-pending">Pending</span>
                            </div>
                            <div class="inscription-item">
                                <div class="inscription-info">
                                    <h4>Mike Chen</h4>
                                    <p>Basic Plan • Registered 1 week ago</p>
                                </div>
                                <span class="inscription-status status-approved">Approved</span>
                            </div>
                            <div class="inscription-item">
                                <div class="inscription-info">
                                    <h4>Emily Davis</h4>
                                    <p>Premium Plan • Registered 3 days ago</p>
                                </div>
                                <span class="inscription-status status-rejected">Rejected</span>
                            </div>
                            <a href="#" class="btn btn-primary" style="margin-top: 15px;">View All Inscriptions</a>
                        </div>

                        <!-- Plans Management -->
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-icon">📋</div>
                                <h2 class="section-title">Manage Plans</h2>
                            </div>
                            <div class="plan-image">
                                <span>Current Featured Plan</span>
                            </div>
                            <p style="color: #a0aec0; margin-bottom: 20px;">
                                Manage your fitness plans, update content, images, and pricing information.
                            </p>
                            <div class="admin-controls">
                                <button class="btn btn-success btn-small">Add Plan</button>
                                <button class="btn btn-warning btn-small">Edit</button>
                                <button class="btn btn-danger btn-small">Delete</button>
                            </div>
                        </div>

                        <!-- Events Management -->
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-icon">🎯</div>
                                <h2 class="section-title">Manage Events</h2>
                            </div>
                            <div class="event-item">
                                <div style="flex: 1;">
                                    <div class="event-date">Dec 15, 2024</div>
                                    <div class="event-title">Winter Fitness Challenge</div>
                                    <div class="event-desc">45 participants registered</div>
                                </div>
                                <div style="display: flex; gap: 5px;">
                                    <button class="btn btn-warning btn-small" style="padding: 6px 10px; font-size: 12px;">Edit</button>
                                    <button class="btn btn-danger btn-small" style="padding: 6px 10px; font-size: 12px;">Delete</button>
                                </div>
                            </div>
                            <div class="event-item">
                                <div style="flex: 1;">
                                    <div class="event-date">Dec 20, 2024</div>
                                    <div class="event-title">Yoga & Meditation Workshop</div>
                                    <div class="event-desc">23 participants registered</div>
                                </div>
                                <div style="display: flex; gap: 5px;">
                                    <button class="btn btn-warning btn-small" style="padding: 6px 10px; font-size: 12px;">Edit</button>
                                    <button class="btn btn-danger btn-small" style="padding: 6px 10px; font-size: 12px;">Delete</button>
                                </div>
                            </div>
                            <button class="btn btn-success" style="margin-top: 15px;">Add New Event</button>
                        </div>

                        <!-- Contact Management -->
                        <div class="section-card">
                            <div class="section-header">
                                <div class="section-icon">📞</div>
                                <h2 class="section-title">Manage Contacts</h2>
                            </div>
                            <p style="color: #a0aec0; margin-bottom: 20px;">
                                Update social media links and contact information displayed to users.
                            </p>
                            <div class="social-links" style="margin-bottom: 20px;">
                                <a href="#" class="social-link facebook">📘</a>
                                <a href="#" class="social-link twitter">🐦</a>
                                <a href="#" class="social-link instagram">📷</a>
                                <a href="#" class="social-link linkedin">💼</a>
                            </div>
                            <div class="admin-controls">
                                <button class="btn btn-success btn-small">Add Social</button>
                                <button class="btn btn-warning btn-small">Edit Links</button>
                                <button class="btn btn-danger btn-small">Remove</button>
                            </div>
                        </div>
                    </div>
                `;
            }
        }

        // Initialize with participant view
        document.addEventListener('DOMContentLoaded', function() {
            switchRole('participant');
        });
    </script>
@endsection