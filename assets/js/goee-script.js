(function ($) {
    "use strict";

    var editMode = false;
    //alert script starts
    var exclusiveAlert = function ($scope, $) {
        var alertClose = $scope.find('[data-alert]').eq(0);
        alertClose.each(function (index) {
            var alert = $(this);
            alert.find('.goee-alert-element-dismiss-icon').click(function (e) {
                e.preventDefault();
                alert.fadeOut(500);
            });
            alert.find('.goee-alert-element-dismiss-button').click(function (e) {
                e.preventDefault();
                alert.fadeOut(500);
            });
        });
    }

    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            editMode = true;
        }

        elementorFrontend.hooks.addAction('frontend/element_ready/goee-exclusive-alert.default', exclusiveAlert);

    });

}(jQuery));