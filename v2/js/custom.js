$(document).ready(function () {
    /** Overlay Scrollbars */
    scrollbar = $('#wrapper').overlayScrollbars({}).overlayScrollbars();

    /** Detect .navbar-row-* */
    /** NEED FRESH SOLUTION */
    if ($('.navbar-2-lg').length) {
        $('#navbar').addClass('row').children('div').addClass('col-lg')
    } else if ($('.navbar-2-xl').length) {
        $('#navbar').addClass('row').children('div').addClass('col-xl');
    }

    /** system parameter */
    api_url = 'http://oowl-indonesia.com/v2/api/';
    menu_loaded = false;

    /** Navigo */
    baseUrl = $('base').attr('href');
    router = new Navigo(baseUrl);
    router.hooks({
        before: function (done, params) {
            if (router._lastRouteResolved != null) {
                if (router._lastRouteResolved.query == '') {
                    router._lastRouteResolved.query = '_=' + Number(new Date());
                } else {
                    router._lastRouteResolved.query += '&_=' + Number(new Date());
                }
                done();
            }
        },
    });
    router
        .on({
            '/:modul': function (params, query) {
                if (params.modul == 'index.php') {
                    params.modul = 'home';
                }
                current_modul = params.modul;
                current_query = new FormData();
                if (menu_loaded) {
                    loadContent(current_modul);
                }
            },
            '*': function (params, query) {
                current_modul = 'home';
                current_query = new FormData();
                if (menu_loaded) {
                    loadContent(current_modul);
                }
            }
        })
        .resolve();

    /** system ajax */
    ajax = function (par, xhrf = {}, method = 'POST', url = api_url) {
        return $.ajax({
            url: url,
            method: method,
            data: par,
            xhrFields: xhrf,
            contentType: false,
            processData: false,
        });
    };
    /** system loadAppInfo */
    loadAppInfo = function () {
        fd = new FormData();
        fd.append('action', 'getAppInfo');
        ajax(fd)
            .done(function (res) {
                $('title').text(res.name);
                $('.brand-link>span').text(res.name);
                $('.main-footer>div').text(res.motto);
                $('.main-footer>a').text(res.copyright);
                loadUserInfo();
            })
            .fail(function () {
                console.log('loadAppInfo failed');
            });
    };
    /** system loadUserInfo */
    loadUserInfo = function () {
        fd = new FormData();
        fd.append('action', 'getUserInfo');
        ajax(fd)
            .done(function (res) {
                $('.user-panel>.image>img').attr('src', api_url + res.photo);
                $('.user-panel>.info>a').text(res.name);
                loadUserMenu();
            })
            .fail(function () {
                console.log('loadUserInfo failed');
            });
    };
    /** system loadUsermenu */
    loadUserMenu = function () {
        fd = new FormData();
        fd.append('action', 'getUserMenu');
        ajax(fd)
            .done(function (res) {
                var html = {
                    'sidebar': '',
                    'navbar-left': '',
                    'navbar-right': ''
                }
                /** NEED ATTENTION */
                $.each(res, function (position, menu) {
                    if (position == 'sidebar' && $('aside.main-sidebar').length == 0) {
                        position = 'navbar-left';
                    }
                    if (position == 'sidebar') {
                        $.each(menu, function (k, main_menu) {
                            if (main_menu[3].length == 1 && main_menu[2] == main_menu[3][0][2]) {
                                html[position] += '<li class="nav-item">'
                                    + '<a data-navigo class="nav-link" href="' + main_menu[3][0][0] + '">'
                                    + '<i class="nav-icon fa ' + main_menu[1] + '"></i>'
                                    + '<p>' + main_menu[2] + '</p>'
                                    + '</a>'
                                    + '</li>';
                            } else {
                                html[position] += '<li class="nav-item has-treeview">'
                                    + '<a class="nav-link" href="#">'
                                    + '<i class="nav-icon fa ' + main_menu[1] + '"></i>'
                                    + '<p>' + main_menu[2] + '<i class="right fa fa-angle-double-left"></i></p>'
                                    + '</a>'
                                    + '<ul class="nav nav-treeview">';
                                $.each(main_menu[3], function (k, sub_menu) {
                                    html[position] += '<li class="nav-item">'
                                        + '<a data-navigo class="nav-link" href="' + sub_menu[0] + '">'
                                        + '<i class="nav-icon fa ' + sub_menu[1] + '"></i>'
                                        + '<p>' + sub_menu[2] + '</p>'
                                        + '</a>'
                                        + '</li>';
                                });
                                html[position] += '</ul>'
                                    + '</li>';
                            }
                        });
                    } else {
                        $.each(menu, function (k, main_menu) {
                            if (main_menu[3].length == 1 && main_menu[2] == main_menu[3][0][2]) {
                                html[position] += '<li class="nav-item text-nowrap ' + main_menu[0] + '">'
                                    + '<a data-navigo class="nav-link" href="' + main_menu[3][0][0] + '">'
                                    + '<i class="fa fa-fw ' + main_menu[1] + '"></i>'
                                    + '<span class="ml-1">' + main_menu[2] + '</span>'
                                    + '</a>'
                                    + '</li>';
                            } else {
                                html[position] += '<li class="nav-item dropdown text-nowrap ' + main_menu[0] + '">'
                                    + '<a class="nav-link" href="#" data-toggle="dropdown">'
                                    + '<i class="fa fa-fw ' + main_menu[1] + '"></i>'
                                    + '<span class="ml-1">' + main_menu[2] + '</span>'
                                    + '<i class="d-none d-sm-inline-block fa fa-fw fa-caret-down"></i>'
                                    + '<i class="d-sm-none fa fa-fw fa-caret-down float-right mt-1"></i>'
                                    + '</a>'
                                    + '<div class="dropdown-menu">';
                                $.each(main_menu[3], function (k, sub_menu) {
                                    html[position] += '<a data-navigo class="dropdown-item" href="' + sub_menu[0] + '">'
                                        + '<i class="mr-2 fa fa-fw ' + sub_menu[1] + '"></i>' + sub_menu[2]
                                        + '</a>';
                                });
                                html[position] += '</div>'
                                    + '</li>';
                            }
                        });
                    }
                });
                $.each(html, function (key, val) {
                    $('#' + key).html(val);
                });
                router.updatePageLinks();
                $('#page-loader').fadeOut();
                menu_loaded = true;
                loadContent();
            })
            .fail(function () {
                console.log('loadUserMenu failed');
            });
    };
    note = {
        'success': { color: 'success', icon: 'check' },
        'warning': { color: 'warning', icon: 'exclamation-triangle' },
        'error': { color: 'danger', icon: 'times' }
    };
    showNote = function (type, message) {
        $('.note-wrapper').append('<div class="note">'
            + '<div class="alert alert-' + note[type].color + ' rounded-0 px-3 py-2 float-right">'
            + '<i class= "fa fa-fw fa-' + note[type].icon + '"></i >&nbsp; <span class="message">' + message + '</span>'
            + '</div >'
            + '</div>')
            .children('.note:last-child').delay(2000).fadeOut(function () { $(this).remove(); });
    };
    /** system loadContent */
    loadContent = function (modul = current_modul, next = null) {
        fd = new FormData();
        fd.append('modul', modul);
        /*ajax($.grep([$.param({ modul: modul }), query], Boolean).join('&'))*/
        ajax(fd)
            .done(function (res) {
                if (res.type == 'success') {
                    $('#content-wrapper').html(res.content);
                    router.updatePageLinks();
                    setActiveLink();
                    $('.entry-form>div>form').find('input[type="number"]').not('.skip-mask').attr('type', 'text').addClass('mask');
                    $('.mask').inputmask('currency', { groupSeparator: ',' }).val(0);
                };
                showNote(res.type, res.message);
                if (next) {
                    fd = new FormData();
                    fd.append('src', next.src);
                    fd.append('rid', next.rid);
                    loadDataExt(fd);
                    setEntryForm('add');
                    $('.entry-form').children('.card-body').children('form').append('<input type="hidden" name="' + next.src + '_rid" value="' + next.rid + '">');
                    $('.advanced-search').hide();
                    $('.entry-form').show();
                    scrollbar.scroll({ y: 0 }, 300);
                }
            })
            .fail(function () {
                console.log('loadContent failed');
            });
    };
    loadData = function (note = true) {
        var arr_ob = {};
        var arr_od = {};
        $('.view-sort').children('sup:not(:empty)').each(function () {
            let curr = $(this).parent();
            arr_ob[curr.data('so')] = curr.data('ob');
            arr_od[curr.data('so')] = curr.data('od');
        });
        /*
        var query = $.grep([$.param({
            ob: arr_ob,
            od: arr_od,
            limit: $('.limit').val(),
            page: $('.page').val()
        }), current_query], Boolean).join('&');
        ajax($.grep([$.param({ modul: current_modul, req: 'data' }), query], Boolean).join('&'))
        */
        fd = current_query;
        fd.append('modul', current_modul);
        fd.append('req', 'data');
        fd.append('ob', JSON.stringify(arr_ob));
        fd.append('od', JSON.stringify(arr_od));
        fd.append('limit', $('.limit').val());
        fd.append('page', $('.page').val());
        ajax(fd)
            .done(function (res) {
                if (typeof (res) == 'string') {
                    showNote('error', 'response failed');
                    return;
                }
                if (res.type == 'success') {
                    setData(res.content);
                    $('.cb-parent').prop('checked', false);
                    $('.n-selected').html(0);
                }
                if (note) {
                    showNote(res.type, res.message);
                }
            })
            .fail(function () {
                console.log('loadData failed');
            });
    };
    loadDataEdit = function (par) {
        fd = new FormData();
        fd.append('modul', current_modul);
        fd.append('req', 'data_edit');
        fd.append('rid', par);
        ajax(fd)
            .done(function (res) {
                if (typeof (res) == 'string') {
                    showNote('error', 'response failed');
                    return;
                }
                if (res.type == 'success') {
                    setDataEdit(res.content);
                }
            })
            .fail(function () {
                console.log('loadDataEdit failed');
            });
    };
    loadDataExt = function (par) {
        fd = new FormData();
        fd.append('modul', current_modul);
        fd.append('req', 'data_' + par.src);
        fd.append('rid', par.rid);
        ajax(fd)
            .done(function (res) {
                if (typeof (res) == 'string') {
                    showNote('error', 'response failed');
                    return;
                }
                if (res.type == 'success') {
                    setDataEdit(res.content);
                }
            })
            .fail(function () {
                console.log('loadDataExt failed');
            });
    };
    _setDataEdit = function (res) {
        form = $('.entry-form').children('.card-body').children('form');
        $.each(res, function (key, value) {
            form.find('[name="' + key + '"]').val(value);
        })
    }
    loadDataDetail = function (par) {
        fd = new FormData();
        fd.append('modul', current_modul);
        fd.append('req', 'data_detail');
        fd.append('rid', par);
        ajax(fd)
            .done(function (res) {
                if (typeof (res) == 'string') {
                    showNote('error', 'response failed');
                    return;
                }
                if (res.type == 'success') {
                    setDataDetail(res.content);
                }
            })
            .fail(function () {
                console.log('loadDataDetail failed');
            });
    };
    _setDataDetail = function (res) {
        container = $('.data-detail');
        $.each(res, function (key, value) {
            container.find('._' + key).html(value);
        })
        modal = $('#modal-detail');
        modal.find('.modal-body').html($('.data-detail').html());
        modal.modal();
    }
    /** system downloadFile */
    downloadFile = function (type = 'xlsx', modul = current_modul, query = current_query) {
        fd = current_query;
        fd.append('modul', current_modul);
        fd.append('req', type);
        ajax(fd, { responseType: 'blob' })
            .done(function (res) {
                let a = document.createElement('a');
                a.href = window.URL.createObjectURL(res);
                a.download = 'report.' + type;
                a.click();
            })
            .fail(function () {
                console.log('downloadFile failed');
            });
    };
    /** system downloadFile */
    printData = function (type = 'print', modul = current_modul, query = current_query) {
        fd = current_query;
        fd.append('modul', current_modul);
        fd.append('req', type);
        ajax(fd)
            .done(function (res) {
                let w = window.open('about:blank');
                w.document.open();
                w.document.write(res);
                w.document.close();
            })
            .fail(function () {
                console.log('printData failed');
            });
    };
    /** system setActiveLink */
    setActiveLink = function () {
        /** hide navbar (on xs device) after load content */
        $('#navbar').removeClass('show');
        /** hide sidebar (on md device) after load content */
        if ($('body.sidebar-open').length && $(window).width() < 992) {
            $('body').removeClass('sidebar-open').addClass('sidebar-collapse');
        }
        /** remove all active class */
        $('#sidebar, #navbar-left, #navbar-right').find('a').removeClass('active');
        /** add active class on sidebar menu */
        $('#sidebar').find('a[href="' + current_modul + '"]').addClass('active')
            .parent().parent('.nav-treeview').prev().addClass('active').parent().addClass('menu-open');
        /** add active class on navbar menu */
        $('#navbar-left, #navbar-right').find('a[href="' + current_modul + '"]').addClass('active')
            .parent('.dropdown-menu').prev().addClass('active');
    }
    /** call loadAppInfo */
    loadAppInfo();

    confirmDelete = function (par) {
        modal = $('#modal-delete');
        modal.find('.modal-body>b').html(par.length);
        modal.find('.modal-btn-ok').attr('onclick', 'deleteData(\'' + JSON.stringify(Object.assign({}, par)) + '\')');
        modal.modal();
    }

    deleteData = function (par) {
        fd = new FormData();
        fd.append('modul', current_modul);
        fd.append('action', 'delete');
        fd.append('rid', par);
        ajax(fd)
            .done(function (res) {
                if (res.type == 'success' || res.type == 'warning') {
                    loadData(false);
                }
                showNote(res.type, res.message);
            })
            .fail(function () {
                console.log('deleteData failed');
            })
            .always(function () {
                $('#modal-delete').modal('hide');
            });
    }

    confirmProses = function (par) {
        fd = new FormData();
        fd.append('modul', current_modul);
        fd.append('action', 'proses');
        fd.append('rid', par);
        ajax(fd)
            .done(function (res) {
                if (res.type == 'success' || res.type == 'warning') {
                    loadData(false);
                }
                showNote(res.type, res.message);
            })
            .fail(function () {
                console.log('confirmProses failed');
            });
    }

    entryForm = {
        'add': { color: 'primary' },
        'edit': { color: 'success' }
    };
    setEntryForm = function (par = 'add') {
        entry_form = $('.entry-form');
        entry_form.children('.card-header').removeClass('bg-primary bg-success').addClass('bg-' + entryForm[par].color).html(ucfirst(par) + ' Data');
        card_body = entry_form.children('.card-body').removeClass('border-primary border-success').addClass('border-' + entryForm[par].color);
        form = card_body.children('form');
        form.find('input[name="rid"]').remove();
        form.find('input[name="booking_rid"]').remove();
        form.find('input[name="persewaan_rid"]').remove();
        form.find('.dynamic-data').html('');
        form[0].reset();
        form.find('.submit-entry-form').removeClass('btn-primary btn-success').addClass('btn-' + entryForm[par].color);
    }

    saveData = function (par) {
        if ($('.entry-form>.card-header').hasClass('bg-' + entryForm.edit.color)) {
            action = 'edit';
        } else {
            action = 'add';
        }
        par.append('modul', current_modul);
        par.append('action', action);
        ajax(par)
            .done(function (res) {
                if (res.type == 'success') {
                    setEntryForm();
                    if (action == 'edit') {
                        $('.entry-form').hide();
                    }
                    loadData(false);
                }
                showNote(res.type, res.message);
            })
            .fail(function (res) {
                console.log('saveData failed');
            });
    }

    $('body')
        .on('click', '.note', function () {
            $(this).remove();
        })
        .on('click', '.show-advanced-search', function () {
            scrollbar.scroll({ y: 0 }, 300);
            $('.entry-form').hide();
            $('.advanced-search').toggle();
        })
        .on('click', '.show-entry-form', function () {
            scrollbar.scroll({ y: 0 }, 300);
            $('.advanced-search').hide();
            if (!$('.entry-form>.card-header').hasClass('bg-' + entryForm.edit.color)) {
                $('.entry-form').toggle();
            }
            setEntryForm();
        })
        .on('click', '.cancel-advanced-search, .cancel-entry-form', function (e) {
            $(this).parents('form')[0].reset();
            $(this).parents('.card').hide();
        })
        .on('click', '.view-report', function (e) {
            downloadFile($(this).data('type'));
        })
        .on('click', '.view-print', function (e) {
            printData($(this).data('type'));
        })
        .on('click', '.act-delete', function (e) {
            var rid = [$(this).parents('tr').find('.cb-child').data('rid')];
            confirmDelete(rid);
        })
        .on('click', '.act-edit', function (e) {
            var rid = $(this).parents('tr').find('.cb-child').data('rid');
            loadDataEdit(rid);
            setEntryForm('edit');
            $('.entry-form').children('.card-body').children('form').append('<input type="hidden" name="rid" value="' + rid + '">');
            $('.advanced-search').hide();
            $('.entry-form').show();
            scrollbar.scroll({ y: 0 }, 300);
        })
        .on('click', '.act-detail', function (e) {
            var rid = $(this).parents('tr').find('.cb-child').data('rid');
            $('#modal-detail>.modal-dialog').removeClass('modal-lg');
            loadDataDetail(rid);
        })
        .on('click', '.act-delete-selected', function (e) {
            var checked = $('.view-data').find('.cb-child:checked');
            if (checked.length > 0) {
                var rid = [];
                checked.each(function () {
                    rid.push($(this).data('rid'));
                });
                confirmDelete(rid);
            }
        })
        .on('click', '.act-proses', function (e) {
            var rid = $(this).parents('tr').find('.cb-child').data('rid');
            confirmProses(rid);
        })
        .on('click', '.submit-search', function () {
            $('.advanced-search>div>form')[0].reset();
            $('.page').val(1);
            current_query = new FormData();
            current_query.append('keyword', $('.keyword').val());
            /*current_query = $.param({ keyword: $('.keyword').val() });*/
            loadData();
        })
        .on('click', '.submit-advanced-search', function () {
            $('.keyword').val('');
            $('.page').val(1);
            current_query = new FormData($('.advanced-search>div>form')[0]);
            loadData();
        })
        .on('click', '.submit-entry-form', function () {
            $('.entry-form>div>form').find('.mask').each(function () {
                v = $(this).inputmask('unmaskedvalue');
                $(this).inputmask('remove');
                $(this).val(v);
            });
            saveData(new FormData($('.entry-form>div>form')[0]));
            $('.mask').inputmask('currency', { groupSeparator: ',' });
        })
        .on('change', '.cb-parent', function () {
            var cb_child = $(this).parents('.view-data').find('.cb-child');
            if ($(this).is(':checked')) {
                cb_child.prop('checked', true);
                $('.n-selected').html(cb_child.length);
            } else {
                cb_child.prop('checked', false);
                $('.n-selected').html(0);
            }
        })
        .on('change', '.cb-child', function () {
            let cb_child_checked = $(this).parents('.view-data').find('.cb-child:checked');
            if ($(this).is(':checked')) {
                let cb_child = $(this).parents('.view-data').find('.cb-child');
                if (cb_child.length == cb_child_checked.length) {
                    $(this).parents('.view-data').find('.cb-parent').prop('checked', true);
                }
            } else {
                $(this).parents('.view-data').find('.cb-parent').prop('checked', false);
            }
            $('.n-selected').html(cb_child_checked.length);
        })
        .on('click', '.page-goto', function () {
            loadData();
        })
        .on('click', '.page-1st', function () {
            $('.page').val(1);
            loadData();
        })
        .on('click', '.page-prev', function () {
            let page = parseInt($('.page').val());
            if (page > 1) {
                $('.page').val(page - 1);
            }
            loadData();
        })
        .on('click', '.page-next', function () {
            let page = parseInt($('.page').val());
            let n_page = parseInt($('.n-page').text());
            if (page < n_page) {
                $('.page').val(page + 1);
            }
            loadData();
        })
        .on('click', '.page-last', function () {
            $('.page').val($('.n-page').text());
            loadData();
        })
        .on('click', '.view-reload', function () {
            loadData();
        })
        .on('click', '.view-sort', function () {
            let so = $(this).data('so');
            let od = $(this).data('od');
            if (so == 0) {
                so = $(this).parent().parent().find('sup:not(:empty)').length + 1;
                $(this).children('sup').text(so);
                od = 1;
                $(this).children('i').removeClass('fa-sort').addClass('fa-sort-asc');
            } else {
                if (od == 1) {
                    od = 2;
                    $(this).children('i').removeClass('fa-sort-asc').addClass('fa-sort-desc');
                } else {
                    $(this).parent().parent().find('sup:not(:empty)').each(function () {
                        let sibling = $(this).parent();
                        let sibling_so = sibling.data('so');
                        if (sibling_so > so) {
                            sibling_so--;
                            sibling.data('so', sibling_so)
                            $(this).text(sibling_so);
                        }
                    });
                    so = 0;
                    $(this).children('sup').text('');
                    od = 0;
                    $(this).children('i').removeClass('fa-sort-desc').addClass('fa-sort');
                }
            }
            $(this).data('so', so);
            $(this).data('od', od);
        })
        .on('click', '.view-report, .view-sort, .view-reload, .act-print, .act-detail, .act-edit, a.act-delete, .act-delete-selected, .act-proses', function (e) {
            e.preventDefault();
        })
        .on('keypress', 'input', function (e) {
            if (e.which == 13) {
                e.preventDefault();
            }
        });

});