@extends('layouts.dashboard')

@section('title', 'Report - Sleepy Panda')

@section('content')
    <!-- Statistics Cards -->
    <div class="stats-grid-report" id="statsGrid">
        <div class="stat-card-report">
            <div class="stat-icon-report">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-info-report">
                <h3>Total Users</h3>
                <p id="statTotalUsers">5500</p>
            </div>
        </div>

        <div class="stat-card-report stat-danger">
            <div class="stat-icon-report stat-icon-danger">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-info-report">
                <h3>Insomnia Cases</h3>
                <p id="statInsomniaCases">700</p>
            </div>
        </div>

        <div class="stat-card-report">
            <div class="stat-icon-report">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info-report">
                <h3>Time to Sleep</h3>
                <p id="statTimeToSleep">110 min</p>
            </div>
        </div>

        <div class="stat-card-report">
            <div class="stat-icon-report">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info-report">
                <h3>Average Sleep Time</h3>
                <p id="statAvgSleepTime">5.5 h</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="report-content">
        <!-- Chart Section -->
        <div class="chart-section-report">
            <div class="chart-header-report">
                <select id="reportTypeSelector" class="report-type-dropdown">
                    <option value="daily" selected>Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                </select>
                <select id="chartDateSelector" class="chart-date-dropdown-report">
                    <option value="13-08-2023">13 Agustus 2023</option>
                </select>
            </div>

            <div class="chart-wrapper-report">
                <h4>Users</h4>
                <div class="chart-container-report">
                    <canvas id="reportChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Alert Section -->
        <div class="alert-section-report">
            <h3>Alert Insomnia Terbaru</h3>
            <div class="alert-list" id="alertList">
                <!-- Alerts will be populated by JavaScript -->
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .stats-grid-report {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card-report {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .stat-card-report.stat-danger {
            border-color: rgba(239, 68, 68, 0.3);
        }

        .stat-card-report:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .stat-icon-report {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .stat-icon-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .stat-info-report {
            flex: 1;
        }

        .stat-info-report h3 {
            font-size: 14px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 8px;
        }

        .stat-info-report p {
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .report-content {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        .chart-section-report {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .chart-header-report {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .report-type-dropdown,
        .chart-date-dropdown-report {
            background: rgba(42, 46, 80, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 12px 40px 12px 20px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='white' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
        }

        .report-type-dropdown {
            min-width: 150px;
        }

        .chart-date-dropdown-report {
            min-width: 200px;
        }

        .report-type-dropdown:focus,
        .chart-date-dropdown-report:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .chart-wrapper-report h4 {
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin-bottom: 20px;
        }

        .chart-container-report {
            position: relative;
            height: 450px;
        }

        .alert-section-report {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .alert-section-report h3 {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin-bottom: 25px;
        }

        .alert-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-height: 520px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .alert-list::-webkit-scrollbar {
            width: 6px;
        }

        .alert-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }

        .alert-list::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .alert-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .alert-item:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(239, 68, 68, 0.3);
        }

        .alert-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .alert-item-date {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .alert-item-time {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.4);
        }

        .alert-item-content {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .alert-icon {
            width: 40px;
            height: 40px;
            background: rgba(239, 68, 68, 0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #ef4444;
            flex-shrink: 0;
        }

        .alert-user-icon {
            font-size: 20px;
        }

        .alert-details {
            flex: 1;
        }

        .alert-user-info {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .alert-user-emoji {
            font-size: 18px;
        }

        .alert-user-id {
            font-size: 13px;
            font-weight: 600;
            color: white;
        }

        .alert-duration-info {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .alert-duration-icon {
            font-size: 12px;
            color: #ef4444;
        }

        .alert-duration-text {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
        }

        .alert-message {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.4;
        }

        @media (max-width: 1200px) {
            .stats-grid-report {
                grid-template-columns: repeat(2, 1fr);
            }

            .report-content {
                grid-template-columns: 1fr;
            }

            .alert-section-report {
                max-height: none;
            }

            .alert-list {
                max-height: 400px;
            }
        }

        @media (max-width: 768px) {
            .stats-grid-report {
                grid-template-columns: 1fr;
            }

            .chart-header-report {
                flex-direction: column;
            }

            .report-type-dropdown,
            .chart-date-dropdown-report {
                width: 100%;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        let reportChart = null;
        const reportCtx = document.getElementById('reportChart').getContext('2d');

        // Data untuk setiap report type
        const reportData = {
            daily: {
                stats: {
                    totalUsers: '5500',
                    insomniaCases: '700',
                    timeToSleep: '110 min',
                    avgSleepTime: '5.5 h'
                },
                chartLabels: ['22:00', '23:00', '00:00', '01:00', '02:00', '03:00', '03:00'],
                chartData: [1000, 50, 1000, 2500, 2000, 1000, 100],
                dateOptions: [{
                        value: '13-08-2023',
                        label: '13 Agustus 2023'
                    },
                    {
                        value: '12-08-2023',
                        label: '12 Agustus 2023'
                    },
                    {
                        value: '11-08-2023',
                        label: '11 Agustus 2023'
                    }
                ],
                alerts: [{
                        date: '13 Agustus 2023',
                        time: '30 menit yang lalu',
                        userId: '#12145',
                        duration: '1 Jam 30 Menit',
                        message: 'Tidak Tidur selama 29 jam terakhir'
                    },
                    {
                        date: '13 Agustus 2023',
                        time: '2 jam yang lalu',
                        userId: '#17308',
                        duration: '1 Jam 15 Menit',
                        message: 'Tidak Tidur selama 34 jam terakhir'
                    },
                    {
                        date: '13 Agustus 2023',
                        time: '3 jam yang lalu',
                        userId: '#18432',
                        duration: '1 Jam 25 Menit',
                        message: 'Tidak Tidur selama 32 jam terakhir'
                    },
                    {
                        date: '13 Agustus 2023',
                        time: '5 jam yang lalu',
                        userId: '#28173',
                        duration: '1 Jam 40 Menit',
                        message: 'Tidak Tidur selama 36 jam terakhir'
                    }
                ]
            },
            weekly: {
                stats: {
                    totalUsers: '4500',
                    insomniaCases: '900',
                    timeToSleep: '90 min',
                    avgSleepTime: '5.2 h'
                },
                chartLabels: ['22:00', '23:00', '00:00', '01:00', '02:00', '03:00', '03:00'],
                chartData: [50, 10, 1000, 2200, 1900, 500, 100],
                dateOptions: [{
                        value: '12-18-08-2023',
                        label: '12 Agustus - 18 Agustus 2023'
                    },
                    {
                        value: '05-11-08-2023',
                        label: '5 Agustus - 11 Agustus 2023'
                    }
                ],
                alerts: [{
                        date: '15 Agustus 2023',
                        time: '15 menit yang lalu',
                        userId: '#12388',
                        duration: '1 Jam 35 Menit',
                        message: 'Tidak Tidur selama 36 jam terakhir'
                    },
                    {
                        date: '14 Agustus 2023',
                        time: '1 hari yang lalu',
                        userId: '#16902',
                        duration: '1 Jam 20 Menit',
                        message: 'Tidak Tidur selama 20 jam terakhir'
                    },
                    {
                        date: '13 Agustus 2023',
                        time: '2 hari yang lalu',
                        userId: '#12402',
                        duration: '93 Menit',
                        message: 'Tidak Tidur selama 27 jam terakhir'
                    },
                    {
                        date: '12 Agustus 2023',
                        time: '3 hari yang lalu',
                        userId: '#12455',
                        duration: '1 Jam 1 Menit',
                        message: 'Tidak Tidur selama 38 jam terakhir'
                    }
                ]
            },
            monthly: {
                stats: {
                    totalUsers: '3800',
                    insomniaCases: '800',
                    timeToSleep: '140 min',
                    avgSleepTime: '5.0 h'
                },
                chartLabels: ['22:00', '23:00', '00:00', '01:00', '02:00', '03:00', '03:00'],
                chartData: [1000, 50, 1000, 2500, 2000, 1000, 100],
                dateOptions: [{
                        value: 'agustus-2023',
                        label: 'Agustus 2023'
                    },
                    {
                        value: 'juli-2023',
                        label: 'Juli 2023'
                    },
                    {
                        value: 'juni-2023',
                        label: 'Juni 2023'
                    }
                ],
                alerts: [{
                        date: '10 September 2023',
                        time: '30 menit yang lalu',
                        userId: '#12145',
                        duration: '1 Jam 30 Menit',
                        message: 'Tidak Tidur selama 29 jam terakhir'
                    },
                    {
                        date: '24 Agustus 2023',
                        time: '17 hari yang lalu',
                        userId: '#17308',
                        duration: '1 Jam 15 Menit',
                        message: 'Tidak Tidur selama 34 jam terakhir'
                    },
                    {
                        date: '13 Juli 2023',
                        time: '57 hari yang lalu',
                        userId: '#18432',
                        duration: '1 Jam 25 Menit',
                        message: 'Tidak Tidur selama 32 jam terakhir'
                    },
                    {
                        date: '20 Juni 2023',
                        time: '80 hari yang lalu',
                        userId: '#28173',
                        duration: '1 Jam 40 Menit',
                        message: 'Tidak Tidur selama 36 jam terakhir'
                    }
                ]
            }
        };

        function updateStats(reportType) {
            const stats = reportData[reportType].stats;
            document.getElementById('statTotalUsers').textContent = stats.totalUsers;
            document.getElementById('statInsomniaCases').textContent = stats.insomniaCases;
            document.getElementById('statTimeToSleep').textContent = stats.timeToSleep;
            document.getElementById('statAvgSleepTime').textContent = stats.avgSleepTime;
        }

        function renderDateOptions(reportType) {
            const dateSelector = document.getElementById('chartDateSelector');
            const options = reportData[reportType].dateOptions;

            let html = '';
            options.forEach(option => {
                html += `<option value="${option.value}">${option.label}</option>`;
            });

            dateSelector.innerHTML = html;
        }

        function renderAlerts(reportType) {
            const alertList = document.getElementById('alertList');
            const alerts = reportData[reportType].alerts;

            let html = '';
            alerts.forEach(alert => {
                html += `
                    <div class="alert-item">
                        <div class="alert-item-header">
                            <div class="alert-item-date">${alert.date}</div>
                            <div class="alert-item-time">${alert.time}</div>
                        </div>
                        <div class="alert-item-content">
                            <div class="alert-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="alert-details">
                                <div class="alert-user-info">
                                    <span class="alert-user-emoji">😊</span>
                                    <span class="alert-user-id">User ID ${alert.userId}</span>
                                </div>
                                <div class="alert-duration-info">
                                    <i class="fas fa-bed alert-duration-icon"></i>
                                    <span class="alert-duration-text">Average Durasi Tidur<br>${alert.duration}</span>
                                </div>
                                <div class="alert-message">${alert.message}</div>
                            </div>
                        </div>
                    </div>
                `;
            });

            alertList.innerHTML = html;
        }

        function renderChart(reportType) {
            const data = reportData[reportType];

            // Destroy existing chart
            if (reportChart) {
                reportChart.destroy();
            }

            // Create new chart
            reportChart = new Chart(reportCtx, {
                type: 'bar',
                data: {
                    labels: data.chartLabels,
                    datasets: [{
                        label: 'Users',
                        data: data.chartData,
                        backgroundColor: ['#c5727d', '#a3636c', '#c5727d', '#ed8b97', '#ed8b97', '#c5727d',
                            '#a3636c'
                        ],
                        borderRadius: 6,
                        barPercentage: 0.7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(42, 46, 80, 0.95)',
                            titleColor: '#ffffff',
                            bodyColor: '#8e92bc',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 2500,
                            ticks: {
                                stepSize: 500,
                                color: '#8e92bc',
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#8e92bc',
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        function updateView(reportType) {
            updateStats(reportType);
            renderDateOptions(reportType);
            renderAlerts(reportType);
            renderChart(reportType);
        }

        // Report Type Selector
        document.getElementById('reportTypeSelector').addEventListener('change', function(e) {
            updateView(e.target.value);
        });

        // Chart Date Selector
        document.getElementById('chartDateSelector').addEventListener('change', function(e) {
            console.log('Selected date:', e.target.value);
        });

        // Initialize with daily view
        updateView('daily');
    </script>
@endpush
