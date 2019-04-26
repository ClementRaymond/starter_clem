// TO USE :
// import utility from '../core/functions';
// then write utility.function_name


export default {
    listener_delete:
      function ($el, event, cb) {
        $el.addEventListener(event, function callback (e) {
          cb.call($el, e)
          this.removeEventListener(event, callback)
        })

        // This function is used to add the event listener and remove it afterwards
        // to not have stacing listeners that gets triggered x time each time

        // Exemple :
        // f.listener_delete($element, 'event', function () {
        //   ... your code here
        // })
      },
    once :
      function (fn, context) {
      	var executed;
      	return function() {
          if (!executed) {
            executed = true;
            if(fn) {
              var result = fn.apply(context || this, arguments);
              fn = null;
            }
          }
      		return result;
      	};

        // Run once a function ( Use as a wraper )
        // Usage
        // f.once(function() {
        // 	console.log('Executed!');
        // });

        // run_once(); // "Executed!"
        // run_once(); // nothing
      },
    params :
      function (qs) {
      qs = qs.split('+').join(' ');

      var params = {},
          tokens,
          re = /[?&]?([^=]+)=([^&]*)/g;

      while (tokens = re.exec(qs)) {
          params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
      }

      return params;

      // Get the URL params
      // var url_params = f.params(location.search);
    },
  same_height :
    function (el) {
      var el_class = el;
      function equilise() {
        var blocs = document.querySelectorAll(el_class);
        var all_h = 0;
        var all_w = 0;

        for (var i = 0; i < blocs.length; i++) {
          if (blocs[i].getBoundingClientRect().height > all_h) {
              all_h = blocs[i].getBoundingClientRect().height
          }
          if (blocs[i].getBoundingClientRect().width > all_w) {
              all_w = blocs[i].getBoundingClientRect().width
          }
        }

        for (var i = 0; i < blocs.length; i++) {
          if (all_w > all_h) {
            blocs[i].style.height = all_w + 'px';
          }
          if (all_h > all_w) {
            blocs[i].style.height = all_h + 'px';
          }
          if (all_w < all_h) {
            blocs[i].style.height = all_w + 'px';
          }
        }
      }

      window.addEventListener("resize", function(){
        equilise();
      });
      // Call the function with the classes of the elements
      // Set block to have the same height / width
      // var elements_to_equilise = document.querySelectorAll('.elements');
      // f.same_height(elements_to_equilise);
    },
  }
