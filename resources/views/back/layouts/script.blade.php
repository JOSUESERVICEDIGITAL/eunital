<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const body = document.body;

        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainArea = document.querySelector('.main-area');

        const mobileSearchToggle = document.getElementById('mobileSearchToggle');
        const mobileSearchPanel = document.getElementById('mobileSearchPanel');
        const mobileSearchClose = document.getElementById('mobileSearchClose');

        const themeToggle = document.getElementById('themeToggle');
        const themeToggleIcon = document.getElementById('themeToggleIcon');
        const themeToggleMobile = document.getElementById('themeToggleMobile');
        const themeToggleMobileIcon = document.getElementById('themeToggleMobileIcon');

        const statutSelect = document.getElementById('statutSelect');

        const MOBILE_BREAKPOINT = 992;
        const SIDEBAR_POPUP_ID = 'sidebarFloatingPopup';

        const isMobile = () => window.innerWidth < MOBILE_BREAKPOINT;
        const isSidebarCollapsed = () => !!sidebar?.classList.contains('collapsed') && !isMobile();

        function getFloatingPopup() {
            return document.getElementById(SIDEBAR_POPUP_ID);
        }

        function removeFloatingPopup() {
            const popup = getFloatingPopup();
            if (popup) popup.remove();

            if (!sidebar) return;
            sidebar.querySelectorAll('.menu-toggle-btn, .submenu-toggle-btn').forEach(btn => {
                btn.classList.remove('popup-open');
            });
        }

        function openFloatingPopup(button, target) {
            if (!button || !target) return;

            removeFloatingPopup();
            button.classList.add('popup-open');

            const popup = document.createElement('div');
            popup.id = SIDEBAR_POPUP_ID;
            popup.className = 'sidebar-floating-popup';

            /* HEADER avec bouton fermer */
            const header = document.createElement('div');
            header.className = 'sidebar-popup-header';

            const title = document.createElement('span');
            title.className = 'sidebar-popup-title';
            title.textContent = button.querySelector('.menu-text')?.textContent || 'Menu';

            const closeBtn = document.createElement('button');
            closeBtn.className = 'sidebar-popup-close';
            closeBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';

            closeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                removeFloatingPopup();
            });
            popup.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            popup.addEventListener('wheel', (e) => {
                e.stopPropagation();
            }, {
                passive: true
            });

            header.appendChild(title);
            header.appendChild(closeBtn);

            /* CONTENT */
            const content = target.cloneNode(true);
            content.classList.remove('show');
            content.classList.add('sidebar-popup-content');

            /* ASSEMBLY */
            popup.appendChild(header);
            popup.appendChild(content);
            document.body.appendChild(popup);

            const rect = button.getBoundingClientRect();
            const popupWidth = 300;
            const gap = 12;

            let left = rect.right + gap;
            let top = rect.top;

            popup.style.visibility = 'hidden';
            popup.style.display = 'block';

            const popupRect = popup.getBoundingClientRect();

            if (left + popupWidth > window.innerWidth - 12) {
                left = window.innerWidth - popupWidth - 12;
            }

            if (top + popupRect.height > window.innerHeight - 12) {
                top = Math.max(12, window.innerHeight - popupRect.height - 12);
            }

            popup.style.left = `${left}px`;
            popup.style.top = `${top}px`;
            popup.style.visibility = 'visible';

            bindPopupNestedDropdowns(popup);
        }

        function bindPopupNestedDropdowns(container) {
            const nestedButtons = container.querySelectorAll('.submenu-toggle-btn');

            nestedButtons.forEach(button => {
                const selector = button.getAttribute('data-target');
                if (!selector) return;

                const id = selector.startsWith('#') ? selector.slice(1) : selector;
                const target = container.querySelector(`#${CSS.escape(id)}`);
                if (!target) return;

                const shouldBeOpen = button.getAttribute('aria-expanded') === 'true';
                target.classList.toggle('show', shouldBeOpen);

                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    const isOpen = target.classList.contains('show');
                    target.classList.toggle('show', !isOpen);
                    button.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
                });
            });
        }

        function openMobileSidebar() {
            if (!sidebar) return;
            sidebar.classList.add('mobile-open');
            sidebarOverlay?.classList.add('show');
            body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            if (!sidebar) return;
            sidebar.classList.remove('mobile-open');
            sidebarOverlay?.classList.remove('show');
            body.style.overflow = '';
        }

        function toggleDesktopSidebar() {
            if (!sidebar) return;
            sidebar.classList.toggle('collapsed');
            mainArea?.classList.toggle('expanded');
            removeFloatingPopup();
        }

        function closeMobileSearch() {
            mobileSearchPanel?.classList.remove('show');
        }

        function toggleMobileSearch() {
            mobileSearchPanel?.classList.toggle('show');
        }

        function closeAllTopbarDropdowns() {
            document.querySelectorAll('.topbar-popup').forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }

        function applyTheme(theme) {
            const isDark = theme === 'dark';
            body.classList.toggle('dark-mode', isDark);

            if (themeToggleIcon) {
                themeToggleIcon.classList.toggle('fa-moon', !isDark);
                themeToggleIcon.classList.toggle('fa-sun', isDark);
            }

            if (themeToggleMobileIcon) {
                themeToggleMobileIcon.classList.toggle('fa-moon', !isDark);
                themeToggleMobileIcon.classList.toggle('fa-sun', isDark);
            }
        }

        function toggleTheme() {
            const newTheme = body.classList.contains('dark-mode') ? 'light' : 'dark';
            localStorage.setItem('eunital-theme', newTheme);
            applyTheme(newTheme);
        }

        function updateStatutColor() {
            if (!statutSelect) return;
            statutSelect.classList.remove('en_attente', 'valide', 'termine', 'abandonne');
            if (statutSelect.value) {
                statutSelect.classList.add(statutSelect.value);
            }
        }

        sidebarToggle?.addEventListener('click', () => {
            if (isMobile()) {
                sidebar?.classList.contains('mobile-open') ? closeMobileSidebar() : openMobileSidebar();
            } else {
                toggleDesktopSidebar();
            }
        });

        sidebarCollapseBtn?.addEventListener('click', () => {
            if (!isMobile()) {
                toggleDesktopSidebar();
            }
        });

        sidebarOverlay?.addEventListener('click', closeMobileSidebar);

        if (sidebar) {
            const sidebarButtons = sidebar.querySelectorAll('.menu-toggle-btn, .submenu-toggle-btn');

            const getTarget = (button) => {
                const selector = button.getAttribute('data-target');
                return selector ? document.querySelector(selector) : null;
            };

            const setExpanded = (button, isOpen) => {
                button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            };

            const openMenu = (button, target) => {
                target.classList.add('show');
                setExpanded(button, true);
            };

            const closeMenu = (button, target) => {
                target.classList.remove('show');
                setExpanded(button, false);
            };

            const toggleMenu = (button, target) => {
                target.classList.contains('show') ?
                    closeMenu(button, target) :
                    openMenu(button, target);
            };

            sidebarButtons.forEach(button => {
                const target = getTarget(button);
                if (!target) return;

                const initiallyOpen = button.getAttribute('aria-expanded') === 'true';
                target.classList.toggle('show', initiallyOpen);
                setExpanded(button, initiallyOpen);

                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    if (isSidebarCollapsed()) {
                        const currentPopup = getFloatingPopup();
                        const isSameButtonOpen = button.classList.contains('popup-open') &&
                            currentPopup;

                        if (isSameButtonOpen) {
                            removeFloatingPopup();
                        } else {
                            openFloatingPopup(button, target);
                        }
                        return;
                    }

                    removeFloatingPopup();
                    toggleMenu(button, target);
                });
            });
        }

        mobileSearchToggle?.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMobileSearch();
        });

        mobileSearchClose?.addEventListener('click', closeMobileSearch);

        document.querySelectorAll('.topbar-dropdown-toggle').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();

                const dropdownName = button.dataset.dropdown;
                const target = document.getElementById(`dropdown-${dropdownName}`);
                if (!target) return;

                const isOpen = target.classList.contains('show');
                closeAllTopbarDropdowns();

                if (!isOpen) {
                    target.classList.add('show');
                }
            });
        });

        document.querySelectorAll('.topbar-popup').forEach(dropdown => {
            dropdown.addEventListener('click', (e) => e.stopPropagation());
        });

        applyTheme(localStorage.getItem('eunital-theme') || 'light');

        themeToggle?.addEventListener('click', toggleTheme);
        themeToggleMobile?.addEventListener('click', () => {
            toggleTheme();
            closeAllTopbarDropdowns();
        });

        if (statutSelect) {
            updateStatutColor();
            statutSelect.addEventListener('change', updateStatutColor);
        }

        document.addEventListener('click', (e) => {
            const floatingPopup = getFloatingPopup();

            if (floatingPopup) {
                const clickedInsidePopup = floatingPopup.contains(e.target);
                const clickedSidebarBtn =
                    e.target.closest('.menu-toggle-btn') ||
                    e.target.closest('.submenu-toggle-btn');

                if (!clickedInsidePopup && !clickedSidebarBtn) {
                    removeFloatingPopup();
                }
            }

            if (
                mobileSearchPanel &&
                !mobileSearchPanel.contains(e.target) &&
                !mobileSearchToggle?.contains(e.target)
            ) {
                closeMobileSearch();
            }

            closeAllTopbarDropdowns();
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                removeFloatingPopup();
                closeAllTopbarDropdowns();
                closeMobileSidebar();
                closeMobileSearch();
            }
        });

        window.addEventListener('resize', () => {
            removeFloatingPopup();

            if (!isMobile()) {
                closeMobileSidebar();
                closeMobileSearch();
            } else {
                sidebar?.classList.remove('collapsed');
                mainArea?.classList.remove('expanded');
            }
        });

        window.addEventListener('scroll', (e) => {
            const popup = getFloatingPopup();
            if (!popup) return;

            if (popup.contains(e.target)) return;
            removeFloatingPopup();
        }, true);

        const brandToggle = document.getElementById('brandToggle');

        brandToggle?.addEventListener('click', () => {
            if (isMobile()) {
                sidebar?.classList.contains('mobile-open') ?
                    closeMobileSidebar() :
                    openMobileSidebar();
            } else {
                toggleDesktopSidebar();
            }
        });

    });
</script>
