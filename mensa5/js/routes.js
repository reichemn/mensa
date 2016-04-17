angular.module('app.routes', [])

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider
    
  

      .state('foodsaver', {
    url: '/page1',
    templateUrl: 'templates/foodsaver.php',
    controller: 'foodsaverCtrl'
  })

  .state('bewertung', {
    url: '/page2',
    templateUrl: 'templates/bewertung.php',
    controller: 'bewertungCtrl'
  })

  .state('bewertung2', {
    url: '/page4',
    templateUrl: 'templates/bewertung2.php',
    controller: 'bewertung2Ctrl'
  })

  .state('bewertung3', {
    url: '/page5',
    templateUrl: 'templates/bewertung3.php',
    controller: 'bewertung3Ctrl'
  })

  .state('danke', {
    url: '/page3',
    templateUrl: 'templates/danke.html',
    controller: 'dankeCtrl'
  })

$urlRouterProvider.otherwise('/page1')

  

});