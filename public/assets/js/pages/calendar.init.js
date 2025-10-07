(function ($) {
    "use strict";

    function CalendarPage() {}

    CalendarPage.prototype.init = function () {
        var $eventModal = $("#event-modal"),
            $modalTitle = $("#modal-title"),
            $formEvent = $("#form-event"),
            currentEvent = null,
            selectedDate = null,
            validationForms = document.getElementsByClassName("needs-validation"),
            today = new Date(),
            day = today.getDate(),
            month = today.getMonth(),
            year = today.getFullYear();

        // External events draggable
        new FullCalendarInteraction.Draggable(document.getElementById("external-events"), {
            itemSelector: ".external-event",
            eventData: function (el) {
                return {
                    title: el.innerText,
                    className: $(el).data("class")
                };
            }
        });

        // Initial events
        var initialEvents = [
        ];

        var calendarEl = document.getElementById("calendar");

        function showAddEventModal(info) {
            $eventModal.modal("show");
            $formEvent.removeClass("was-validated");
            $formEvent[0].reset();
            $("#event-title").val("");
            $("#event-category").val("");
            $modalTitle.text("Add Event");
            selectedDate = info;
            currentEvent = null;
        }

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ["bootstrap", "interaction", "dayGrid", "timeGrid"],
            editable: true,
            droppable: true,
            selectable: true,
            defaultView: "dayGridMonth",
            themeSystem: "bootstrap",
            header: {
            left: false,
            center: "title",
            right: "today prev,next"
            },
            eventClick: function (info) {
            $eventModal.modal("show");
            $formEvent[0].reset();
            currentEvent = info.event;
            $("#event-title").val(currentEvent.title);
            $("#event-category").val(currentEvent.classNames[0]);
            $modalTitle.text("Edit Event");
            selectedDate = null;
            },
            dateClick: function (info) {
            showAddEventModal(info);
            },
            events: initialEvents,
            locale: 'id' // Bahasa Indonesia
        });

        calendar.render();

        $formEvent.on("submit", function (e) {
            e.preventDefault();
            var title = $("#event-title").val(),
                category = $("#event-category").val();

            if (!validationForms[0].checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                validationForms[0].classList.add("was-validated");
            } else {
                if (currentEvent) {
                    currentEvent.setProp("title", title);
                    currentEvent.setProp("classNames", [category]);
                } else {
                    var newEvent = {
                        title: title,
                        start: selectedDate.date,
                        allDay: selectedDate.allDay,
                        className: category
                    };
                    calendar.addEvent(newEvent);
                }
                $eventModal.modal("hide");
            }
        });

        $("#btn-delete-event").on("click", function () {
            if (currentEvent) {
                currentEvent.remove();
                currentEvent = null;
                $eventModal.modal("hide");
            }
        });

        $("#btn-new-event").on("click", function () {
            showAddEventModal({ date: new Date(), allDay: true });
        });
    };

    $.CalendarPage = new CalendarPage();
    $.CalendarPage.Constructor = CalendarPage;
})(window.jQuery);

(function () {
    "use strict";
    window.jQuery.CalendarPage.init();
})();
