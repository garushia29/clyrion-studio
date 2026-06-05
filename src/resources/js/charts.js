import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

export function createChart(canvas, config) {
    if (!canvas) return null;
    const existing = Chart.getChart(canvas);
    if (existing) existing.destroy();
    return new Chart(canvas, config);
}

export function lineChart(canvas, labels, datasets, options = {}) {
    return createChart(canvas, {
        type: 'line',
        data: { labels, datasets },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#9ca3af',
                        font: { family: 'Figtree, sans-serif' },
                    },
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                    titleColor: '#fff',
                    bodyColor: '#d1d5db',
                    borderColor: 'rgba(31, 41, 55, 1)',
                    borderWidth: 1,
                    padding: 10,
                },
            },
            scales: {
                x: {
                    ticks: { color: '#6b7280', font: { size: 11 } },
                    grid: { color: 'rgba(31, 41, 55, 0.5)' },
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6b7280', font: { size: 11 } },
                    grid: { color: 'rgba(31, 41, 55, 0.5)' },
                },
            },
            ...options,
        },
    });
}

export function barChart(canvas, labels, datasets, options = {}) {
    return createChart(canvas, {
        type: 'bar',
        data: { labels, datasets },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#9ca3af',
                        font: { family: 'Figtree, sans-serif' },
                    },
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.95)',
                    titleColor: '#fff',
                    bodyColor: '#d1d5db',
                    borderColor: 'rgba(31, 41, 55, 1)',
                    borderWidth: 1,
                    padding: 10,
                },
            },
            scales: {
                x: {
                    ticks: { color: '#6b7280', font: { size: 11 } },
                    grid: { display: false },
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#6b7280', font: { size: 11 } },
                    grid: { color: 'rgba(31, 41, 55, 0.5)' },
                },
            },
            ...options,
        },
    });
}
