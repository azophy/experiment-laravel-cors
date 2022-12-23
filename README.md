Experiment with cookie storage accross different domains
========================================================

## How to use
1. start the local development server using `php artisan serve --host 0.0.0.0 --port 3000`. You should be able to access it locally from `http://localhost:3000`
2. To simulate cross-domain interaction, expose your local server using public reverse proxy service. My favorite is using [Localhost.run](https://localhost.run). Just run this ssh command locally, you should receive a temporary public url: `ssh -R 80:localhost:3000 nokey@localhost.run`
3. Open you localhost site, then enter you public url as base url input. Then try the 'Set cookies & Redirect' button. 

From my experience, Chrome has no trouble to set the cookies and retrieved later, while Firefox Privacy Protection prevent it.

![Web Screenshot](/docs/screenshot.png?raw=true "Screenshot of successful set cookie & redirect operation in Chrome Browser")
## Stack

- PHP 8.1 with [Laravel](https://laravel.com) Framework

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
