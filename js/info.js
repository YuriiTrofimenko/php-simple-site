jQuery(document).ready(function ($) {

            //var jssor_1_SlideoTransitions = [];
            //var $JssorCaptionSlideo$=[];
            //var $JssorArrowNavigator$=[];
            //var $JssorBulletNavigator$=[];

 var jssor_1_options = {
              $AutoPlay: true,
              $Idle: 2000,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions,
                $Breaks: [
                  [{d:2000,b:1000}]
                ]
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
});