import Chart from '/chart.js/chart.js';
export function makeChart(DOM) {
  const labels = [
    '08:00',
    '09:00',
    '10:00',
    '11:00',
    '12:00',
    'now',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'Temp',
      fill: true,
      backgroundColor: 'rgba(252, 37, 37, .2)',
      borderColor: '#FC2525',
      data: [12, 13, 15, 16, 20, 21, 22],
      tension: .4
    }]
  };

  Chart.defaults.borderColor = "rgba(255, 255, 255, .1)";

  const config = {
    type: 'line',
    data: data,
    options: {
      plugins: {
        legend: {
          display: false,
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      },
      grid: {
        drawBorder: false,
        drawOnChartArea: false
      },
      parsing: {
        xAxisKey: 'hours',
        yAxisKey: 'temp'
      }
    }
  };

  let myChart = new Chart(DOM, config);
}