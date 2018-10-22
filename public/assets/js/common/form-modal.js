/**
 * 表单-字段合法式-验证 操作
 */
var formValidator = {
    container: '',
    icons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields:{},
    init: function(container, fields) {
        this.fields = fields;
        this.container = container;
        $(this.container).bootstrapValidator({
            feedbackIcons: this.icons,
            fields: this.fields
        });
    },
    noStatus: function(e, data) {
        var parent = data.element.parents('.form-group');
        // Remove the has-success class
        parent.removeClass('has-success');
        // Hide the success icon
        parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]')
            .data('bv.messages')
            .hide();
    },
    hasSuccess: function(e, data) {
        var parent = data.element.parents('.form-group');
//        data.element.data('bv.messages');
        // Remove the has-success class
        parent.addClass('has-success');
        // Hide the success icon
        parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]')
            .removeClass('glyphicon-remove')
            .addClass('glyphicon glyphicon-ok')
            .show();
        console.log(data);
//        parent.find('small').data("data-bv-result","VALID");
    },
    hasError: function(e, data, msg) {
        var parent = data.element.parents('.form-group');
        // Remove the has-success class
        parent.addClass('has-error');
        // Hide the success icon
        parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]')
            .removeClass('glyphicon-ok')
            .addClass('glyphicon-remove glyphicon')
            .show();
        this.setMsg(data, msg);
    },
    setMsg: function(data, msg) {
        var field  = data.field,        // Get the field name
            $field = data.element,      // Get the field element
            bv     = data.bv;           // BootstrapValidator instance
        var tip = $field.parent().find('.help-block[data-bv-validator="other"]');
        if (tip.length==0) {
            var tip = '<small class="help-block" data-bv-validator="other" data-bv-for="'+field+'" data-bv-result="INVALID" style="display: block;">'+msg+'</small>';
            $field.parent().append(tip);
        } else {
            $(tip).show().html(msg);
        }
    }
};
