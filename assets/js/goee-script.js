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
    var exclusiveNewsTicker = function( $scope, $ ) {

        var goee_news_ticker = $scope.find( '.goee-news-ticker' );
    
        if ( $.isFunction( $.fn.breakingNews ) ) {  
            goee_news_ticker.each( function() {
                var t            = $(this),
                auto             = t.data( 'autoplay' ) ? !0 : !1,
                animationEffect  = t.data( 'animation' ) ? t.data( 'animation' ) : '',                                   
                fixedPosition      = t.data( 'fixed_position' ) ? t.data( 'fixed_position' ) : '',                                   
                pauseOnHover     = t.data( 'pause_on_hover' ) ? t.data( 'pause_on_hover' ) : '',                                   
                animationSpeed   = t.data( 'animation_speed' ) ? t.data( 'animation_speed' ) : '',                                   
                autoplayInterval = t.data( 'autoplay_interval' ) ? t.data( 'autoplay_interval' ) : '',                                   
                height           = t.data( 'ticker_height' ) ? t.data( 'ticker_height' ) : '',                                   
                direction        = t.data( 'direction' ) ? t.data( 'direction' ) : ''; 
    
                $(this).breakingNews( {
                    position: fixedPosition,
                    play: auto,
                    direction: direction,
                    scrollSpeed: animationSpeed,
                    stopOnHover: pauseOnHover,
                    effect: animationEffect,
                    delayTimer: autoplayInterval,                    
                    height: height,
                    fontSize: 'default',
                    themeColor: 'default',
                    background: 'default'             
                } );    
            } );
        }
    }

    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            editMode = true;
        }

        elementorFrontend.hooks.addAction( 'frontend/element_ready/goee-exclusive-alert.default', exclusiveAlert );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/goee-news-ticker.default', exclusiveNewsTicker );

    });

}(jQuery));