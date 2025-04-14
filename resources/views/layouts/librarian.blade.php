<!doctype html>
<html lang="en" data-bs-theme="light">
  <script>
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.setAttribute('data-bs-theme', 'dark');
    } else {
      document.documentElement.setAttribute('data-bs-theme', 'light');
    }
  </script>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>arsipin | admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/css/tabler.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" />
  </head>
  <body>
    <div>
      @include('partials.navbar')
    </div>
    <div>
      @include('partials.navmenu')
    </div>
    <div>
      @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.1.1/dist/js/tabler.min.js"></script>
    
    {{-- Dark mode toggle script --}}
    <script>
      const html = document.documentElement;
      const darkModeToggle = document.getElementById('darkModeToggle');
      const lightIcon = document.getElementById('lightIcon');
      const darkIcon = document.getElementById('darkIcon');

      // Check for saved theme preference
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme) {
        html.setAttribute('data-bs-theme', savedTheme);
        updateIcon(savedTheme);
      }

      darkModeToggle.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        html.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateIcon(newTheme);
      });

      function updateIcon(theme) {
        if (theme === 'dark') {
          lightIcon.style.display = 'none';
          darkIcon.style.display = 'inline';
        } else {
          lightIcon.style.display = 'inline';
          darkIcon.style.display = 'none';
        }
      }
    </script>
  </body>
</html>
