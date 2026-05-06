        </main>
    </div>
    <div style="position: fixed; bottom: 10px; right: 20px; font-size: 11px; color: #999;">
        ver 5.2.6
    </div>

    <script>
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const adminSidebar = document.querySelector('.admin-sidebar');
        if(sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                adminSidebar.classList.toggle('active');
            });
        }

        // Manage Blog Dropdown Toggle
        const manageBlogToggle = document.getElementById('manageBlogToggle');
        const blogSubmenu = document.getElementById('blogSubmenu');
        if(manageBlogToggle) {
            manageBlogToggle.addEventListener('click', (e) => {
                e.preventDefault();
                blogSubmenu.style.display = blogSubmenu.style.display === 'none' ? 'block' : 'none';
            });
        }

        // Generic Dropdown Handler
        document.addEventListener('click', (e) => {
            const dropdowns = ['gridMenu', 'profileMenu'];
            const toggles = ['gridMenuToggle', 'profileMenuToggle'];

            dropdowns.forEach((id, index) => {
                const menu = document.getElementById(id);
                const toggle = document.getElementById(toggles[index]);
                
                if (toggle && toggle.contains(e.target)) {
                    menu.classList.toggle('active');
                } else if (menu && !menu.contains(e.target)) {
                    menu.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
