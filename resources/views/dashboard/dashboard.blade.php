@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">لوحة التحكم</h1>

    <canvas id="statsChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('statsChart').getContext('2d');
    const statsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['المقالات', 'التعليقات', 'المستخدمين'],
            datasets: [{
                label: 'الإحصائيات',
                data: [
                    {{ $postsCount }},
                    {{ $commentsCount }},
                    {{ $usersCount }}
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }
        }
    });
</script>
@endsection
