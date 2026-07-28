import './bootstrap';

const root = document.documentElement;
const themeButton = document.querySelector('#theme-toggle');
const menuButton = document.querySelector('#menu-toggle');
const mobileMenu = document.querySelector('#mobile-menu');
const header = document.querySelector('#header');

themeButton?.addEventListener('click', () => {
    const dark = !root.classList.contains('dark');
    root.classList.toggle('dark', dark);
    root.style.colorScheme = dark ? 'dark' : 'light';
    localStorage.setItem('fz-theme', dark ? 'dark' : 'light');
});

menuButton?.addEventListener('click', () => {
    const open = mobileMenu.classList.toggle('hidden') === false;
    menuButton.setAttribute('aria-expanded', String(open));
});

mobileMenu?.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
    mobileMenu.classList.add('hidden');
    menuButton?.setAttribute('aria-expanded', 'false');
}));

const links = [...document.querySelectorAll('.nav-link')];
const observer = new IntersectionObserver(entries => {
    entries.filter(entry => entry.isIntersecting).forEach(entry => {
        links.forEach(link => link.classList.toggle('active', link.hash === `#${entry.target.id}`));
    });
}, { rootMargin: '-30% 0px -60% 0px' });

document.querySelectorAll('main section[id]').forEach(section => observer.observe(section));
addEventListener('scroll', () => header?.classList.toggle('scrolled', scrollY > 8), { passive: true });
