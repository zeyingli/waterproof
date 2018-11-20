var routes = [
  // Login page
  {
    path: '/login',
    url: '/login',
    pageName: 'login',
  },

  // Logout page
  {
    path: '/logout',
    url: '/logout',
    pageName: 'logout',
  },

  // Register page
  {
    path: '/register',
    url: '/register',
  }

  // User Dashboard
  {
    path: '/dashboard/',
    url: '/dashboard',
    pageName: 'dashboard',
  },

  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.html',
  },
];
