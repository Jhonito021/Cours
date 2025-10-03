$(document).ready(function() {
    $('#filterTechnology, #filterLevel').on('change', function() {
        filterCours();
    })


    function filterCours() {
        const technology = $('#fileterTechnology').val();
        const level = $('$filterLevel').val();

        $('.cours-item').each(function() {
            const itemTech = $(this).data('technology');
            const itemLevel = $(this).data('level');

            const showTech = !technology || itemTech === technology;
            const showLevel = !level || itemLevel === level;

            if (showTech && showLevel) {
                $(this).show();
            } else {
                $(this).hide();
            }
        })
    };
});