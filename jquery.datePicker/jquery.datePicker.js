// jquery.datePicker 1.1.0
(function($) {
    function tag(name) {
        return $('<' + name + '></' + name + '>')
    }

    function collectionIndexOf(collection, value, predicate) {
        for (var i = 0; i < collection.length; i++) {
            if(predicate(collection[i], value))
                return i;
        }
        return -1;
    }

    moment.isBetween = function(target, moment1, moment2) {
        var from = moment.min(moment1, moment2);
        var to = moment.max(moment1, moment2);
        return (target.isAfter(from) && target.isBefore(to));
    };

    moment.equalsDatePart = function(moment1, moment2) {
        return moment1.format("YYYY-MM-DD") == moment2.format("YYYY-MM-DD");
    };

    moment.comparer = function (moment1, moment2) {
        if(moment1.isBefore(moment2)) return -1;
        if(moment1.isAfter(moment2)) return 1;
        return 0;
    };

    $.datePicker = {
        default: {
            prev: '<',                          // change prev button. html is allowed.
            next: '>',                          // change next button. html is allowed.
            changeMonthYear: false,             // add dropdown list for month year
            minDate: null,                      // minimum date of calendar. date string or integer.
            maxDate: null,                      // maximum date of calendar. date string or integer.
            monthCount: 1,                      // displaying month count
            holiday: null,                      // array ['YYYY-MM-DD'] or function(moment) { return false }
            disabled: null,                     // function(moment) { return true; } or [function, function, ...]
            range: null,                        // '#text' or ['#text2', '#text3', 'text4']
            weekdayName: moment.weekdaysMin(),  // array of weekdayName
            cssClass: {                         // You can change css class
                main: 'jqueryDatePicker',
                wrapper: 'wrapper',
                month: 'month',
                prev: 'prev',
                yearMonth: 'yearMonth',
                next: 'next',
                weekdayName: 'weekdayName',
                date: 'date',
                weekday: [ 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'],
                holiday: 'holiday',
                today: 'today',
                hover: 'hover',
                disabled: 'disabled',
                selected: 'selected',
                start: 'start',
                between: 'between',
                point: 'point',
                end: 'end'
            }
        }
    };
    $.fn.datePicker = function (option) {
        //noinspection JSUnusedGlobalSymbols
        var newOption = $.extend(
            true,
            {},
            $.datePicker.default,
            {
                getMomentMinDate : function () {
                    if (this.minDate == null)
                        return null;

                    if ($.isNumeric(newOption.minDate))
                        return moment().add(newOption.minDate - 1, 'd');

                    return moment(newOption.minDate);
                },
                getMomentMaxDate : function () {
                    if (newOption.maxDate == null)
                        return null;

                    if ($.isNumeric(newOption.maxDate))
                        return moment().add(newOption.maxDate, 'd');

                    return moment(newOption.maxDate);
                },
                isDisabled: function (moment, index) {
                    var momentMinDate = this.getMomentMinDate();
                    var momentMaxDate = this.getMomentMaxDate();

                    if(momentMinDate != null && moment.isBefore(momentMinDate))
                        return true;

                    if(momentMaxDate != null && moment.isAfter(momentMaxDate))
                        return true;

                    if($.isFunction(this.disabled) && this.disabled(moment))
                        return true;

                    //noinspection RedundantIfStatementJS
                    if ($.isArray(this.disabled) && this.disabled[index + 1](moment))
                        return true;

                    return false;
                },
                isHoliday: function (moment) {
                    if($.isFunction(this.holiday) && this.holiday(moment))
                        return true;

                    //noinspection RedundantIfStatementJS
                    if($.isArray(this.holiday) && 0 <= $.inArray(moment.format('YYYY-MM-DD'), newOption.holiday))
                        return true;

                    return false;
                }
            },
            option
        );

        if($.type(newOption.range) == 'string')
            newOption.range = [ newOption.range ];

        (function ($input, newOption) {

            $($input).focusin(function () {
                var $body = $('body');
                var offset = $input.offset();
                var val = moment($input.val()).format('YYYY-MM-DD');
                if(!moment($input.val()).isValid())
                    val = moment().format('YYYY-MM-DD');

                $body.append(
                    tag('div').addClass(newOption.cssClass.main).css({
                        left: 0, top: 0, right: 0, bottom: 0,
                        position: 'fixed',
                        backgroundColor: '#000',
                        opacity: 0.0005
                    }).click(function () {
                        close();
                    })
                );

                $body.append(
                    tag('div').addClass(newOption.cssClass.main).css({
                        left: offset.left, top: offset.top + $input.outerHeight(),
                        position: 'absolute',
                        border: '1px solid #cbd3d9'
                    }).append(drawCalendar($input, newOption, val, val))
                );

                if(newOption.range) {
                    var arrayMoment = getArrayMoment();
                    refreshDateForPeriod(arrayMoment);
                }

            }).keydown(function (e) {
                if(!$(this).is(":focus"))
                    close();

                if(e.keyCode === 9)
                    close();
            }).focusout(function () {
                //close();
            });

            if(newOption.range) {
                $.each(newOption.range, function (index, value) {
                    $(value).focusin(function () {
                        if($input.val())
                            $input.attr('data-range', index);

                        $input.focusin();
                    }).keydown(function (e) {
                        if(!$(this).is(":focus"))
                            close();

                        if(e.keyCode === 9)
                            close();
                    });
                });
            }

            function close() {
                $('.' + newOption.cssClass.main).remove();
                $input.attr('data-range', null);
            }

            function drawCalendar($input, newOption, selected, display) {
                var tr = tag('tr');

                var momentDisplay = moment(display);
//                var momentForPrint = moment(display).add(-Math.floor((newOption.monthCount - 1) / 2), 'M');
                var momentForPrint = moment(display);

                for(var i = 0; i < newOption.monthCount; i++){
                    tr.append(
                        tag('td')
                            .css({verticalAlign: 'top', padding: '10px'})
                            .append(drawMonth($input, newOption, selected, momentForPrint.format('YYYY-MM-DD')))
                    );
                    momentForPrint.add(1, 'M');
                }

                tr.find('>td:first table tr td.' + newOption.cssClass.prev).html(newOption.prev).css({ cursor: 'pointer' }).click(function () {
                    $(this).parents('.' + newOption.cssClass.main).empty().append(
                        drawCalendar($input, newOption, selected, momentDisplay.add(-1, 'M'))
                    );
                });
                tr.find('>td:last table tr td.' + newOption.cssClass.next).html(newOption.next).css({ cursor: 'pointer' }).click(function () {
                    $(this).parents('.' + newOption.cssClass.main).empty().append(
                        drawCalendar($input, newOption, selected, momentDisplay.add(1, 'M'))
                    );
                });
                return tag('table').addClass(newOption.cssClass.wrapper).append(tr);
            }

            function drawMonth($input, newOption, selected, display) {
                var momentSelected = moment(selected);
                var momentDisplay = moment(display);

                var $table = tag('table').addClass(newOption.cssClass.month).attr('data-date', momentDisplay.format('YYYY-MM-DD')).css({ borderCollapse: 'collapse' }).append(
                    tag('tr')
                        .append(tag('td').addClass(newOption.cssClass.prev))
                        .append(tag('td').addClass(newOption.cssClass.yearMonth).attr('colspan', '5').css({ textAlign: 'center' }).text(momentDisplay.format('YYYY-MM')))
                        .append(tag('td').addClass(newOption.cssClass.next))
                );


                if(newOption.monthCount == 1 && newOption.changeMonthYear){
                    $table.find('.' + newOption.cssClass.yearMonth).empty();
                    var $selectYear = tag('select');
                    //noinspection JSDuplicatedDeclaration
                    for(var i = momentDisplay.year() - 10; i <= momentDisplay.year() + 10; i++) {
                        if(i == momentDisplay.year()){
                            $selectYear.append(tag('option').val(i).text(i).attr('selected', 'selected'));
                        } else {
                            $selectYear.append(tag('option').val(i).text(i));
                        }
                    }
                    $selectYear.change(function () {
                        $(this).parents('.' + newOption.cssClass.main).empty().append(drawCalendar($input, newOption, selected, momentDisplay.year($(this).val())));
                    });
                    $table.find('.' + newOption.cssClass.yearMonth).append($selectYear);

                    var $selectMonth = tag('select');
                    //noinspection JSDuplicatedDeclaration
                    for(var i = 0; i < 12; i++) {
                        if(i == momentDisplay.month()) {
                            $selectMonth.append(tag('option').val(i).text(i + 1).attr('selected', 'selected'));
                        }
                        else
                        {
                            $selectMonth.append(tag('option').val(i).text(i + 1));
                        }
                    }
                    $selectMonth.change(function () {
                        $(this).parents('.' + newOption.cssClass.main).empty().append(drawCalendar($input, newOption, selected, momentDisplay.month(parseInt($(this).val()))));
                    });
                    $table.find('.' + newOption.cssClass.yearMonth).append($selectMonth);
                }

                var $trForWeekHeader = tag('tr').appendTo($table);
                //noinspection JSDuplicatedDeclaration
                for(var i = 0; i < 7; i++) {
                    $trForWeekHeader.append(tag('th').addClass(newOption.cssClass.weekdayName).addClass(newOption.cssClass.weekday[i]).text(newOption.weekdayName[i]));
                }


                var momentFirstDayOfMonth = moment(momentDisplay).startOf('month');
                var momentLastDayOfMonth = moment(momentDisplay).endOf('month');
                var firstDayOfWeek = momentFirstDayOfMonth.day();
                var lastDay = momentLastDayOfMonth.date();

                var $tr = tag('tr').appendTo($table);
                var weekday = 0;

                //noinspection JSDuplicatedDeclaration
                for(var i = 0; i < firstDayOfWeek; i++) {
                    $tr.append(tag('td').addClass(newOption.cssClass.date));
                    weekday++;
                }


                var momentForPrint = moment(momentFirstDayOfMonth);
                //noinspection JSDuplicatedDeclaration
                for(var i = 1; i <= lastDay; i++) {
                    momentForPrint.date(i);

                    var dataRange = parseInt($input.attr('data-range'));

                    var $td = tag('td')
                        .attr('data-date', momentForPrint.format('YYYY-MM-DD'))
                        .text(momentForPrint.date())
                        .addClass(newOption.cssClass.date)
                        .addClass(moment(new Date()).format('YYYY-MM-DD') == momentForPrint.format('YYYY-MM-DD') ? newOption.cssClass.today : '')
                        .addClass(momentSelected.format('YYYY-MM-DD') == momentForPrint.format('YYYY-MM-DD') ? newOption.cssClass.selected : '')
                        .addClass(newOption.cssClass.weekday[weekday])
                        .addClass(newOption.isHoliday(momentForPrint) ? newOption.cssClass.holiday : "")
                        .addClass(newOption.isDisabled(momentForPrint, isNaN(dataRange) ? -1 : dataRange) ? newOption.cssClass.disabled : "")
                        .click(function () {
                            if($(this).hasClass(newOption.cssClass.disabled))
                                return;

                            if(!newOption.range) {
                                $input.val($(this).attr('data-date'));
                                close();
                                return;
                            }

                            var range = parseInt($input.attr('data-range'));
                            if(!$input.attr('data-range')) {
                                $input.val($(this).attr('data-date'));
                                $input.attr('data-range', 0);
                                $(this).mouseenter();
                                return;
                            }

                            $(newOption.range[range]).val($(this).attr('data-date'));
                            range++;
                            $input.attr('data-range', range);
                            if(range < newOption.range.length) {
                                $(this).mouseenter();
                                return;
                            }

                            close();
                        })
                        .mouseenter(function () {
                            if($(this).hasClass(newOption.cssClass.disabled))
                                return;

                            $(this).addClass(newOption.cssClass.hover);
                            if(!newOption.range)
                                return;


                            if(newOption.range) {
                                var dataRange = parseInt($input.attr('data-range'));
                                var arrayMoment = getArrayMoment(isNaN(dataRange) ? -1 : dataRange);
                                arrayMoment.push(moment($(this).attr('data-date')));
                                refreshDateForPeriod(arrayMoment);
                            }
                        })
                        .mouseleave(function () {
                            if($(this).hasClass(newOption.cssClass.disabled))
                                return;

                            $(this).removeClass(newOption.cssClass.hover);
                        });

                    $tr.append($td);
                    weekday = (weekday + 1) % 7;
                    if(weekday == 0)
                        $tr = tag('tr').appendTo($table);
                }

                return $table;
            }

            function getArrayInput(except) {
                var array = [$input];
                if(except == -1)
                    array = [];

                $.each(newOption.range, function (index, value) {
                    if(typeof except == 'number' && except == index)
                        return;

                    array.push($(value));
                });
                return array;
            }

            function getArrayMoment(except) {
                var array = [];
                $.each(getArrayInput(except), function (index, value) {
                    var momentValue = moment($(value).val());
                    if(!momentValue.isValid())
                        return;

                    array.push(momentValue);
                });

                return array;
            }

            function refreshDateForPeriod(arrayMoment) {
                if(arrayMoment.length == 0)
                    return;

                arrayMoment.sort(moment.comparer);
                var momentFrom = arrayMoment[0];
                var momentTo = arrayMoment[arrayMoment.length - 1];

                $('.' + newOption.cssClass.main + ' .' + newOption.cssClass.date).each(function (index, value) {
                    var $date = $(value);
                    var dataDate = $date.attr('data-date');
                    if(!dataDate)
                        return;

                    var dataRange = parseInt($input.attr('data-range'));

                    var momentDate = moment(dataDate);
                    $date
                        .removeClass(newOption.cssClass.disabled)
                        .removeClass(newOption.cssClass.selected)
                        .removeClass(newOption.cssClass.start)
                        .removeClass(newOption.cssClass.between)
                        .removeClass(newOption.cssClass.point)
                        .removeClass(newOption.cssClass.end)
                        .addClass(newOption.isDisabled(momentDate, isNaN(dataRange) ? -1 : dataRange) ? newOption.cssClass.disabled : "");

                    if(moment.equalsDatePart(momentDate, momentFrom)) {
                        $date.addClass(newOption.cssClass.between).addClass(newOption.cssClass.start);
                    } else if(moment.equalsDatePart(momentDate, momentTo)) {
                        $date.addClass(newOption.cssClass.between).addClass(newOption.cssClass.end);
                    } else if(moment.isBetween(momentDate, momentFrom, momentTo)){
                        if(-1 == collectionIndexOf(arrayMoment, momentDate, moment.equalsDatePart)) {
                            $date.addClass(newOption.cssClass.between);
                        } else {
                            $date.addClass(newOption.cssClass.between).addClass(newOption.cssClass.point);
                        }
                    } else {
                        // do nothing.
                    }
                });
            }
        })($(this), newOption);
    };
})(jQuery);
