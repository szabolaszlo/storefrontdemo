import {
  start,
  registerApplication
} from 'single-spa';

const apps = [
  {
    name: 'app-one',
    app: () => System.import('app-one'),
    activeWhen: location => location.pathname.startsWith('/customers')
  },
  {
    name: '@newsletter/admin',
    app: () => System.import('@newsletter/admin'),
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
