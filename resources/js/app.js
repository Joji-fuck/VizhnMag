import './bootstrap';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', function () {
    const teamItems = document.querySelectorAll('.team-item');
    const previewImg = document.getElementById('preview-img');
    const previewText = document.getElementById('preview-text');
    const burger = document.getElementById('burger');
    const navLinks = document.getElementById('nav-links');

    function updatePreview(item) {
        if (!previewImg || !previewText) return;

        teamItems.forEach(el => el.classList.remove('active'));
        item.classList.add('active');

        const newImage = item.getAttribute('data-image');
        const newDetails = item.getAttribute('data-details');

        if (!newImage) return;

        if (!previewImg.src.includes(newImage)) {
            previewImg.style.opacity = 0;
            previewText.style.opacity = 0;

            setTimeout(() => {
                previewImg.src = newImage;
                previewText.innerHTML = newDetails || '';
                previewImg.style.opacity = 1;
                previewText.style.opacity = 1;
            }, 150);
        }
    }

    if (teamItems.length && previewImg && previewText) {
        teamItems.forEach(item => {
            item.addEventListener('mouseenter', function () {
                updatePreview(this);
            });

            item.addEventListener('click', function () {
                updatePreview(this);
            });
        });
    }

    if (burger && navLinks) {
        burger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            burger.classList.toggle('active');
        });

        const links = navLinks.querySelectorAll('li a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                burger.classList.remove('active');
            });
        });
    }
});
