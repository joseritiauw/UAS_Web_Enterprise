@extends('layouts.dashboard')

@section('title', 'Jurnal Tidur Report - Sleepy Panda')

@section('content')
    <!-- Page Title -->
    <div class="page-title-section">
        <h1>Jurnal Tidur Report</h1>
        <div class="report-type-selector">
            <select id="reportTypeSelector" class="report-dropdown">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div>
    </div>

    <!-- Content Section -->
    <div class="jurnal-content" id="jurnalContent">
        <!-- Left Side - Cards (will be dynamically populated) -->
        <div class="jurnal-cards" id="jurnalCards"></div>

        <!-- Right Side - Chart -->
        <div class="jurnal-chart-section">
            <div class="chart-header">
                <h3>Users</h3>
                <select id="chartDateSelector" class="chart-date-dropdown"></select>
            </div>
            <div class="chart-container-jurnal">
                <canvas id="jurnalChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .page-title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .page-title-section h1 {
            font-size: 28px;
            font-weight: 600;
            color: white;
            margin: 0;
            width: 100%;
            text-align: center;
        }

        .report-type-selector {
            position: relative;
        }

        .report-dropdown {
            background: rgba(42, 46, 80, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 12px 40px 12px 20px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            appearance: none;
            min-width: 150px;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='white' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
        }

        .report-dropdown:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .jurnal-content {
            display: grid;
            grid-template-columns: 400px 1fr;
            gap: 30px;
        }

        .jurnal-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .jurnal-card {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
        }

        .card-date {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 20px;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-stats {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon-emoji,
        .stat-icon-bed,
        .stat-icon-sun {
            font-size: 24px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .stat-icon-emoji {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .stat-icon-bed {
            background: rgba(233, 30, 99, 0.2);
            color: #e91e63;
        }

        .stat-icon-sun {
            background: rgba(255, 152, 0, 0.2);
            color: #ff9800;
        }

        .stat-detail {
            flex: 1;
        }

        .stat-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 13px;
            color: white;
            font-weight: 600;
        }

        .jurnal-card-large {
            padding: 25px;
        }

        .card-stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .stat-item-large {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-icon-moon {
            font-size: 20px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            flex-shrink: 0;
            background: rgba(103, 58, 183, 0.2);
            color: #673ab7;
        }

        .stat-icon-clock {
            font-size: 20px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            flex-shrink: 0;
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .jurnal-chart-section {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .chart-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin: 0;
        }

        .chart-date-dropdown {
            background: rgba(42, 46, 80, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 8px 35px 8px 15px;
            color: white;
            font-size: 13px;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='white' stroke-width='2' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        .chart-date-dropdown:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .chart-container-jurnal {
            position: relative;
            height: 450px;
        }

        @media (max-width: 1200px) {
            .jurnal-content {
                grid-template-columns: 1fr;
            }

            .jurnal-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        let jurnalChart = null;
        const jurnalCtx = document.getElementById('jurnalChart').getContext('2d');

        // Data untuk setiap tipe report
        const reportData = {
            daily: {
                cards: [{
                        date: '12 Agustus 2023',
                        stats: {
                            user: 1000,
                            duration: '7 jam 2 menit',
                            waktu: '21:30 - 06:10'
                        }
                    },
                    {
                        date: '12 Agustus 2023',
                        stats: {
                            user: 1000,
                            duration: '7 jam 2 menit',
                            waktu: '21:30 - 06:10'
                        }
                    },
                    {
                        date: '12 Agustus 2023',
                        stats: {
                            user: 1000,
                            duration: '7 jam 2 menit',
                            waktu: '21:30 - 06:10'
                        }
                    }
                ],
                chartType: 'line',
                chartLabels: ['0j', '2j', '4j', '6j', '8j'],
                chartData: [0, 1000, 100, 50, 2500],
                dateOptions: [{
                        value: '12-08-2023',
                        label: '12 Agustus 2023'
                    },
                    {
                        value: '11-08-2023',
                        label: '11 Agustus 2023'
                    },
                    {
                        value: '10-08-2023',
                        label: '10 Agustus 2023'
                    }
                ]
            },
            weekly: {
                cards: [{
                    date: '1 Juni - 7 Juni 2023',
                    stats: {
                        user: 4000,
                        avgDuration: '8 jam 2 menit',
                        totalDuration: '80 jam 51 menit',
                        avgWaktu: '21:08',
                        avgBangun: '06:30'
                    }
                }],
                chartType: 'bar',
                chartLabels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                chartData: [5, 7, 4, 9, 7, 7, 4],
                dateOptions: [{
                        value: '01-07-06-2023',
                        label: '1 Juni - 7 Juni 2023'
                    },
                    {
                        value: '08-14-06-2023',
                        label: '8 Juni - 14 Juni 2023'
                    }
                ]
            },
            monthly: {
                cards: [{
                        date: 'Juni 2023',
                        stats: {
                            user: 5000,
                            avgDuration: '8 jam 2 menit',
                            totalDuration: '80 jam 51 menit',
                            avgWaktu: '21:58',
                            avgBangun: '07:10'
                        }
                    },
                    {
                        date: 'Mei 2023',
                        stats: {
                            user: 8000,
                            avgDuration: '7 jam 35 menit',
                            totalDuration: '60 jam 18 menit',
                            avgWaktu: '22:48',
                            avgBangun: '06:30'
                        }
                    }
                ],
                chartType: 'bar',
                chartLabels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                chartData: [5, 4, 7, 7],
                dateOptions: [{
                        value: 'juni-2023',
                        label: 'Juni 2023'
                    },
                    {
                        value: 'mei-2023',
                        label: 'Mei 2023'
                    }
                ]
            }
        };

        function renderCards(reportType) {
            const cardsContainer = document.getElementById('jurnalCards');
            const cards = reportData[reportType].cards;

            let html = '';

            cards.forEach(card => {
                if (reportType === 'daily') {
                    html += `
                        <div class="jurnal-card">
                            <div class="card-date">${card.date}</div>
                            <div class="card-stats">
                                <div class="stat-item">
                                    <i class="fas fa-smile stat-icon-emoji"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">User</div>
                                        <div class="stat-value">${card.stats.user}</div>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-bed stat-icon-bed"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">Average Durasi Tidur</div>
                                        <div class="stat-value">${card.stats.duration}</div>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-sun stat-icon-sun"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">Average Waktu Tidur</div>
                                        <div class="stat-value">${card.stats.waktu}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="jurnal-card jurnal-card-large">
                            <div class="card-date">${card.date}</div>
                            <div class="card-stats-grid">
                                <div class="stat-item-large">
                                    <i class="fas fa-smile stat-icon-emoji"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">User</div>
                                        <div class="stat-value">${card.stats.user}</div>
                                    </div>
                                </div>
                                <div class="stat-item-large">
                                    <i class="fas fa-bed stat-icon-bed"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">Average Durasi Tidur</div>
                                        <div class="stat-value">${card.stats.avgDuration}</div>
                                    </div>
                                </div>
                                <div class="stat-item-large">
                                    <i class="fas fa-sun stat-icon-sun"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">Total Durasi Tidur</div>
                                        <div class="stat-value">${card.stats.totalDuration}</div>
                                    </div>
                                </div>
                                <div class="stat-item-large">
                                    <i class="fas fa-moon stat-icon-moon"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">Average Mulai Tidur</div>
                                        <div class="stat-value">${card.stats.avgWaktu}</div>
                                    </div>
                                </div>
                                <div class="stat-item-large">
                                    <i class="fas fa-clock stat-icon-clock"></i>
                                    <div class="stat-detail">
                                        <div class="stat-label">Average Bangun Tidur</div>
                                        <div class="stat-value">${card.stats.avgBangun}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            });

            cardsContainer.innerHTML = html;
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

        function renderChart(reportType) {
            const data = reportData[reportType];

            // Destroy existing chart
            if (jurnalChart) {
                jurnalChart.destroy();
            }

            // Create new chart
            if (data.chartType === 'line') {
                jurnalChart = new Chart(jurnalCtx, {
                    type: 'line',
                    data: {
                        labels: data.chartLabels,
                        datasets: [{
                            label: 'Users',
                            data: data.chartData,
                            borderColor: '#ffa726',
                            backgroundColor: 'transparent',
                            borderWidth: 3,
                            tension: 0,
                            pointRadius: 5,
                            pointBackgroundColor: '#ffa726',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointHoverRadius: 7
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
            } else {
                jurnalChart = new Chart(jurnalCtx, {
                    type: 'bar',
                    data: {
                        labels: data.chartLabels,
                        datasets: [{
                            label: 'Hours',
                            data: data.chartData,
                            backgroundColor: '#c5727d',
                            borderRadius: 6,
                            barPercentage: 0.6
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
                                max: 10,
                                ticks: {
                                    stepSize: 2,
                                    color: '#8e92bc',
                                    font: {
                                        size: 12
                                    },
                                    callback: function(value) {
                                        return value + 'j';
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
        }

        function updateView(reportType) {
            renderCards(reportType);
            renderDateOptions(reportType);
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
