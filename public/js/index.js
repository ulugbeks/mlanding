
document.addEventListener('DOMContentLoaded', () => {
    const shell = document.querySelector('.reviews__shell');
    const track = shell.querySelector('.reviews__track');
    const prevBtn = shell.querySelector('.reviews__btn--prev');
    const nextBtn = shell.querySelector('.reviews__btn--next');
    const viewport = shell.querySelector('.reviews__viewport');

    const GAP = 24;
    const cardSize = () => track.querySelector('.review').getBoundingClientRect().width + GAP;

    let locked = false;
    const goNext = () => {
        if (locked) return; locked = true;
        track.style.transition = 'transform .45s ease';
        track.style.transform = `translateX(-${cardSize()}px)`;
        track.addEventListener('transitionend', () => {
            track.append(track.firstElementChild);
            track.style.transition = 'none';
            track.style.transform = 'translateX(0)';
            requestAnimationFrame(() => locked = false);
        }, { once: true });
    };
    const goPrev = () => {
        if (locked) return; locked = true;
        track.style.transition = 'none';
        track.prepend(track.lastElementChild);
        track.style.transform = `translateX(-${cardSize()}px)`;
        requestAnimationFrame(() => {
            track.style.transition = 'transform .45s ease';
            track.style.transform = 'translateX(0)';
            track.addEventListener('transitionend', () => locked = false, { once: true });
        });
    };

    // клики по стрелкам
    nextBtn.setAttribute('type', 'button');
    prevBtn.setAttribute('type', 'button');
    nextBtn.addEventListener('click', goNext);
    prevBtn.addEventListener('click', goPrev);

    // свайп — только в области слайдов, и не трогаем, если жмём по кнопке
    let startX = 0, dx = 0, active = false;
    viewport.addEventListener('pointerdown', e => {
        if (e.target.closest('.reviews__btn')) return; // не перехватываем клики по кнопкам
        active = true; startX = e.clientX; dx = 0;
    });
    viewport.addEventListener('pointermove', e => {
        if (!active) return;
        dx = e.clientX - startX;
    });
    viewport.addEventListener('pointerup', () => {
        if (!active) return; active = false;
        if (Math.abs(dx) > 40) (dx < 0 ? goNext : goPrev)();
    });

    // сброс смещений при ресайзе
    new ResizeObserver(() => {
        track.style.transition = 'none';
        track.style.transform = 'translateX(0)';
    }).observe(viewport);
});