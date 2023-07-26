// doughnut-charts.js

// Function to create a Doughnut Chart
function createDoughnutChart(data, ctx) {
    var chartData = data.map(item => item.projects_count);
    var campusLabels = data.map(item => item.location);

    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: campusLabels,
            datasets: [{
                data: chartData,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'], // Custom colors for each segment
                borderWidth: 0,
            }]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                display: false,
            },
        }
    });
}

// // Get the campus data from the Blade view
// var campusData = @json($campusData);

// Get the canvas context and create the Campus Doughnut Chart
var campusCtx = document.getElementById('campusDoughnutChart').getContext('2d');
createDoughnutChart(campusData, campusCtx);
