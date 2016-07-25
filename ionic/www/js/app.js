// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'angular-oauth2', 'ngResource','starter.controllers', 'starter.services'])

.constant('appConfig', {
  baserUrl: 'http://localhost:8000'
})

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})
.config(function ($stateProvider, $urlRouterProvider,OAuthProvider, OAuthTokenProvider, appConfig) {

  OAuthProvider.configure({
    baseUrl: appConfig.baserUrl,
    clientId: 'appid01',
    clientSecret: 'secret', // optional
    grantPath: '/oauth/access_token'
  });

  OAuthTokenProvider.configure({
    name: 'token',
    options: {
      secure: false
    }
  });

  $stateProvider

    .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'loginController'
    })

    .state('home', {
      url: '/home',
      templateUrl: 'templates/home.html',
      controller: function ($scope, $http) {
        $http.get('http://localhost:8000/api/authenticated').then(function (data) {
          $scope.user = data.data;
        });
      }
    })
    .state('client', {
      abstract: true,
      url: '/client',
      template: '<ion-nav-view/>'
    })
    .state('client.checkout', {
      cache: false,
      url: '/checkout',
      templateUrl: 'templates/client/checkout.html',
      controller: 'ClientCheckoutController'
    })
    .state('client.checkout_detail', {
      cache: false,
      url: '/checkout/detail/:index',
      templateUrl: 'templates/client/checkout_detail.html',
      controller: 'ClientCheckoutDetailController'
    })
    .state('client.view_products', {
      url: '/view_products',
      templateUrl: 'templates/client/view_products.html',
      controller: 'ClientViewProductController'
    })
    .state('client.checkout_successful', {
      url:'/checkout/successful',
      templateUrl: 'templates/client/checkout_successful.html',
      controller: 'ClientCheckoutSuccessful'
    })
    .state('client.my_orders', {
      url:'/my_orders',
      templateUrl: 'templates/client/my_orders.html',
      controller: 'myOrdersController'
    });

  $urlRouterProvider.otherwise('/login');
});
