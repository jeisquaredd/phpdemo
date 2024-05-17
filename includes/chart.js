
// Data for Bar Graph

const barData = {
    labels: ['Male', 'Female'],
    datasets: [{
        label: 'Total',
        data: [100, 19],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
    }]
};

// Data for Pie Chart
const pieData = {
    labels: ['Male', 'Female'],
    datasets: [{
        label: 'Total',
        data: [12, 19],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
    }]
};

// Config for Bar Graph
const barConfig = {
    type: 'bar',
    data: barData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// Config for Pie Chart
const pieConfig = {
    type: 'pie',
    data: pieData,
    options: {}
};

// Render Bar Graph
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, barConfig);

// Render Pie Chart
const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, pieConfig);
