function loadAttendanceScript() {
    $(document).ready(function () {
        const now = new Date();
        const currentMonth = now.getMonth() + 1;
        const currentYear = now.getFullYear();

        const monthFilter = document.getElementById("monthFilter");
        const yearFilter = document.getElementById("yearFilter");

        $("#btnAttendanceFilter").on("click", function () {
            const monthFilter = $("#monthFilter").val();
            const yearFilter = $("#yearFilter").val();
            fetchAttendanceTable(monthFilter, yearFilter);
        });

        populateYear([yearFilter]);
        defaultValueFilter([monthFilter], [yearFilter]);
        fetchAttendanceTable(currentMonth, currentYear);
    });
}

function populateYear(selectIds) {
    const START_YEAR = 1990;
    const ADVANCED_YEAR = 80;
    const currentYear = new Date().getFullYear() + ADVANCED_YEAR;

    selectIds.forEach(select => {
        if (!select) {
            return;
        }

        for (let year = currentYear; year >= START_YEAR; year--) {
            let option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            select.appendChild(option);
        }
    });
}

function defaultValueFilter(selectIdsMonth, selectIdsYear) {
    const now = new Date();

    const currentMonth = String(now.getMonth() + 1).padStart(2, '0');
    const currentYear = now.getFullYear();

    selectIdsMonth.forEach(monthId => {
        if (!monthId) {
            return;
        }
        monthId.value = currentMonth;
    });

    selectIdsYear.forEach(yearId => {
        if (!yearId) {
            return;
        }
        yearId.value = currentYear;
    });
}

async function fetchAttendanceTable(monthFilter, yearFilter) {

    try {
        const response = await fetch(`${ATTENDANCES}?month=${encodeURIComponent(monthFilter)}&year=${encodeURIComponent(yearFilter)}`, {
            method: "GET"
        });
        const result = await response.json();
        console.log(result);
        const tbody = document.querySelector('.management-table tbody');
        tbody.innerHTML = '';
        result.data.forEach(row => {
            tbody.innerHTML += `
                <tr class="row-hover">
                    <td class="table-body-cell">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#B38888]/10 flex items-center justify-center text-[#966D6D] font-serif italic font-bold">${getFirstLetter(row.firstname)}</div>
                            <div>
                                <p class="font-semibold text-gray-900 leading-none">${getFullname(row.firstname, row.middlename, row.lastname)}</p>
                            </div>
                        </div>
                    </td>
                    <td class="table-body-cell">${row.date}</td>
                    <td class="table-body-cell">${returnFormattedTime(row.timeIn)}</td>
                    <td class="table-body-cell">${returnFormattedTime(row.timeOut)}</td>
                    <td class="table-body-cell"><span class="status-chip active">${getStatus(row.status)}</span></td>
                    <td class="table-body-cell text-right">
                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                id="editEmpInfoModalBtn">
                                <i class="bi bi-printer"></i>
                            </button>
                    </td>
                </tr>
            `;
        });

    } catch (error) {
        console.log(error);
    }
}

async function exportAttendance() {
    const dateFrom = $("#dateFrom").val();
    const dateTo = $("#dateTo").val();

    try {
        const response = await fetch(`${EXPORT_ATTENDANCE}?dateFrom=${dateFrom}&dateTo=${dateTo}`, {
            method: "GET",
            credentials: "include"
        });

        const blob = await response.blob();

        const url = window.URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = "Attendance Report.pdf";
        document.body.appendChild(a);
        a.click();
        a.remove();

        window.URL.revokeObjectURL(url);
    } catch (error) {
        console.log(error);
    }
}

function getStatus(status) {
    switch (status) {
        case "3": {
            return "PRESENT";
        }

        case "5": {
            return "TIME-IN";
        }

        default: {
            return "ABSENT";
        }
    }
}

function getFirstLetter(firstname) {
    return firstname.charAt(0).toUpperCase();
}

function getFullname(firstname, middlename, lastname) {
    return firstname + " " + middlename + " " + lastname;
}

function returnFormattedTime(time) {

    if (!time) {
        return "";
    }

    const [hour, minute, second] = time.split(":");
    const date = new Date();

    date.setHours(hour, minute, second);

    return date.toLocaleTimeString("en-Us", {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: true
    });
}
