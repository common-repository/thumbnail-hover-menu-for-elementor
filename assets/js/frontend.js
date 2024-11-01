window.addEventListener('load', () => {
    const menu = document.querySelectorAll('.thmfe-menu');

    if (typeof menu === 'undefined' || menu.length === 0) {
        return;
    }

    menu.forEach((e) => {
        e.addEventListener('mousemove', (e) => {
            let x = e.clientX,
                y = e.clientY;

            e.target.closest('.thmfe-container').querySelector('.thmfe-cursor_inner').style.transform = `translate3d(${x}px, ${y}px, 0)`;
        });
    });

    document.addEventListener('mouseover', (e) => {
        let trigger = e.target.getAttribute('data-thmfe-cursor-trigger-id');

        if (!trigger || !e.target.classList.contains('thmfe-cursor_trigger')) {
            return document.querySelectorAll('.thmfe-cursor_list').forEach((e) => {
                e.classList.remove('thmfe-is-active');
            });
        }

        const container = e.target.closest('.thmfe-container');

        container.querySelectorAll('.thmfe-cursor_item').forEach((e) => {
            e.getAttribute('data-thmfe-cursor-item-id') === trigger ? e.classList.add('thmfe-is-active') : e.classList.remove('thmfe-is-active');
        }),
            container.querySelector('.thmfe-cursor_list').classList.add('thmfe-is-active');
    });

    document.addEventListener('scroll', () => {
        document.querySelectorAll('.thmfe-cursor_list').forEach((e) => {
            e.classList.remove('thmfe-is-active');
        });
    });
});