// app.js
    // create angular app
    var SmartschoolAngCode = angular.module('SmartschoolAngCode', ['ui.bootstrap']);

    // create angular controller
    SmartschoolAngCode.controller('validationApp', function($scope) {

        // function to submit the form after all validation has occurred            
        $scope.submitForm = function(isValid) {
            // check to make sure the form is completely valid

        };

    });
   SmartschoolAngCode.controller('Collapse', function ($scope) {
  $scope.isCollapsed = true;
});
SmartschoolAngCode.controller('Datepicker', function ($scope) {
  $scope.today = function() {
    $scope.dt = new Date();
  };
  $scope.today();

  $scope.clear = function () {
    $scope.dt = null;
  };

  // Disable weekend selection

  $scope.toggleMax = function() {
    $scope.maxDate = $scope.maxDate ? null : new Date();
  };
  $scope.toggleMax();
  $scope.toggleMin = function() {
    $scope.minDate = $scope.minDate ? null : new Date();
  };
  $scope.toggleMin();
  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1
  };

  $scope.formats = ['MM/dd/yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];
});
