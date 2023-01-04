import {start, registerApplication, navigateToUrl} from 'single-spa';
import { auth$ } from 'admin-auth';

let authenticated = false;

const ROUTES = {
  ROOT: '/',
  LOGIN: '/login',
};


const apps = [
  {
    name: 'admin-navbar',
    app: () => System.import('admin-navbar'),
    activeWhen: (location) =>
        location.pathname.startsWith('/') && authenticated,
  },
  {
    name: 'admin-login',
    app: () => System.import('admin-login'),
    activeWhen: (location) =>
        [ROUTES.ROOT, ROUTES.LOGIN].includes(location.pathname) && !authenticated,
  },
  {
    name: 'customer-admin',
    app: () => System.import('customer-admin'),
    activeWhen: location => location.pathname.startsWith('/customers') && authenticated,
  },
  {
    name: 'newsletter-admin',
    app: () => System.import('newsletter-admin'),
    activeWhen: location => location.pathname.startsWith('/subscribers') && authenticated,
  }
]

Promise.all([
  System.import('pubsub-js'),
  System.import('snackbar'),
]).then(() => {
  apps.forEach(app =>  registerApplication(app) );

  auth$.subscribe(({ sessionToken }) => {
    authenticated = !!sessionToken;
    if (!authenticated && window.location.pathname !== ROUTES.LOGIN)
      navigateToUrl(ROUTES.LOGIN);
    if (authenticated && window.location.pathname === ROUTES.LOGIN)
      navigateToUrl(ROUTES.ROOT);
  });

  start();
});
