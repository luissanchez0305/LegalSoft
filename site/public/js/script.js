validate = (function(){
    items = {};
    items.init = function(){
        $.validator.addMethod("check_zero", function(value, el) {
          $el = $(el);
          return value.length > 0 && $el.prev().val() != '0';
        });
    }

    items.validate_form = function($form, rules, valid_callback){
        $form.validate(rules);
        if($form.valid()) {
            valid_callback();
        }
    }

    items.check_zero = function(el){
        $el = $(el);
        return $el.val().length == 0 || $el.prev().val() == '0';
    }
    return items;
});