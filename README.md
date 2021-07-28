# PHP Joke API Project
Developed By Matt Toner for E-Cigarette Direct on 28th July 2021 with a complete time of 2 hours.

This project was based on the interview process provided by Gary Bell from E-Cigarette Direct based in Swansea. The 
project was to create a PHP Back-End System that pulled in Jokes from 3 separate APIs that provided jokes for the user.

## Steps To Install & Setup using Symfony Server
* Pull or download the repository from Github.
* In the root directory run `composer install --dev` to install all the vendor libraries to run the application.
* For changes in CSS and JS, navigate to `public/assets` and run `npm install` to install all node modules to assist in 
  the compiling of the SASS and JS files for production purposes.
* In the root directory, run `symfony start:server` to run the application locally. For more information on Symfony 
  Server please visit https://symfony.com/doc/current/setup/symfony_server.html.

## Complete Jobs
* The engine requests jokes from the Chuck Norris and Joke API systems using Symfony and HTTP Client Requests.
* The number of jokes displayed will depend on the choice of the user (minimum of 1, and a maximum of 20 jokes).
* The Bootstrap Framework is used for the CSS side of design.
* jQuery is used as the JavaScript Framework.
* The interface is mobile friendly due to the Bootstrap Framework.

## Incomplete Jobs
* Adding integer labels to the bottom of the Input Range element. It's hard for the user to see what number they have 
  requested.
* Adding new jokes to the site. There was an API endpoint that could have been used to submit jokes on 
  https://sv443.net/jokeapi/v2/#submit-endpoint, and/or submitting data to a database could have been used.
* Incomplete styling of the front-end. I would have liked to have added more to the SASS stylesheet with custom style 
  classes, mixins and designs to give a better feel for the site. The current stylesheet (and JavaScript file) has been 
  compiled using Gulp.

### Hold Ups & Improvements
There were a few hold-ups carrying out this project such as designing the front-end of the site. The back-end 
development went quite well and the development of separate services helped manage the content from the API's.

To improve this, I would have used ReactJS or VueJS as the front-end framework to develop a PWA which would have worked 
faster for the end user. However, using the Symfony HTTP Client does get the data direct from the API asynchronously and 
does provide fast way of implementing the data.

### Development Time Needed
To complete this project by adding a new joke to the API would take an extra 15 minutes, and the same for submitting it 
to a database. 
