import {
  start,
  registerApplication
} from 'single-spa';

const apps = [
  {
    name: 'customer-admin',
    app: () => System.import('customer-admin'),
    activeWhen: location => location.pathname.startsWith('/customers')
  },
  {
    name: 'newsletter-admin',
    app: () => System.import('newsletter-admin'),
    activeWhen: location => location.pathname.startsWith('/subscribers')
  }
]

Promise.all([
  System.import('pubsub-js'),
  System.import('snackbar')
]).then(() => {
  apps.forEach(app =>  registerApplication(app) );
  start();
});
