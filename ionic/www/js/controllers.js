angular.module('starter.controllers', [])
    .controller('loginController', ['$scope', 'OAuth', 'OAuthToken', '$state', '$ionicPopup', 'UserData', 'User', function ($scope, OAuth, OAuthToken, $state, $ionicPopup, UserData, User){

        $scope.user = {
            username:'',
            password: ''
        };

        $scope.login = function () {
            var promise = OAuth.getAccessToken($scope.user);

            promise
                .then(function (data) {
                    return User.authenticated({include: 'clientes'}).$promise;
                })
                .then(function (data) {
                    UserData.set(data.data);
                    $state.go('client.checkout');
                }, function (responseError) {
                    UserData.set(null);
                    OAuthToken.removeToken();
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login ou senha inválidos'
                    });
                    console.debug(responseError);
                });
        };
    }])
    .controller('ClientMenuController', function ($state, $scope, UserData) {
        $scope.user = UserData.get();

        $scope.logout = function () {
            $state.go('login');
        }
    })
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
    .controller('myOrdersController', function ($scope, Orders, $ionicLoading, $ionicActionSheet) {
        $scope.orders = [];
        $ionicLoading.show({
            template: 'Carregando...'
        });

        $scope.doRefresh = function () {
            getOrders().then(function (data) {
                $scope.orders = data.data;
                $scope.$broadcast('scroll.refreshComplete');
            }, function (dataError) {
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.showActionSheet = function (order) {
            $ionicActionSheet.show({
                buttons: [
                    {text: 'Ver Detalhes'},
                    {text: 'Ver Entrega'}
                ],
                titleText: 'O que fazer ?',
                cancelText: 'Cancelar',

                cancel: function () {
                    //Cancelamento
                },
                buttonClicked: function (index) {
                    switch (index){
                        case 0:
                            $state.go('client.my_orders', {id: order.id});
                            break;
                        case 1: $state.go('client.view_delivery', {id: order.id});
                            break;
                    }
                }

            });
        };

        function getOrders() {
            return Orders.query({
                orderBy: 'created_at',
                sortedBy: 'desc'
            }).$promise;
        };

        getOrders().then(function (data) {
            $scope.orders = data.data;
            $ionicLoading.hide();
        }, function (dataError) {
            $ionicLoading.hide();
        });

    })
    .controller('ViewDeliveryController', function () {

    })
    .controller('DeliverymanMenuController', function ($state, $scope, $ionicLoading, UserData) {
        $scope.user = UserData.get();

        $scope.logout = function () {
            $state.go('login');
        }
    })
    .controller('DeliverymanOrderController', function ($scope, $state, $ionicLoading, DeliverymanOrder) {
        $scope.orders = [];
        $ionicLoading.show({
            template: 'Carregando...'
        });

        $scope.doRefresh = function () {
            getOrders().then(function (data) {
                $scope.orders = data.data;
                $scope.$broadcast('scroll.refreshComplete');
            }, function (dataError) {
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.openOrderDetail = function (order) {
          $state.go('deliveryman.view_order', {id:order.id})
        };


        function getOrders() {
            return DeliverymanOrder.query({
                orderBy: 'created_at',
                sortedBy: 'desc'
            }).$promise;
        };

        getOrders().then(function (data) {
            console.log(data.data);
            $scope.orders = data.data;
            $ionicLoading.hide();
        }, function (dataError) {
            $ionicLoading.hide();
        });
    })
    .controller('DeliverymanViewOrderController', function ($stateParams, $scope, DeliverymanOrder, $ionicLoading, $cordovaGeolocation, $ionicPopup) {
        var watch;

        $scope.orders = {};

        $ionicLoading.show({
           template: 'Carregando'
        });

        DeliverymanOrder.get({id: $stateParams.id, include: 'items, cupoms'}, function (data) {
            console.log(data.data);
            $scope.orders = data.data;
            $ionicLoading.hide();

        }, function (dataError) {
            $ionicLoading.hide();
        });

       $scope.goToDelivery = function () {

        $ionicPopup.alert({
            title: "Advertência",
            template: 'Para parar interromper a localização aperte ok'
        }).then(function () {
           stopWatchPosition();
        });

        DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 1}, function () {
           var  watchOptions = {
               timeout: 3000,
               enableHighAccuracy: false
           };

           watch = $cordovaGeolocation.watchPosition(watchOptions);

           watch.then(null, function (responseError) {
               //error
           }, function (position) {
                DeliverymanOrder.geo({id: $stateParams.id}, {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude

                });
           });
        });

       };

       function stopWatchPosition(){

           if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')) {
               $cordovaGeolocation.clearWatch(watch.watchId);

           }

       }
    });