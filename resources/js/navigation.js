const navItems = document.querySelectorAll('.nav-item');
const triggerSublist = document.querySelectorAll('.trigger-sublist');
const subNavItems = document.querySelectorAll('.sub-nav-item');
const navSublist = document.querySelectorAll('.nav-sublist');
const minimizeBtn = document.querySelector('.minimize-btn');
const arrow = document.querySelectorAll('.arrow-icon');
const profileBtn = document.getElementById('profile-btn');
const profileMenu = document.getElementById('profile-menu');
const notifBtn = document.getElementById('notif-btn');
const notifMenu = document.getElementById('notif-menu');

// Fungsi pembantu untuk menutup semua sub-menu
function closeAllSublists() {
    navSublist.forEach(sublist => sublist.classList.remove('active'));
    arrow.forEach(icon => icon.classList.remove('rotate-180'))
}

// 1. Handle Toggle Dropdown / Sub-list
triggerSublist.forEach(trigger => {
    trigger.addEventListener('click', (e) => {
        // Mencegah bubbling jika trigger juga merupakan nav-item
        e.stopPropagation();

        const sublist = trigger.nextElementSibling;
        const arrow = trigger.querySelector('.arrow-icon');

        // Reset panah lain yang sedang terbuka
        document.querySelectorAll('.arrow-icon').forEach(icon => {
            if (icon !== arrow) icon.classList.remove('rotate-180');
        });

        // Toggle rotasi panah ini
        if (arrow) arrow.classList.toggle('rotate-180');

        // Catatan: Jika ingin menutup sublist lain saat 1 sublist dibuka, hilangkan komentar baris bawah:
        navSublist.forEach(s => s !== sublist && s.classList.remove('active'));

        if (sublist) {
            sublist.classList.toggle('active');
        }
    });
});

// 2. Handle State Active (Highlight Menu yang Diklik)
navItems.forEach(item => {
    item.addEventListener('click', () => {
        // Reset state active dari item lain
        navItems.forEach(nav => nav.classList.remove('active'));
        subNavItems.forEach(sub => sub.classList.remove('active'));

        // Jika menu yang diklik BUKAN trigger dropdown, tutup semua sublist yang sedang terbuka
        if (!item.classList.contains('trigger-sublist')) {
            closeAllSublists();
        }

        item.classList.add('active');
    });
});

// 3. Handle State Active khusus Sub-item
subNavItems.forEach(subItem => {
    subItem.addEventListener('click', (e) => {
        e.stopPropagation(); // Biar tidak bentrok dengan event parent navItem

        subNavItems.forEach(sub => sub.classList.remove('active'));
        navItems.forEach(nav => nav.classList.remove('active'));

        subItem.classList.add('active');
    });
});

// 4. Handle Minimized Button Sidebar
minimizeBtn.addEventListener('click', () => {
    const sidebar = document.querySelector('.container-sidebar');
    const textNavs = document.querySelectorAll('.text-nav');
    const subNavItems = document.querySelectorAll('.sub-nav-item');
    const formSearch = document.querySelector('.form-search');

    sidebar.classList.toggle('minimized');
    textNavs.forEach(textNav => textNav.classList.toggle('minimized'));
    subNavItems.forEach(subNav => subNav.classList.toggle('minimized'));
});

// 5. Handle Profile Menu
profileBtn.addEventListener('click', (e) => {
    e.stopPropagation();

    const isHidden = profileMenu.classList.contains('hidden');

    if (isHidden) {
        // 1. Tampilkan elemen dari display none
        profileMenu.classList.remove('hidden');
        profileMenu.classList.add('block');

        // 2. Beri jeda 1 frame agar browser sempat render 'hidden', baru jalankan animasi
        requestAnimationFrame(() => {
            profileMenu.classList.remove('opacity-0', '-translate-y-2');
            profileMenu.classList.add('opacity-100', 'translate-y-0');
        });
    } else {
        // 1. Jalankan animasi hilang terlebih dahulu
        profileMenu.classList.remove('opacity-100', 'translate-y-0');
        profileMenu.classList.add('opacity-0', '-translate-y-2');

        // 2. Sembunyikan elemen setelah durasi animasi (200ms) selesai
        setTimeout(() => {
            profileMenu.classList.remove('block');
            profileMenu.classList.add('hidden');
        }, 200);
    }
});
// Tutup menu otomatis jika user mengklik area di luar dropdown
document.addEventListener('click', (e) => {
    if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
        if (!profileMenu.classList.contains('hidden')) {
            profileMenu.classList.remove('opacity-100', 'translate-y-0');
            profileMenu.classList.add('opacity-0', '-translate-y-2');
            setTimeout(() => {
                profileMenu.classList.add('hidden');
            }, 200);
        }
    }
});

// 5. Handle Notif Menu
notifBtn.addEventListener('click', (e) => {
    e.stopPropagation();

    const isHidden = notifMenu.classList.contains('hidden');

    if (isHidden) {
        // 1. Tampilkan elemen dari display none
        notifMenu.classList.remove('hidden');

        // 2. Beri jeda 1 frame agar browser sempat render 'hidden', baru jalankan animasi
        requestAnimationFrame(() => {
            notifMenu.classList.remove('opacity-0', '-translate-y-2');
            notifMenu.classList.add('opacity-100', 'translate-y-0');
        });
    } else {
        // 1. Jalankan animasi hilang terlebih dahulu
        notifMenu.classList.remove('opacity-100', 'translate-y-0');
        notifMenu.classList.add('opacity-0', '-translate-y-2');

        // 2. Sembunyikan elemen setelah durasi animasi (200ms) selesai
        setTimeout(() => {
            notifMenu.classList.add('hidden');
        }, 200);
    }
});
// Tutup menu otomatis jika user mengklik area di luar dropdown
document.addEventListener('click', (e) => {
    if (!notifMenu.contains(e.target) && !notifBtn.contains(e.target)) {
        if (!notifMenu.classList.contains('hidden')) {
            notifMenu.classList.remove('opacity-100', 'translate-y-0');
            notifMenu.classList.add('opacity-0', '-translate-y-2');
            setTimeout(() => {
                notifMenu.classList.add('hidden');
            }, 200);
        }
    }
});
