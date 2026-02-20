function fetchAttendanceTable() 
{
    fetch('/OJTAttendance/public/index.php/attendances')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('.management-table tbody');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">No Data found</td></tr>';
                return;
            }

            data.forEach(row => {
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
        });
}

function getStatus(status)
{
    console.log(status);
    switch(status){
        case "3" : {
            return "PRESENT";
        }
        
        case "5" : {
            return "TIME-IN";
        }

        default : {
            return "ABSENT";
        }
    }
}

function getFirstLetter(firstname)
{
    return firstname.charAt(0).toUpperCase();
}

function getFullname(firstname, middlename, lastname)
{
    return firstname + " " + middlename + " " + lastname;
}

function returnFormattedTime(time)
{

    if (!time) {
        return "";
    }

    const [hour, minute, second] = time.split(":");
    const date = new Date();

    date.setHours(hour, minute, second);

    return date.toLocaleTimeString("en-Us", {
        hour : "2-digit",
        minute : "2-digit",
        second : "2-digit",
        hour12 : true
    });
}