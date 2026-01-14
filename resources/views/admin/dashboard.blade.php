@extends('layouts.dashboard')

@section('title', 'Dashboard - Sleepy Panda')

@section('content')
    @if (session('token'))
        <div class="success-message">
            <i class="fas fa-check-circle"></i> Login berhasil! Selamat datang di Sleepy Panda.
        </div>
    @endif

    <!-- Report Charts Section -->
    <div class="reports-section">
        <!-- Daily Report -->
        <div class="report-card">
            <h3>Daily Report</h3>
            <div class="chart-legend">
                <span><span class="legend-dot female"></span> Female</span>
                <span><span class="legend-dot male"></span> Male</span>
            </div>
            <div class="chart-container-small">
                <canvas id="dailyChart"></canvas>
            </div>
        </div>

        <!-- Weekly Report -->
        <div class="report-card">
            <h3>Weekly Report</h3>
            <div class="chart-legend">
                <span><span class="legend-dot female"></span> Female</span>
                <span><span class="legend-dot male"></span> Male</span>
            </div>
            <div class="chart-container-small">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        <!-- Monthly Report -->
        <div class="report-card">
            <h3>Monthly Report</h3>
            <div class="chart-legend">
                <span><span class="legend-dot female"></span> Female</span>
                <span><span class="legend-dot male"></span> Male</span>
            </div>
            <div class="chart-container-small">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon-user">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-info">
                <h3>Total Users</h3>
                <p>4500</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-user">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-info">
                <h3>Female Users</h3>
                <p>2000</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-user">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-info">
                <h3>Male Users</h3>
                <p>2500</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon-clock">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3>Average Time</h3>
                <p>154.25</p>
            </div>
        </div>
    </div>

    <!-- Average Users Sleep Time Chart -->
    <div class="content-card">
        <h2>Average Users Sleep Time</h2>
        <div class="chart-legend">
            <span><span class="legend-dot female"></span> Female</span>
            <span><span class="legend-dot male"></span> Male</span>
        </div>
        <div class="chart-container">
            <canvas id="sleepChart"></canvas>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .reports-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .report-card {
            background: rgba(42, 46, 80, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
        }

        .report-card h3 {
            font-size: 16px;
            font-weight: 600;
            color: white;
            margin-bottom: 15px;
        }

        .chart-legend {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        .chart-legend span {
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.7);
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .legend-dot.female {
            background: #ec4899;
        }

        .legend-dot.male {
            background: #3b82f6;
        }

        .chart-container-small {
            height: 200px;
            position: relative;
        }

        .stat-icon-user,
        .stat-icon-clock {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }

        .stat-icon-user {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .stat-icon-clock {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Daily Report Chart
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Female',
                    data: [2000, 2200, 1800, 2400, 500, 100, 200],
                    backgroundColor: '#ec4899',
                    borderRadius: 4,
                    barPercentage: 0.6
                }, {
                    label: 'Male',
                    data: [1800, 2000, 1600, 2200, 400, 1200, 100],
                    backgroundColor: '#3b82f6',
                    borderRadius: 4,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                                size: 10
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
                                size: 10
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Weekly Report Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Female',
                    data: [2100, 2300, 2500, 2400],
                    backgroundColor: '#ec4899',
                    borderRadius: 4,
                    barPercentage: 0.6
                }, {
                    label: 'Male',
                    data: [1900, 2100, 2000, 2200],
                    backgroundColor: '#3b82f6',
                    borderRadius: 4,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                                size: 10
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
                                size: 10
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Monthly Report Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt'],
                datasets: [{
                    label: 'Female',
                    data: [2200, 2100, 2300, 2200, 2100, 2000, 2400, 2100, 2300, 2200],
                    backgroundColor: '#ec4899',
                    borderRadius: 4,
                    barPercentage: 0.6
                }, {
                    label: 'Male',
                    data: [2000, 1900, 2100, 2000, 1900, 1800, 2200, 1900, 2100, 2000],
                    backgroundColor: '#3b82f6',
                    borderRadius: 4,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                                size: 10
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
                                size: 10
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Average Users Sleep Time Chart (Line Chart)
        const sleepCtx = document.getElementById('sleepChart').getContext('2d');
        new Chart(sleepCtx, {
            type: 'line',
            data: {
                labels: ['Jan 01', 'Jan 02', 'Jan 03', 'Jan 04', 'Jan 05', 'Jan 06'],
                datasets: [{
                    label: 'Female',
                    data: [2, 3, 4, 5, 8, 7],
                    borderColor: '#ec4899',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    tension: 0,
                    pointRadius: 0,
                    pointHoverRadius: 6
                }, {
                    label: 'Male',
                    data: [1, 2, 5, 3, 5, 4],
                    borderColor: '#3b82f6',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    tension: 0,
                    pointRadius: 0,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
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
                                size: 11
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
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
