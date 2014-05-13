var taxons = {
    rootTaxons: $('.taxon[data-parent="0"]'),

    appendIndex: 0,

    redrawAll: function() {
        var self = this;
        $('.taxon').each(function(index, taxon) {
            setTimeout(function() {
                self.drawTaxon($(taxon));
            }, 1000 * self.appendIndex);
            self.appendIndex += 1;
        });
    },

    drawTaxon: function(taxon) {
        var self = this,
            top = 0,
            parent = $('.taxon[data-id="' + taxon.data('parent') + '"]');

        taxon.removeClass('hidden');

        if (parent.length) {
            // top = 138;
            // left = 356;
            top = parseInt(parent.data('top'));
            left = parseInt(parent.data('left')) + 356;
            parent.data('top', top + 138);
            taxon.css({
                top: top,
                left: left,
            });
            parent.append(taxon);
        } else {
            $('.taxa-wrapper .taxa').append(taxon);
        }
    },
}

$(function() {
    taxons.redrawAll();
});