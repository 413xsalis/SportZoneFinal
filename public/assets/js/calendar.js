// calendar.js

document.addEventListener("DOMContentLoaded", () => {
    const calendarBody = document.getElementById("calendarBody");
    const monthSelector = document.getElementById("monthSelector");
    const prevButton = document.getElementById("prevMonth");
    const nextButton = document.getElementById("nextMonth");
    const dailyEventsContainer = document.getElementById("dailyEvents");
    const dailyEventsTitle = document.querySelector("#dailyEvents h5");
    const dailyEventsContent =
        dailyEventsContainer.querySelector(".list-group");
    const notificationList = document.getElementById("notificationList");
    const addFormContainer = document.getElementById("add-form-container");
    const addOptionsContainer = document.getElementById(
        "add-options-container"
    );

    let currentDate = new Date();
    let nextEventId = 1;
    let nextNotificationId = 1;

    // Funciones de utilidad para localStorage
    function loadData(key, defaultValue) {
        const storedData = localStorage.getItem(key);
        return storedData ? JSON.parse(storedData) : defaultValue;
    }

    function saveData(key, data) {
        localStorage.setItem(key, JSON.stringify(data));
    }

    // Cargar datos al inicio
    let events = loadData("events", []);
    if (events.length > 0) {
        nextEventId = Math.max(...events.map((e) => e.id)) + 1;
    }

    let notifications = loadData("notifications", []);
    if (notifications.length > 0) {
        nextNotificationId = Math.max(...notifications.map((n) => n.id)) + 1;
    }

    // Generar una notificación de asistencia diaria
    function addAttendanceNotification(grupo, subgrupo) {
        const today = new Date();
        const todayStr = `${today.getFullYear()}-${
            today.getMonth() + 1
        }-${today.getDate()}`;
        const lastAttendanceDate = localStorage.getItem("lastAttendanceDate");
        const lastAttendanceDetails = localStorage.getItem(
            "lastAttendanceDetails"
        );

        if (
            lastAttendanceDate !== todayStr ||
            lastAttendanceDetails !== `${grupo}-${subgrupo}`
        ) {
            const newNotification = {
                id: nextNotificationId++,
                title: "Asistencia Registrada",
                group: grupo,
                subgroup: subgrupo,
                text: `Asistencia registrada exitosamente del grupo ${subgrupo
                    .replace("Grupo ", "")
                    .toLowerCase()} ${grupo.toLowerCase()}, fecha ${today.toLocaleDateString()}`,
                date: new Date().getTime(),
            };
            notifications.unshift(newNotification);
            saveData("notifications", notifications);
            localStorage.setItem("lastAttendanceDate", todayStr);
            localStorage.setItem(
                "lastAttendanceDetails",
                `${grupo}-${subgrupo}`
            );
            renderNotifications();
            console.log("Notificación de asistencia creada correctamente.");
        } else {
            console.log(
                "La asistencia para este grupo y subgrupo ya ha sido registrada hoy."
            );
        }
    }

    // Renderizar las notificaciones
    function renderNotifications() {
        if (!notificationList) return;

        notificationList.innerHTML = notifications
            .map((notif) => {
                let iconClass, bgClass, textClass;
                let notificationText = notif.text;

                switch (notif.type) {
                    case "student":
                        iconClass = "bi-person-plus";
                        bgClass = "bg-success bg-opacity-10";
                        textClass = "text-success";
                        break;
                    case "reminder":
                        iconClass = "bi-bell";
                        bgClass = "bg-warning bg-opacity-10";
                        textClass = "text-warning";
                        break;
                    case "event":
                        iconClass = "bi-bell";
                        bgClass = "bg-info bg-opacity-10";
                        textClass = "text-info";
                        break;
                    case "attendance":
                        iconClass = "bi-clipboard-check";
                        bgClass = "bg-success bg-opacity-10";
                        textClass = "text-success";
                        // CORRECCIÓN: Usar los datos del objeto notif para el texto.
                        notificationText = `Asistencia registrada exitosamente del grupo ${
                            notif.group
                        } - subgrupo ${notif.subgroup}, fecha ${new Date(
                            notif.date
                        ).toLocaleDateString()}`;
                        break;
                    default:
                        iconClass = "bi-info-circle";
                        bgClass = "bg-secondary bg-opacity-10";
                        textClass = "text-secondary";
                }

                return `
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                        <div class="${bgClass} ${textClass} rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi ${iconClass}"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">${notif.title}</h6>
                            <small class="text-muted">${notificationText}</small>
                        </div>
                        <small class="ms-auto text-muted">${formatTimeAgo(
                            notif.date
                        )}</small>
                    </div>
                </a>
            `;
            })
            .join("");
    }

    function renderCalendar() {
        calendarBody.innerHTML = "";
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const lastDayOfMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        let firstDayOfWeek = new Date(year, month, 1).getDay();
        if (firstDayOfWeek === 0) firstDayOfWeek = 6;
        else firstDayOfWeek--;
        let day = 1;
        let currentRow;
        for (let i = 0; i < firstDayOfWeek; i++) {
            if (i % 7 === 0) {
                currentRow = document.createElement("div");
                currentRow.classList.add("calendar-row", "d-flex");
                calendarBody.appendChild(currentRow);
            }
            const emptyCell = document.createElement("div");
            emptyCell.classList.add(
                "calendar-day",
                "text-center",
                "p-2",
                "border"
            );
            emptyCell.style.cssText = "width: 14.28%; height: 60px;";
            currentRow.appendChild(emptyCell);
        }
        while (day <= lastDayOfMonth) {
            if ((firstDayOfWeek + day - 1) % 7 === 0) {
                currentRow = document.createElement("div");
                currentRow.classList.add("calendar-row", "d-flex");
                calendarBody.appendChild(currentRow);
            }
            const dayCell = document.createElement("div");
            dayCell.classList.add(
                "calendar-day",
                "text-center",
                "p-2",
                "border"
            );
            dayCell.style.cssText =
                "width: 14.28%; height: 60px; cursor: pointer;";
            dayCell.dataset.day = day;
            const hasEvent = events.some(
                (e) => e.day === day && e.month === month + 1 && e.year === year
            );
            const isToday =
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear();
            dayCell.innerHTML = `
                <div class="d-flex flex-column h-100">
                    <div class="day-number ${
                        isToday
                            ? "bg-primary text-white rounded-circle d-inline-block mx-auto"
                            : ""
                    }"
                        style="width: 24px; height: 24px; line-height: 24px;">
                        ${day}
                    </div>
                    ${
                        hasEvent
                            ? '<div class="event-indicator mt-auto"><span class="badge bg-success rounded-pill" style="font-size: 6px;">●</span></div>'
                            : ""
                    }
                </div>
            `;
            dayCell.addEventListener("click", () => {
                const selectedDay = parseInt(dayCell.dataset.day);
                renderDailyEvents(selectedDay, month + 1, year);
                document
                    .querySelectorAll(".calendar-day.active")
                    .forEach((cell) => cell.classList.remove("active"));
                dayCell.classList.add("active");
            });
            currentRow.appendChild(dayCell);
            day++;
        }
        const monthString = currentDate.toISOString().slice(0, 7);
        monthSelector.value = monthString;
    }

    function renderDailyEvents(
        selectedDay,
        selectedMonth,
        selectedYear,
        eventToEdit = null
    ) {
        const today = new Date();
        const isToday =
            selectedDay === today.getDate() &&
            selectedMonth === today.getMonth() + 1 &&
            selectedYear === today.getFullYear();
        const dailyEvents = events.filter(
            (e) =>
                e.day === selectedDay &&
                e.month === selectedMonth &&
                e.year === selectedYear
        );

        let titleText = `Actividades para el ${selectedDay}/${selectedMonth}/${selectedYear}`;
        if (isToday) {
            titleText = "Actividades para hoy";
        }
        dailyEventsTitle.textContent = titleText;

        let eventsHtml = "";
        if (eventToEdit) {
            eventsHtml = `
            <form id="editEventForm" class="p-3 border rounded shadow-sm" data-event-id="${
                eventToEdit.id
            }">
                <h6 class="mb-3">Editar actividad</h6>
                <div class="mb-3">
                    <label for="editTitle" class="form-label">Título</label>
                    <input type="text" class="form-control" id="editTitle" value="${
                        eventToEdit.title
                    }" required>
                </div>
                <div class="mb-3">
                    <label for="editTime" class="form-label">Horario</label>
                    <input type="time" class="form-control" id="editTime" value="${
                        eventToEdit.time
                    }" required>
                </div>
                <div class="mb-3">
                    <label for="editLocation" class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="editLocation" value="${
                        eventToEdit.location
                    }" required>
                </div>
                <div class="mb-3">
                    <label for="editStatus" class="form-label">Estado</label>
                    <select class="form-select" id="editStatus" required>
                        <option value="Confirmado" ${
                            eventToEdit.status === "Confirmado"
                                ? "selected"
                                : ""
                        }>Confirmado</option>
                        <option value="Cancelado" ${
                            eventToEdit.status === "Cancelado" ? "selected" : ""
                        }>Cancelado</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="cancelEditBtn">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                </div>
            </form>
        `;
        } else if (dailyEvents.length > 0) {
            eventsHtml = dailyEvents
                .map((event) => {
                    const statusColor =
                        event.status === "Confirmado"
                            ? "text-success"
                            : "text-danger";
                    const statusIcon =
                        event.status === "Confirmado"
                            ? "bi-check-circle"
                            : "bi-x-circle";
                    return `
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="me-3">
                        <h6 class="mb-1 d-flex justify-content-between align-items-center">
                            ${event.title}
                            <small class="ms-3 text-muted">${event.time}</small>
                        </h6>
                        <p class="mb-1 text-muted">${event.location}</p>
                        <small class="${statusColor}"><i class="bi ${statusIcon}"></i> ${event.status}</small>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary edit-event-btn" data-event-id="${event.id}">
                        <i class="bi bi-pencil"></i>
                    </button>
                </a>
            `;
                })
                .join("");
        } else {
            eventsHtml = `
            <div class="alert alert-info" role="alert">
                No hay actividades para este día.
            </div>
        `;
        }

        dailyEventsContent.innerHTML = eventsHtml;

        // --- LÓGICA DE MANEJO DE FORMULARIO ---

        if (eventToEdit) {
            const editForm = document.getElementById("editEventForm");
            const cancelBtn = document.getElementById("cancelEditBtn");

            editForm.addEventListener("submit", (e) => {
                e.preventDefault();
                const eventId = parseInt(e.currentTarget.dataset.eventId);
                updateEvent(eventId, selectedDay, selectedMonth, selectedYear);
            });

            cancelBtn.addEventListener("click", () => {
                renderDailyEvents(selectedDay, selectedMonth, selectedYear);
            });
        }

        if (addOptionsContainer) {
            if (!eventToEdit) {
                addOptionsContainer.style.display = "block";
                addFormContainer.innerHTML = "";
                const showActivityBtn = document.getElementById(
                    "showActivityFormBtn"
                );
                const showReminderBtn = document.getElementById(
                    "showReminderFormBtn"
                );

                if (showActivityBtn) {
                    showActivityBtn.addEventListener("click", () => {
                        addFormContainer.innerHTML = renderActivityForm();
                        document
                            .getElementById("addEventForm")
                            .addEventListener("submit", (e) => {
                                e.preventDefault();
                                addEvent(
                                    selectedDay,
                                    selectedMonth,
                                    selectedYear
                                );
                            });
                        document
                            .getElementById("closeActivityFormBtn")
                            .addEventListener("click", () => {
                                addFormContainer.innerHTML = "";
                            });
                    });
                }

                if (showReminderBtn) {
                    showReminderBtn.addEventListener("click", () => {
                        addFormContainer.innerHTML = renderReminderForm();
                        document
                            .getElementById("addReminderForm")
                            .addEventListener("submit", (e) => {
                                e.preventDefault();
                                addReminder(
                                    selectedDay,
                                    selectedMonth,
                                    selectedYear
                                );
                            });
                        document
                            .getElementById("closeReminderFormBtn")
                            .addEventListener("click", () => {
                                addFormContainer.innerHTML = "";
                            });
                    });
                }
            } else {
                addOptionsContainer.style.display = "none";
            }
        }

        document.querySelectorAll(".edit-event-btn").forEach((button) => {
            button.addEventListener("click", (e) => {
                const eventId = parseInt(e.currentTarget.dataset.eventId);
                const eventToEdit = events.find(
                    (event) => event.id === eventId
                );
                renderDailyEvents(
                    selectedDay,
                    selectedMonth,
                    selectedYear,
                    eventToEdit
                );
            });
        });
    }

    // Función para generar el HTML del formulario de actividad
    function renderActivityForm() {
        return `
            <form id="addEventForm" class="p-3 border rounded shadow-sm position-relative">
                <h6 class="mb-3">Agregar nueva actividad</h6>
                <span id="closeActivityFormBtn" class="close-btn position-absolute top-0 end-0 me-2 mt-1" style="cursor: pointer; font-size: 1.5rem; color: #6c757d;">&times;</span>
                <div class="mb-3">
                    <label for="eventTitle" class="form-label">Título</label>
                    <input type="text" class="form-control" id="eventTitle" required>
                </div>
                <div class="mb-3">
                    <label for="eventTime" class="form-label">Horario</label>
                    <div class="input-group">
                        <input type="time" class="form-control" id="eventTime" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="eventLocation" class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="eventLocation" placeholder="Ej: Cancha 2" required>
                </div>
                <div class="mb-3">
                    <label for="eventStatus" class="form-label">Estado</label>
                    <select class="form-select" id="eventStatus" required>
                        <option value="Confirmado">Confirmado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar actividad</button>
            </form>
        `;
    }

    // Función para generar el HTML del formulario de recordatorio
    function renderReminderForm() {
        return `
            <form id="addReminderForm" class="p-3 border rounded shadow-sm position-relative">
                <h6 class="mb-3">Agregar nuevo recordatorio</h6>
                <span id="closeReminderFormBtn" class="close-btn position-absolute top-0 end-0 me-2 mt-1" style="cursor: pointer; font-size: 1.5rem; color: #6c757d;">&times;</span>
                <div class="mb-3">
                    <label for="reminderDescription" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="reminderDescription" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar recordatorio</button>
            </form>
        `;
    }

    // Nueva función para agregar un recordatorio (similar a addEvent)
    function addReminder(day, month, year) {
        const description = document.getElementById(
            "reminderDescription"
        ).value;

        const newNotification = {
            id: nextNotificationId++,
            title: `Recordatorio para el día ${day}/${month}/${year}`,
            text: description,
            type: "reminder",
            date: new Date().getTime(),
        };

        notifications.unshift(newNotification);
        saveData("notifications", notifications);
        renderNotifications();

        document.getElementById("add-form-container").innerHTML = "";
    }

    function addEvent(day, month, year) {
        const title = document.getElementById("eventTitle").value;
        const time = document.getElementById("eventTime").value;
        const location = document.getElementById("eventLocation").value;
        const status = document.getElementById("eventStatus").value;

        const newEvent = {
            id: nextEventId++,
            day,
            month,
            year,
            title,
            time,
            location,
            status,
        };
        events.push(newEvent);
        saveData("events", events);

        renderDailyEvents(day, month, year);
        renderCalendar();
        renderNotifications();
    }

    function formatTimeAgo(timestamp) {
        const now = new Date().getTime();
        const seconds = Math.floor((now - timestamp) / 1000);

        let interval = seconds / 31536000;
        if (interval > 1)
            return `Hace ${Math.floor(interval)} año${
                Math.floor(interval) > 1 ? "s" : ""
            }`;
        interval = seconds / 2592000;
        if (interval > 1)
            return `Hace ${Math.floor(interval)} mes${
                Math.floor(interval) > 1 ? "es" : ""
            }`;
        interval = seconds / 86400;
        if (interval > 1)
            return `Hace ${Math.floor(interval)} día${
                Math.floor(interval) > 1 ? "s" : ""
            }`;
        interval = seconds / 3600;
        if (interval > 1)
            return `Hace ${Math.floor(interval)} hora${
                Math.floor(interval) > 1 ? "s" : ""
            }`;
        interval = seconds / 60;
        if (interval > 1)
            return `Hace ${Math.floor(interval)} minuto${
                Math.floor(interval) > 1 ? "s" : ""
            }`;
        return "Justo ahora";
    }

    function updateEvent(eventId, day, month, year) {
        const title = document.getElementById("editTitle").value;
        const time = document.getElementById("editTime").value;
        const location = document.getElementById("editLocation").value;
        const status = document.getElementById("editStatus").value;

        const eventToUpdate = events.find((event) => event.id === eventId);
        if (eventToUpdate) {
            eventToUpdate.title = title;
            eventToUpdate.time = time;
            eventToUpdate.location = location;
            eventToUpdate.status = status;
        }

        saveData("events", events);
        renderCalendar();
        renderDailyEvents(day, month, year);
    }

    function initializeDailyEventsSection() {
        dailyEventsTitle.textContent = "Actividades para hoy";
        dailyEventsContent.innerHTML = `
            <div class="alert alert-info" role="alert">
                Selecciona una fecha en el calendario para ver o agregar actividades.
            </div>
        `;
        document
            .querySelectorAll(".calendar-day.active")
            .forEach((cell) => cell.classList.remove("active"));
    }

    // Manejadores de eventos
    prevButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
        initializeDailyEventsSection();
    });

    nextButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
        initializeDailyEventsSection();
    });

    monthSelector.addEventListener("change", (e) => {
        const [year, month] = e.target.value.split("-");
        currentDate = new Date(year, month - 1, 1);
        renderCalendar();
        initializeDailyEventsSection();
    });

    // CORRECCIÓN: Separar la lógica de verificación en una función para reutilizarla
    function checkAttendanceNotification() {
        const attendanceSaved = localStorage.getItem("attendanceSaved");
        const attendanceGroup = localStorage.getItem("attendanceGroup");
        const attendanceSubgroup = localStorage.getItem("attendanceSubgroup");

        if (attendanceSaved && attendanceGroup && attendanceSubgroup) {
            addAttendanceNotification(attendanceGroup, attendanceSubgroup);

            // MUY IMPORTANTE: Limpiar los datos después de crear la notificación
            localStorage.removeItem("attendanceSaved");
            localStorage.removeItem("attendanceGroup");
            localStorage.removeItem("attendanceSubgroup");
        }
    }

    // Llamadas iniciales
    renderCalendar();
    initializeDailyEventsSection();
    renderNotifications();

    // CORRECCIÓN: Llamar a la función de verificación de asistencia cuando la ventana recupera el foco
    window.addEventListener("focus", () => {
        checkAttendanceNotification();
    });

    // CORRECCIÓN: Llamar a la función también en la carga inicial de la página
    checkAttendanceNotification();
});
