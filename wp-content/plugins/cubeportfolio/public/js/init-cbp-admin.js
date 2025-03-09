(function($, window, document, undefined) {
    'use strict';

    var options = {
        /**
         *  Define the wrapper for loadMore
         *  Values: strings that represent the elements in the document (DOM selector).
         */
        element: '',

        /**
         *  How the loadMore functionality should behave. Load on click on the button or
         *  automatically when you scroll the page
         *  Values: - click
         *          - auto
         */
        action: 'click',
        /**
         * How many items to load when you click on the loadMore button
         * Values: positive integer
         */
        loadItems: 3,
    };

    var CubePortfolio = $.fn.cubeportfolio.constructor;

    function Plugin(parent) {
        var t = this;

        t.parent = parent;

        t.options = $.extend({}, options, t.parent.options.plugins.loadMore);

        t.loadMore = $(t.options.element).find('.cbp-l-loadMore-link');

        // load click or auto action
        if (t.loadMore.length === 0) {
            return;
        }

        t.loadItems = t.loadMore.find('.cbp-l-loadMore-loadItems');

        if (t.loadItems.text() === '0') {
            t.loadMore.addClass('cbp-l-loadMore-stop');
        }

        parent.registerEvent('filterStart', function(filter) {
            t.populateItems().then(function() {
                var itemsLen = t.items.filter(filter).length;

                if (itemsLen > 0) {
                    t.loadMore.removeClass('cbp-l-loadMore-stop');
                    t.loadItems.html(itemsLen);
                } else {
                    t.loadMore.addClass('cbp-l-loadMore-stop');
                }
            });
        });

        t[t.options.action]();
    }

    Plugin.prototype.populateItems = function() {
        var t = this;

        if (t.items) {
            return $.Deferred().resolve();
        }

        var idsInGrid = t.parent.blocks.map(function(index, el) {
            return $(el).data('cbpid');
        });

        t.items = $();

        var loadMoreItems = $('#cbp-load-more-container').children().clone(true);

        loadMoreItems.each(function(index, el) {
            var id = $(el).data('cbpid');

            if ($.inArray(id, idsInGrid) === -1) {
                t.items = t.items.add(el);
            }
        });

        t.items.addClass('cbp-item-config-loaded');

        return $.Deferred().resolve();
    };

    Plugin.prototype.populateInsertItems = function(callback) {
        var t = this;
        var insertItems = [];
        var filter = t.parent.defaultFilter;

        var foundItem = 0;
        t.items.each(function(index, el) {
            if (foundItem === t.options.loadItems) {
                return false;
            }

            if (!filter || (filter === '*')) {
                insertItems.push(el);
                t.items[index] = null;

                foundItem++;
            } else {
                if ($(el).filter(filter).length) {
                    insertItems.push(el);
                    t.items[index] = null;

                    foundItem++;
                }
            }
        });

        t.items = t.items.map(function(index, el) {
            return el;
        });

        // stop the loadMore
        if (insertItems.length === 0) {
            t.loadMore.removeClass('cbp-l-loadMore-loading').addClass('cbp-l-loadMore-stop');
            return;
        }

        t.parent.$obj.cubeportfolio('append', insertItems, callback);
    }

    Plugin.prototype.click = function() {
        var t = this;

        t.loadMore.on('click.cbp', function(e) {
            e.preventDefault();

            if (t.parent.isAnimating || t.loadMore.hasClass('cbp-l-loadMore-stop')) {
                return;
            }

            // set loading status
            t.loadMore.addClass('cbp-l-loadMore-loading');

            t.populateItems().then(function() {
                t.populateInsertItems(appendCallback);
            });
        });

        function appendCallback() {
            // remove class from t.loadMore
            t.loadMore.removeClass('cbp-l-loadMore-loading');

            var filter = t.parent.defaultFilter;
            var itemsInLoadMore;

            if (!filter || (filter === '*')) {
                itemsInLoadMore = t.items.length;
            } else {
                itemsInLoadMore = t.items.filter(filter).length;
            }

            // check if we have more loadMore
            if (itemsInLoadMore === 0) {
                t.loadMore.addClass('cbp-l-loadMore-stop');
            } else {
                t.loadItems.html(itemsInLoadMore);
            }
        }
    };

    Plugin.prototype.auto = function() {
        var t = this;
        var $window = $(window);
        var isActive = false;

        // add scroll event to page for loadMore
        CubePortfolio.private.loadMoreScroll = new CubePortfolio.private.publicEvents('scroll.loadMore', 100);

        t.parent.$obj.one('initComplete.cbp', function() {
            // add events for scroll
            t.loadMore
                .addClass('cbp-l-loadMore-loading')
                .on('click.cbp', function(e) {
                    e.preventDefault();
                });

            CubePortfolio.private.loadMoreScroll.initEvent({
                instance: t,
                fn: function() {
                    if (!t.parent.isAnimating) {
                        // get new items on scroll
                        getNewItems();
                    }
                }
            });

            // when the filter is completed
            t.parent.$obj.on('filterComplete.cbp', function() {
                getNewItems();
            });

            // trigger method
            getNewItems();
        });

        function getNewItems() {
            if (isActive || t.loadMore.hasClass('cbp-l-loadMore-stop')) {
                return;
            }

            // add a treshold
            var topLoadMore = t.loadMore.offset().top - 200;
            var topWindow = $window.scrollTop() + $window.height();

            if (topLoadMore > topWindow) {
                return;
            }

            // this job is now busy
            isActive = true;

            t.populateItems().then(function() {
                t.populateInsertItems(appendCallback);
            }).fail(function() {
                // make the job inactive
                isActive = false;
            });
        }

        function appendCallback() {
            var itemsInLoadMore;
            var filter = t.parent.defaultFilter;

            if (!filter || (filter === '*')) {
                itemsInLoadMore = t.items.length;
            } else {
                itemsInLoadMore = t.items.filter(filter).length;
            }

            // check if we have more loadMore
            if (itemsInLoadMore === 0) {
                t.loadMore.removeClass('cbp-l-loadMore-loading').addClass('cbp-l-loadMore-stop');
            } else {
                t.loadItems.html(itemsInLoadMore);

                $window.trigger('scroll.loadMore');
            }

            // make the job inactive
            isActive = false;

            // remove events
            if (t.items.length === 0) {
                CubePortfolio.private.loadMoreScroll.destroyEvent(t);
                t.parent.$obj.off('filterComplete.cbp');
            }
        }
    };

    Plugin.prototype.destroy = function() {
        this.loadMore.off('.cbp');

        if (CubePortfolio.private.loadMoreScroll) {
            CubePortfolio.private.loadMoreScroll.destroyEvent(this);
        }
    };

    CubePortfolio.plugins.loadMore = function(parent) {
        var plugins = parent.options.plugins;

        // backward compatibility
        if (parent.options.loadMore) {
            if (!plugins.loadMore) {
                plugins.loadMore = {};
            }

            plugins.loadMore.element = parent.options.loadMore;
        }

        // backward compatibility
        if (parent.options.loadMoreAction) {
            if (!plugins.loadMore) {
                plugins.loadMore = {};
            }

            plugins.loadMore.action = parent.options.loadMoreAction;
        }

        // backward compatibility
        if (parent.options.displayItemsLoadMore) {
            if (!plugins.loadMore) {
                plugins.loadMore = {};
            }

            plugins.loadMore.loadItems = parent.options.displayItemsLoadMore;
        }

        // rename options
        if (plugins.loadMore && plugins.loadMore.selector !== undefined) {
            plugins.loadMore.element = plugins.loadMore.selector;
            delete plugins.loadMore.selector;
        }

        if (!plugins.loadMore || !plugins.loadMore.element) {
            return null;
        }

        return new Plugin(parent);
    };
})(jQuery, window, document);


(function($, window, document, undefined) {
    'use strict';

    // reset _filterFromUrl to not trigger on admin side
    $.fn.cubeportfolio.constructor.prototype.filterFromUrl = function() {};

    var gridContainer = $('#cbpw-grid' + cbpwOptions.id),
        filtersContainer = $('#cbpw-filters' + cbpwOptions.id),
        wrap, filtersCallback;

    /*********************************
     init cubeportfolio
     *********************************/
    cbpwOptions.options.singlePageCallback = function(url, element) {

        // to update singlePage content use the following method: this.updateSinglePage(yourContent)
        var self = this;

        $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                timeout: 30000,
                data: {
                    link: url,
                    type: 'cbp-singlePage',
                    source: 'cubeportfolio',
                    id: cbpwOptions.id,
                    popupData: localStorage.getItem('popup')
                }
            }).done(function(result) {
                self.updateSinglePage('<div class="notice-cbp-singlePage"><strong>Cube Portfolio Notice:</strong> You can\'t test this feature here because some contents don\'t work fine on the admin side. <br>Please test this feature on the frontend side.</div>');
            })
            .fail(function() {
                self.updateSinglePage("Error! Please refresh the page!");
            });
    };

    cbpwOptions.options.singlePageInlineCallback = function(url, element) {

        // to update singlePage content use the following method: this.updateSinglePageInline(yourContent)
        var self = this;

        $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                timeout: 30000,
                data: {
                    link: url,
                    type: 'cbp-singlePageInline',
                    source: 'cubeportfolio',
                    id: cbpwOptions.id,
                    popupData: localStorage.getItem('popup')
                }
            }).done(function(result) {
                self.updateSinglePageInline('<div class="notice-cbp-singlePage"><strong>Cube Portfolio Notice:</strong> You can\'t test this feature here because some contents don\'t work fine on the admin side. <br>Please test this feature on the frontend side.</div>');
            })
            .fail(function() {
                self.updateSinglePageInline("Error! Please refresh the page!");
            });
    };

    /*********************************
     add id attr to singlePage block
     *********************************/
    // when the plugin is completed
    gridContainer.on('initComplete.cbp', function() {
        var item = $(this).data('cubeportfolio').singlePage;

        if (item) {
            item.wrap.attr('id', 'cbpw-singlePage' + cbpwOptions.id);
        }
    });

    gridContainer.cubeportfolio(cbpwOptions.options);

    cbpwOptions.initFilters = function(container) {

        if (container.hasClass('cbp-l-filters-dropdown')) {

            wrap = container.find('.cbp-l-filters-dropdownWrap');

            wrap.on({
                'mouseover.cbp': function() {
                    wrap.addClass('cbp-l-filters-dropdownWrap-open');
                },
                'mouseleave.cbp': function() {
                    wrap.removeClass('cbp-l-filters-dropdownWrap-open');
                }
            });

            filtersCallback = function(me) {
                wrap.find('.cbp-filter-item').removeClass('cbp-filter-item-active');

                wrap.find('.cbp-l-filters-dropdownHeader').text(me.text());

                me.addClass('cbp-filter-item-active');

                wrap.trigger('mouseleave.cbp');
            };

        } else {
            filtersCallback = function(me) {
                me.addClass('cbp-filter-item-active').siblings().removeClass('cbp-filter-item-active');
            };
        }

        container.on('click.cbp', '.cbp-filter-item', function() {

            var me = $(this);

            if (me.hasClass('cbp-filter-item-active')) {
                return;
            }

            // get cubeportfolio data and check if is still animating (reposition) the items.
            if (!$.data(gridContainer[0], 'cubeportfolio').isAnimating) {
                filtersCallback.call(null, me);
            }

            // filter the items
            gridContainer.cubeportfolio('filter', me.data('filter'), function() {});

        });
    };

    cbpwOptions.refreshFilters = function(container) {
        container.off('click.cbp');
        cbpwOptions.initFilters(container);
    };


    /*********************************
     add listener for filters
     *********************************/
    cbpwOptions.initFilters(filtersContainer);


    /*********************************
     activate counter for filters
     *********************************/
    gridContainer.cubeportfolio('showCounter', filtersContainer.find('.cbp-filter-item'), function() {
        /* don't exevute this snippet on admin side
        // read from url and change filter active
        var match = /#cbpf=(.*?)([#|?&]|$)/gi.exec(location.href),
            item;
        if (match !== null) {
            item = filtersContainer.find('.cbp-filter-item').filter('[data-filter="' + match[1] + '"]');
            if (item.length) {
                filtersCallback.call(null, item);
            }
        }
        */
    });
})(jQuery, window, document);