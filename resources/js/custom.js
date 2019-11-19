$(document).ready(function() {

    $('.fecha').each(function (index, dateElem) {
        var $dateElem = $(dateElem);
        var formatted = moment($dateElem.text()).locale('es').format('LL');
        $dateElem.text(formatted);
    });

    $('.navbar-toggler').on('click', function(ev) {
        ev.preventDefault();
        $('.aside-bar').toggle();
    });

    $('#expandir-horario').on('click', function(ev) {
        ev.preventDefault();
        $('body').toggleClass('no-scroll');
        $(this).toggleClass('expandir-circulo');
        setTimeout(function() {
            $('.horario').toggleClass('full-table');
            $('#expandir-horario').removeClass('expandir-circulo');
        },800);
    });

    var clases = document.getElementsByClassName('clase');
    [].forEach.call(clases, function(el) {
        if (el.children.length > 1) {
            el.classList.add('ocupado');
        }
    });

    // $('#app input[type="date"]').datepicker({
    //     language: "es",
    //     daysOfWeekDisabled: "0,6",
    //     todayHighlight: true,
    //     datesDisabled: ['12/06/2018', '12/21/2018']
    // });

    $('select:not(.not-selectize)').selectize();

    $('.dataTable').DataTable({
        "ordering": false,
        //"sDom": '<"view-filter p-4"<f>>t<>',
        "info": false,
        "paging": true,
        "language": {
            "paginate": {
                "previous": "<i class='fas fa-chevron-left'></i>",
                "next": "<i class='fas fa-chevron-right'></i>",
            },
            "search": "",
            "sSearchPlaceholder": "Descripción, nombre, código...",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "sInfo": "Mostrando <strong>_START_ a _END_</strong> de _TOTAL_ registros",
            "emptyTable": "No hay datos disponibles en la tabla",
            "sEmptyTable": "No hay datos disponibles en la tabla",
            "infoFiltered": " - filtrando de _MAX_ registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No hay registros para mostrar",
            "sInfoEmpty": "Mostrando <strong>0 a 0</strong> de 0 registros",
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
});
