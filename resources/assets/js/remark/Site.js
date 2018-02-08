import $ from 'jquery';
import Base from './Base';
import Menubar from './Section/Menubar';
import GridMenu from './Section/GridMenu';
import Sidebar from './Section/Sidebar';
import PageAside from './Section/PageAside';

const DOC = document;
const $DOC = $(document);
const $BODY = $('body');

class Site extends Base {
    willProcess() {
        this.startLoading();
        this.initializePluginAPIs();
        this.initializePlugins();
    }

    processed() {
        this.initBootstrap();
        this.setupMenubar();
        //this.setupGridMenu();
        this.setupFullScreen();
        this.setupNavbar();
        this.setupNavbarCollpase();

        // Dropdown menu setup
        // ===================
        this.$el.on('click', '.dropdown-menu-media', (e) => {
            e.stopPropagation();
        });
    }

    _getDefaultMeunbarType() {
        let breakpoint = this.getCurrentBreakpoint(),
            type = false;

        if ($BODY.data('autoMenubar') === false || $BODY.is('.site-menubar-keep')) {
            if ($BODY.hasClass('site-menubar-fold')) {
                type = 'fold';
            } else if ($BODY.hasClass('site-menubar-unfold')) {
                type = 'unfold';
            }
        }

        switch (breakpoint) {
            case 'lg':
                type = type || 'unfold';
                break;
            case 'md':
            case 'sm':
                type = type || 'fold';
                break;
            case 'xs':
                type = 'hide';
                break;
            // no default
        }

        return type;
    }

    getDefaultState() {
        let menubarType = this._getDefaultMeunbarType();

        return {
            menubarType,
            gridmenu: false
        };
    }

    getDefaultActions() {
        return {
            menubarType(type) {
                let toggle = function ($el) {
                    $el.toggleClass('hided', !(type === 'open'));
                    $el.toggleClass('unfolded', !(type === 'fold'));
                };

                $('[data-toggle="menubar"]').each(function () {
                    let $this = $(this);
                    let $hamburger = $(this).find('.hamburger');

                    if ($hamburger.length > 0) {
                        toggle($hamburger);
                    } else {
                        toggle($this);
                    }
                });
            }
        };
    }

    getDefaultChildren() {
        let menubar = new Menubar({
            $el: $('.site-menubar')
        }),
            gridmenu = new GridMenu({
                $el: $('.site-gridmenu')
            }),
            sidebar = new Sidebar();

        let children = [menubar, gridmenu, sidebar];

        let $aside = $('.page-aside');
        if ($aside.length > 0) {
            children.push(new PageAside({
                $el: $aside
            }));
        }
        return children;
    }

    getCurrentBreakpoint() {
        let bp = Breakpoints.current();
        return bp ? bp.name : 'lg';
    }

    initBootstrap() {
        // Tooltip setup
        // =============
        $DOC.tooltip({
            selector: '[data-tooltip=true]',
            container: 'body'
        });

        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    }

    setupFullScreen() {
        if (typeof screenfull !== 'undefined') {
            $DOC.on('click', '[data-toggle="fullscreen"]', () => {
                if (screenfull.enabled) {
                    screenfull.toggle();
                }

                return false;
            });

            if (screenfull.enabled) {
                DOC.addEventListener(screenfull.raw.fullscreenchange, () => {
                    $('[data-toggle="fullscreen"]').toggleClass('active', screenfull.isFullscreen);
                });
            }
        }
    }

    setupGridMenu() {
        let self = this;
        $DOC.on('click', '[data-toggle="gridmenu"]', function () {
            let $this = $(this),
                isOpened = self.getState('gridmenu');

            if (isOpened) {
                $this.addClass('active').attr('aria-expanded', true);
            } else {
                $this.removeClass('active').attr('aria-expanded', false);
            }

            self.setState('gridmenu', !isOpened);
        });


    }

    setupNavbar() {
        $DOC.on('click', '.site-navbar .dropdown-menu', (e) => {
            e.stopPropagation();
        }).on('show.bs.dropdown', (e) => {
            let $target = $(e.target);
            let $trigger = e.relatedTarget ? $(e.relatedTarget) : $target.children('[data-toggle="dropdown"]');
            let animation = $trigger.data('animation');

            if (animation) {
                let $menu = $target.children('.dropdown-menu');
                $menu
                .addClass(`animation-${animation}`)
                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', () => {
                    $menu.removeClass('animation-' + animation);
                });
            }
        }).on('shown.bs.dropdown', (e) => {
            let $menu = $(e.target).find('.dropdown-menu-media > .list-group');
            if ($menu.length > 0) {
                let api = $menu.data('asScrollable');

                if (api) {
                    api.update();
                } else {
                    $menu.asScrollable({
                        namespace: 'scrollable',
                        contentSelector: '> [data-role=\'content\']',
                        containerSelector: '> [data-role=\'container\']'
                    });
                }
            }
        });
    }

    setupMenubar() {
        $(document).on('click', '[data-toggle="menubar"]', () => {
            this.toggleMenuBarState();
            return false;
        });

        Breakpoints.on('change', () => {
            this.updateMenuBar();
        });
    }

    toggleMenuBarState() {
        let type = this.getState('menubarType');

        switch (type) {
            case 'fold':
                type = 'unfold';
                break;
            case 'unfold':
                type = 'fold';
                break;
            case 'open':
                type = 'hide';
                break;
            case 'hide':
                type = 'open';
                break;
            // no default
        }

        this.setState('menubarType', type);
    }

    updateMenuBar() {
        let type = this._getDefaultMeunbarType();

        this.setState('menubarType', type);
    }

    setupNavbarCollpase() {
        $(document).on('click', "[data-target='#site-navbar-collapse']", function (e) {
            let $trigger = $(this);
            let isClose = $trigger.hasClass('collapsed');
            $BODY.addClass("site-navbar-collapsing");
            $BODY.toggleClass("site-navbar-collapse-show", !isClose);
            setTimeout(() => {
                $BODY.removeClass("site-navbar-collapsing");
            }, 350);
        });
    }

    startLoading() {
        if (typeof $.fn.animsition === 'undefined') {
            return false;
        }

        // let loadingType = 'default';
        $BODY.animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 800,
            outDuration: 500,
            loading: true,
            loadingClass: 'loader-overlay',
            loadingParentElement: 'html',
            loadingInner: `
      <div class="loader-content">
        <div class="loader-index">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>`,
            onLoadEvent: true
        });
    }

    setBodyClasses(classes) {
        $BODY.removeClass();
        this.addBodyClasses(classes);
    }

    addBodyClasses(classes) {
        $BODY.addClass(classes);
    }
}

let instance = null;

function getInstance() {
    if (!instance) {
        instance = new Site();
    }

    return instance;
}

export default Site;
export {
    Site,
    getInstance
};
