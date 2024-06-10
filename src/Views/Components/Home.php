<?php

namespace App\Views\Components;

use App\Views\BaseView;

class Home extends BaseView
{

    public static function render()
    { ?>
        <div style="display: flex; justify-content: center;">
            <div style="flex: 1; text-align: center;">
                <h1>Welcome to Our Website!</h1>
                <p>Explore amazing content and enjoy your stay!</p>
            </div>
        </div>
        <div class="container" style="margin-left:210px; margin-top: 10px;">
            <div class="infomation">
                <div class="small-box bg-info" style="width:520px; float:left;">
                    <div class="inner">
                        <h3>783</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

                <div class="small-box bg-gradient-success" style="width:520px; float:left; margin-left:20px;">
                    <div class="inner">
                        <h3>3327</h3>
                        <p>Cient</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

                <div class="info-box" style="float:left; width: 300px; margin-left: 30px;">
                    <span class="info-box-icon bg-info"><i class="far fa-bookmark"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Project</span>
                        <span class="info-box-number">320</span>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 40%"></div>
                        </div>
                        <span class="progress-description">
                            40% Increase in 30 Days
                        </span>
                    </div>
                </div>

                <div class="info-box bg-gradient-warning" style="float:left; width: 300px; margin-left: 50px;">
                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Appointment</span>
                        <span class="info-box-number">2365</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 87%"></div>
                        </div>
                        <span class="progress-description">
                            87% Increase in 30 Days
                        </span>
                    </div>
                </div>

                <div class="info-box bg-success" style="float:left; width: 300px; margin-left: 50px;">
                    <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Rate</span>
                        <span class="info-box-number">Extremely positive</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 95%"></div>
                        </div>
                        <span class="progress-description">
                            3214 customer reviews
                        </span>
                    </div>
                </div>
            </div>
<div style="width: 64%; margin: auto; margin-bottom:30px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Include Chart.js library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Sample revenue data
            const data = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Revenue (in thousands USD)',
                    data: [12000, 19000, 3000, 5000, 2000, 3000, 12000, 15000, 8000, 20000, 25000, 30000],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            // Chart configuration
            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Initialize the chart
            const revenueChart = new Chart(
                document.getElementById('revenueChart'),
                config
            );
        </script>
    <?php }

public static function handle(){

}
}
