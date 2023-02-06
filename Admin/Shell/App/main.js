import {start, registerApplication, navigateToUrl} from 'single-spa';
import { auth$ } from 'admin-shared';
import  axios  from 'axios';

let authenticated = false;

const apps = [
  {
    name: 'admin-navbar',
    app: () => System.import('admin-navbar'),
    activeWhen: (location) =>
        location.pathname.startsWith('/') && authenticated,
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
  },
]

Promise.all([
  System.import('pubsub-js'),
  System.import('snackbar'),

  axios
      .get("http://localhost:5007/token",{ withCredentials: true })
      .then((response) => {
        if (response.data.token !== ''){
          authenticated = response.data.token;
          auth$.next({
            sessionToken: response.data.token,
            error: false,
          });
        }
      })
      .catch((err) => console.log(err))

]).then(() => {

  apps.forEach(app =>  registerApplication(app) );


  auth$.subscribe(({ sessionToken }) => {
    authenticated = !!sessionToken;
    if (!authenticated)
      window.location.href = 'http://localhost:5007/auth';
    if (authenticated )
      navigateToUrl("/");
  });

  start();
});
