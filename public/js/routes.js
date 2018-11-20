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
    name: 'User Logout',
  },

  // User Dashboard
  {
    path: '/dashboard/',
    url: '/dashboard',
    name: 'User Dashboard',
  },

  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.html',
  },
];
