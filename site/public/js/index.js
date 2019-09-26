
$(function() {
  $('.close-dropdown').click(function(){
    $('.nav-dropdown-wrapper').removeClass('in');
  });
  $('#hamburger').click(function(){
    $('body').toggleClass('visible');
  });
  $('.top-menu .nav-item:not(.image-item):not(.theme-color-item)').click(function(e){
    e.stopPropagation();
    if($('.top-menu .nav-item').hasClass('active-nav') && !($(this).hasClass('active-nav'))){
      $('.top-menu .nav-item').removeClass('active-nav');
      $('.nav-dropdown-wrapper').removeClass('in');
    }
    reqId = $(this).find('.nav-link').attr('data-target');
    if($(this).hasClass('active-nav')){
      $('.nav-dropdown-wrapper').removeClass('in');
      $(this).removeClass('active-nav');
    } else{
      $(this).addClass('active-nav');
      setTimeout(function(){
        $('.navbar-fixed-top').find(reqId).addClass('in');
        $('.side-menu').find(reqId).addClass('in');
      }, 200);
    }

  });
  $('.theme-picker').click(function() {
          changeTheme($(this).attr('data-theme'));
      });

      function changeTheme(theme) {

          $('<link>')
          .appendTo('head')
          .attr({type : 'text/css', rel : 'stylesheet'})
          .attr('href', '/css/app-'+theme+'.css');

          $.get('api/change-theme?theme='+theme);
      }
  $('body').click(function(){
    $('.top-menu .nav-item').removeClass('active-nav');
    $('.nav-dropdown-wrapper').removeClass('in');
  });
  $('body').on('click', '.delete-client', function(e){
    e.preventDefault();
    var _data = {
      _token: $('input[name="_token"]').val(),
      id: $(this).attr('data-id')
    }
    $.post('{{ route("people.destroy") }}', _data , function(data){
      location.reload();
    });
  });

  $('body').on('click','#people-search-btn', function(){
    var _data = {
      _token: $('input[name="_token"]').val(),
      list_type: $('#list-type').val(),
      q: $('#people-search-text').val(),
      is_autocomplete: false
    };
    $.post('{{ route("people.search") }}', _data, function(data){
      data = $.parseJSON(data);
      $('#people_rows').html(data.people);
    });
  });
  
  $('body').on('click', '.client-item', function(){
    location.href = $(this).attr('edit-url');
  });
  let path = '{{ route("people.search") }}';
  $('#people-search-text').typeahead({
    minLength: 2,
    source:  function (query, process) {
      return $.post(path, { _token: $('input[name="_token"]').val(), q: query, list_type: $('#list-type').val(), is_autocomplete: true }, 
        function (data){
              return process(data);
        }
      );
    },
    updater: function(item) {
      // do what you want with the item here
      var _data = {
        _token: $('input[name="_token"]').val(),
        id: item.id
      };
      $.post('{{ route("people.search_one") }}', _data, function(data){
        data = $.parseJSON(data);
        $('#people_rows').html(data.people);
      });
    }
  });
});