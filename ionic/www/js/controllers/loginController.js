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
    }]);