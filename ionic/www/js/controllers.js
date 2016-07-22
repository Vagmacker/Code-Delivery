angular.module('starter.controllers', [])
    .controller('loginController', ['$scope', 'OAuth', '$state', '$ionicPopup', function ($scope, OAuth, $state, $ionicPopup) {

        $scope.user = {
            username:'',
            password: ''
        };

        $scope.login = function () {
            OAuth.getAccessToken($scope.user).then(function (data) {
                    console.log(data);
                    $state.go('home');
                },
                function (responseError) {
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login ou senha invalidos'
                    })
                });
        }
    }])
    .controller('ClientCheckoutController', function($scope, $state, $cart){
        var cart = $cart.get();
        $scope.items = cart.items;
        $scope.total = cart.total;
    })
    .controller('ClientCheckoutDetailController', function ($scope) {
        
    })
    .controller('ClientViewProductController', function ($scope, Product, $ionicLoading, $state, $cart) {
        $scope.products = [];

        $ionicLoading.show({
            template: 'Carregando ...'
        });

       Product.query({}, function (data) {
           $scope.products = data.data;
           $ionicLoading.hide();
       }, function (dataError) {
           $ionicLoading.hide();
       });

        $scope.addItem = function (item) {
            item.qtd = 1;
            $cart.addItem(item);
            $state.go('client.checkout');
        };
    });