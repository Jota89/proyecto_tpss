$(function () {
    if($("#email").val() != ''){
      $(".checkout-data").show();
    } else{
      $(".checkout-data").hide();
    }
    //
    $('body').on('change','#email', function(){
      var email = $(this).val();
      var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
      if(pattern.test(email)) {
        $(".checkout-data").show();
      } else{
        $(".checkout-data").hide();
      }
    });
    //
});
//
$(function () {
  function autoComplete() {
    var path = "/autoComplete";
    $('#search').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
            return process(data);
        });
        }
    });
  }

  function search() {
    $('body').on('click','.typeahead li a', function(){
     //console.log($(this).text())
      var path = "/search";
      $.get(path, { query: $(this).text() }, function (data) {
        console.log(data[0]);
        url="/tienda/producto/"+data[0];
        window.location = url;
      });
    });
  }

  function clearSearch() {
    $('body').on('focusout','#search', function(){
      $(this).val('');
    });
  }

  function filter() {
    $('body').on('change','#filters input', function(){
      console.log($(this).val());
      val = [];
      if ($(this).is(':checked')) {
        val.push($(this).val()) ;
      } else{
        val = null;
      }
      //
      var path = "/filter";
      $.get(path, { query: val }, function (data) {
        $('.producto').hide();
        data.forEach(element => {
          console.log(element);
          $('#'+element).show();
        });
      });
    });
  }

  //
  autoComplete();
  search();
  clearSearch();
  filter();

});

//
// VANILLA JS
//
(function () {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()