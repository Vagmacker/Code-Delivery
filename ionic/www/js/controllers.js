angular.module('starter.controllers', [])
    .controller('loginController', ['$scope', 'OAuth', '$state', '$ionicPopup', function ($scope, OAuth, $state, $ionicPopup) {

        $scope.user = {
            username:'',
            password: ''
        };

        $scope.login = function () {
            OAuth.getAccessToken($scope.user).then(function (data) {
                    $state.go('client.checkout');
                },
                function (responseError) {
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login ou senha invalidos'
                    })
                });
        }
    }])
    .controller('ClientCheckoutController', function($scope, $state, $cart, Order, $ionicLoading, $ionicPopup, Cupom, $cordovaBarcodeScanner){
        var cart = $cart.get();
        $scope.cupom = cart.cupom;
        $scope.items = cart.items;
        $scope.total = $cart.getTotalFinal();
        $scope.removeItem = function (i) {
            $cart.removeItem(i);
            $scope.items.splice(i,1);
            $scope.total = $cart.getTotalFinal();
        };
        
        $scope.openProductDetail = function (i) {
            $state.go('client.checkout_detail', {index: i});
        };
        
        $scope.openListProducts = function () {
            $state.go('client.view_products');
        };

        $scope.save = function () {

            var o = {items: angular.copy($scope.items)};

            angular.forEach(o.items, function (item) {
               item.produto_id = item.id;
            });

            if($scope.cupom.value){
                o.cupom_code = $scope.cupom.code;
            }

            $ionicLoading.show({
                template: 'Carregando...'
            });

            Order.save({id: null}, o, function (data) {
               $ionicLoading.hide();
               $state.go('client.checkout_successful');
            }, function (responseError) {
                $ionicLoading.hide();
                $ionicPopup.alert({
                    title: 'Advertência',
                    template: 'Pedido não realizado<br>Tente novamente !'
                })
            });
        };

        $scope.readBarCode = function () {
            $cordovaBarcodeScanner.scan().then(function(barcodeData) {
                    getValueCupom(barcodeData.text);
                }, function(error) {
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Não foi possivel ler o cupom!<br> Tente novamente!'
                    });
                });
        };

        $scope.removeCupom = function () {
            $cart.removeCupom();
            $scope.cupom = $cart.get().cupom;
            $scope.total = $cart.getTotalFinal();
        };

        function getValueCupom(code) {
            $ionicLoading.show({
                template: 'Carregando ...'
            });
            
            Cupom.get({code: code}, function (data) {

                var cupomCode = data.data.code, cupomValue = data.data.value;

                if(cupomValue > $scope.total) {
                    $cart.setCupom(cupomCode, cupomValue);
                    $scope.cupom = $cart.get().cupom;
                    $scope.total = $cart.getTotalFinal();
                    $ionicLoading.hide();
                } else {
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Para utilizar este cupom você precisa adicionar mais itens ao seu pedido!'
                    });
                }

            }, function (responseError) {
                $ionicLoading.hide();
                $ionicPopup.alert({
                    title: 'Advertência',
                    template: 'Cupom inválido'
                });
            });
        };
    })
    .controller('ClientCheckoutDetailController', function ($scope, $cart, $state, $stateParams) {

        $scope.product = $cart.getItem($stateParams.index);

        $scope.updateQtd = function () {
            $cart.updateQtd($stateParams.index, $scope.product.qtd);
            $state.go('client.checkout');
        };

        $scope.hide = function () {
            $state.go('client.checkout');
        };
    })
    .controller('ClientViewProductController', function ($scope, Product, $ionicLoading, $state, $cart) {
        $scope.products = [];

        $ionicLoading.show({
            template: 'Carregando...'
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
    })
    .controller('ClientCheckoutSuccessful', function ($scope, $cart, $state) {

        var cart = $cart.get();
        $scope.cupom = cart.cupom;
        $scope.items = cart.items;
        $scope.total = $cart.getTotalFinal();

        $cart.clear();

        $scope.openListOrder = function () {
            $state.go('client.my_orders');
        };
    })
    .controller('myOrdersController', function ($scope, Orders, $ionicLoading) {
        $scope.orders = [];
        $ionicLoading.show({
            template: 'Carregando...'
        });

        Orders.query({}, function (data) {
            $scope.orders = data.data;
            console.log(data.data);
            $ionicLoading.hide();
        }, function (dataError) {
            $ionicLoading.hide();
        });

    });