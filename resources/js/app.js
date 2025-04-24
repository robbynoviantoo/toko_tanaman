import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById('theme-toggle');
    const icon = document.getElementById('theme-icon');
    const root = document.documentElement;

    // Set awal berdasarkan localStorage
    if (localStorage.getItem('theme') === 'dark') {
        root.classList.add('dark');
        icon.textContent = '🌙';
    } else {
        root.classList.remove('dark');
        icon.textContent = '🌞';
    }

    toggle.addEventListener('click', function () {
        root.classList.toggle('dark');
        if (root.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            icon.textContent = '🌙';
        } else {
            localStorage.setItem('theme', 'light');
            icon.textContent = '🌞';
        }
    });
});