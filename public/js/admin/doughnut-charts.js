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
                // #4e73df - tandag - primary
                // #1cc88a - cantilan - success
                // #d63384 - cagwait - pink
                // #36b9cc - lianga - info
                // #f6c23e - tagbina - warning
                // #858796 - bislig - secondary
                backgroundColor: ['#4e73df', '#1cc88a', '#d63384', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'], // Custom colors for each segment
                borderWidth: 0,
            }]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                display: true,
                position: 'bottom',
                padding: 20,
            },
        }
    });
}

function createCampusStatusChart(data, ctx) {
    var functional_projects_count = data.map(item => item.functional_projects_count);
    var phased_out_projects_count = data.map(item => item.phased_out_projects_count);
    var campusLabels = data.map(item => item.location);

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: campusLabels,
            datasets: [
                {
                    data: phased_out_projects_count,
                    label: 'Phased Out',
                    // #4e73df - tandag - primary
                // #1cc88a - cantilan - success
                // #d63384 - cagwait - pink
                // #36b9cc - lianga - info
                // #f6c23e - tagbina - warning
                // #858796 - bislig - secondary
                    backgroundColor: '#e74a3b', // Custom colors for each segment
                    borderWidth: 0,
                },
                {
                    data: functional_projects_count,
                    label: 'Functional',   
                    backgroundColor: '#1cc88a',
                    borderWidth: 0,
                }
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: true,
                position: 'bottom',
            },
        }
    });
}



// Get the canvas context and create the Campus Doughnut Chart
let campusCtx = document.getElementById('campusDoughnutChart').getContext('2d');
createDoughnutChart(campusData, campusCtx);

// Get the canvas context and create the Project statuses Bar Chart
let campusStatusCtx = document.getElementById('campusStatusBarChart').getContext('2d');
createCampusStatusChart(campusStatusData, campusStatusCtx);
