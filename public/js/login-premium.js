document.addEventListener('DOMContentLoaded', () => {
    const card = document.querySelector('.glass-card');
    const form = document.querySelector('form');
    const input = document.querySelector('.form-control-custom');
    const button = document.querySelector('.btn-premium');

    // Entrance animation
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';

    setTimeout(() => {
        card.style.transition = 'all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1)';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 100);

    // Subtle parallax effect on mouse move
    document.addEventListener('mousemove', (e) => {
        const xAxis = (window.innerWidth / 2 - e.pageX) / 50;
        const yAxis = (window.innerHeight / 2 - e.pageY) / 50;
        card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
    });

    // Reset card on mouse leave
    document.addEventListener('mouseleave', () => {
        card.style.transition = 'all 0.5s ease';
        card.style.transform = `rotateY(0deg) rotateX(0deg)`;
    });

    // Button loading state on submit
    form.addEventListener('submit', () => {
        button.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Verificando...';
        button.style.pointerEvents = 'none';
        button.style.opacity = '0.8';
    });

    // Focus glow effect
    input.addEventListener('focus', () => {
        card.style.borderColor = 'rgba(59, 130, 246, 0.5)';
        card.style.boxShadow = '0 0 30px rgba(59, 130, 246, 0.2)';
    });

    input.addEventListener('blur', () => {
        card.style.borderColor = 'rgba(255, 255, 255, 0.1)';
        card.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.5)';
    });
});
