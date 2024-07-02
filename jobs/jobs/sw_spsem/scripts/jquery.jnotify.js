(function (jQuery) {
    jQuery.fn.jnotifyInizialize = function (options) {
        var element = this;
        var defaults = {
            oneAtTime: false,
            appendType: 'append'
        };
        var options = jQuery.extend({}, defaults, options);
        this.addClass('notify-wrapper');
        if (options.oneAtTime) this.addClass('notify-wrapper-oneattime');
        if (options.appendType == 'prepend' && options.oneAtTime == false) this.addClass('notify-wrapper-prepend');
        return this;
    };
    jQuery.fn.jnotifyAddMessage = function (options) {

        var notifyWrapper = this;

        if (notifyWrapper.hasClass('notify-wrapper')) {

            var defaults = {
                text: '',
                type: 'message',
                permanent: false,
                disappearTime: 3000
            };

            var options = jQuery.extend({}, defaults, options);
            var styleClass;

            switch (options.type) {
                case 'alert':
                    styleClass = 'jnotify-alert';
                break;
                case 'success':
                    styleClass = 'jnotify-success';
                break;
                case 'error':
                    styleClass = 'jnotify-error';
                break;
                default:
                    styleClass = 'jnotify-alert';
                break;
            }

            if (notifyWrapper.hasClass('notify-wrapper-oneattime')) {
                this.children().remove();
            }

            var notifyItemWrapper   = jQuery('<div class="jnotify-item-wrapper"></div>');
            var notifyItem          = jQuery('<div class="jnotify-item"></div>').addClass(styleClass);

            if (notifyWrapper.hasClass('notify-wrapper-prepend'))
                notifyItem.prependTo(notifyWrapper);
            else
                notifyItem.appendTo(notifyWrapper);

            notifyItem.wrap(notifyItemWrapper);
            jQuery('<span></span>').html(options.text).appendTo(notifyItem);
            jQuery('<div class="jnotify-item-close">×</div>').prependTo(notifyItem).click(function () { remove(notifyItem) });
            if (!options.permanent) {
                setTimeout(function () { remove(notifyItem); }, options.disappearTime);
            }
        }

        function remove(obj) {
            obj.animate({ opacity: '0', left: '-100px' }, 600, function () {
                obj.parent().animate({ height: '0px' }, 300, function () {
                    obj.parent().remove();
                });
            });
        }
    };
})(jQuery);