/* $(document).ready(function () {
    $(".test").click(function (e) {
        theURL = $(this).attr('href');
        console.log(theURL); // can be removed just included for testing
        $("#pageload").load(theURL);
        //e.preventDefault();
        $.ajax({
            url: theURL, success: function () {

               // $("#pageload").load(theURL);
                var selector = '.product-category li';

                $(selector).on('click', function () {
                    $(selector).removeClass('active');
                    $(this).addClass('active');
                });

            }
        });
    });
});
  
 */


// $(function () {
//     var current = window.location.href;
//     $(selector).each(function ()
    
//      {
//         var $this = $(this);
        
        
//         // if the current path is like this link, make it active
//         if ($this.attr('href').indexOf(current) !== -1) {
//             //$(selector).removeClass('active');
//             $this.addClass('active');
//         }
//     })
// })

