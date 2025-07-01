<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";

// First Database: signup_db
$database1 = "signup_db";
$conn1 = mysqli_connect($hostname, $username, $password, $database1);
if (!$conn1) {
    die("Connection to signup_db failed: " . mysqli_connect_error());
}

// Second Database: post_event
$database2 = "post_event";
$conn2 = mysqli_connect($hostname, $username, $password, $database2);
if (!$conn2) {
    die("Connection to post_event failed: " . mysqli_connect_error());
}

// Check if AdminLoginId or username is not set
if (!isset($_SESSION['AdminLoginId'])) {
    header("location: admin.php");
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("location: admin.php");
}

include('signup-2.php');
include('save_event-2.php');

// Query to count users
$user_query = "SELECT COUNT(*) AS user_count FROM signup_db.users";
$user_result = mysqli_query($conn1, $user_query);
$user_count = ($user_result) ? mysqli_fetch_assoc($user_result)['user_count'] : 0;

// Query to count events
$event_query = "SELECT COUNT(*) AS event_count FROM post_event.posted_events";
$event_result = mysqli_query($conn2, $event_query);
$event_count = ($event_result) ? mysqli_fetch_assoc($event_result)['event_count'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_panel.css">
    <script src="admin_panel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Admin Panel</title>
    <script src="https://kit.fontawesome.com/5df5ba9f64.js" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="sidenav">
        <ul class="nav-top">
            <li>
                <a href="#" onclick="showContent('dashboard')">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <!-- Rest of your navigation -->
            <li>
                <a href="#" onclick="showContent('analytics')">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-text">Analytics</span>
                </a>
            </li>
        </ul>
        <!-- Bottom Section for Settings and Logout -->
        <form method="POST">
            <ul class="nav-bottom">
                <li>
                    <button type="submit" name="logout" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">Logout</span>
                    </button>
                </li>
            </ul>
        </form>
    </nav>

    <main class="main-content">
        <div class="uppernav">
            <h2>Welcome to Admin Panel</h2>
        </div>

        <div id="dashboard" class="content-section">
            <!-- Users Box (Now Redirects to users.php) -->
            <a href="users_data.php" class="count-box" id="user">
                <div class="count-section">
                    <div class="count-content" id="users-count">
                        <h2 id="user-count" data-count="<?= $user_count ?>">0</h2>
                        <p class="count-label">Users</p>
                    </div>
                    <div id="chart-icon-line">
                        <img src="line-chart.png" alt="Chart">
                    </div>
                </div>
            </a>

            <!-- Users Box (Now Redirects to users.php) -->
            <a href="event_data.php" class="count-box" id="event">
                <div class="count-section">
                    <div class="count-content" id="events-count">
                        <h2 id="event-count" data-count="<?= $event_count ?>">0</h2>
                        <p class="count-label">Events</p>
                    </div>
                    <div id="chart-icon-bar">
                        <img src="bar-graph.png" alt="Chart">
                    </div>
                </div>
            </a>
        </div>

        <!-- Real-time Traffic Chart -->
        <div class="traffic">
            <h2>Traffic</h2>
            <div id="chart"></div>

            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                // Initial Data
                let userCounts = [10, 20, 30]; // Starting values
                let dataLabels = ['Jan', 'Feb', 'Mar']; // X-axis labels

                // Chart Options
                const options = {
                    chart: {
                        type: 'area',
                        height: 350,
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            dynamicAnimation: {
                                speed: 350
                            }
                        },
                        background: 'transparent'
                    },
                    series: [{
                        name: 'Users',
                        data: userCounts
                    }],
                    xaxis: {
                        categories: dataLabels,
                        labels: {
                            style: {
                                colors: '#333',
                                fontSize: '14px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#333',
                                fontSize: '14px'
                            }
                        }
                    },
                    title: {
                        text: 'Real-Time User Traffic',
                        align: 'center',
                        style: {
                            fontSize: '20px',
                            fontWeight: 'bold',
                            color: '#333'
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    colors: ['#007BFF'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'vertical',
                            gradientToColors: ['#00c6ff'],
                            stops: [0, 100]
                        }
                    },
                    tooltip: {
                        theme: 'dark'
                    }
                };

                // Create the chart
                const chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();

                // Function to generate dynamic data
                function getRandomUsers() {
                    return Math.floor(Math.random() * 200) + 10; // Simulate user growth (10-200)
                }

                // Function to update the chart dynamically
                setInterval(() => {
                    // Add new random user count and remove oldest data
                    userCounts.push(getRandomUsers());
                    userCounts.shift();

                    // Update the chart
                    chart.updateSeries([{
                        data: userCounts
                    }]);
                }, 3000); // Refresh every 3 seconds
            </script>
        </div>


        <!-- Social Boxes  -->

        <div class="social">
            <div class="social_box">
                <div class="logo-section" id="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <div class="text-section">
                    <span>
                        <h2>89k</h2>
                        <p>FRIENDS</p>
                    </span>
                    <div class="separator"></div> <!-- Vertical Separator -->
                    <span>
                        <h2>459</h2>
                        <p>FEEDS</p>
                    </span>
                </div>
            </div>
            <div class="social_box">
                <div class="logo-section" id="Twitter">
                    <i class="fab fa-twitter"></i>
                </div>
                <div class="text-section">
                    <span>
                        <h2>973k</h2>
                        <p>FOLLOWERS</p>
                    </span>
                    <div class="separator"></div> <!-- Vertical Separator -->
                    <span>
                        <h2>1.792</h2>
                        <p>TWEETS</p>
                    </span>
                </div>
            </div>
            <div class="social_box">
                <div class="logo-section" id="Linkedin">
                    <i class="fab fa-linkedin-in"></i>
                </div>
                <div class="text-section">
                    <span>
                        <h2>500+</h2>
                        <p>CONTACTS</p>
                    </span>
                    <div class="separator"></div> <!-- Vertical Separator -->
                    <span>
                        <h2>292</h2>
                        <p>FEEDS</p>
                    </span>
                </div>
            </div>
        </div>


    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let userCountElement = document.querySelector("#user-count");
            let eventCountElement = document.querySelector("#event-count");

            function animateCount(element) {
                if (!element) return;
                let target = parseInt(element.getAttribute("data-count"));
                if (isNaN(target) || target === 0) return;

                let current = 0;
                let speed = Math.max(10, 1000 / target);

                function countUp() {
                    if (current < target) {
                        current += Math.ceil(target / 100);
                        element.innerText = current > target ? target : current;
                        setTimeout(countUp, speed);
                    } else {
                        element.innerText = target;
                    }
                }
                countUp();
            }

            animateCount(userCountElement);
            animateCount(eventCountElement);
        });
    </script>


</body>

</html>